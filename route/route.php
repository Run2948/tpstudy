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


//Route::get('/', 'index');

//Route::get('/address/details/:id', 'address/details');
//Route::rule('/address/details/:id', 'address/details', 'GET');
//Route::rule('/address/details/:id', 'address/details', 'POST');
//Route::rule('/address/details/:id', 'address/details', 'GET|POST');

//Route::pattern([
//    'id' => '\d+',
//    'uid' => '\d+'
//]);

//静态路由
//Route::get('/address/ad', 'address/index');
//静态动态结合的地址
//Route::get('/address/details/:id', 'address/details')->name('det')->pattern('id', '\d+');
//多参数静态动态结合的地址
//Route::get('/address/search/:id/:uid', 'address/search')->pattern([
//    'id' => '\d+',
//    'uid' => '\d+'
//]);
//全动态地址，不限制是否 search 固定
//Route::get('/address/:search/:id/:uid', 'address/search');
//包含可选参数的地址
//Route::get('/address/find/:id/[:content]', 'address/find');
//规则完全匹配的地址
//Route::get('/address/search/:id/:uid$', 'address/search');

//Route::get('/address/details-<id>', 'address/details')->pattern('id', '\d+');

//Route::get('/details-:name-:id', ':name/details')->pattern('id', '\d+');


//支持多级路由  /group.address/details/id/5
//Route::get('details/:id', 'group.Address/details');

//Route::get('details', 'group.Address/index?flag=1&status=2');

//Route::get('details', 'app\controller\group\Address@index');

//Route::get('stat', 'app\controller\group\Address::stat');

// 路由重定向
//Route::get('details/:id', 'http://www.liyanhui.com/details/:id')->status(302);
//Route::redirect('details/:id', 'http://www.liyanhui.com/details/:id', 302);

// 路由模版传值
//Route::view('see/:name', 'See/other');
//Route::view('see/:name', 'See/other', ['email'=>'huiye@163.com']);

//Route::get('details/:id','Address/details',['ext' => 'html']);
//Route::get('details/:id','Address/details',['ext' => 'html|shtml']);
//Route::get('details/:id','Address/details')->ext('html');

//Route::get('details/:id','Address/details',['ext' => 'html','https' => true]);
//Route::get('details/:id','Address/details')->ext('html')->https();

//Route::get('details/:id', 'Address/details')->denyExt('gif|jpg|png');

//Route::get('details/:id', 'address/details')->filter('id', 10);

// /user/19
//Route::get('user/:id', 'address/getUser')->model('id', '\app\model\User');

//Route::option('ext', 'html');
//Route::option('ext', 'html')->option('https', true);

//Route::controller('short', 'Short');

//Route::group('col', [
//    ':id' => 'Collect/read',
//    ':name' => 'Collect/who'
//])->ext('html')->pattern(['id' => '\d+$', 'name' => '\w+$']);

//Route::group('col', function () {
//    Route::get(':id', 'Collect/read');
//    Route::get(':name', 'Collect/who');
//})->ext('html')->pattern(['id' => '\d+$', 'name' => '\w+$']);

//Route::group('col', function () {
//    Route::get(':id', 'read');
//    Route::get(':name', 'who');
//})->prefix('Collect/')
//    ->ext('html')
//    ->pattern(['id' => '\d+$', 'name' => '\w+$']);

//Route::miss('error/miss');

//Route::group('col', function () {
//    Route::get(':id', 'read');
////    Route::get(':name', 'who');
//    Route::miss('miss');
//})->prefix('Collect/')
//    ->ext('html')
//    ->pattern(['id' => '\d+$', 'name' => '\w+$']);

// 跨域请求
//Route::get('col/:id', 'Collect/read')
//    ->ext('html')
//    ->allowCrossDomain();

// 想限制跨域请求的域名
//Route::get('col/:id', 'Collect/read')
//    ->ext('html')
//    ->header('Access-Control-Allow-Origin','http://localhost')
//    ->allowCrossDomain();

//Route::bind('admin');
//Route::bind('index/User');
//Route::bind('index/User/read');

//Route::get('user/:id','User/read');

// /index/user/edit/id/5 ->  /user/edit/id/5
//Route::alias('user','index/User');
//Route::alias('user','\app\index\controller\User');

//Route::alias('user', 'index/User', ['ext' => 'html']);
//Route::alias('user', 'index/User')->ext('html');

//Route::resource('blog', 'Blog');
Route::resource('blog', 'Blog')
    //相应的 delete($blog_id);
//    ->vars(['blog'=>'blog_id']);
//    ->only(['index','save','create'])
    ->except(['read', 'delete', 'update']);

Route::resource('blog.comment', 'Comment');
//Route::resource('blog.comment', 'Comment')->vars(['blog'=>'blog_id']);

//Route::domain('news', function () {
//    Route::get('edit/:id', 'Collect/edit');
//});
//Route::domain('news', [
//    'edit/:id' => ['Collect/edit']
//]);
//Route::domain('news.abc.com', [
//    'edit/:id' => ['Collect/edit']
//]);

//Route::domain(['news', 'blog', 'live'], function () {
//    Route::get('edit/:id', 'Collect/edit');
//});

//Route::domain('news', 'admin');
//Route::domain('news.abc.com', 'admin');
//Route::domain('127.0.0.1', 'admin');

Route::domain('*.news', [
    'edit/:id' => ['Collect/edit']
]);

Route::domain('*', [
    'edit/:id' => ['Collect/edit']
]);

return [

];
