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

    public function other()
    {
//        $result = Db::name('user')->count();
//        $result = Db::name('user')->count('uid');

//        $result = Db::name('user')->max('price');
//        $result = Db::name('user')->max('price',false);

//        $result = Db::name('user')->min('price');
//        $result = Db::name('user')->avg('price');
//        $result = Db::name('user')->sum('price');

//        $subQuery = Db::name('user') -> fetchSql(true) -> select();
//        $subQuery = Db::name('user') -> buildSql(true);

//        $subQuery = Db::name('two')->field('uid')->where('gender', '男')->buildSql(true);
//        $result = Db::name('one')->where('id', 'exp', 'IN ' . $subQuery)->select();

//        $result = Db::name('one')->where('id', 'in', function ($query) {
//            $query->name('two')->where('gender', '男')->field('uid');
//        })->select();
//
//        return json($result);

        $result = Db::query('select * from tp_user');
//        $result = Db::execute('update tp_user set username="孙悟空" where id=29');

//        return $result;
    }
}