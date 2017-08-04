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
    '__pattern__' => [
        'name' => '\w+',
    ],
    '[hello]'     => [
        ':id'   => ['index/hello', ['method' => 'get'], ['id' => '\d+']],
        ':name' => ['index/hello', ['method' => 'post']],
    ],
    // 添加路由规则 路由到 index控制器的hello操作方法
    // 'hello/[:name]' => 'index/index/hello',

    //路由到Blob控制器
 //   'blog/:year/:month' => ['blog/archive', ['method' => 'get'], ['year' => '\d{4}', 'month' => '\d{2}']],
//    'blog/:id'          => ['blog/get', ['method' => 'get'], ['id' => '\d+']],
 //   'blog/:name'        => ['blog/read', ['method' => 'get'], ['name' => '\w+']],
    '[blog]' => [
        ':year/:month' => ['blog/archive', ['method' => 'get'], ['year' => '\d{4}', 'month' => '\d{2}']],    
        ':id'          => ['blog/get', ['method' => 'get'], ['id' => '\d+']],
        ':name'        => ['blog/read', ['method' => 'get'], ['name' => '\w+']],
    ],

];
