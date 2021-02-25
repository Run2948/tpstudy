<?php


namespace app\controller;


use think\facade\Log;

class Record
{
    public function index()
    {
        Log::close();

//        Log::record('测试日志！');

        Log::record('测试错误级别日志！','error');

        Log::record('测试自定义级别日志！','diy');

        try {
            echo 0/0;
        } catch (ErrorException $e)
        {
            echo '发生错误：'.$e->getMessage();
            Log::record('被除数不得为零', 'error');
        }

        Log::clear();
    }
}