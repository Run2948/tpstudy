<?php

namespace app\controller;

use think\Controller;

class Block extends Controller
{
    public function index()
    {
        $this->assign('title', '模版');
        return $this -> fetch();
    }
}