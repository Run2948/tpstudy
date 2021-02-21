<?php
namespace app\test\controller;

class Abc
{
    public function eat($who = '隔壁老王')
    {
        return $who.'吃饭';
    }
}