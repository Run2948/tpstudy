<?php
namespace app\controller;

use think\Controller;
use think\facade\Env;

class Index extends Controller
{
    protected function initialize()
    {
        // parent::initialize();
        echo 'initialize...';
    }

    public function index()
    {
        return '单一模块'.Env::get('app_path');
    }

    public function txt()
    {
        return '<h3>直接输出</h3>';
    }

    public function arr()
    {
        $data = array('a'=>1, 'b'=>2, 'c'=>3);
        return json($data);
    }

    public function tpl()
    {
        return view();
    }

}