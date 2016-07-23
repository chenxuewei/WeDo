<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Menu;
use app\models\User;
use app\models\Account;
use yii\web\Cookie;
use yii\web\Session;
use yii\web\CookieCollection;
use yii\caching\MemCache;
class MenuController extends Controller
{
    //调用后台模板
    public $layout='project';
    /*
     * 菜单创建页面
     */
    function actionMenuadd(){
        $this->layout=false;
        $session = Yii::$app->session;
        $id = $session->get('aid');
        //print_r($id);
        if(!$id){
           return $this->success(['index/index'],'还没有选取公众号，请选着要操作的公众号');
        }
        $user=Account::find()->where('aid='.$id)->asArray()->one();
        $count=Menu::find()->where('aid='.$id)->count();
        if($count>0){
            $arr=Menu::find()->where('aid='.$id)->orderBy('states desc')->asArray()->one();
            $arr=json_decode($arr['content'],true);
        }else{
            $arr='';
        }
        //print_r($user);die;
        return $this->render('menuadd',['menu'=>$arr,'user'=>$user]);
    }
    public function curlPost($url,$data,$method){
        $ch = curl_init();   //1.初始化
        curl_setopt($ch, CURLOPT_URL, $url); //2.请求地址
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);//3.请求方式
        //4.参数如下
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);//https
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');//模拟浏览器
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER,array('Accept-Encoding: gzip, deflate'));//gzip解压内容
        curl_setopt($ch, CURLOPT_ENCODING, 'gzip,deflate');

        if($method=="POST"){//5.post方式的时候添加数据
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        }
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $tmpInfo = curl_exec($ch);//6.执行

        if (curl_errno($ch)) {//7.如果出错
            return curl_error($ch);
        }
        curl_close($ch);//8.关闭
        return $tmpInfo;
    }
    /*
     * 添加验证后台
     */
    function actionMenuinfo(){
        $request=\Yii::$app->request;
        $arr=$request->post();
        $session = Yii::$app->session;
        $id = $session->get('aid');
        if(!$id){
         return   $this->success(['index/index'],'还没有选取公众号，请选着要操作的公众号');die;
        }
        $user=Account::find()->where('aid='.$id)->asArray()->one();

        $access_token= Yii::$app->cache->get('access_token');
        if ($access_token==''){
            $access_token=$this->getAccessToken($user['appid'],$user['appsecret']);
            yii::$app->cache->set('access_token', $access_token, 7200);
        }else{
            $access_token=$access_token;
        }
        $url="https://api.weixin.qq.com/cgi-bin/menu/create?access_token=".$access_token;
        $re=json_decode($this->curlPost($url,$arr['do'],'POST'),true);
        if($re['errmsg']=='ok'){
            $count=Menu::find()->where('aid='.$id)->count();
            $menu=new Menu;
            $menu->aid=$id;
            $menu->content=$arr['do'];
            $menu->states=$count+1;
           if($menu->save()>0){
               return $this->success(['menu/getmenu'],'菜单设置成功');
           }
        }else{
            return $this->success(['menu/getmenu'],'添加失败');
        }
    }

    //菜单回退上一版本
    function actionLastmenu(){
        //获取用户
        $session = Yii::$app->session;
        $id = $session->get('aid');
        if(!$id){
         return   $this->success(['index/index'],'还没有选取公众号，请选着要操作的公众号');die;
        }
        //查看是否存在上一个版本
        $count=Menu::find()->where('aid='.$id)->count();
        if($count>0){
            $arr=Menu::find()->where('aid='.$id)->orderBy('states desc')->asArray()->one();
        }else{
            return $this->success(['menu/menuadd'],'菜单还没有配置，去配置');
        }
        //获取access_token
        $access_token= Yii::$app->cache->get('access_token');
        if ($access_token==''){
            $user=Account::find()->where('aid='.$id)->asArray()->one();
            $access_token=$this->getAccessToken($user['appid'],$user['appsecret']);
            yii::$app->cache->set('access_token', $access_token, 7200);
        }else{
            $access_token=$access_token;
        }
        //设置菜单格式
        $url="https://api.weixin.qq.com/cgi-bin/menu/create?access_token=".$access_token;
        $re=json_decode($this->curlPost($url,$arr['content'],'POST'),true);
        //如果成功
        if($re['errmsg']=='ok'){
//            $menu=Menu::find()->where('aid='.$id.' and states = '.$arr['states']);
            $re=Menu::deleteAll('aid = :aid AND states = :states', [':aid' => $id, ':states' => $arr['states']]);

            if($re){
                return $this->success(['menu/getmenu'],'菜单设置成功');die;
            }
        }else{
            return $this->success(['menu/getmenu'],'添加失败');
        }

    }

    //获取access_token
    private function getAccessToken($appid,$appsecret){
        $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".$appid."&secret=".$appsecret;
        //print_r($url);die;
        $json = file_get_contents($url);
        $arr = json_decode($json,true);
        $access_token = $arr['access_token'];
        return $access_token;
    }

    //获取菜单配置
    function actionGetmenu(){
        $session = Yii::$app->session;
        $id = $session->get('aid');
        if(!$id){
            return    $this->success(['index/index'],'还没有选取公众号，请选择要操作的公众号');die;
        }
      //获取用户的信息
        $user=Account::find()->where('uid='.$id)->asArray()->one();
        //查看数据库中是否有数据
        $count=Menu::find()->where('aid='.$id)->count();

        if($count>0){
            //查出最后一次的配置
            $arr=Menu::find()->where('aid='.$id)->orderBy('states desc')->asArray()->one();
            $arr=json_decode($arr['content'],true);
        }else{
           return $this->success(['menu/menuadd'],'菜单还没有配置，去配置');die;
        }
//       print_r($arr);die;
        //处理数据取得想要的数组
        foreach($arr['button'] as $key=>$v){
            if(isset($v['type'])){
                $v['mine']='';
                $menu[]=$v;
            }else{
                if(isset($v['sub_button'])){
                   foreach($v['sub_button']as $k=>$val){
                       $val['mine']=$v['name'];
                       $menu[]=$val;
                   }
                }
            }
        }
//        print_r($menu);die;
        $count=Menu::find()->where('aid='.$id)->count();
//        print_r($menu);
       return $this->render('menushow',['menu'=>$menu,'user'=>$user,'count'=>$count]);
    }

}