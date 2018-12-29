<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/23
 * Time: 4:08
 */

namespace app\api\controller\v2;
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

        return 'This is V2 Version';



    }
}