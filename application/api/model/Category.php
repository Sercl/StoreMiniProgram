<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/28
 * Time: 9:35
 */

namespace app\api\model;


class Category extends BaseModlel
{
    protected $hidden=['delete_time','update_time','create_time'];
    public function img(){
       return $this->belongsTo('Image','topic_img_id','id');
    }
}