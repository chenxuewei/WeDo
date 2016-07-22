<?php

namespace app\controllers;
use Yii;
use yii\web\Controller;
use app\models\Reply;
use app\models\TextReply;
use app\models\Account;
use yii\data\Pagination;
use yii\web\UploadedFile;
use app\models\Graphic;

class ReplyController extends HomeController
{	
	public $layout='project';
	//加载添加规则页面
	public function actionRuled(){
		$row = Account::find()->asArray()->all();
		//print_r($row);die;	
		return $this->render('ruled',['arr'=>$row]);
	}

	//添加规则
	public function actionAdd(){
		// $connection=\Yii::$app->db;
		// $reid=$connection->getLastInsertID();

		$request=\yii::$app->request;
		$arr=$request->post();
		//print_r($arr);die;
		$aid=$arr['aid'];
		$rename=$arr['rename'];
		$rekeyword=$arr['rekeyword'];
		$date['trcontent']=$arr['trcontent'];

		$reply=new Reply();
		$reply->attributes=$arr;
		$res=$reply->insert(
			);

		//print_r($res);die;
		$reid=Yii::$app->db->getLastInsertID();
		//$reid=mysql_insert_id();
		//echo $reid;die;
		//$arr['reid']=$reid;
		//$date['reid']=$reid;
		//print_r($date);die;
		$textReply=new TextReply();
		$textReply->reid=$reid;
		$textReply->trcontent=$date['trcontent'];
		$ress=$textReply->save(
			);
		if($ress){
			return $this->success('reply/sreply');
		}
		
	}

	//文字回复
	public function actionSreply(){
		//$connection=\yii::$app->db;
		$tem = Yii::$app->db->tablePrefix;
		$query=new \yii\db\Query();
		$query1=$query->from($tem.'reply')->innerjoin($tem.'text_reply',"".$tem."reply.reid=".$tem."text_reply.reid");

		// $query=$connection->createCommand()->select('*')->join('join','wd_text_reply','wd_reply.reid=wd_text_reply.reid');
		// $query=Reply::find()->join('join','wd_text_reply','wd_reply.reid=wd_text_reply.reid');
		//echo $query;die;
		$Pagination=new pagination([
			'defaultPageSize'=>2,
			'totalCount'=>$query1->count(),
			]);
		$countries=$query1->orderBy('rename')
		->offset($Pagination->offset)
		->limit($Pagination->limit)
		->all();
		//print_r($countries);die;
		return $this->render('rlist',[
			'countries'=>$countries,
			'pagination'=>$Pagination,
			]);

	}


	public function actionSou(){
		$request=\yii::$app->request;
		$ser=$request->get('ser');
		$tem = Yii::$app->db->tablePrefix;
		$query=new \yii\db\Query();
		$query1=$query->from($tem.'reply')->innerjoin($tem.'text_reply',"".$tem."reply.reid=".$tem."text_reply.reid")->andFilterWhere(['like','rename',$ser]);


		//$query=Reply::find()->andFilterWhere(['like','rename',$ser]);
		$Pagination=new pagination([
			'defaultPageSize'=>2,
			'totalCount'=>$query1->count(),
			]);
		$countries=$query1->orderBy('rename')
		->offset($Pagination->offset)
		->limit($Pagination->limit)
		->all();

		return $this->render('rlist',[
			'countries'=>$countries,
			'pagination'=>$Pagination,
			]);

	}

	//删除
	function actionDel(){
		$reply=new Reply();
		$request=\yii::$app->request;
		$reid=$request->get('reid');
		//print_r($aid);die;
		// $connection=\Yii::$app->db;
		// $tem = $connection->tablePrefix;


		$re=$reply->deleteAll("reid='$reid'");

		if($re){
			return $this->success('reply/sreply');
			
		}else{
			return $this->error('删除失败');
		}
	}
	/*
    * 图文回复
    * @[author]�?
    */
	public function actionGraphic()
	{
		$request=\yii::$app->request;
		if(!$request->isPost)
		{
			$tem = Yii::$app->db->tablePrefix;
			$query=new \yii\db\Query();
			$data['list']=$query->select('*')->from($tem.'account')->all();
			return $this->render('graphic',$data);
		}
		else
		{
			//图片
			$file=UploadedFile::getInstanceByName('s_img');
			$new_name=time().rand(1,100).$file->name;
			$pak='public/img/'.$new_name;
			$file->saveAs($pak,true);
			$data=$request->post();
			$model=new Graphic();
			$model->s_title=$data['s_title'];
			$model->s_url=$data['s_url'];
			$model->s_desc=$data['s_desc'];
			$model->s_img=$pak;
			$model->a_id=$data['a_id'];
			$model->s_guan=$data['s_guan'];
			$a=$model->save();
			if($a)
			{
				echo "<script>alert('提交成功');location.href='?r=reply/graphic'</script>";
			}
	   }
	}

}

?>
