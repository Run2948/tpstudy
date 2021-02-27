<?php


namespace app\controller;


use think\Controller;
use think\Db;

class Page extends Controller
{
    public function index()
    {
        //查找 user 表所有数据，每页显示 5 条
        $list = Db::name('user')->paginate(5, 10)->each(function ($item, $key) {
            $item['gender'] = '【' . $item['gender'] . '】';
            return $item;
        });

//        return json($list);

        $this->assign('list', $list);

        // 获取分页显示
//        $page = $list->render();
//        echo $list->total();
//        echo $list->currentPage();
//        echo $list->count();
//        $this->assign('page', $page);

        return $this->fetch();
    }
}