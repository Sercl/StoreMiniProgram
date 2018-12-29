<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/28
 * Time: 10:33
 */

namespace app\lib\exception;


class CategoryException extends BaseException
{
    public $code = 400;
    public $msg = '指定的类目不存在,请检查参数';
    public $errorCode = 50000;
}