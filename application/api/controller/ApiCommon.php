<?php 
namespace app\api\controller;

use think\Controller;
use think\Request;

class ApiCommon extends Controller 
{
	public $param;

    public $authResult;

    public $apiAuth;

    /**
     * 返回的资源类的
     * @var string
     */
    protected $restTypeList = 'json';

    /**
     * REST允许输出的资源类型列表
     * @var array
     */
    protected $restOutputType = [ 
        'json' => 'application/json',
    ];    

    /**
     * 控制器初始化操作
     */
	public function _initialize()
	{
		parent::_initialize();

        $this->init();

        // 行为绑定
        $this->apiAuth && $this->authResult = \think\Hook::add('action_begin','app\\common\\behavior\\SignatureBehavior');	
	}

    /**
     * 初始化方法 
     * 检测请求类型，数据格式等操作
     */
    protected function init()
    {
        $this->apiAuth = false;
        $this->authResult = false;
        $param =  Request::instance()->param();           
        $this->param = $param;
    }
    
    protected function object_array($array) 
    {  
        if (is_object($array)) {  
            $array = (array)$array;  
        } 
        if (is_array($array)) {  
            foreach ($array as $key=>$value) {  
                $array[$key] = $this->object_array($value);  
            }  
        }  
        return $array;  
    }
}