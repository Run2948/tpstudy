<?php

namespace app\controller;

use app\model\User as UserModel;
use app\model\Profile as ProfileModel;

class Grade
{
    public function index()
    {
        $user = UserModel::get(19);
//        return json($user->profile);
        return $user->profile->hobby;
    }

    public function belong()
    {
        $profile = ProfileModel::get(1);
//        return json($profile->user);
        return $profile->user->email;
    }
}