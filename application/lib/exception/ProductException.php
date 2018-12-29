<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/28
 * Time: 6:05
 */

namespace app\lib\exception;


class ProductException extends BaseException
{
    public $code=404;
    public $msg='指定商品不存在,请检查参数';
    public $errorCode=20000;
}