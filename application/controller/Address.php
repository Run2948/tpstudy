<?php


namespace app\controller;


use think\Controller;

class Address extends Controller
{
    public function index()
    {
        return "Address Index";
    }

    public function details($id)
    {
        return "Address Details " . $id;
    }

    public function search($id, $uid)
    {
        return "Address Serach " . $id . ' ' . $uid;
    }

    public function find($id, $content)
    {
        return "Address Find " . $id . ' ' . $content;
    }

    public function url()
    {
//        return url('address/details', ['id' => 10]);
        return url('det', ['id' => 10]);
    }

    public function getUser(\app\model\User $user)
    {
        return json($user);
    }
}