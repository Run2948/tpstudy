<?php


namespace app\controller;


use think\captcha\Captcha;
use think\Controller;
use think\facade\Request;

class Code extends Controller
{
    public function index()
    {
        return $this->fetch();
    }

    public function verify()
    {
        $data = [
            'code' => Request::post('code')
        ];
        $flag = $this->validate($data, [
            'code|验证码' => 'require|captcha'
        ]);

        dump($flag);
    }

    public function show()
    {
//        $config = [
//            //字体大小
//            'fontSize' => 30,
//            //验证码位数
//            'length' => 3,
//            //验证码杂点
//            'useNoise' => true,
//        ];

//        $captcha = new Captcha($config);

        $captcha = new Captcha();
        return $captcha->entry();
//        return $captcha->entry(1);

    }

    public function check()
    {
        $captcha = new Captcha();
        dump($captcha->check(Request::post('code')));
//        dump($captcha->check(Request::post('code'), 1));

//        captcha_check(Request::post('code'), 1);
    }
}