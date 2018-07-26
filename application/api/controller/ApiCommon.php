<?php 
namespace app\api\controller;

use think\Controller;
use think\Request;

class ApiCommon extends Controller 
{
	public $param;

	public function _initialize()
	{
		parent::_initialize();
		
        $param =  Request::instance()->param();           
        $this->param = $param;
	}
    
    public function object_array($array) 
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