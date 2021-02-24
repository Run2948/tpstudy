<?php


namespace app\controller;

use think\Controller;

//class Reply extends Controller
//{
//    public function index()
//    {
//        return $this->request->param('name');
//    }
//}


//use think\Request;
//class Reply extends Controller
//{
//    public function index(Request $req)
//    {
//        return $req->param('name');
//    }
//}

//use think\Request;
//class Reply
//{
//    protected $request;
//
//    public function __construct(Request $request)
//    {
//        $this->request = $request;
//    }
//
//    public function index()
//    {
//        return $this->request->param('name');
//    }
//}


use think\facade\Request;
class Reply
{
    public function index()
    {
        echo Request::url().'<br/>';
        return Request::param('name');
    }
}


//class Reply
//{
//    public function index()
//    {
//        return request()->param('name');
//    }
//}