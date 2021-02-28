<?php
namespace app\controller;

use think\Image;

class Picture
{
    public function index()
    {
        $image = Image::open('static/img/image.png');

        //图片宽度
        echo $image->width();
        //图片高度
        echo $image->height();
        //图片类型
        echo $image->type();
        //图片 mime
        echo $image->mime();
        //图片大小
        dump($image->size());

        //裁剪图片
        $image->crop(550,400)->save('temp/crop1.png');
        //生成缩略图
        $image->thumb(500,500)->save('temp/thumb1.png');
        $image->thumb(500,500,2)->save('temp/thumb2.png');
        // 旋转180度
        $image->rotate()->save('temp/rotate1.png');
        $image->rotate(180)->save('temp/rotate2.png');

        $image->water('static/img/mr.lee.png')->save('temp/water1.png');
        $image->text('Mr.Zhu',getcwd().'/static/font/1.ttf',20,'#ffffff')->save('temp/water2.png');
        $image->text('Mr.Zhu',getcwd().'/static/font/1.ttf',20,'#ffffff',9,50,5)->save('temp/water3.png');
    }
}