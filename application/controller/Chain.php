<?php

namespace app\controller;

use think\Controller;
use think\Db;

class Chain extends Controller
{
    public function index()
    {
//        $result = Db::name('user')->where([
//            'gender' => '男',
//            'price' => 100 //'price' => [60,70,80]
//        ])->select();

//        $result = Db::name('user')->where([
//            ['gender', '=', '男'],
//            ['price', '=', '100']
//        ])->select();

//        $map[] = ['gender', '=', '男'];
//        $map[] = ['price', 'in', [60, 70, 80]];
//        $result = Db::name('user')->where($map)->select();

//        $result = Db::name('user')->where('gender="男" AND price IN (60, 70, 80)')->select();


//        $result = Db::name('user')->field('id, username, email')->select();
//        $result = Db::name('user')->field(['id', 'username', 'email'])->select();

//        $result = Db::name('user')->field('id,username as name')->select();
//        $result = Db::name('user')->field(['id', 'username' => 'name'])->select();

//        $result = Db::name('user')->field('id,SUM(price)')->select();

//        $result = Db::name('user')->field(['id', 'LEFT(email, 5)' => 'leftemail'])->select();

//        $result = Db::name('user')->field(true)->select();

//        $result = Db::name('user')->field('details,email', true)->select();
//        $result = Db::name('user')->field(['details,email'], true)->select();


        $data = [
            'username' => '辉夜',
            'password' => '123',
            'gender' => '女',
            'email' => 'huiye@163.com',
            'price' => 90,
            'details' => '123',
            'create_time' => date('Y-m-d H:i:s')
        ];
        $result = Db::name('user')->field('username, email, details')->insert($data);

        return json($result);
    }

    public function other()
    {
//        $result = Db::name('user')->limit(5)->select();

//        $result = Db::name('user')->limit(2, 5)->select();

        //第一页
//        $result = Db::name('user')->limit(0, 5)->select();
        //第二页
//        $result = Db::name('user')->limit(5, 5)->select();

        //第一页
//        $result = Db::name('user')->limit(0, 5)->select();
        //第二页
//        $result = Db::name('user')->limit(5, 5)->select();


//        $result = Db::name('user')->field('gender, sum(price)')->group('gender')->select();
//        $result = Db::name('user')->field('gender, sum(price)')->group('gender,password')->select();

        $result = Db::name('user')
            ->field('gender, sum(price)')
            ->group('gender')
            ->having('sum(price)>600')
            ->select();

        return json($result);
    }
}