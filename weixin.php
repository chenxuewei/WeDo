<?php
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
$id = $rs['aid'];
define("TOKEN", $token);
define("APPID", $appid);
define("APPSECRET", $appsecret);
define("ID", $id);
$wechatObj = new wechatCallbackapiTest();
$wechatObj->valid();

class wechatCallbackapiTest
{
	public function valid()
    {
        $echoStr = $_GET["echostr"];

        //valid signature , option
        if($this->checkSignature()){
        	echo $echoStr;
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
                $keyword = trim($postObj->Content);
                $time = time();
                $textTpl = "<xml>
							<ToUserName><![CDATA[%s]]></ToUserName>
							<FromUserName><![CDATA[%s]]></FromUserName>
							<CreateTime>%s</CreateTime>
							<MsgType><![CDATA[%s]]></MsgType>
							<Content><![CDATA[%s]]></Content>
							<FuncFlag>0</FuncFlag>
							</xml>";             
				if(!empty($keyword))
                {
                    $arr=$pdo->query("select trcontent from wd_reply inner join wd_text_reply on wd_reply.reid = wd_text_reply.reid where rekeyword='$keyword' and aid= ".ID)->fetch();
              		$msgType = "text";
                    if($arr){
                        $contentStr = $arr['trcontent'];
                    }else{
                        $url="http://www.tuling123.com/openapi/api?key=81a7161f18e492a769d2dadb6c0ae363&info=".$keyword;
                        $html=file_get_contents($url);
                        $arr=json_decode($html,true);
                        $msgType = "text";
                        $contentStr = $arr['text'];
                    }                	
                	$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                	echo $resultStr;
                }else{
                	$msgType = "text";
                    $contentStr = "感谢您的关注";
                    $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                    echo $resultStr;
                }

        }else {
        	echo "";
        	exit;
        }
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
		
		if( $tmpStr == $signature ){
			return true;
		}else{
			return false;
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

    //CURL模拟POST提交
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
}

?>