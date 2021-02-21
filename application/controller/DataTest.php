<?php

namespace app\controller;

use app\model\User;
use think\Controller;
use think\Db;

class DataTest extends Controller
{
    public function index()
    {
        return "index";
    }

    public function getNoModelData()
    {
        $data = Db::table('tp_user') -> select();
        return json($data);
    }

    public function getModelData()
    {
        $data = User::select();
//        return json($data);
    }


}