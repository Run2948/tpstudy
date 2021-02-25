<?php

namespace app\controller;
//use app\model\One;
//
//class Inject
//{
//    protected $one;
//
//    public function __construct(One $one)
//    {
//        $this->one = $one;
//    }
//
//    public function index()
//    {
//        return $this->one->name;
//    }
//}

use think\Controller;
use think\facade\Hook;
use think\Request;

class Inject extends Controller
{

//    protected $middleware = ['Auth'];

    protected $middleware = [
        'Auth' => ['only' => ['index', 'test']],
        'Check' => ['except' => ['bhv', 'read']],
    ];

    public function index(Request $request)
    {
//        bind('one', 'app\model\One');

//        $one = app('one');

        //每次调用总是会重新实例化
//        $one = app('one', true);

//        return $one->name;

//        return app('app\model\One')->name;

//        bind([
//            'one' => 'app\model\One',
//            'user' => 'app\model\User'
//        ]);

//        bind([
//            'one' => \app\model\One::class,
//            'user' => \app\model\User::class
//        ]);

//        return app('one')->name;

        // 来自中间件的值
//        return $request->middle_name;
        return \think\facade\Request::param('middle_name');
    }

    public function test()
    {
        $test = new \app\common\Test();
//        return $test->hello('world!');

        return \app\facade\Test::hello('Mr.Lee');
    }

    public function bhv()
    {
        //钩子
        Hook::listen('eat', '吃饭');
    }

    public function read($id)
    {
        return 'inject read: ' . $id;
    }
}