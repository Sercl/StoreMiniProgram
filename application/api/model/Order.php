<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/1
 * Time: 4:53
 */

namespace app\api\model;


class Order extends BaseModlel
{
    protected $hidden = ['user_id','update_time','delete_time'];
    protected $autoWriteTimestamp=true;
    //读取器
    //读取器
    //读取器
    public function getSnapItemsAttr($value){
        if(empty($value)){
            return null;
        }
        return json_decode($value);
    }
    public function getSnapAddressAttr($value){
        if(empty($value)){
            return null;
        }
        return json_decode($value);
    }
    public static function getSummaryByUser($uid,$page=1,$size=15){
        $pagingData=self::where('user_id','=',$uid)
                        ->order('create_time desc')
                        ->paginate($size,true,['page'=>$page]);
        return $pagingData;
    }
    public static function getSummaryByPage($page=1, $size=20){
        $pagingData = self::order('create_time desc')
            ->paginate($size, true, ['page' => $page]);
        return $pagingData ;
    }

}