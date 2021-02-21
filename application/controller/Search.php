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
}