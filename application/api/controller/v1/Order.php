<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/30
 * Time: 23:25
 */

namespace app\api\controller\v1;
use app\api\controller\BaseController;

use app\api\service\Token;
use app\api\validate\IDMustBePostiveInt;
use app\api\validate\OrderPlace;
use app\api\validate\PagingParameter;
use app\lib\exception\OrderException;
use think\Controller;
use app\api\service\Token as TokenService;
use app\api\service\Order as OrderService;
use app\api\model\Order as OrderModel;
use app\lib\exception\SuccessMessage;
class Order extends BaseController
{
    //用户在选择商品后,提交包含所选商品的相关信息
    //API 在接收到信息后,需要检查相关商品的库存量 1
    //有库存,将订单数据存储到数据库中=下单成功,返回消息可以支付
    //调用支付接口,进行支付 
    //还需要再次检测库存量检测 2
    //服务器调用微信支付接口进行支付
    //小程序根据服务器返回结果拉起微信支付
    //微信会返回一个支付结果(异步)
    //成功:也需要库存量检测 3
    //成功:进行库存量的扣除,失败:返回支付失败结果

    //库存量检测
    //创建订单
    //根据商品数量减库存    预扣除
    //如果用户支付真正减库存
    //在一定时间没有支付则还原库存

    //任务队列   redis
    //订单任务加入到任务队列


    protected $beforeActionList=[
        'checkExclusiveScope'=>['only'=>'placeOrder'],
        'checkPrimaryScope'=>['only'=>'getDetail,getSummaryByUser'],
    ];




    /**
     * 获取全部订单简要信息（分页）
     * @param int $page
     * @param int $size
     * @return array
     * @throws \app\lib\exception\ParameterException
     */
    public function getSummary($page=1, $size = 20){
        (new PagingParameter())->goCheck();
        $pagingOrders = OrderModel::getSummaryByPage($page, $size);
        if ($pagingOrders->isEmpty())
        {
            return [
                'current_page' => $pagingOrders->currentPage(),
                'data' => []
            ];
        }
        $data = $pagingOrders->hidden(['snap_items', 'snap_address'])
            ->toArray();
        return [
            'current_page' => $pagingOrders->currentPage(),
            'data' => $data
        ];
    }


    public function getDetail($id){
        (new IDMustBePostiveInt())->goCheck();
        $orderDetail=OrderModel::get($id);
        if (!$orderDetail){
            throw new OrderException();
        }
        return $orderDetail->hidden(['prepay_id']);
    }

    public function getSummaryByUser($page=1,$size=15){
        (new PagingParameter())->goCheck();
        $uid=Token::getCurrentUid();
        $pagingOrders=OrderModel::getSummaryByUser($uid,$page,$size);
        if ($pagingOrders->isEmpty()){
            return [
               'data'=>[],
               'current_page'=>$pagingOrders->getCurrentPage()//当前页码
            ];
        }
        $data=$pagingOrders->hidden(['snap_items','snap_address','prepay_id'])->toArray();
        return [
            'data'=>$data,
            'current_page'=>$pagingOrders->getCurrentPage()//当前页码
        ];
    }

    public function placeOrder(){
        (new OrderPlace())->goCheck();
        $products=input('post.products/a');//    /a获取数组参数
        $uid=TokenService::getCurrentUid();
        $order=new OrderService();
        $status=$order->place($uid,$products);
        return $status;
    }
    //获取发送模板的订单号
    public function delivery($id){
        (new IDMustBePostiveInt())->goCheck();
        $order = new OrderService();
        $success = $order->delivery($id);
        if($success){
            return new SuccessMessage();
        }
    }

    //查询订单数量
    public function orderCount(){
        $orderCount = new OrderModel();
        return $orderCount->count('*');
    }
    
}