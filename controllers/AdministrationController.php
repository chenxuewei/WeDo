<?php

namespace app\controllers;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\WdAccount;

class AdministrationController extends HomeController
{	
	 public $layout='project';
	public function actionIndex(){
		return $this->render('glist');
	}

	//公众号添加
	public function actionAdd(){
			 $atok=$this->actionRands(5);
             $url=substr('http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'],0,strpos('http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'],'we'))."we7/we.php?str=".$atok;
             $session = \Yii::$app->session;
             $session->open();
			 $connection=\Yii::$app->db;
			 $request=\Yii::$app->request;
			 $arr=$request->post();
			 $arr['aurl']=$url;
			 $arr['atok']=$atok;
			 $arr['uid']=$session->get('uid');
			 //$arr['atoken']=$atoken;
			 //print_r($arr);die;
			 //$arr['atoken']=md5(rand(1000,9999));
			 $aa=md5(rand(1000,9999));
			 $aa1=substr($aa,0,1);
			 $reg="/^[A-Za-z]$/";
			 if(preg_match($reg,$aa1)){
			 	$arr['atoken']=$aa;
			 }else{
			 	$ass=array('a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z','A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
			 	$num = rand(0,51);

			 	$arr['atoken']=substr_replace($aa,$ass[$num],0,1);
			 }

			 $models=new WdAccount();
			 $models->attributes=$arr;
			 $res=$models->insert();
		if($res){
			return $this->success('administration/sel');
			
		}else{
			return $this->render('glist',['error'=>$models->getErrors()]);
		}

	}

	//查询公众号
	public function actionSel(){
		$session = \Yii::$app->session;
        $session->open();
        $uid=$session->get("uid");
		$connection=\Yii::$app->db;
		$tem = $connection->tablePrefix;

		$sql="select * from ".$tem."account join wd_user on ".$tem."account.uid=".$tem."user.uid where ".$tem."account.uid='$uid'";
		$row=$connection->createCommand($sql)->queryAll();
		return $this->render('show',['arr'=>$row]);
	}

	//查询公众号属性
	public function actionAttribute(){
		$request=\yii::$app->request;
		$aid=$request->get('aid');
		$query=new \yii\db\Query();
		$connection=\Yii::$app->db;
		$tem = $connection->tablePrefix;



		$ress=$query->select('*')->from($tem."account")->where("aid='$aid'")->one();

		return $this->render('slist',['arr2'=>$ress]);
	}


	//公众号删除
	function actionDel(){
		$request=\yii::$app->request;
		$aid=$request->get('aid');
		//print_r($aid);die;
		$connection=\Yii::$app->db;
		$tem = $connection->tablePrefix;


		$re=$connection->createCommand()->delete($tem."account","aid='$aid'")->execute();

		if($re){
			return $this->success('administration/sel');
			
		}else{
			return $this->error('删除失败');
		}

	}

	//公众号编辑
	public function actionSave(){
		$request=\yii::$app->request;
		$aid=$request->get('aid');
		$query=new \yii\db\Query();
		$connection=\Yii::$app->db;
		$tem = $connection->tablePrefix;

		$date=$query->select('*')->from($tem."account")->where("aid='$aid'")->one();
		return $this->render('saveform',['arr1'=>$date]);
	}

	//执行编辑
	public function actionUp(){
		$request=\yii::$app->request;
		$aid=$request->post('aid');
		//print_r($aid);die;
		$ass=$request->post();
		$connection=\Yii::$app->db;
		$tem = $connection->tablePrefix;


		$msg=$connection->createCommand()->update($tem."account",['aname'=>$ass['aname'],'appid'=>$ass['appid'],'appsecret'=>$ass['appsecret'],'account'=>$ass['account']],"aid='$aid'")->execute();

		if($msg){
			return $this->success('administration/sel');
		}else{
			return $this->error('编辑失败');
		}

	}


	public function actionRands($length){
        $str = 'abcdefghijklmnopqrstuvwxyz0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randString = '';
        $len = strlen($str)-1;
        for($i = 0;$i < $length;$i ++)
        {
            $num = mt_rand(0, $len); $randString .= $str[$num];
        }
        return $randString;
    }
	
}

?>