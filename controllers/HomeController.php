<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;

class HomeController extends Controller
{
   public function init()
    {
        $session= \YII::$app->session;
        $session->open();
        $uid=$session->get('uid');
        $uname=$session->get('uname');
        if(!isset($uid) || !isset($uname)){
        	echo "<script>alert('您没有登陆');location.href='?r=extra/login'</script>";
        }
    }
}