<?php
namespace app\index\controller;

use think\Controller;

class Index extends Controller
{
    public function index()
    {
        if (isset($_SESSION['uid'])) {
            $uid = $_SESSION['uid'];
        } else {
            $uid = uniqid();
        }
        $this->assign([
            'uid' => $uid,
            'uname' => '匿名用户-' . $uid,
        ]);

        return $this->fetch();
    }

    // pc客户端
    public function chat()
    {
        // 跳转到移动端
        if(request()->isMobile()){
            $param = http_build_query([
                'id' => input('param.id'),
                'name' => input('param.name'),
                'group' => input('param.group'),
                'avatar' => input('param.avatar'),
                'kfid' => input('param.kfid'),
            ]);
            $this->redirect('/index/index/mobile?' . $param);
        }
        $this->assign([
            'socket' => config('socket'),
            'id' => input('param.id'),
            'name' => input('param.name'),
            'group' => input('param.group'),
            'avatar' => input('param.avatar'),
            'kfid' => input('param.kfid'),
        ]);
        
        return $this->fetch();
    }

    // 移动客户端
    public function mobile()
    {
        $this->assign([
            'socket' => config('socket'),
            'id' => input('param.id'),
            'name' => input('param.name'),
            'group' => input('param.group'),
            'avatar' => input('param.avatar'),
        ]);

        return $this->fetch();
    }
}
