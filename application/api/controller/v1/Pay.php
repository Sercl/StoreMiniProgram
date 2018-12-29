<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/1
 * Time: 23:01
 */

namespace app\api\controller\v1;

use app\api\service\Pay as PayService;
use app\api\controller\BaseController;
use app\api\service\WxNotify;
use app\api\validate\IDMustBePostiveInt;

class Pay extends BaseController
{
    protected $beforeActionList=[
        'checkExclusiveScope'=>['only'=>'getPreOrder']
    ];

    public function getPreOrder($id=''){
        (new IDMustBePostiveInt())->goCheck();
        $pay=new PayService($id);
        return $pay->pay();
    }

    public function redirectNotify(){
        //通知频率15/15/30/180/1800/1800/1800/1800/3600   单位:秒
        //1.检查库存量,防止超卖情况
        //2.真实更订单status状态
        //3.减库存
        //如果成功处理返回微信成功处理的消息.否则返回处理失败.
        //特点post:xml格式:不能携带参数
        $notify=new WxNotify();
        $notify->Handle();
    }

    public function receiveNotify(){
        //通知频率15/15/30/180/1800/1800/1800/1800/3600   单位:秒
        //1.检查库存量,防止超卖情况
        //2.真实更订单status状态
        //3.减库存
        //如果成功处理返回微信成功处理的消息.否则返回处理失败.
        //特点post:xml格式:不能携带参数
//        $notify=new WxNotify();
//        $notify->Handle();
        //带参数转发
        $xmlData=file_get_contents('php://input');
        $result=curl_post_raw('http://118.89.175.68/api/v1/pay/re_notify',$xmlData);
    }
}