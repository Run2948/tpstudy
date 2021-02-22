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


    public function insert()
    {
//        $user = new \app\model\User();
        $user = new UserModel();

//        $user->username = '李白';
//        $user->password = '123';
//        $user->gender = '男';
//        $user->email = 'libai@163.com';
//        $user->price = 100;
//        $user->details = '123';
//        $user->uid = 1011;
//        $user->create_time = date('Y-m-d H:i:s');
//        $user->save();
//        echo $user -> id;

//        $insert = $user->save([
//            'username' => '李白',
//            'password' => '123',
//            'gender' => '男',
//            'email' => 'libai@163.com',
//            'price' => 100,
//            'details' => '123',
//            'uid' => 1011,
//            'create_time' => date('Y-m-d H:i:s')
//        ]);
//        echo $insert;

        $dataAll = [
            [
                'username' => '李白 1',
                'password' => '123',
                'gender' => '男',
                'email' => 'libai@163.com',
                'price' => 100,
                'details' => '123',
                'uid' => 1011,
                'create_time' => date('Y-m-d H:i:s')
            ],
            [
                'username' => '李白 2',
                'password' => '123',
                'gender' => '男',
                'email' => 'libai@163.com',
                'price' => 100,
                'details' => '123',
                'uid' => 1011,
                'create_time' => date('Y-m-d H:i:s')
            ]
        ];
        print_r($user->saveAll($dataAll));
    }

    public function delete()
    {
//        $user = UserModel::get(93);
//        print_r($user -> delete());

//        UserModel::destroy(93);

//        UserModel::destroy('80, 90, 91');
//        UserModel::destroy([80, 90, 91]);

//        UserModel::where('id', '>', 80)->delete();

        UserModel::destroy(function ($query) {
            $query->where('id', '>', 80);
        });
    }
}