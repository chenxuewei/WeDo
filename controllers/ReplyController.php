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
	//添加规则�
	public function actionRuled(){
		$session = Yii::$app->session;
		$id = $session->get('aid');
		if(!$id){
		//获取用户的信息
			return    $this->success(['index/index'],'您还没有选择公众号');die;
		}
		//如果选择了
		$user=Account::find()->where('aid='.$id)->asArray()->one();
		return $this->render('ruled',['arr'=>$user]);
	}
	//添加入库��
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
		$reid=Yii::$app->db->getLastInsertID();
		$textReply=new Text_reply();
		$textReply->reid=$reid;
		$textReply->trcontent=$date['trcontent'];
		$ress=$textReply->save();
		if($ress){
			return $this->success('reply/sreply');
		}
		
	}
	//规则展示
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
	  //删除�
	public function actionDel(){
		$reply=new Reply();
		$request=\yii::$app->request;
		$reid=$request->get('reid');
		$re=$reply->deleteAll("reid='$reid'");
		if($re){
			return $this->success('reply/sreply');
		}else{
              return $this->error('删除失败');
		}
	}
	/*
    * 图文回复
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
				return   $this->success(['index/index'],'您还没有选择公众号');die;
			}
			$user=Account::find()->where('aid='.$id)->asArray()->one();
			return $this->render('graphic',['arr'=>$user]);
		}
		else
		{
			//接收值入库
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
				echo "<script>alert('添加成功');location.href='?r=reply/graphic'</script>";
			}
	   }
	}

}

?>
