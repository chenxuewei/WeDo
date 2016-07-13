<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use Vcode;
use yii\captcha\CaptchaValidator;

class ExtraController extends Controller
{



   //加载模板页面
    public $layout='login';


    /*
     * 判断是否安装
     */



    /*
     * 登录
     */
    function actionLogin()
    {
      if (is_file("assets/existence.php")) {
        if (empty(Yii::$app->session->get('uid'))) {
            $vcode= new Vcode(80,30,4);
            $session=\Yii::$app->session;
            //$session->open();
            $session->set('code',$vcode->getcode());
            //将验证码图片输出
            // $vcode->outimg();
           return $this->render('extra-signin');
        } else {
            return $this->success(['index/index'],'您已处于登陆状态，无需再次登陆');
        }
       } else {
           return  $this->success(['install/install'],'您还没有安装，即将跳入安装页面！');
       }
        
    }

     /*
     * 检测登陆
     */
    public function actionCheck_login()
    {
        $arr = Yii::$app->request->post();
        // $model = new LoginForm;
        $db = Yii::$app->db;
        $tem = $db->tablePrefix;
        $sql = "select * from ".$tem."user where uname='".$arr['username']."'";
        $res = $db->createCommand("select * from ".$tem."user")->queryOne();
        // 防止SQL注入
        if($res){
            if($res['upwd']==$arr['password']){
                $session = \Yii::$app->session;
                $session->open();
                $session->set("uid",$res['uid']);
                $session->set("uname",$res['uname']);
                echo "<script>alert('欢迎登陆');location.href='?r=index/index'</script>";
            }else{
                echo "<script>alert('密码错误');location.href='?r=extra/login'</script>";            
            }
        }else{
            echo "<script>alert('该用户不存在，请重新登陆');location.href='?r=extra/login'</script>";
        }
    }
    /*
     *  用户退出
     */
    public function actionLogout()
    {
        $session = Yii::$app->session;
        $session->open();
        $session->remove('uid');
        $session->remove('uname');
        $session->close();
        return  $this->success(['extra/login'],'退出成功，请重新登陆！');
    }

}