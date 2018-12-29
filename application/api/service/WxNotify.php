<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/2
 * Time: 23:12
 */

namespace app\api\service;

use app\api\model\Order as OrderModel;
use app\api\model\Product;
use app\api\service\Order as OrderService;
use app\lib\enum\OrderStatusEnum;
use think\Exception;
use think\Loader;
use think\Log;
use think\Db;
Loader::import('WxPay.WxPay',EXTEND_PATH,'.Api.php');

class WxNotify extends \WxPayNotify
{
    public function NotifyProcess($data, &$msg)
    {
        if ($data['result_code']=='SUCCESS'){
            $orderNo=$data['out_trade_no'];
            Db::startTrans();//startTrans开始事务  Db::commit();结束事务
            try{
                $order=OrderModel::where('order_no','=',$orderNo)->lock(true)->find();//lock(true)数据库加锁
                if ($order->status==1){
                    $service=new OrderService();
                    $stockStatus=$service->checkOrderStock($order->id);
                    if($stockStatus['pass']){
                        $this->updateOrderStatus($order->id,true);
                        $this->reduceStock($stockStatus);
                    }
                    else{
                        $this->updateOrderStatus($order->id,false);
                    }
                }
                Db::commit();
                return true;
            }catch (Exception $ex){
                Db::rollback();
                Log::error($ex);
                return false;
            }
        }
        else{
            return true;
        }
    }

    private function reduceStock($stockStatus){
        foreach ($stockStatus['pStatusArray'] as $singlePStatus){
            $singlePStatus['count'];
        }
        Product::where('id','=',$singlePStatus['id'])
            ->setDec('stock',$singlePStatus['count']);
    }
    private function updateOrderStatus($orderID,$success){
        $status=$success ?
            OrderStatusEnum::PAID :
            OrderStatusEnum::PAID_BUT_OUT_OF;
        OrderModel::where('id','=',$orderID)->update(['status'=>$status]);

    }
}