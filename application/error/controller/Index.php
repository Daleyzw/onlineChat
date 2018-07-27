<?php 

namespace app\error\controller;

use think\Request;

class Index extends \think\Controller
{
	// miss 路由：处理没有匹配到的路由规则
	public function miss()
	{
		throw new \think\exception\HttpException(404, '走错路了');
		
	}	
}
