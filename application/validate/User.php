<?php

namespace app\validate;

use think\Validate;

class User extends Validate
{
    /**
     * 定义验证规则
     * 格式：'字段名'	=>	['规则1','规则2'...]
     *
     * @var array
     */	
	protected $rule = [
        'name|姓名' => 'require|max:20|checkName:胖虎', //不得为空，不得大于 20 位
        'price' => 'number|between:1,100', //必须是数值，1-100 之间
        'email' => 'email' //邮
    ];

    /**
     * 定义错误信息
     * 格式：'字段名.规则名'	=>	'错误信息'
     *
     * @var array
     */	
    protected $message = [
        'name.require' => '姓名不得为空',
        'name.max' => '姓名不得大于 20 位',
        'price.number' => '价格必须是数字',
        'price.between' => '价格必须 1-100 之间',
        'email' => '邮箱的格式错误'
    ];


    //自定义规则，名称中不得是“胖虎”
//    protected function checkName($value, $rule)
    protected function checkName($value, $rule, $data, $field, $title)
    {
        echo $data;
        echo $field;
        echo $title;
        return $rule != $value ? true : '名称不得是“'.$rule.'”';
    }
}
