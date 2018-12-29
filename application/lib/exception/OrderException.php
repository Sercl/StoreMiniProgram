<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/1
 * Time: 2:46
 */

namespace app\lib\exception;


class OrderException extends BaseException
{
    public $code =404;
    public $msg = '订单不存在';
    public $errorCode = 80000;
}