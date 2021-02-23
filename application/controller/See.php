<?php

namespace app\controller;

use think\Controller;
use app\model\User as UserModel;

class See extends Controller
{
    protected function initialize()
    {
//        parent::initialize();

//        $this->filter(function ($content) {
//            return str_replace("1", '<br/>', $content);
//        });
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

        return view()->filter(function ($content) {
            return str_replace("1", '<br/>', $content);
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

    public function testVar()
    {
        $this->assign('name', 'ThinkPHP');

        $data['username'] = '辉夜';
        $data['email'] = 'huiye@163.com';
        $this->assign('user', $data);

        $obj = new \stdClass();
        $obj->username = '辉夜';
        $obj->email = 'huiye@163.com';
        $this->assign('obj', $obj);

        $this->assign('password', '123456');

        $this->assign('time', time());

        $this->assign('number', '14');

        return $this->fetch('var');
    }

    public function testLoop()
    {
        $list = UserModel::all();
        $this->assign('list', $list);
        return $this->fetch('user');
    }

    public function testCompare()
    {
        $this->assign('username', 'Mr.Lee');
        $this->assign('number', 10);

        return $this->fetch('compare');
    }

    public function testCondition()
    {
        $this->assign('number', 10);
        $user = new \stdClass();
        $user->name = 'Mr.Lee';
        $this->assign('user', $user);
        return $this->fetch('condition');
    }

    public function other()
    {
        $this->assign('name','ThinkPHP');
        return $this->fetch();
    }
}