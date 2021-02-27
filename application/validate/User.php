<?php

namespace app\validate;

use think\Validate;

class User extends Validate
{
    /**
     * 定义验证规则
     * 格式：'字段名'    =>    ['规则1','规则2'...]
     *
     * @var array
     */
//    protected $rule = [
//        'name|姓名' => 'require|max:20|checkName:胖虎', //不得为空，不得大于 20 位
//        'price|售价' => 'number|between:1,100', //必须是数值，1-100 之间
//        'email|邮箱' => 'email' //邮箱
//    ];

//    protected $rule = [
//        'name' => [
//            'require',
//            'max' => 10,
//            'checkName' => '李炎恢'
//        ],
//        'price' => [
//            'number',
//            'between' => '1,100'
//        ],
//        'email' => 'email'
//    ];

    protected $rule = [
        'id' => 'number|between:1,10'
    ];

    /**
     * 定义错误信息
     * 格式：'字段名.规则名'    =>    '错误信息'
     *
     * @var array
     */
//    protected $message = [
//        'name.require' => '姓名不得为空',
//        'name.max' => '姓名不得大于 20 位',
//        'price.number' => '价格必须是数字',
//        'price.between' => '价格必须 1-100 之间',
//        'email' => '邮箱的格式错误'
//    ];
    protected $message = [
        'id.between' => 'id 只能是 1-10 之间',
        'id.number' => 'id 必须是数字'
    ];


    // 场景验证设置
//    protected $scene = [
//        'insert' => ['name', 'price', 'email'],
//        'edit' => ['name', 'price'],
//    ];

    // 公共方法的场景验证
    public function sceneEdit()
    {
        $edit = $this->only(['name', 'price']) //仅对两个字段验证
        ->remove('name', 'max') //移出掉最大字段的限制
        ->append('price', 'require'); //增加一个不能为空的限制
        return $edit;
    }

    //自定义规则，名称中不得是“胖虎”
//    protected function checkName($value, $rule)
    protected function checkName($value, $rule, $data, $field, $title)
    {
        dump($data);
        echo $field;
        echo $title;
        return $rule != $value ? true : '名称不得是“' . $rule . '”';
    }
}
