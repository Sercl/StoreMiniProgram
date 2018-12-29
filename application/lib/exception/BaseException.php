<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/25
 * Time: 23:14
 */

namespace app\lib\exception;


use think\Exception;

class BaseException extends Exception
{   //HTTP状态码 404,200
    public $code = 400;
    //具体错误信息
    public $msg ='参数错误';
    //自定义的错误码
    public $errorCode= 10000;
    public function __construct($params = [])
    {
        if(!is_array($params)){
            return ;
//            throw new Exception('参数必须是数组');
        }
        if(array_key_exists('code',$params)){
            $this->code = $params['code'];
        }
        if(array_key_exists('msg',$params)){
            $this->msg = $params['msg'];
        }
        if(array_key_exists('errorCode',$params)){
            $this->errorCode = $params['errorCode'];
        }

    }
}