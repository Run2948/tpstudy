<?php

namespace app\controller;

use think\Controller;

class See extends Controller
{
    public function index()
    {
        // 使用助手函数 view()方法，无需继承 Controller
//        return view('edit');

        //自动定位
        return $this->fetch();

//        return $this->fetch('edit'); //指定模版
//        return $this->fetch('public/edit'); //指定目录下的模版
//        return $this->fetch('admin@public/edit'); //指定模块下的模版
//        return $this->fetch('/edit'); //view_path 下的模版
    }
}