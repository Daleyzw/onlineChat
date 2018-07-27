<?php
namespace app\api\controller;

class Index extends ApiCommon
{
    public function test()
    {
		return ['code' => 108, 'error' => 'Test Api'];
    }

}
