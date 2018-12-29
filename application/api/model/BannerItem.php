<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/27
 * Time: 4:23
 */

namespace app\api\model;
use think\Model;

class BannerItem extends BaseModlel
{
    protected $hidden = ['id','img_id','banner_id','update_time','delete_time'];
    public function img(){
        return $this->belongsTo('Image','img_id','id');//拥有外键一方关联需要用belongsTO,相反用hasOne.一对一关系
    }
}