<?php
namespace app\api\controller;

class Export extends ApiCommon
{
	// 添加专家
	public function create()
	{
        if(request()->isPost()){

            // $param = input('post.');
            $param = $this->param;
            // 检测头像
            if(empty($param['user_avatar'])){
                $param['user_avatar'] = '/static/default-face.jpg';
            }

            if(empty($param['group_id'])){
                return ['code' => 300, 'data' => '', 'error' => '请选择分组'];
            }

            $has = db('users')->field('id')->where('user_name', $param['user_name'])->find();
            if(!empty($has)){
                return json(['code' => 300, 'data' => '', 'error' => '该专家已经存在']);
            }

            $param['user_pwd'] = md5($param['user_pwd'] . config('salt'));
            $param['online'] = 2; // 离线状态
            $param['status'] = 1;
            $param['create_time'] = $param['update_time'] = time();
            file_put_contents(RUNTIME_PATH . '/test.json', json_encode($param));
            try{
                $lastInsID = db('users')->insert($param, false, true);
            }catch(\Exception $e){
                return ['code' => 300, 'data' => '', 'error' => $e->getMessage()];
            }

            return ['code' => 200, 'data' => ['export_id' => $lastInsID], 'error' => '添加专家成功'];
        }
	}

    // 修改专家
    public function update()
    {

    }
}
