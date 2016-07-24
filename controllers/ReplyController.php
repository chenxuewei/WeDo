<?php

namespace app\controllers;
use Yii;
use yii\web\Controller;
use app\models\Reply;
use app\models\Text_reply;
use app\models\Account;
use yii\data\Pagination;
use yii\web\UploadedFile;
use app\models\Graphic;

class ReplyController extends HomeController
{	
	public $layout='project';
	//������ӹ���ҳ��
	public function actionRuled(){
		$session = Yii::$app->session;
		$id = $session->get('aid');
		if(!$id){
			return    $this->success(['index/index'],'��û��ѡȡ���ںţ���ѡ��Ҫ�����Ĺ��ں�');die;
		}
		//获取用户的信息
		$user=Account::find()->where('aid='.$id)->asArray()->one();
		//print_r($row);die;

		return $this->render('ruled',['arr'=>$user]);
	}

	//��ӹ���
	public function actionAdd(){


		$request=\yii::$app->request;
		$arr=$request->post();
		$aid=$arr['aid'];
		$rename=$arr['rename'];
		$rekeyword=$arr['rekeyword'];
		$date['trcontent']=strip_tags($arr['trcontent']);
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
		$textReply=new Text_reply();
		$textReply->reid=$reid;
		$textReply->trcontent=$date['trcontent'];
		$ress=$textReply->save();
		if($ress){
			return $this->success('reply/sreply');
		}
		
	}

	//���ֻظ�
	public function actionSreply(){
		$session = Yii::$app->session;
		$id = $session->get('aid');
		//print_r($id);die;
		if(!$id){
			return   $this->success(['index/index'],'还没有选取公众号，请选着要操作的公众号');die;
		}
		$user=Account::find()->where('aid='.$id)->asArray()->one();

		$tem = Yii::$app->db->tablePrefix;
		$query=new \yii\db\Query();

		$query1=$query->from($tem.'reply')->innerjoin($tem.'text_reply',"".$tem."reply.reid=".$tem."text_reply.reid");

		$pagination = new Pagination([
			'defaultPageSize' => 2,
			'totalCount' => $query1->count(),
		]);
		$countries=$query1->where('aid='.$user['aid'])
			->orderBy('rename')
		->offset($pagination->offset)
		->limit($pagination->limit)
		->all();
		return $this->render('rlist',[
			'countries'=>$countries,
			'pagination'=>$pagination,
			]);

	}


	public function actionSou(){
		$request=\yii::$app->request;
		$ser=$request->get('ser');
		$tem = Yii::$app->db->tablePrefix;
		$query=new \yii\db\Query();
		$query1=$query->from($tem.'reply')->innerjoin($tem.'text_reply',"".$tem."reply.reid=".$tem."text_reply.reid")->andFilterWhere(['like','rename',$ser]);


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

	//ɾ��
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
			return $this->error('ɾ��ʧ��');
		}
	}
	/*
    * ͼ�Ļظ�
    * @[author]��
    */
	public function actionGraphic()
	{
		$request=\yii::$app->request;
		if(!$request->isPost)
		{
			$session = Yii::$app->session;
			$id = $session->get('aid');
			//print_r($id);die;
			if(!$id){
				return   $this->success(['index/index'],'��û��ѡȡ���ںţ���ѡ��Ҫ�����Ĺ��ں�');die;
			}
			$user=Account::find()->where('aid='.$id)->asArray()->one();
			//print_r($user);die;
			return $this->render('graphic',['arr'=>$user]);
		}
		else
		{
			//ͼƬ
			$file=UploadedFile::getInstanceByName('s_img');
			$newName=time().rand(1,100).substr($file->name,strrpos($file->name,'.'));
			//echo  $newName;die;
			$pak='public/img/'.$newName;
			$file->saveAs($pak,true);
			$data=$request->post();
			$model=new Graphic();
			$model->s_title=$data['s_title'];
			$model->s_url=$data['s_url'];
			$model->s_desc=strip_tags($data['s_desc']);
			$model->s_img=$pak;
			$model->a_id=$data['a_id'];
			$model->s_guan=$data['s_guan'];
			$a=$model->save();
			if($a)
			{
				echo "<script>alert('�ύ�ɹ�');location.href='?r=reply/graphic'</script>";
			}
	   }
	}

}

?>
