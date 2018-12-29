<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/29
 * Time: 0:05
 */

namespace app\api\model;


class User extends BaseModlel
{
    public function address()
    {
        return $this->hasOne('UserAddress','user_id','id');
    }
    public static function getByOpenID($openid){
        $user = self::where('openid','=',$openid)->find();
        return $user;
    }
    
    
}