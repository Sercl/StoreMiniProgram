<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/30
 * Time: 13:27
 */

namespace app\api\controller\v1;


use app\api\controller\BaseController;
use app\api\model\User as UserModel;
use app\api\model\UserAddress;
use app\api\validate\AddressNew;
use app\api\service\Token as TokenService;

use app\lib\exception\SuccessMessage;

use app\lib\exception\UserException;
use think\Controller;

class Address extends BaseController
{

    protected $beforeActionList=[
        'checkPrimaryScope'=>['only'=>'createOrUpdateAddress']
    ];
    
//    //前置操作.
//    protected $beforeActionList=[
//        'first'=>['only'=>'second,third']
//    ];
//    protected function first(){
//        echo 'first';
//    }
//    //API接口
//    public function second(){
//        echo 'second';
//    }
//    public function third(){
//        echo 'third';
//    }
    public function getUserAddress(){
        $uid = TokenService::getCurrentUid();
        $userAddress = UserAddress::where('user_id', $uid)
            ->find();
        if(!$userAddress){
            throw new UserException([
                'msg' => '用户地址不存在',
                'errorCode' => 60001
            ]);
        }
        return $userAddress;
    }


    public function createOrUpdateAddress(){
        $validate=new AddressNew();
        $validate->goCheck();
        
        //根据token获取用户ID
        $uid= TokenService::getCurrentUid();
        
        //根据ID来查找用户数据,判断用户是否存在 不存在则抛出异常.
        $user=UserModel::get($uid);
        if(!$user){
            throw new UserException;
        }
        
        //获取用户从客户端提交的地址信息.
        $dataArray=$validate->getDataByRule(input('post.'));


        //根据用户地址信息是否存在 从而判断是添加地址还是更新地址.
        $userAddress=$user->address;
        if (!$userAddress){
            $user->address()->save($dataArray);
        }
        else{
            $user->address->save($dataArray);
        }
        //return $user;
        return json(new SuccessMessage(),201);

    }
}