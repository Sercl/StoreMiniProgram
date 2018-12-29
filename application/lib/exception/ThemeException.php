<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/28
 * Time: 3:41
 */

namespace app\lib\exception;


class ThemeException extends BaseException
{
    public $code=404;
    public $msg='指定主题不存在,请检查主题ID';
    public $errorCode=30000;
}