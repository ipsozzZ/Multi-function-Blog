<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

/**
 * 动态路由方法配置路由，这种定义的方法必须放在配置定义路由的上边
 * 格式 ：路由表达式（必填） + 路由地址（必填）+ 路由参数（数组，选填）+ 变量规则（数组，选填）
 * 最终url是由主机名+路由表达式组成
 * 在路由表达式中 用:value表示动态地址，如果加了[:value]表示这个变量可有可无
 */
use think\Route;
Route::rule('/','index/index/index');
Route::rule('about/:id','index/page/index','get','',['id'=>'\d+']);
//Route::rule('pictures/list/:id','index/pictures/index','get','',['id'=>'\d+']);
//Route::rule('pictures/show/:id','index/pictures/show','get','',['id'=>'\d+']);
//Route::rule('news/list/:id','index/news/index','get','',['id'=>'\d+']);
//Route::rule('news/show/:id','index/news/show','get','',['id'=>'\d+']);
Route::rule('contact/:id','index/contact/index','get','',['id'=>'\d+']);

// 具有相同前缀的
Route::group('pictures',[
    'list/:id'   => ['index/pictures/index', ['method' => 'get'], ['id' => '\d+']],
    'show/:id' => ['index/pictures/show', ['method' => 'get'],['id' => '\d+']],
]);
Route::group('news',[
    'list/:id'   => ['index/news/index', ['method' => 'get'], ['id' => '\d+']],
    'show/:id' => ['index/news/show', ['method' => 'get'],['id' => '\d+']],
]);

/**
 *  配置定义路由法，实质就是返回个数组
 * 格式 ：路由表达式（必填） + 路由地址（必填）+ 路由参数（数组，选填）+ 变量规则（数组，选填）
 * 用:value表示动态地址，如果加了[]表示这个变量可有可无
 * 只有必填项时，可以只用一个字符串就可以，如果还有选填项时就要用数组了
 */
return [
    /*'__pattern__' => [
        'name' => '\w+',
    ],
    '[hello]'     => [
        ':id'   => ['index/hello', ['method' => 'get'], ['id' => '\d+']],
        ':name' => ['index/hello', ['method' => 'post']],
    ],*/
//    'page/[:id]' => 'index/page/index',
//    'page/[:id]' => ['index/page/index',['method'=>'get'],['id'=>'\d+']],
//    'pictures/[:id]' => 'index/pictures/index',
//    'show/[:id]' => 'index/pictures/show',
];
