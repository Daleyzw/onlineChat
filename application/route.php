<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

return [
    // MISS路由
    // '__miss__'  => 'error/index/miss',
    '[hello]'     => [
        ':id'   => ['index/hello', ['method' => 'get'], ['id' => '\d+']],
        ':name' => ['index/hello', ['method' => 'post']],
    ],
    // 添加专家
    'api/export/create' => ['api/export/create', ['method' => 'POST']],
    // 修改专家
    'api/export/update' => ['api/export/update', ['method' => 'PUT']],
    // 删除专家
    'api/export/delete' => ['api/export/delete', ['method' => 'DELETE']],
    // 测试路由
    'api/index/test' => ['api/index/test', ['method' => 'GET']],
    
    '__pattern__' => [
        'name' => '\w+',
    ],
];
