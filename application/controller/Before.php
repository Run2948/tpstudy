<?php

namespace app\controller;

use think\Controller;

class Before extends Controller
{
    protected $beforeActionList = [
        'first',
        // one 方法执行不调用 second 前置方法
        'second' => ['except' => 'one'],
        // third 前置只能通过调用 one 和 two 方法触发
        'third' => ['only' => 'one,two']
    ];

    protected function first()
    {
        echo 'first</br>';
    }

    protected function second()
    {
        echo 'second</br>';
    }

    protected function third()
    {
        echo 'third</br>';
    }

    // 空方法拦截
    public function _empty($name)
    {
        return $name . " Method Not Found";
    }

    protected $flag = true;

    public function index()
    {
        if ($this->flag) {
            // 如果不指定 url，则返回$_SERVER['HTTP_REFERER']
            $this->success('操作成功！', '../');
        } else {
            // 自动返回前一页
            $this->error('操作失败！');
        }

        return 'index';
    }

    public function one()
    {
        return 'one';
    }

    public function two()
    {
        return 'two';
    }
}