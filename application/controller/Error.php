<?php


namespace app\controller;


use think\Request;

class Error
{
    public function index(Request $req)
    {
        return $req -> controller().' Controller Not Found';
    }
}