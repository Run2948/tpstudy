<?php

namespace app\controller;

use think\Controller;

class Block extends Controller
{
    public function index()
    {
        $this->assign('title', '模版');
        $this->view->engine->layout(true);
        return $this->fetch();
    }

    public function extend()
    {
        $this->assign('title', '模版继承');
        return $this->fetch();
    }

    public function other()
    {
        $this->assign('name', 'ThinkPHP');
        $this->assign('demo_time',time());
        return $this->fetch();
    }
}