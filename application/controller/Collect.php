<?php

namespace app\controller;

use think\Controller;


class Collect extends Controller
{
    public function index()
    {
        echo Url::build('Blog'); // /collect/blog.html
        echo Url::build('Blog/create'); // /blog/create.html
        echo Url::build('Blog/read', 'id=5'); // /blog/read/id/5.html // /read/5.html

        echo Url::build('Blog/read', ['id'=>5]);
        echo Url::build('Blog/read', 'id=5&uid=10');
        echo Url::build('Blog/read', ['id'=>5, 'uid'=>10]);

        echo Url::build('Blog/read?id=5');
        echo Url::build('/read/5');

        echo url('Blog/read', ['id'=>5]);
        echo url('Blog/edit', ['id'=>5], 'shtml');
        echo url('Blog/edit#name', ['id'=>5]);

        // 隐藏 index.php
        echo Url::root('/index.php');

        return "index";
    }

    /**
     * @param $id
     * @return string
     * @route('col/:id', 'get')
     * ->ext('html')
     * ->pattern(['id'=>'\d+'])
     *
     */
    public function read($id)
    {
        return 'read id:' . $id;
    }

    /**
     * @param $name
     * @return string
     * @route('col/:name', 'get')
     * ->ext('html')
     * ->pattern(['name'=>'\w+'])
     *
     */
    public function who($name)
    {
        return 'your name:' . $name;
    }

    public function miss()
    {
        return 'Collect 路由规则不存在, 404！';
    }
}