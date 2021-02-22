<?php

namespace app\model;

use think\Model;

class User extends Model
{
    // 指定主键为 uid 属性
//    protected $pk = 'uid';
    // 指定数据表为 tp_one
//    protected $table = 'tp_one';

    // 初始化方法
    protected static function init()
    {
//        parent::init();
//        echo '初始化！';
    }

    public function getUserName()
    {
        return self::where('username', '辉夜')->find()->getAttr('username');
    }
}