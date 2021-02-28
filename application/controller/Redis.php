<?php

namespace app\controller;

use think\facade\Cache;

class Redis
{
    public function index()
    {
//        Cache::init([
//            // 驱动方式
//            'type' => 'File',
//            // 缓存保存目录(默认 runtime/cache)
//            'path' => '',
//            // 缓存前缀
//            'prefix' => '',
//            // 缓存有效期 0 表示永久缓存
//            'expire' => 0,
//        ]);

        Cache::set('user','Mr.Lee');
        Cache::set('age',150);
//        Cache::set('name','Mr.Lee',10);

        echo Cache::get('user');
        echo Cache::has('user');

        Cache::inc('age');
        Cache::dec('age');

        echo Cache::get('age');

        // 删除缓存文件，但不会删除文件夹
        Cache::rm('user');

        Cache::pull('user');

        // 清空所有缓存，文件夹也会删除
        Cache::clear();

        // 设置 tag
        Cache::tag('tag', ['user', 'age']);

        Cache::tag('tag')->set('user', 'Mr.Lee');
        Cache::tag('tag')->set('age', 20);
        Cache::set('user', 'Mr.Lee');
        Cache::set('age', 20);
        Cache::clear('tag');

        //设置缓存
        cache('user', 'Mr.Lee', 3600);
        //输出缓存
        echo cache('user');
        //删除指定缓存
        cache('user', null);
    }
}