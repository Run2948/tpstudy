<?php

namespace app\controller;

use think\Db;

class Search
{
    public function index()
    {
//        $result = Db::name('user') -> where('id',80) -> select();
//        $result = Db::name('user') -> where('id','=',80) -> select();
//        $result = Db::name('user') -> where('id','<',80) -> select();
//        $result = Db::name('user') -> where('id','<>',80) -> select();

//        $result = Db::name('user')->where('email', 'like', 'xiao%')->select();
//        $result = Db::name('user')->where('email', 'like', ['xiao%', 'wu%'], 'or')->select();

//        $result = Db::name('user')->whereLike('email', 'xiao%')->select();
//        $result = Db::name('user')->whereNotLike('email', 'xiao%')->select();

//        $result = Db::name('user')->whereBetween('id',[19, 25])->select();
//        $result = Db::name('user')->whereIn('id','19,21,29')->select();
//        $result = Db::name('user')->whereNull('uid')->select();

//        $result = Db::name('user')->where('id','exp','IN (19,21,25)')->select();
        $result = Db::name('user')->whereExp('id', 'IN (19,21,25)')->select();
        return json($result);
    }

    public function time()
    {
//        $result = Db::name('user')->where('create_time', '> time', '2018-1-1')->select();
//        $result = Db::name('user')->where('create_time', 'between time', ['2018-1-1', '2019-12-31'])->select();

//        $result = Db::name('user')->whereTime('create_time', '>', '2018-1-1')->select();
//        $result = Db::name('user')->whereBetweenTime('create_time', '2018-1-1', '2019-12-31')->select();

        // 默认大于时间
//        $result = Db::name('user')->whereTime('create_time', '2018-1-1')->select();

        // 当日数据
//        $result = Db::name('user')->whereTime('create_time','d')->select();
        // 本月数据
//        $result = Db::name('user')->whereTime('create_time','m')->select();
        // 本年数据
//        $result = Db::name('user')->whereTime('create_time','y')->select();
        // 2小时内的数据
        $result = Db::name('user')->whereTime('create_time', '-2 hour')->select();
        return json($result);
    }
}