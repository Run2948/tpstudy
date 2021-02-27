<?php


namespace app\controller;


use think\facade\Cookie;
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

    public function cookie()
    {
        Cookie::prefix('tp_');

//        Cookie::set('user', 'Mr.Lee');
        Cookie::set('users', ['zs','ls','ww'],3600);
//        Cookie::set('user', 'Mr.Lee', 3600);
//        Cookie::set('user', 'Mr.Lee', [
//            'prefix' => 'tp_',
//            'expire' => 3600
//        ]);

        // 永久（10年）
        Cookie::forever('user', 'Mr.Lee');

//        Cookie::has('user');

//        Cookie::get('user');
//        Cookie::get('users');

//        Cookie::delete('user');

//        Cookie::clear('tp_');

        //输出
//        echo cookie('user');
        dump(cookie('users'));
        //设置
//        cookie('user', 'Mr.Lee', 3600);
        //删除
//        cookie('user', null);
        //清除
//        cookie(null, 'tp_');
    }
}