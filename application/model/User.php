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

    // 创建一个获取器，status 字段
    public function getStatusAttr($value)
    {
        $status = [-1 => '删除', 0 => '禁用', 1 => '正常', 2 => '待审核'];
        return $status[$value];
    }

    // 创建一个虚拟字段的获取器，可以对多字段进行过滤
    public function getNothingAttr($value, $data)
    {
        $myGet = [-1 => '删除', 0 => '禁用', 1 => '正常', 2 => '待审核'];
        return $myGet[$data['status']];
    }

    // 模型修改器
    public function setEmailAttr($value)
    {
        return strtoupper($value);
    }

    // 搜索器
    public function searchEmailAttr($query, $value)
    {
        $query->where('email', 'like', $value . '%');

        if (isset($data['sort'])) {
            $query->order($data['sort']);
        }
    }

    public function searchCreateTimeAttr($query, $value)
    {
        $query->whereBetweenTime('create_time', $value[0], $value[1]);
    }
}