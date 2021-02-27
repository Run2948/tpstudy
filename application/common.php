<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件
use \think\Facade;

//Facade::bind('app\facade\Test','app\common\Test');

Facade::bind([
    'app\facade\Test' => 'app\common\Test'
]);

//用错误级别关闭异常
//error_reporting(0);

// 设置语言包限定列表，
//Lang::setAllowLangList(['zh-cn','en-us','ja-jp']);