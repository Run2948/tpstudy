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
//        $result = UserModel::select();

//        return json($result);

//        $user = UserModel::get(81);
//        $user = UserModel::where('username', '辉夜')->find();
//        echo $user->username;

//        $user = new UserModel();
//        echo $user->getUserName();
//

//        $user = UserModel::all('79, 118, 128');
//        $user = UserModel::all([79, 118, 128]);

//        $user = UserModel::where('gender', '男')->order('id', 'asc')->limit(2)->select();

//         $user = UserModel::where('id', 79)->value('username');
//         $user = UserModel::whereIn('id',[79,118,128])->column('username','id');

//        $user = UserModel::getByUsername('辉夜');
//        $user = UserModel::getByEmail('huiye@163.com');

//        $user = UserModel::max('price');
//        return json($user);

//        $user = UserModel::get(21);
//        echo $user -> status;
//        echo $user -> nothing;
//        // 获取原始值
//        echo $user -> getData('status');
//
//        dump($user->getData());
//        dump($user);
//
//        return json($user);

//        $result = UserModel::WithAttr('email', function ($value) {
//            return strtoupper($value);
//        })->select();
//        return json($result);

        $result = UserModel::WithAttr('status', function ($value) {
            $status = [-1 => '删除', 0 => '禁用', 1 => '正常', 2 => '待审核'];
            return $status[$value];
        })->select();
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

    public function update()
    {
//        $user = UserModel::get(118);
//        $user->username = '李黑';
//        $user->email = 'lihei@163.com';
//        $user->save();

//        $user = UserModel::where('username', '李黑')->find();
//        $user->username = '李白';
//        $user->email = 'libai@163.com';

//        $user->save();
//        $user->force()->save();
        //显示更新
//        $user->isUpdate(true)->save();
        //显示新增
//        $user->isUpdate(false)->save();

//        $user->price = Db::raw('price+1');

//        $user->price = ['inc', 1];

//        $user->save([
//            'username' => '李黑',
//            'email' => 'lihei@163.com'
//        ], ['id' => 118]);

//        $list = [
//            ['id'=>118, 'username'=>'李白', 'email'=>'libai@163.com'],
//            ['id'=>128, 'username'=>'李白', 'email'=>'libai@163.com'],
//            ['id'=>129, 'username'=>'李白', 'email'=>'libai@163.com']
//        ];
//        $user = new UserModel();
//        $user->saveAll($list);


//        UserModel::where('id', 118)->update([
//            'username' => '李黑',
//            'email' => 'lihei@163.com'
//        ]);

//        UserModel::update([
//            'id' => 118,
//            'username' => '李黑',
//            'email' => 'lihei@163.com'
//        ]);
    }


}