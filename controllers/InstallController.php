<?php

namespace app\controllers;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;

class InstallController extends Controller
{

    public $enableCsrfValidation = false;


    /*
  * 加载后台模板
  */
    public $layout='install';
    /*
     * 验证是否安装
     */
    function actionIndex(){
        // 安装界面如果安装好之后生成一个php文件 文件如果存在则跳到登录界面
       if (is_file("assets/existence.php")) {
           return $this->redirect(['extra/login']);
       } else {
           return $this->redirect(['install/install']);
       }
    }

    /*
     * 协议一
     */
    public function actionInstall()
    {
        $view = Yii::$app->view;
        $view->params['progress']='25';
        $view->params['steps0']=' list-group-item-info';
        $view->params['steps1']='';
        $view->params['steps2']='';
        $view->params['steps3']='';
        return $this->render("install-agreement");
    }

    /*
     * 环境监测
     */
    public function actionAmbient(){
        $view = Yii::$app->view;
        $view->params['progress']='50';
        $view->params['steps0']=' list-group-item-success';
        $view->params['steps1']=' list-group-item-info';
        $view->params['steps2']='';
        $view->params['steps3']='';

        //环境监测
        $ret = array();
        $ret['server']['os']['value'] = php_uname();//电脑的系统配置
        $ret['server']['os']['value'] = iconv("GBK","UTF-8",$ret['server']['os']['value']);
        // print_r($ret);die;
        if(PHP_SHLIB_SUFFIX == 'dll') {
            $ret['server']['os']['remark'] = '建议使用 Linux 系统以提升程序性能';
            $ret['server']['os']['class'] = 'warning';
        }else{
            $ret['server']['os']['class'] = '';
        }
        $ret['server']['sapi']['value'] = $_SERVER['SERVER_SOFTWARE'];//服务器软件
        if(PHP_SAPI == 'isapi') {
            $ret['server']['sapi']['remark'] = '建议使用 Apache 或 Nginx 以提升程序性能';
            $ret['server']['sapi']['class'] = 'warning';
        }else{
            $ret['server']['sapi']['class'] = '';
        }
        $ret['server']['php']['value'] = PHP_VERSION;
        @$ret['server']['dir']['value'] = IA_ROOT;
        if(function_exists('disk_free_space')) {
           @ $ret['server']['disk']['value'] = floor(disk_free_space(IA_ROOT) / (1024*1024)).'M';
        } else {
            $ret['server']['disk']['value'] = 'unknow';
        }
        $ret['server']['upload']['value'] = ini_get('file_uploads') ? ini_get('upload_max_filesize') : 'unknow';

        $ret['php']['version']['value'] = PHP_VERSION;
        $ret['php']['version']['class'] = 'success';
        if(version_compare(PHP_VERSION, '5.4.0') == -1) {
            $ret['php']['version']['class'] = 'danger';
            $ret['php']['version']['failed'] = true;
            $ret['php']['version']['remark'] = 'PHP版本必须为 5.4.0 以上. <a href="http://bbs.we7.cc/forum.php?mod=redirect&goto=findpost&ptid=3564&pid=58062">详情</a>';
        }else{
            $ret['php']['version']['class'] = '';
        }

        $ret['php']['mysql']['ok'] = function_exists('mysql_connect');
        if($ret['php']['mysql']['ok']) {
            $ret['php']['mysql']['value'] = '<span class="glyphicon glyphicon-ok text-success"></span>';
        } else {
            $ret['php']['pdo']['failed'] = true;
            $ret['php']['mysql']['value'] = '<span class="glyphicon glyphicon-remove text-danger"></span>';
        }

        $ret['php']['pdo']['ok'] = extension_loaded('pdo') && extension_loaded('pdo_mysql');
        if($ret['php']['pdo']['ok']) {
            $ret['php']['pdo']['value'] = '<span class="glyphicon glyphicon-ok text-success"></span>';
            $ret['php']['pdo']['class'] = 'success';
            if(!$ret['php']['mysql']['ok']) {
                $ret['php']['pdo']['remark'] = '您的PHP环境不支持 mysql_connect，请开启此扩展. <a target="_blank" href="http://bbs.we7.cc/forum.php?mod=redirect&goto=findpost&ptid=3564&pid=58073">详情</a>';
            }
        } else {
            $ret['php']['pdo']['failed'] = true;
            if($ret['php']['mysql']['ok']) {
                $ret['php']['pdo']['value'] = '<span class="glyphicon glyphicon-remove text-warning"></span>';
                $ret['php']['pdo']['class'] = 'warning';
                $ret['php']['pdo']['remark'] = '您的PHP环境不支持PDO, 请开启此扩展. <a target="_blank" href="http://bbs.we7.cc/forum.php?mod=redirect&goto=findpost&ptid=3564&pid=58074">详情</a>';
            } else {
                $ret['php']['pdo']['value'] = '<span class="glyphicon glyphicon-remove text-danger"></span>';
                $ret['php']['pdo']['class'] = 'danger';
                $ret['php']['pdo']['remark'] = '您的PHP环境不支持PDO, 也不支持 mysql_connect, 系统无法正常运行. <a target="_blank" href="http://bbs.we7.cc/forum.php?mod=redirect&goto=findpost&ptid=3564&pid=58074">详情</a>';
            }
        }

        $ret['php']['fopen']['ok'] = ini_get('allow_url_fopen') && function_exists('fsockopen');
        if($ret['php']['fopen']['ok']) {
            $ret['php']['fopen']['value'] = '<span class="glyphicon glyphicon-ok text-success"></span>';
        } else {
            $ret['php']['fopen']['value'] = '<span class="glyphicon glyphicon-remove text-danger"></span>';
        }

        $ret['php']['curl']['ok'] = extension_loaded('curl') && function_exists('curl_init');
        if($ret['php']['curl']['ok']) {
            $ret['php']['curl']['value'] = '<span class="glyphicon glyphicon-ok text-success"></span>';
            $ret['php']['curl']['class'] = 'success';
            if(!$ret['php']['fopen']['ok']) {
                $ret['php']['curl']['remark'] = '您的PHP环境虽然不支持 allow_url_fopen, 但已经支持了cURL, 这样系统是可以正常高效运行的, 不需要额外处理. <a target="_blank" href="http://bbs.we7.cc/forum.php?mod=redirect&goto=findpost&ptid=3564&pid=58076">详情</a>';
            }
        } else {
            if($ret['php']['fopen']['ok']) {
                $ret['php']['curl']['value'] = '<span class="glyphicon glyphicon-remove text-warning"></span>';
                $ret['php']['curl']['class'] = 'warning';
                $ret['php']['curl']['remark'] = '您的PHP环境不支持cURL, 但支持 allow_url_fopen, 这样系统虽然可以运行, 但还是建议你开启cURL以提升程序性能和系统稳定性. <a target="_blank" href="http://bbs.we7.cc/forum.php?mod=redirect&goto=findpost&ptid=3564&pid=58086">详情</a>';
            } else {
                $ret['php']['curl']['value'] = '<span class="glyphicon glyphicon-remove text-danger"></span>';
                $ret['php']['curl']['class'] = 'danger';
                $ret['php']['curl']['remark'] = '您的PHP环境不支持cURL, 也不支持 allow_url_fopen, 系统无法正常运行. <a target="_blank" href="http://bbs.we7.cc/forum.php?mod=redirect&goto=findpost&ptid=3564&pid=58086">详情</a>';
                $ret['php']['curl']['failed'] = true;
            }
        }

        $ret['php']['ssl']['ok'] = extension_loaded('openssl');
        if($ret['php']['ssl']['ok']) {
            $ret['php']['ssl']['value'] = '<span class="glyphicon glyphicon-ok text-success"></span>';
            $ret['php']['ssl']['class'] = 'success';
        } else {
            $ret['php']['ssl']['value'] = '<span class="glyphicon glyphicon-remove text-danger"></span>';
            $ret['php']['ssl']['class'] = 'danger';
            $ret['php']['ssl']['failed'] = true;
            $ret['php']['ssl']['remark'] = '没有启用OpenSSL, 将无法访问公众平台的接口, 系统无法正常运行. <a target="_blank" href="http://bbs.we7.cc/forum.php?mod=redirect&goto=findpost&ptid=3564&pid=58109">详情</a>';
        }

        $ret['php']['gd']['ok'] = extension_loaded('gd');
        if($ret['php']['gd']['ok']) {
            $ret['php']['gd']['value'] = '<span class="glyphicon glyphicon-ok text-success"></span>';
            $ret['php']['gd']['class'] = 'success';
        } else {
            $ret['php']['gd']['value'] = '<span class="glyphicon glyphicon-remove text-danger"></span>';
            $ret['php']['gd']['class'] = 'danger';
            $ret['php']['gd']['failed'] = true;
            $ret['php']['gd']['remark'] = '没有启用GD, 将无法正常上传和压缩图片, 系统无法正常运行. <a target="_blank" href="http://bbs.we7.cc/forum.php?mod=redirect&goto=findpost&ptid=3564&pid=58110">详情</a>';
        }

        $ret['php']['dom']['ok'] = class_exists('DOMDocument');
        if($ret['php']['dom']['ok']) {
            $ret['php']['dom']['value'] = '<span class="glyphicon glyphicon-ok text-success"></span>';
            $ret['php']['dom']['class'] = 'success';
        } else {
            $ret['php']['dom']['value'] = '<span class="glyphicon glyphicon-remove text-danger"></span>';
            $ret['php']['dom']['class'] = 'danger';
            $ret['php']['dom']['failed'] = true;
            $ret['php']['dom']['remark'] = '没有启用DOMDocument, 将无法正常安装使用模块, 系统无法正常运行. <a target="_blank" href="http://bbs.we7.cc/forum.php?mod=redirect&goto=findpost&ptid=3564&pid=58111">详情</a>';
        }

        $ret['php']['session']['ok'] = ini_get('session.auto_start');
        if($ret['php']['session']['ok'] == 0 || strtolower($ret['php']['session']['ok']) == 'off') {
            $ret['php']['session']['value'] = '<span class="glyphicon glyphicon-ok text-success"></span>';
            $ret['php']['session']['class'] = 'success';
        } else {
            $ret['php']['session']['value'] = '<span class="glyphicon glyphicon-remove text-danger"></span>';
            $ret['php']['session']['class'] = 'danger';
            $ret['php']['session']['failed'] = true;
            $ret['php']['session']['remark'] = '系统session.auto_start开启, 将无法正常注册会员, 系统无法正常运行. <a target="_blank" href="http://bbs.we7.cc/forum.php?mod=redirect&goto=findpost&ptid=3564&pid=58111">详情</a>';
        }

        $ret['php']['asp_tags']['ok'] = ini_get('asp_tags');
        if(empty($ret['php']['asp_tags']['ok']) || strtolower($ret['php']['asp_tags']['ok']) == 'off') {
            $ret['php']['asp_tags']['value'] = '<span class="glyphicon glyphicon-ok text-success"></span>';
            $ret['php']['asp_tags']['class'] = 'success';
        } else {
            $ret['php']['asp_tags']['value'] = '<span class="glyphicon glyphicon-remove text-danger"></span>';
            $ret['php']['asp_tags']['class'] = 'danger';
            $ret['php']['asp_tags']['failed'] = true;
            $ret['php']['asp_tags']['remark'] = '请禁用可以使用ASP 风格的标志，配置php.ini中asp_tags = Off';
        }

    $ret['write']['root']['ok'] = 1;
        if($ret['write']['root']['ok']) {
            $ret['write']['root']['value'] = '<span class="glyphicon glyphicon-ok text-success"></span>';
            $ret['write']['root']['class'] = 'success';
        } else {
            $ret['write']['root']['value'] = '<span class="glyphicon glyphicon-remove text-danger"></span>';
            $ret['write']['root']['class'] = 'danger';
            $ret['write']['root']['failed'] = true;
            $ret['write']['root']['remark'] = '本地目录无法写入, 将无法使用自动更新功能, 系统无法正常运行.  <a href="http://bbs.we7.cc/">详情</a>';
        }
      $ret['write']['data']['ok'] = 1;
        if($ret['write']['data']['ok']) {
            $ret['write']['data']['value'] = '<span class="glyphicon glyphicon-ok text-success"></span>';
            $ret['write']['data']['class'] = 'success';
        } else {
            $ret['write']['data']['value'] = '<span class="glyphicon glyphicon-remove text-danger"></span>';
            $ret['write']['data']['class'] = 'danger';
            $ret['write']['data']['failed'] = true;
            $ret['write']['data']['remark'] = 'data目录无法写入, 将无法写入配置文件, 系统无法正常安装. ';
        }

        $ret['continue'] = true;
      // print_r($ret);die;
        foreach($ret['php'] as $opt) {
            if(isset($opt['failed'])) {
                $ret['continue'] = false;
                break;
            }
        }
        if(isset($ret['write']['failed'])) {
            $ret['continue'] = false;
        }



        return $this->render("install-ambient",['ret'=>$ret]);
    }

    /*
     * 数据库创建表单页面
     */
    function actionMysql(){

        $view = Yii::$app->view;
        $view->params['progress']='75';
        $view->params['steps0']=' list-group-item-success';
        $view->params['steps1']=' list-group-item-success';
        $view->params['steps2']=' list-group-item-info';
        $view->params['steps3']='';

        return $this->render("install-mysql");
    }






/****************************************************方案一*****************************************************/
    public function actionSuccess(){
        $post=\Yii::$app->request->post();
//        print_r($post);die;
        $host=$post['db']['server'];//数据库地址
        $duan=$post['db']['duan'];//数据库端口
        $name=$post['db']['username'];//数据库用户名
        $pwd=$post['db']['password'];//数据库密码
        $db=$post['db']['name'];//数据库名字
        $uname=$post['user']['username'];//用户名
        $upwd=md5($post['user']['password']);//用户密码
        $dbtem=$post['db']['prefix'];//表前缀
        //echo $db;die;
//        $urepwd=$post['urepwd'];//确认用户密码
        @$link = mysqli_connect("$host","$name","$pwd","","$duan");
        if(!$link){
            return $this->error('数据库连接失败，请检查输入项');
        }
        $db_selected = mysqli_select_db($link , "$db");
        if($db_selected){
            $sql="drop database ".$db;
            mysqli_query($link , $sql);
        }
        $sql="create database ".$db;
        mysqli_query($link , $sql);
        $file=file_get_contents('./assets/wedo.sql');
        $arr=explode('-- ----------------------------',$file);
        $db_selected = mysqli_select_db($link , $db);
        for($i=0;$i<count($arr);$i++){
            if($i%2==0){
                $a=explode(";",trim($arr[$i]));
                array_pop($a);
                foreach($a as $v){
                    mysqli_query($link , $v);
                }
            }
        }
        
        $str="<?php
                return [
                    'class' => 'yii\db\Connection',
                    'dsn' => 'mysql:host=".$host.";port=".$duan.";dbname=".$db."',
                    'username' => '".$name."',
                    'password' => '".$pwd."',
                    'charset' => 'utf8',
                    'tablePrefix' => '".$dbtem."',   //加入前缀名称
                ];";
        file_put_contents('../config/db.php',$str);
        //修改表前缀
        $a = "SHOW TABLES FROM ".$db;
        $aa = mysqli_query($link,$a);
        while($arr = $aa->fetch_row()){
            $table = $dbtem.$arr[0];
            mysqli_query($link,"rename table `$arr[0]` to $table");     
        }
        $str1="<?php
                    \$pdo=new PDO('mysql:host= $host;port=".$duan.";dbname=$db','$name','$pwd',array(PDO::MYSQL_ATTR_INIT_COMMAND=>'set names utf8'));
                     ?>";
        file_put_contents('./assets/abc.php',$str1);
        $tt = $dbtem."user";
        $sql="insert into `$tt` (uname,upwd) VALUES ('$uname','$upwd')";
        mysqli_query($link , $sql);
        //mysqli_close($link);
        $counter_file       =   'assets/existence.php';//文件名及路径,在当前目录下新建aa.txt文件
        $fopen                     =   fopen($counter_file,'wb');//新建文件命令
        fputs($fopen,   'aaaaaa ');//向文件中写入内容;
        fclose($fopen);
        $strs=str_replace("// 'db' => require(__DIR__ . '/db.php'),","'db' => require(__DIR__ . '/db.php'),",file_get_contents("../config/web.php"));
        file_put_contents("../config/web.php",$strs);
        
        return  $this->success(['extra/login'],'安装完成，即将跳入登陆页面！');

    }


}