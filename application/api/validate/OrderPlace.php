<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/31
 * Time: 22:47
 */

namespace app\api\validate;


use app\lib\exception\ParameterException;


class OrderPlace extends BaseValidate
{
//    protected $oProducts=[
//        [
//            'product_id'=>1,
//            'count'=>3
//        ],
//        [
//            'product_id'=>2,
//           'count'=>3
//        ],
//        [
//            'product_id'=>3,
//            'count'=>3
//        ]
//    ];
    //    protected $Products=[
    //        [
    //            'product_id'=>1,
    //            'count'=>3
    //        ],
    //        [
    //            'product_id'=>2,
    //           'count'=>3
    //        ],
    //        [
    //            'product_id'=>3,
    //            'count'=>3
    //        ]
    //    ];
    protected $rule=[
        'products'=>'checkProducts'
    ];
    //$rule数组下每一个子项的验证规则
    protected $singleRule=[
        'product_id'=>'require|isPositiveInteger',
        'count'=>'require|isPositiveInteger',
    ];
    protected function checkProducts($values){
        if(!is_array($values)){
            throw new ParameterException([
                'msg'=>'商品参数不正确'
            ]);
        }
        if(empty($values)){
            throw new ParameterException([
                'msg'=>'商品列表不能为空'
            ]);
        }
        foreach ($values as $value){
            $this->checkProduct($value);
        }
        return true;
    }
    protected function checkProduct($value){
        //手动验证singleRule
        $validate=new BaseValidate($this->singleRule);
        $result=$validate->check($value);
        if(!$result){
            throw new ParameterException([
                'msg'=>'商品参数不正确'
            ]);
        }
    }
}