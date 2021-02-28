<?php


namespace app\model;


use think\Model;

class Profile extends Model
{
    public function user()
    {
        return $this->belongsTo('User');
//        return $this->belongsTo('User','id');
    }
}