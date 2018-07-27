<?php
namespace app\api\controller;

class Export extends ApiCommon
{
	// 添加专家
	public function create()
	{
        if(request()->isPost()){

            // $param = input('post.');
            file_put_contents('test.json', json_encode($this->param));
            return ['code' => 300, 'data' => '', 'msg' => '请上传头像'];
            exit;
            // 检测头像
            if(empty($param['user_avatar'])){
            }

            if(empty($param['group_id'])){
                return ['code' => 300, 'data' => '', 'msg' => '请选择分组'];
            }

            $has = db('users')->field('id')->where('user_name', $param['user_name'])->find();
            if(!empty($has)){
                return json(['code' => 300, 'data' => '', 'msg' => '该专家已经存在']);
            }

            $param['user_pwd'] = md5($param['user_pwd'] . config('salt'));
            $param['online'] = 2; // 离线状态

            try{
                $lastInsID = db('users')->insert($param, false, true);
            }catch(\Exception $e){
                return ['code' => 300, 'data' => '', 'error' => $e->getMessage()];
            }

            return ['code' => 200, 'data' => ['export_id' => $lastInsID], 'msg' => '添加专家成功'];
        }
	}
}
