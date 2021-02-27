<?php


namespace app\controller;


use think\facade\Session;

class Sundry
{
    public function index()
    {

    }

    public function sess()
    {

        // 初始化
        Session::init([
            'prefix' => 'tp',
            'auto_start' => true,
        ]);

        Session::set('user', 'Mr.Lee');

        dump($_SESSION);
        dump(Session::get());
        dump(Session::get('user'));

        dump(Session::has('user'));
        Session::delete('user');

//        echo $_SESSION['think']['user'];

        Session::prefix('tp');

        echo Session::pull('user');

        Session::clear();
        Session::clear('think');

        // 设置闪存数据，只请求一次有效的情况
        Session::flash('user','Mr.Lee');
        echo Session::pull('user');
        echo Session::pull('user');
        Session::flush();

    }
}