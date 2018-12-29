<?php

namespace app\api\model;

use think\Model;

class BaseModlel extends Model
{
    //public function getUrlAttr($value,$data){//Url是字段名  get和attr是固定字符.$data是所有字段数据
    
    protected function prefixImgUrl($value,$data){//Url是字段名  get和attr是固定字符.$data是所有字段数据
        $finalUrl= $value;
        if($data['from']==1){
            return config('setting.img_prefix').$value;
        }
        else{
            return $finalUrl;
        }
    }
}
