<?php

namespace app\controller;

use think\Controller;


class Collect extends Controller
{
    public function index()
    {
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