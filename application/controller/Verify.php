<?php


namespace app\controller;

use think\Controller;

class Verify extends Controller
{
    // 手动开启批量验证
    protected $batchValidate = false;
    // 手动开启验证失败后抛出异常
    protected $failException = false;

    public function index()
    {
        $data = [
            'name' => '蜡笔小新',
            'price' => 90,
            'email' => 'xiaoxin@163.com',
        ];

//        $validate = new \app\validate\User();
//        if (!$validate->check($data)) {
//            dump($validate->getError());
//        }

//        $result = $this->validate([
//            'name' => '胖虎',
//            'price' => 90,
//            'email' => 'xiaoxin@163.com',
//        ], '\app\validate\User');
//        if ($result !== true) {
//            dump($result);
//        }

        // 独立验证
//        $validate = new \think\Validate();
//        //$validate->rule('name', 'require|max:10');
//        $validate->rule([
//            'name' => 'require|max:10',
//            'price' => 'number|between:1,100',
//            'email' => 'email'
//        ]);

        // 批量验证
        $validate = new \app\validate\User();
        if (!$validate->batch()->check($data)) {
            dump($validate->getError());
        }

        // 独立验支持对象化的定义方式
//        $validate = new \think\Validate();
//        //$validate->rule('name', ValidateRule::isRequire()->max(10));
//        $validate->rule([
//            'name' => ValidateRule::isRequire()->max(10),
//            'price' => ValidateRule::isNumber()->between('1,100'),
//            'email' => ValidateRule::isEmail()
//        ]);

        // 独立验支持闭包的自定义方式
        $validate = new \think\Validate();
        $validate->rule([
            'name' => function ($value, $data) {
                return $value != '' ? true : '姓名不得为空';
            },
            'price'=> function ($value) {
                return $value > 0 ? true : '价格不得小于零';
            }
        ]);
    }
}