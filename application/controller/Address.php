<?php


namespace app\controller;


use think\Controller;

class Address extends Controller
{
    public function index()
    {
        return "Address Index";
    }

    public function detail($id)
    {
        return "Address Detail " . $id;
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
}