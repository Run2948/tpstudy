<?php


namespace app\controller;

use think\Controller;

class Verify extends Controller
{
    // 手动开启批量验证
    protected $batchValidate = true;
    // 手动开启验证失败后抛出异常
    protected $failException = false;

    public function index()
    {
//        $data = [
//            'name' => '蜡笔小新',
//            'price' => 90,
//            'email' => 'xiaoxin@163.com',
//        ];
//
//        $validate = new \app\validate\User();
//        if (!$validate->check($data)) {
//            dump($validate->getError());
//        }

        $result = $this->validate([
            'name' => '胖虎',
            'price' => 90,
            'email' => 'xiaoxin@163.com',
        ], '\app\validate\User');
        if ($result !== true) {
            dump($result);
        }

    }
}