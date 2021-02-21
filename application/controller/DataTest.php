<?php

namespace app\controller;

use app\model\User;
use think\Controller;
use think\Db;
use think\db\exception\DataNotFoundException;

class DataTest extends Controller
{
    public function index()
    {
//        $data = Db::table('tp_user') -> find();
//        return Db::getLastSql();

//        $data = Db::table('tp_user') -> where('id', 127) -> find();

//        try {
//            $data = Db::table('tp_user')->where('id', 127)->findOrFail();
//        } catch (DataNotFoundException $e) {
//            return "查询不到数据";
//        }

//        $data = Db::table('tp_user') -> where('id', 27) -> selectOrFail();

//        $data = Db::name('user') -> where('id', 27) -> selectOrFail();

//        $data = \db('user') -> selectOrFail();
//        $data = \db('user') -> where('id', 27) -> value('username');
//        $data = \db('user') -> column('username');
//        $data = \db('user') -> column('username','id');

//        $data = \db('user') -> field('id,username') -> select();

//        $data = Db::name('user') -> where('id',27) -> order('id','desc') -> find();

        $user = Db::name('user');

        $data1 = $user->where('id', 27)->order('id', 'desc')->find();
//        $data2 = $user -> select();
        $data2 = $user->removeOption('where')->removeOption('order')->select();

        return json($data2);
    }

    public function getNoModelData()
    {
        $data = Db::table('tp_user')->select();
        return json($data);
    }

    public function getModelData()
    {
        $data = User::select();
//        return json($data);
    }


    public function insert()
    {
        $data = [
            'username' => '辉夜',
            'password' => '123',
            'gender' => '女',
            'email' => 'huiye@163.com',
            'price' => 90,
            'details' => '123',
            'create_time' => date('Y-m-d H:i:s')
        ];
//        $flag = Db::name('user')->insert($data);

//        $flag = Db::name('user')->data($data)->insert();
//        if ($flag) return "新增成功！";

//        $id = Db::name('user')->insertGetId($data);

        $arr = [
            [
                'username' => '辉夜 1',
                'password' => '123',
                'gender' => '女',
                'email' => 'huiye@163.com',
                'price' => 90,
                'details' => 123,
                'create_time' => date('Y-m-d H:i:s')
            ],
            [
                'username' => '辉夜 2',
                'password' => '123',
                'gender' => '女',
                'email' => 'huiye@163.com',
                'price' => 90,
                'details' => 123,
                'create_time' => date('Y-m-d H:i:s')
            ],
        ];
        Db::name('user')->insertAll($arr);
    }


    public function update()
    {
        $data = [
            'username' => '李白',
        ];

//        $update = Db::name('user')->where('id', 38)->update($data);
//        $update = Db::name('user')->where('id', 38)->data($data) -> update(['password' => '456']);

//        $update =  Db::name('user')->inc('price')->dec('price', 3)->update($data);
//        $update = Db::name('user')->where('id', 38)->exp('email', 'UPPER(email)')->update($data);

        $data2 = [
            'username' => '李白',
            'email' => Db::raw('UPPER(email)'),
            'price' => Db::raw('price - 3'),
            'id' => 38
        ];
//        $update = Db::name('user')->update($data2);

//        $update = Db::name('user')->where('id', 38)->setField('username', '辉夜');

        $update = Db::name('user')->where('id', 38)->setInc('price');
        return $update;
    }

    public function delete()
    {
//        $delete = Db::name('user')->delete(51);

//        $delete = Db::name('user')->delete([48, 49, 50]);

        // 删除表中所有数据
//        $delete = Db::name('user')->delete(true);

        $delete = Db::name('user')->where('id', 47)->delete();
        return $delete;
    }
}