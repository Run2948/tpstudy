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

        $data1 = $user -> where('id',27) -> order('id','desc') -> find();
//        $data2 = $user -> select();
        $data2 = $user -> removeOption('where') -> removeOption('order') -> select();

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


}