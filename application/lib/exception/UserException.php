<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/30
 * Time: 19:12
 */

namespace app\lib\exception;


class UserException extends  BaseException
{
    public $code = 404;
    public $msg = '用户不存在';
    public $errorCode = 60000;
}