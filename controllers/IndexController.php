<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;

class IndexController extends Controller
{
   /*
    * 加载后台模板
    */
    public $layout='project';

    /*
     * 后台主页
     */
    function actionIndex(){
        return $this->render('index');
    }

    /*
     * 后台分页1
     */
    function actionFrontend_one_page(){
        return $this->render('frontend-one-page');
}
}