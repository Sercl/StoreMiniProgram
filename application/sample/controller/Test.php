<?php
/**
 * Created by PhpStorm.
 * User: Sercl
 * Date: 2018/3/19 0019
 * Time: 16:46
 */

namespace app\sample\controller;
use think\Request;

class Test
{
    public function hello(Request $req)
    {
        //        $all=input('param.name');
        $all=$req->param();
        var_dump($all);
//        $name=Request::instance()->param('name');
//        $age=Request::instance()->param('age');
//        echo $id;
//        echo '|';
//        echo $name;
//        echo '|';
//        echo $age;
        //Request
        return'Hello World';
    }

}