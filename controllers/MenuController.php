<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Menu;
use app\models\User;
use app\models\Account;

class MenuController extends Controller
{
    //调用后台模板
    public $layout='project';
    /*
     * 菜单创建页面
     */
    function actionMenuadd(){
        $user=Account::find()->asArray()->all();
        $menu=Menu::find()->where(['pid'=>'0'])->asArray()->all();
        //print_r($user);die;
       return $this->render('menuadd',['user'=>$user,'menu'=>$menu]);

    }
    /*
     * 添加验证后台
     */
    function actionMenuinfo(){
        $request=\Yii::$app->request;
        $arr=$request->post();
        if(!isset($arr['user_id'])){
            return  $this->error('用户不能为空');die;
        }
        if(!isset($arr['menu_name'])){
            return  $this->error('名字不能为空');die;
        }
        if(!isset($arr['menu_type'])){
            return  $this->error('类型不能为空');die;
        }
        $menu=new Menu;
        //print_r($arr);die;
        $menu->user_id=$arr['user_id'];
        $menu->menu_name=$arr['menu_name'];
        $menu->menu_comment=$arr['menu_comment'];
        $menu->pid=$arr['menu_type'];
        if(isset($arr['menu_name'])){
            $menu->son_type=$arr['menu_type'];
        }else{
            $menu->son_type='';
        }
        if($menu->save()>0){
           return $this->success(['menu/getmenufrom'],'添加成功');
        }else{
            return $this->success(['menu/getmenufrom'],'添加失败');
        }
    }

    //获取表单页面
    function actionGetmenufrom(){
        $user=Account::find()->asArray()->all();
        return $this->render('getmenufrom',['user'=>$user]);
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
        $request=\Yii::$app->request;
        $id=$request->post('user_id');
        $user=Account::find()->where('uid='.$id)->asArray()->one();
        $access_token=$this->getAccessToken($user['appid'],$user['appsecret']);
       $url="https://api.weixin.qq.com/cgi-bin/get_current_selfmenu_info?access_token=".$access_token;
        $re=file_get_contents($url);
        $arr=json_decode($re,true);
        $menu=array();
        //处理数据取得想要的数组
        foreach($arr['selfmenu_info']['button'] as $key=>$v){
            if(isset($v['type'])){
                $v['mine']='';
                $menu[]=$v;
            }else{
                if(isset($v['sub_button'])){
                   foreach($v['sub_button'] as $k=>$val){
                    foreach($val as $va){
                        $va['mine']=$v['name'];
                        $menu[]=$va;
                    }

                   }
                }
            }
        }
//        print_r($arr);die;
       return $this->render('menushow',['menu'=>$menu,'user'=>$user]);
    }

}