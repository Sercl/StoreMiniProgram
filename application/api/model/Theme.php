<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/28
 * Time: 1:09
 */

namespace app\api\model;


class Theme extends BaseModlel
{
    protected $hidden = [
        'topic_img_id',
        'update_time',
        'delete_time',
        'head_img_id'
    ];
    public function topicImg(){
        //$this->hasOne()//hasOne从表调用主表,belongsTo主表调用从表.
        return $this->belongsTo('Image','topic_img_id','id');
    }
    public function headImg(){
        return $this->belongsTo('Image','head_img_id','id');
    }

    public function products(){
        return $this->belongsToMany('Product','theme_product','product_id','theme_id');
    }

    public static function getThemeWithProducts($id){
        $theme = self::with('products,topicImg,headImg')->find($id);
        return $theme;
    }
}