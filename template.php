<?php
define("APPID", "wxd616fa2c82439bb2");
define("APPSECRET", "612107cae6d8e30c036f7a296623a4bc");
//获取用户基本信息思路:1;点击链接获取code 2.使用类调用getuser_info($code)方法把code传过去.3.getuser_info($code)方法调用getAccesstoken_openid方法,得到access_token和openid.从而得到用户基本信息!!!
//注意事项:链接中的uri,要转码!!
//注意事项二:第一步：用户同意授权，获取code时,用第二个链接.同时自己链接中的版本号要去掉,比如http://1.mengke.applinzi.com/template.php,转码后要把1去掉!
$code=$_GET['code'];
//var_dump($code);die;
$str=$_GET['str'];
//echo $str;die;
include_once("./web/assets/abc.php");
$pdo ->query("set names utf8");
$rs = $pdo->query("SELECT * FROM ".$tem."account where atok ='$str'")->fetch(PDO::FETCH_ASSOC);
// print_r($rs);die;
$token = $rs['atoken'];
$appid = $rs['appid'];
$appsecret = $rs['appsecret'];
$id = $rs['aid'];
define("TOKEN", $token);
define("APPID", $appid);
define("APPSECRET", $appsecret);
define("ID", $id);
$wechatObj = new wechatCallbackapiTest();
$res=$wechatObj->getuser_info($code);

// var_dump($res);

class wechatCallbackapiTest
{
    public function getAccesstoken_openid($code){
        //链接在开始开发->获取access_token
        $url="https://api.weixin.qq.com/sns/oauth2/access_token?appid=".APPID."&secret=".APPSECRET."&code=".$code."&grant_type=authorization_code";
        $json=file_get_contents($url);
        $arr=json_decode($json,true);
        return $arr;
    }
    //获取access_token
    public function getuser_info($code){
         $re=$this->getAccesstoken_openid($code);
        $url="https://api.weixin.qq.com/sns/userinfo?access_token=".$re['access_token']."&openid=".$re['openid']."&lang=zh_CN";
        				
        $json=file_get_contents($url);
        $arr=json_decode($json,true);
        return $arr;
       
    }
  
   
}

?>

<!DOCTYPE html>
    <html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <title>个人中心</title>
        <link rel="stylesheet" type="text/css" href="themes/metro/easyui.css">
        <link rel="stylesheet" type="text/css" href="themes/mobile.css">
        <link rel="stylesheet" type="text/css" href="themes/icon.css">
        <script type="text/javascript" src="jquery.min.js"></script>
        <script type="text/javascript" src="jquery.easyui.min.js"></script>
        <script type="text/javascript" src="jquery.easyui.mobile.js"></script>
    </head>
    <body>
        <div class="easyui-navpanel" style="position:relative">
            <header>
                <div class="m-toolbar">
                    <div class="m-title">个人中心</div>
                </div>
            </header>
            <footer>
                <div class="m-buttongroup m-buttongroup-justified" style="width:100%;">
                    <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-large-picture',size:'large',iconAlign:'top',plain:true">个人中心</a>
                    <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-large-clipart',size:'large',iconAlign:'top',plain:true">搜索</a>
                    <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-large-shapes',size:'large',iconAlign:'top',plain:true">发表</a>
                    <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-large-smartart',size:'large',iconAlign:'top',plain:true">电话本</a>
                </div>
            </footer>
            <div style="text-align:center;margin:50px 30px">
                <a href="javascript:void(0)" class="easyui-linkbutton" data-options="plain:true,outline:true" style="width:80px;height:30px" onclick="$('#dlg1').dialog('open').dialog('center')">Click me</a>
            </div>
    
            <div id="dlg1" class="easyui-dialog" style="padding:20px 6px;width:80%;" data-options="inline:true,modal:true,closed:true,title:'Information'">
                <p>
                	<?php
                    echo $res['nickname'];
                    
                    ?>
                    <img src="<?php echo $res['headimgurl']?>" width="80px" heigth="80px"/>	
                </p>
                <div class="dialog-button">
                    <a href="javascript:void(0)" class="easyui-linkbutton" style="width:100%;height:35px" onclick="$('#dlg1').dialog('close')">OK</a>
                </div>
            </div>
        </div>
    </body>
    </html>
