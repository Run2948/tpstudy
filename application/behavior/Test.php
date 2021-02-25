<?php


namespace app\behavior;


class Test
{
//    public function run($params)
//    {
//        echo $params.'，只要触发，我就执行！';
//    }

    public function appInit($params)
    {
        echo '初始化的行为被触发！';
    }

    public function eat($params)
    {
        echo $params . '的行为被触发！';
    }
}