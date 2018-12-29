<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/25
 * Time: 22:18
 */

namespace app\api\model;

use think\Db;
use think\Exception;
use think\Model;

class Banner extends BaseModlel
{
    protected $hidden = ['update_time','delete_time'];//visble显示某些字段
    
    //protected $table='category';指定关联表.
    public function items(){
        //hasMany('关联模型名','关联模型外键名','当前模型主键名',['模型别名定义']);   一对多
        return $this->hasMany('BannerItem','banner_id','id');
    }
    

    public static function getBannerByID($id)
    {
        $banner=self::with(['items','items.img'])->find($id);//with('模型里的类名')

        return $banner;




//        $result=Db::query(
//            'select * from banner_item where banner_id=?',[$id]);
//        return $result;
        
//        $result=Db::table('banner_item')
//            ->where('banner_id','=',$id)
////            ->where()
//            ->select();
        //find()只返回一条记录,select()多条记录,updete,delete,insert.
        //where('字段名','表达式','查询条件');缺省表达式默认为等于=
        //where有三种方法,表达式法,数组法,闭包法.
//        $result=Db::table('banner_item')
//            ->where(function ($query) use($id){
//                $query->where('banner_id','=',$id);
//            })
//            ->select();
//        return $result;
    }
}