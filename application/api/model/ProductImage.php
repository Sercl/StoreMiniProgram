<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/29
 * Time: 14:01
 */

namespace app\api\model;


class ProductImage  extends BaseModlel
{
    protected $hidden = ['img_id', 'delete_time', 'product_id'];

    public function imgUrl(){
        return $this->belongsTo('Image','img_id','id');
    }
}