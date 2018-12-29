<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/29
 * Time: 1:15
 */
return [
    'app_id' => '',

    'app_secret'=>'',

    'login_url'=>"https://api.weixin.qq.com/sns/jscode2session?" .
    "appid=%s&secret=%s&js_code=%s&grant_type=authorization_code",
    //APPID&secret=SECRET&js_code=JSCODE&grant_type=authorization_code

    'access_token_url' => "https://api.weixin.qq.com/cgi-bin/token?" .
"grant_type=client_credential&appid=%s&secret=%s"
];
//APPID&secret=SECRET&js_code=JSCODE&grant_type=authorization_code"
