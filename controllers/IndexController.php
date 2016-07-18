<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;

class IndexController extends HomeController
{
   /*
    * 加载后台模板
    */
    public $layout='project';
    /*
     * 后台主页
     */
    function actionIndex(){
        if (is_file("assets/existence.php")) {
           return $this->render('index');
       } else {
           return  $this->success(['install/install'],'您还没有安装，即将跳入安装页面！');
       }
        
    }

    /*
     * 后台分页1
     */
    function actionFrontend_one_page(){
        return $this->render('frontend-one-page');
}
}