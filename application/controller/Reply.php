<?php


namespace app\controller;

use think\Controller;

//class Reply extends Controller
//{
//    public function index()
//    {
//        return $this->request->param('name');
//    }
//}


//use think\Request;
//class Reply extends Controller
//{
//    public function index(Request $req)
//    {
//        return $req->param('name');
//    }
//}

//use think\Request;
//class Reply
//{
//    protected $request;
//
//    public function __construct(Request $request)
//    {
//        $this->request = $request;
//    }
//
//    public function index()
//    {
//        return $this->request->param('name');
//    }
//}


use think\facade\Request;
use think\facade\Url;

class Reply
{
    public function index()
    {
        echo Request::url() . '<br/>';
        echo Request::url(true) . '<br/>';

        dump(Request::has('id', 'get'));
        dump(Request::has('username', 'post'));


        //获取请求为 name 的值，过滤
        dump(Request::param('name'));
        //获取所有请求的变量，以数组形式，过滤
        dump(Request::param());
        //获取所有请求的变量(原始变量)，不包含上传变量，不过滤
        dump(Request::param(false));
        //获取所有请求的变量，包含上传变量，过滤
        dump(Request::param(true));


        dump(Request::method());
        // 在判断请求，使用 method(true)可以获取原始请求，否则获取伪装请求
        dump(Request::method(true));
        dump(Request::isGet());
        dump(Request::isPost());
        dump(Request::isPut());


        dump(Request::isAjax());

        dump(Request::header());
        dump(Request::header('host'));


        return Request::param('name');
    }

    public function read(\think\Request $request)
    {
        return $request->name;
    }

    public function edit($id)
    {
        echo $id . '<br/>';
        dump(Request::param());
        dump(Request::param('id'));

        dump(Request::route()); // 路由请求不支持 get 变量
        dump(Request::route('id')); // 路由请求不支持 get 变量

        dump(Request::get('id'));   // get 变量不支持路由请求
        dump(Request::get());   // get 变量不支持路由请求

        // 默认值
        dump(Request::param('name', 'nodata'));

        // 过滤函数
        dump(Request::param('name', '', 'htmlspecialchars'));
        dump(Request::param('name', '', 'strtoupper'));

        // 仅获取指定变量
        dump(Request::only('id,name'));
        dump(Request::only(['id', 'name']));
        dump(Request::only(['id' => 1, 'name' => 'nodata']));
        dump(Request::only(['id', 'name'], 'post'));

        // 排除某些变量
        dump(Request::except('id,name'));
        dump(Request::except(['id', 'name']));
        dump(Request::except(['id' => 1, 'name' => 'nodata']));
        dump(Request::except(['id', 'name'], 'post'));

        // 强制指定参数的类型
        dump(Request::param('id/d'));
        dump(Request::param('name/s'));

        // Request 助手函数
        dump(input('?get.id')); //判断 get 下的 id 是否存在
        dump(input('?post.name')); //判断 post 下的 name 是否存在
        dump(input('param.name')); //获取 param 下的 name 值
        dump(input('param.name', 'nodata')); //默认值
        dump(input('param.name', '', 'htmlspecialchars')); //过滤器
        dump(input('param.id/d')); //设置强制转换
    }

    public function url()
    {
        return Url::build() . ' ' . Request::ext();
    }

    public function get($id, $name)
    {
        return 'get: id=' . $id . ', name=' . $name;
    }

    public function res()
    {
        $data = 'Hello, World';
//        return response($data,201);
//        return response($data)->code(202);
        return response($data)->code(202)->header(['Cache-control' => 'no-cache,must-revalidate']);
    }

    public function red()
    {
//        return redirect('http://www.baidu.com');

//        return redirect('edit/5');

//        return redirect('/address/details/id/5');

        return redirect('/address/details')->params(['id' => 5]);
    }

    public function image()
    {
        return download('static/img/timg.jpg', '大圣归来.jpg');
    }

    public function text()
    {
        $data = '这是一个测试文件';
        return download($data, 'test.txt', true);
    }
}


//class Reply
//{
//    public function index()
//    {
//        return request()->param('name');
//    }
//}