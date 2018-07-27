<?php
// +----------------------------------------------------------------------
// | Description: 签名认证
// +----------------------------------------------------------------------
// | Author:  yangjiecheng <yangjiecheng@boyuntong.com>
// +----------------------------------------------------------------------
namespace app\common\behavior;
use think\Request;

class SignatureBehavior
{

    private $_params;
    public $timeOut;
    public $algo;


    public function __construct()
    {
        header('Content-Type:application/json; charset=utf-8');
        if ($this->timeOut === null ) {
            $this->timeOut = config('requestTimeOut');
        }
        
        if ($this->algo === null ) {
            $this->algo = config('algo');
        }
    }

    public function run(&$content)
    {
        $params = $this->getParams();
        // 参数完整性验证
        if (!isset($params['_key'])
            || !isset($params['_sign'])
            || !isset($params['_time'])
            || !isset($params['_nonce'])
            || strlen($params['_nonce']) !== 32
            || !is_numeric($params['_time'])
        ) {

            exit(json_encode(['code' => 101, 'data' => '', 'error' => '请求参数不全, 或参数不规范']));
        }

        if(Yii::$app->params['app_key'] !== $params['_key']) {
            exit(json_encode(['code' => 101, 'data' => '', 'error' => '非法的app_key']));
        }

        if (!isset($params['_time']) || $this->getIsTimeOut($params['_time'])) {

            exit(json_encode(['code' => 101, 'data' => '', 'error' => '请求超时']));
        }

        $requestSignature = $params['_sign'];
        $requestSignature = str_replace(' ', '+', $requestSignature);
        // 签名验证
        $toSignString = $this->getNormalizedString($params);
        $signature = $this->getSignature($toSignString, Yii::$app->params['app_secret']);
        if ($requestSignature != $signature) {

            exit(json_encode(['code' => 101, 'data' => '', 'error' => '签名错误']));
        }

        return true;
    }

    protected function getParams()
    {
        if (!$this->_params) {
            $this->_params = Request::instance()->param(); //input('post.')
        }

        return $this->_params;
    }

    protected function getNormalizedString($params)
    {
        if (isset($params['_sign'])) {
            unset($params['_sign']);
        }
        ksort($params);
        $normalized = array();
        foreach($params as $key => $val)
        {
            $normalized[] = $key."=".$val;
        }

        return implode("&", $normalized);
    }

    protected function getSignature($str, $key)
    {
        return hash_hmac($this->algo, $str, $key, false);
    }
}