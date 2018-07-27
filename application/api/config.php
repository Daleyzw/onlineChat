<?php
//配置文件
$config =  [
    // cookie有效时长
    'cookie_save_time' => 30 * 86400,
    // 请求超时时间
    'requestTimeOut' => 300,
    'algo' => 'sha256',
    'user.accessTokenExpire' => 7200,
    'user.refreshTokenExpire' => 7200 + 600,
    'api_url' => 'http://online.chart.org/api/',
    'api_username' => 'admin',
    'api_password' => 'cbb2fc826b6cbb2305cca827529b739b',
    'app_key' => 'Ss8nwI!0^**c4FKH',
    'app_secret' => 'UPFGh13QMFUbF1GIDVs9wbYmNCRd5LN8',

    // 默认输出类型
    'default_return_type'    => 'json',
    // 默认AJAX 数据返回格式,可选json xml ...
    'default_ajax_return'    => 'json',
    // 默认JSONP格式返回的处理方法
    'default_jsonp_handler'  => 'jsonpReturn',
];


return $config;