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

Route::get('think', function () {
    return 'hello,ThinkPHP5!';
});

//Route::get('hello/:name', function ($name) {
//    return 'Hello,' . $name;
//});

Route::get('hello/:name', 'index/hello');


Route::get('/', 'index');

//Route::get('/address/details/:id', 'address/details');
//Route::rule('/address/details/:id', 'address/details', 'GET');
//Route::rule('/address/details/:id', 'address/details', 'POST');
//Route::rule('/address/details/:id', 'address/details', 'GET|POST');

//Route::pattern([
//    'id' => '\d+',
//    'uid' => '\d+'
//]);

//静态路由
Route::get('/address/ad', 'address/index');
//静态动态结合的地址
Route::get('/address/details/:id', 'address/details')->name('det')->pattern('id', '\d+');
//多参数静态动态结合的地址
Route::get('/address/search/:id/:uid', 'address/search')->pattern([
    'id' => '\d+',
    'uid' => '\d+'
]);
//全动态地址，不限制是否 search 固定
Route::get('/address/:search/:id/:uid', 'address/search');
//包含可选参数的地址
Route::get('/address/find/:id/[:content]', 'address/find');
//规则完全匹配的地址
Route::get('/address/search/:id/:uid$', 'address/search');

Route::get('/address/details-<id>', 'address/details')->pattern('id', '\d+');

Route::get('/details-:name-:id', ':name/details')->pattern('id', '\d+');

return [

];
