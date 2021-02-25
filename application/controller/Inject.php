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

class Inject
{
    public function index()
    {
//        bind('one', 'app\model\One');

//        $one = app('one');

        //每次调用总是会重新实例化
//        $one = app('one', true);

//        return $one->name;

//        return app('app\model\One')->name;

        bind([
            'one' => 'app\model\One',
            'user' => 'app\model\User'
        ]);

        bind([
            'one' => \app\model\One::class,
            'user' => \app\model\User::class
        ]);

        return app('one')->name;
    }

    public function test()
    {
        $test = new \app\common\Test();
//        return $test->hello('world!');

        return \app\facade\Test::hello('Mr.Lee');
    }
}