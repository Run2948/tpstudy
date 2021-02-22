<?php

namespace app\controller;
//use app\model\User;
use app\model\User as UserModel;
use think\Db;

class User
{
    public function index()
    {
//        $result = \app\model\User::select();
//        $result = User::select();
//        $result = UserModel::select();


        // 根据主键 id 删除
//        $result = UserModel::destroy(81);
        // 根据 uid 主键删除
//        $result = UserModel::destroy(1081);

//        $result = Db::name('user') -> select();
        $result = UserModel::select();

        return json($result);
    }
}