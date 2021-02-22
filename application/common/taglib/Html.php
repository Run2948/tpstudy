<?php

namespace app\common\taglib;

use think\template\TagLib;

class Html extends TagLib
{
    //定义标签列表
    protected $tags = [
        //标签定义： attr 属性列表 close 是否闭合(0 或者 1，默认 1)
        'font' => ['attr' => 'color,size', 'close' => 1]
    ];

    //闭合标签
    public function tagFont($tag, $content)
    {
        $parseStr = '<span style="color: ' . $tag['color'] . ';font-size:' . ($tag['size'] * 10) . 'px">' . $content . '</span>';
        return $parseStr;
    }
}