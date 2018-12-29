<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/25
 * Time: 17:55
 */

namespace app\api\validate;


use think\Validate;

class IDMustBePostiveInt extends BaseValidate
{
    protected $rule=[
        'id'=>'require|isPositiveInteger'
    ];
    protected $message = [
        'id' => 'id必须是正整数'
    ];
}