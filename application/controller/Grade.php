<?php

namespace app\controller;

use app\model\User as UserModel;
use app\model\Profile as ProfileModel;

class Grade
{
    public function index()
    {
        $user = UserModel::get(19);
//        return json($user->profile);

        // 关联修改
        $user->profile->save(['hobby'=>'酷爱小姐姐']);
        // 关联新增
        $user->profile()->save(['hobby'=>'不喜欢吃青椒']);

        return $user->profile->hobby;
    }

    public function belong()
    {
//        $profile = ProfileModel::get(1);
////        return json($profile->user);
//        return $profile->user->email;

        //参数一表示的是 User 模型类的 profile 方法，而非 Profile 模型类
//        $user = UserModel::hasWhere('profile', ['id' => 2])->find();
//        return json($user);

        //采用闭包，这里是两张表操作，会导致 id 识别模糊，需要指明表
        $user = UserModel::hasWhere('profile', function ($query) {
            $query->where('Profile.id', 2);
        })->select();
        return json($user);
    }
}