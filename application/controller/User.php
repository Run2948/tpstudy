<?php

namespace app\controller;
//use app\model\User;
use app\model\User as UserModel;
use think\Controller;
use think\Db;

class User extends Controller
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

//        $result = UserModel::WithAttr('status', function ($value) {
//            $status = [-1 => '删除', 0 => '禁用', 1 => '正常', 2 => '待审核'];
//            return $status[$value];
//        })->select();

//        $result = UserModel::withSearch(['email', 'create_time'], [
//            'email' => 'xiao',
//            'create_time' => ['2014-1-1', '2017-1-1']
//        ])->select();

//        $result = UserModel::withSearch(['email', 'create_time'], [
//            'email' => 'xiao',
//            'create_time' => ['2014-1-1', '2017-1-1']
//        ])->where('gender', '女')->select();


//        $result = UserModel::withSearch(['email', 'create_time'], [
//            'email' => 'xiao',
//            'create_time' => ['2014-1-1', '2017-1-1'],
//            'sort' => ['price' => 'desc']
//        ])->select();


//        $result = UserModel::withSearch(['email', 'create_time' => 'ctime'], [
//            'email' => 'xiao',
//            'ctime' => ['2014-1-1', '2017-1-1']
//        ])->select();

//        echo Db::getLastSql();

        $result = UserModel::where('id', 111)->select();
//        if ($result->isEmpty()) {
//            return '没有数据！';
//        }

//        $result->hidden(['password'])->append(['nothing'])->withAttr('email', function ($value) {
//            return strtoupper($value);
//        });

//        $result = UserModel::select()->filter(function ($data) {
//            return $data['price'] > 100;
//        });
//        $result = UserModel::select()->where('price', '>', '100');

//        $result = UserModel::select()->order('price', 'desc');
//        return json($result);

        $result1 = UserModel::where('price', '>', '80')->select();
        $result2 = UserModel::where('price', '<', '100')->select();
//        return json($result1->diff($result2));
        return json($result2->intersect($result1));
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

    public function typeConversion()
    {
        $user = UserModel::get(21);

        var_dump($user->price);
        var_dump($user->status);
        var_dump($user->create_time);
    }

    public function queryScope()
    {
//        $result = UserModel::scope('gendermale')->select();
//        $result = UserModel::genderMale()->select();

//        $result = UserModel::emailLike('xiao') -> priceGreater(80) -> select();

        $result = UserModel::useGlobalScope(false)->emailLike('xiao')->priceGreater(80)->select();
        echo Db::getLastSql();
        return json($result);
    }

    public function view()
    {
        $user = UserModel::get(21);
        $this->assign('user', $user);
        return $this->fetch();
    }

    public function output()
    {
        $user = UserModel::get(21);
//       print_r($user -> toArray());
//        print_r($user->hidden(['password'])->toArray());

//        print_r(UserModel::select()->toArray());
        print_r($user->toJson());
    }

    public function json()
    {
        $data = [
            'username' => '辉夜',
            'password' => '123',
            'gender' => '女',
            'email' => 'huiye@163.com',
            'price' => 90,
//            'details' => '123',
            'details' => ['content' => 123],
            'uid' => 1011,
            'status' => 1,
            'list' => ['username' => '辉夜', 'gender' => '女', 'email' => 'huiye@163.com'],
        ];
//        Db::name('user')->insert($data);
//        Db::name('user')->json(['details'])->insert($data);


//        $user = Db::name('user')->json(['list','details'])->where('id', 173)->find();
//        return json($user);

//        $user = Db::name('user')->json(['list','details'])->where('list->username', '辉夜')->find();
//        return json($user);

//        $data['list'] = ['username' => '李白', 'gender' => '男'];
//        Db::name('user')->json(['list'])->where('id', 174)->update($data);

//        $data['list->username'] = '李黑';
//        Db::name('user')->json(['list'])->where('id', 174)->update($data);
    }

    public function modelJson()
    {
//        $user = new UserModel();
//        $user->username = '李白';
//        $user->password = '123';
//        $user->gender = '男';
//        $user->email = 'libai@163.com';
//        $user->price = 100;
//        $user->status = 1;
//        $user->details = ['content' => 123];
//        $user->list = ['username' => '辉夜', 'gender' => '女', 'email' => 'huiye@163.com', 'uid' => 1011];
//        $user->save();

//        $user = UserModel::get(179);
//        return $user->list->username;

//        $user = UserModel::where('list->username', '辉夜')->find();
//        return $user->list->email;

        $user = UserModel::get(179);
        $user->list->username = '李白';
        $user->save();
    }

    public function softDelete()
    {
//        Db::name('user')->where('id', 192)->useSoftDelete('delete_time', date('Y-m-d H:i:s'))->delete();
//        return Db::getLastSql();

//        $user = UserModel::get(194);
//        // 软删除
//        $user -> delete();
//        // 真实删除
//        $user -> delete(true);

//        $user = UserModel::select();
//        return json($user);

//        $user = UserModel::withTrashed()->select();
//        return json($user);

//        $user = UserModel::onlyTrashed()->select();
//        return json($user);

//        $user = UserModel::onlyTrashed()->find();
//        $user->restore();

        $user = UserModel::onlyTrashed()->get(193);
//        $user->restore();
        $user->delete(true);
    }
}