<?php

namespace app\index\controller;

class User
{
    public function index()
    {
        return 'index';
    }

    public function read($id)
    {
        return 'read id '.$id;
    }

    public function edit($id)
    {
        return 'edit id '.$id;
    }
}