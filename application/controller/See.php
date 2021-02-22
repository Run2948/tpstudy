<?php

namespace app\controller;

use think\Controller;

class See extends Controller
{
    protected function initialize()
    {
//        parent::initialize();

        $this->filter(function ($content) {
            return str_replace("1", '<br/>', $content);
        });
    }

    public function index()
    {
        // 使用助手函数 view()方法，无需继承 Controller
//        return view('edit');

        //自动定位
//        return $this->fetch();

//        return $this->fetch('edit'); //指定模版
//        return $this->fetch('public/edit'); //指定目录下的模版
//        return $this->fetch('admin@public/edit'); //指定模块下的模版
//        return $this->fetch('/edit'); //view_path 下的模版

//        $this->assign('name', 'ThinkPHP'); //{$name}
//        return $this->fetch();

//        $this->assign([
//            'username' => '辉夜', //{$username}
//            'email' => 'huiye@163.com' //{$email}
//        ]);
//        return $this->fetch();

//        return $this->fetch('index', [
//            'username' => '辉夜',
//            'email' => 'huiye@163.com'
//        ]);

//        return view('index', [
//            'username' => '辉夜',
//            'email' => 'huiye@163.com'
//        ]);

//        return view('index')->assign([
//            'username' => '辉夜',
//            'email' => 'huiye@163.com'
//        ]);

//        return $this->filter(function ($content) {
//            return str_replace("1", '<br/>', $content);
//        })->fetch();

        return view()->filter(function($content){
            return str_replace("1",'<br/>',$content);
        });
    }

    public function testDisplay()
    {
        $content = '{$username}.{$email}';
        return $this->display($content, [
            'username' => '辉夜',
            'email' => 'huiye@163.com'
        ]);
    }

}