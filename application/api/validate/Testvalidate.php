<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/23
 * Time: 4:46
 */

namespace app\api\validate;

use think\Validate;
class Testvalidate extends Validate
{
    protected $rule = [
        'name' => 'require|max:10',
        'email' =>'email'
    ];
}