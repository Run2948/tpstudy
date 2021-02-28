<?php

namespace app\controller;

use app\model\User as UserModel;
use app\model\Profile as ProfileModel;

class Grade
{
    public function index()
    {
//        $user = UserModel::get(19);
//        return json($user->profile);

        // 关联修改
//        $user->profile->save(['hobby'=>'酷爱小姐姐']);
        // 关联新增
//        $user->profile()->save(['hobby'=>'不喜欢吃青椒']);

//        return $user->profile->hobby;
//        return json($user->profile()->where('id', '>', 10)->select());

//        $users = UserModel::has('profile', '>=', 2)->select();
//        $users = UserModel::hasWhere('profile', ['status' => 1])->select();
//        return json($users);

        // 关联新增，批量新增
//        $user = UserModel::get(19);
//        $user->profile()->save(['hobby' => '测试喜好', 'status' => 1]);
//        $user->profile()->saveAll([
//            ['hobby' => '测试喜好', 'status' => 1],
//            ['hobby' => '测试喜好', 'status' => 1]
//        ]);

        // 关联删除
        $user = UserModel::get(227, 'profile');
        $user->together('profile')->delete();
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

    public function union()
    {
        // 在普通的关联查询下，我们循环数据列表会执行 n+1 次 SQL 查询
//        $list = UserModel::all([19, 20, 21]);
//        foreach ($list as $user) {
//            dump($user->profile);
//        }

        // 果采用关联预载入的方式，将会减少到两次
//        $list = UserModel::with('profile')->all([19, 20, 21]);
//        foreach ($list as $user) {
//            dump($user->profile);
//        }

//        $list = UserModel::with('profile,book')->all([19, 20, 21]);
//        foreach ($list as $user) {
//            dump($user->profile.$user->book);
//        }

//        $list = UserModel::all([19, 20, 21], 'profile,book');

//        $list = UserModel::withJoin('profile')->all([19, 20, 21]);
//        $list = UserModel::withJoin(['profile' => function ($query) {
//            $query->withField('hobby');
//        }])->all([19, 20, 21]);
//        $list = UserModel::withJoin(['profile' => ['hobby']])->all([19, 20, 21]);

        // 延迟加载
        $list = UserModel::all([19, 20, 21]);
        $list->load('profile');
        foreach ($list as $user) {
            dump($user->profile);
        }
    }
}