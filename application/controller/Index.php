<?php
namespace app\controller;

use think\facade\Env;

class Index
{
    public function index()
    {
        return '单一模块'.Env::get('app_path');
    }
}