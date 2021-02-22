<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

// +----------------------------------------------------------------------
// | 模板设置
// +----------------------------------------------------------------------

return [
    // 模板引擎类型 支持 php think 支持扩展
    'type' => 'Think',
    // 默认模板渲染规则 1 解析为小写+下划线 2 全部转换小写 3 保持操作方法
    'auto_rule' => 1,
    // 模板路径
    'view_path' => '',
    // 模板后缀
    'view_suffix' => 'html',
    // 模板文件名分隔符
    'view_depr' => DIRECTORY_SEPARATOR,
    // 模板引擎普通标签开始标记
    'tpl_begin' => '{',
    // 模板引擎普通标签结束标记
    'tpl_end' => '}',
    // 标签库标签开始标记
    'taglib_begin' => '{',
    // 标签库标签结束标记
    'taglib_end' => '}',
    // 过滤函数, 默认采用 htmlentities 防止 XSS 跨站脚本攻击
//    'default_filter' => 'htmlspecialchars',
    'tpl_replace_string' => [
        '__JS__' => 'static/js',
        '__CSS__' => 'static/css',
    ],
    // 配置开启模版布局
    'layout_on' => false,
    // 默认的模板布局文件
    'layout_name' => 'public/layout',
    // 更改占位符标签，默认 {__CONTENT__}
//    'layout_item' => '{__REPLACE__}',
    // 预先加载的标签库
    'taglib_pre_load' => 'app\common\taglib\Html',
];
