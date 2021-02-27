<?php

namespace app\controller;

use think\facade\Request;

class Upload
{
    public function index()
    {
        //获取表单的上传数据
        $file = Request::file('image');

        //移动到应用目录 uploads 下
        $info = $file
            ->validate([
                'size' => 102400,
                'ext' => 'jpg,gif,png',
                //'type' => 'text/html'
            ])
//            ->rule('md5')
//            ->rule('uniqid')
//            ->move('../application/uploads');
//            ->move('../application/uploads','');
            ->move('../application/uploads', true, false);

        //判断上传信息
        if ($info) {
            //输出上传信息
            echo $info->getExtension();
            echo '<br>';
            echo $info->getSaveName();
            echo '<br>';
            echo $info->getFileName();
        } else {
            //输出错误信息
            echo $file->getError();
        }
    }

    public function uploads()
    {
        //获取表单的上传数据
        $files = Request::file('image');
        foreach ($files as $file) {
            //移动到应用目录 uploads 下
            $info = $file->move('../application/uploads');
            //判断上传信息
            if ($info) {
                //输出上传信息
                echo $info->getExtension();
                echo '<br>';
                echo $info->getSaveName();
                echo '<br>';
                echo $info->getFileName();
            } else {
                //输出错误信息
                echo $file->getError();
            }
        }
    }
}