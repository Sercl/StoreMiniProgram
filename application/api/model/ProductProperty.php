<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/29
 * Time: 14:04
 */

namespace app\api\model;


class ProductProperty extends BaseModlel
{
    protected $hidden = ['product_id', 'delete_time', 'id'];

//    public function imgUrl(){
//        return $this->belongsTo('Image','img_id','id');
//    }
}