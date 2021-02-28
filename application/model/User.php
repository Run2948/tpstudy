<?php

namespace app\model;

use think\Model;
use think\model\concern\SoftDelete;

class User extends Model
{
    // 指定主键为 uid 属性
//    protected $pk = 'uid';
    // 指定数据表为 tp_one
//    protected $table = 'tp_one';

    //开启自动时间戳
//    protected $autoWriteTimestamp = true;
    protected $autoWriteTimestamp = 'datetime';

    // 自定义字段名
//    protected $createTime = 'create_at';
//    protected $updateTime = 'update_at';

    // 单独设置不自动更新
//    protected $updateTime = false;

    // 设置 username 和 email 不允许被修改，如下：
    protected $readonly = ['username', 'email'];

    // 设置类型转换
    protected $type = [
        'price' => 'integer',
        'status' => 'boolean',
        'create_time' => 'datetime:Y-m-d'
    ];

    // 数据自动完成
    protected $auto = ['email'];
    protected $insert = ['uid' => 1];
    protected $update = [];

    // 设置 json 字段
    protected $json = ['details', 'list'];

    // 软删除
    use SoftDelete;
    protected $deleteTime = 'delete_time';
//    protected $defaultSoftDelete = 0;

    // 设置全局查询
    protected function base($query)
    {
//        $query->where('status', 1);
    }

    // 初始化方法
    protected static function init()
    {
//        parent::init();
//        echo '初始化！';

        self::event('before_update', function ($query) {
            echo '准备开始更新数据...';
        });
        self::event('after_update', function ($query) {
            echo '数据已经更新完毕...';
        });
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

    // 创建查询范围
    public function scopeGenderMale($query)
    {
        $query->where('gender', '男')->field('id,username,gender,email')->limit(5);
    }

    public function scopeEmailLike($query, $value)
    {
        $query->where('email', 'like', '%' . $value . '%');
    }

    public function scopePriceGreater($query, $value)
    {
        $query->where('price', '>', 80);
    }
}