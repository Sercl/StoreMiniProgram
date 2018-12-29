<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

//return [
//    '__pattern__' => [
//        'name' => '\w+',
//    ],
//    '[hello]'     => [
//        ':id'   => ['index/hello', ['method' => 'get'], ['id' => '\d+']],
//        ':name' => ['index/hello', ['method' => 'post']],
//    ],
//
//];

use think\Route;
//Route::get('api/v1/banner/:id','api/v1.Banner/getBanner');
//横幅接口
Route::get('api/:version/banner/:id','api/:version.Banner/getBanner');
//主题接口
//主题列表
Route::get('api/:version/theme/','api/:version.Theme/getSimpleList');
//主题内容
Route::get('api/:version/theme/:id','api/:version.Theme/getComplexOne');

//商品接口
//商品某分类下的商品信息(ID=分类)
Route::get('api/:version/product/by_category','api/:version.Product/getAllInCategory');
//商品详情
Route::get('api/:version/product/:id','api/:version.Product/getOne',[],['id'=>'\d+']);
//最新商品列表
Route::get('api/:version/product/recent','api/:version.Product/getRecent');

//Route::group('api/:version/product',function (){
//    Route::get('/by_category','api/:version.Product/getAllInCategory');
//    Route::get('/:id','api/:version.Product/getOne',[],['id'=>'\d+']);
//    Route::get('/recent','api/:version.Product/getRecent');
//});
//分类接口
Route::get('api/:version/category/all','api/:version.Category/getAllCategories');
//令牌接口
Route::post('api/:version/token/user','api/:version.Token/getToken');
//验证令牌
Route::post('api/:version/token/verify','api/:version.Token/verifyToken');
//第三方令牌
Route::post('api/:version/token/app','api/:version.Token/getAppToken');

//地址接口
Route::post('api/:version/address','api/:version.Address/createOrUpdateAddress');
//获取用户地址
Route::get('api/:version/address', 'api/:version.Address/getUserAddress');

//Route::get('api/:version/second','api/:version.Address/second');
//提交商品信息进行下单
Route::post('api/:version/order','api/:version.Order/placeOrder');

//获取用户订单缩略  分页查询
Route::get('api/:version/order/by_user','api/:version.Order/getSummaryByUser');
//获取订单详情,id=订单ID号
Route::get('api/:version/order/:id','api/:version.Order/getDetail',[],['id'=>'\d+']);//正则限制判断
//商品总数
Route::get('api/:version/order/count','api/:version.Order/orderCount');

Route::get('api/:version/order/paginate','api/:version.Order/getSummary');
Route::put('api/:version/order/delivery','api/:version.Order/delivery');

//预订单,支付操作  提交订单id
Route::post('api/:version/pay/pre_order','api/:version.Pay/getPreOrder');
//转发接收微信支付返回值
Route::post('api/:version/pay/notify','api/:version.Pay/receiveNotify');
//微信支付返回地址
Route::post('api/:version/pay/re_notify','api/:version.Pay/redirectNotify');

Route::get('api/:version/count/ha','api/:version.Count/ha');


//Route::rule('hello','sample/Test/hello','GET|POST',['https'=>false]);//路由,前面是别名,后面是访问路径
//Route::post('hello/:id/:is','sample/test/hello');
//any();代表*号    url路径后xx.com/hello/24?name=wzr
//Route::rule('hello','sample/Test/hello','GET',['https'=>false]);//路由,前面是别名,后面是访问路径
//GET,POST,DELETE,PUT,*
//Route::rule('路由表达式','路由地址','请求类型','路由参数(数组)','变量规则(数组)');