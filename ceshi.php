<?php
header('content-type:text');
/**
  * wechat php test
  */

//define your token
$str=$_GET['str'];
// echo $str;die;
include_once("./web/assets/abc.php");
$pdo ->query("set names utf8");
$rs = $pdo->query("SELECT * FROM wd_account where atok ='$str'")->fetch(PDO::FETCH_ASSOC);
$token = $rs['atoken'];
$appid = $rs['appid'];
$appsecret = $rs['appsecret'];
define("TOKEN", $token);
define("APPID", $appid);
define("APPSECRET", $appsecret);
$wechatObj = new wechatCallbackapiTest();
$wechatObj->valid();

class wechatCallbackapiTest
{
  public function valid()
    {
        $echoStr = $_GET["echostr"];
        // echo $this->getAccessToken();
       
        //valid signature , option
        if($this->checkSignature()){
          echo $echoStr;
          $this->createMenu();
          $this->responseMsg();
          exit;
        }
    }

    public function responseMsg()
    {
    //get post data, May be due to the different environments
    $postStr = $GLOBALS["HTTP_RAW_POST_DATA"];

        //extract post data
    if (!empty($postStr)){
                /* libxml_disable_entity_loader is to prevent XML eXternal Entity Injection,
                   the best way is to check the validity of xml by yourself */
                libxml_disable_entity_loader(true);
                $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
                $fromUsername = $postObj->FromUserName;
                $toUsername = $postObj->ToUserName;

        if($postObj->Event == "CLICK"){
          $access_token = $this->getAccessToken();
            $url = "https://api.weixin.qq.com/cgi-bin/media/upload?access_token=$access_token&type=image";
            $data = array( "file"=>"@123.jpg");
            $json = $this->curlPost($url,$data,"POST");
            $arr = json_decode($json,true);    
             $time = time();
             $textTpl = "<xml>
                          <ToUserName><![CDATA[%s]]></ToUserName>
                          <FromUserName><![CDATA[%s]]></FromUserName>
                          <CreateTime>%s</CreateTime>
                          <MsgType><![CDATA[%s]]></MsgType>
                          <ArticleCount>1</ArticleCount>
                          <Articles>
                          <item>
                          <Title><![CDATA[%s]]></Title>
                          <Description><![CDATA[%s]]></Description>
                          <PicUrl><![CDATA[%s]]></PicUrl>
                          <Url><![CDATA[%s]]></Url>
                          </item>
                          </Articles>
                          </xml>";
             $msgType = "news";
             // $Picurl = $arr['media_id'];
             $Picurl = "http://xiaomeijun.applinzi.com/123.jpg";

             $title = "who are you";
             $description = "我就是我 , 是颜色不一样的烟火!";
             $url = "http://www.baidu.com";
              
            $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType,$title,$description,$Picurl,$url );
            echo $resultStr; 
        }else{
            $keyword = trim($postObj->Content);
            $time = time();
            $msgtyme = $postObj->MsgType;
            $textTpl = "<xml>
              <ToUserName><![CDATA[%s]]></ToUserName>
              <FromUserName><![CDATA[%s]]></FromUserName>
              <CreateTime>%s</CreateTime>
              <MsgType><![CDATA[%s]]></MsgType>
              <Content><![CDATA[%s]]></Content>
              <FuncFlag>0</FuncFlag>
              </xml>";
        if(!empty( $keyword )){
          $url="http://www.tuling123.com/openapi/api?key=81a7161f18e492a769d2dadb6c0ae363&info=".$keyword;
          $html=file_get_contents($url);
          $arr=json_decode($html,true);
          $msgType = "text";
          $contentStr = $arr['text'];
          $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
          echo $resultStr;  
        }else{
          $msgType = "text";
          $contentStr = "欢迎关注";
          $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
          echo $resultStr;
        }
  }
    }else {
      echo "";
      exit;
    }
}





    // 获取accesstoken
  private function getAccessToken(){
    $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".APPID."&secret=".APPSECRET;
    $json = file_get_contents($url);
    $arr = json_decode($json,true);
    $access_token = $arr['access_token'];
    return $access_token;
  }
  // 创建菜单
  public function createMenu(){
    $access_token = $this->getAccessToken();
    $url = "https://api.weixin.qq.com/cgi-bin/menu/create?access_token=".$access_token;
    $data = '{
     "button":[
     {  
          "type":"click",
          "name":"坟头蹦迪",
          "key":"V1001_TODAY_MUSIC"
      },
      {
           "name":"骨灰拌饭",
           "sub_button":[
           {  
               "type":"view",
               "name":"灵车漂移",
               "url":"http://www.soso.com/"
            },
            {
               "type":"view",
               "name":"棺板冲浪",
               "url":"http://v.qq.com/"
            },
            {
               "type":"click",
               "name":"病房K歌",
               "key":"V1001_GOOD"
            }]
       }]
 }';
    return $this->curlPost($url,$data,'POST');
    
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







  private function checkSignature()
  {
        // you must define TOKEN by yourself
        if (!defined("TOKEN")) {
            throw new Exception('TOKEN is not defined!');
        }
        
        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];
            
    $token = TOKEN;
    $tmpArr = array($token, $timestamp, $nonce);
        // use SORT_STRING rule
    sort($tmpArr, SORT_STRING);
    $tmpStr = implode( $tmpArr );
    $tmpStr = sha1( $tmpStr );
    
    return true;
    if( $tmpStr == $signature ){
      return true;
    }else{
      return false;
    }
  }
}

?>
