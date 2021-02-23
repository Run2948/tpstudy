<?php

namespace app\controller;
use think\Controller;

class Short extends Controller
{
    public function index()
    {
        return 'index';
    }

    public function getInfo()
    {
        return 'getInfo';
    }

    public function getList()
    {
        return 'getList';
    }

    public function postInfo()
    {
        return 'postInfo';
    }
}