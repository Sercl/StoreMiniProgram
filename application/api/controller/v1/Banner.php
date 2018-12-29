<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/23
 * Time: 4:08
 */

namespace app\api\controller\v1;
use app\api\validate\IDMustBePostiveInt;
use app\api\model\Banner as BannerModel;
use app\lib\exception\BannerMissException;
use think\Exception;

class Banner
{
    /**
     * 获取指定ID的banner信息
     * @id banner的ID号
     * @url /banner/:id
     * @http GET方式
     */
    public function getBanner($id)
    {
        (new IDMustBePostiveInt())->goCheck();//检测ID是否正整数.
      
//        $banner=BannerModel::with(['items','items.img'])->find($id);//with('模型里的类名')
//        get,find单条,all,select多条.get和all属于模型方法.find和select智能用与Db

//        $banner=new BannerModel();
//        $banner=$banner->get($id);

        $banner=BannerModel::getBannerByID($id);
//        $banner->hidden(['delete_time']);//hidden隐藏属性
//        $banner->visible(['id','items']);//visible显示需要的属性
        if(!$banner){
            throw new BannerMissException();
        }
        return $banner;



    }
}