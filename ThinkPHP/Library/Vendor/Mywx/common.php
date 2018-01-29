<?php
// require_once "conf.php";
class common {

  public $appId="wx53d2c564eeab716f";
  public $appSecret="088bc3330d4917f4a9ac13ee4bf3077c";
  public $key="hdlsjkskiwhdidjdhsadsalkjdsla44s";
  // public function __construct() {
  //   $this->appId ="wx53d2c564eeab716f";
  //   $this->appSecret="088bc3330d4917f4a9ac13ee4bf3077c";
  //   $this->key="hdlsjkskiwhdidjdhsadsalkjdsla44s";
  // }

  public function getUserInfo($state=0){

    if (!isset($_GET['code'])){

     $redirect_uri = urlencode("http://".$_SERVER['SERVER_NAME'].$_SERVER['PHP_SELF']."/");

     Header("Location:https://open.weixin.qq.com/connect/oauth2/authorize?appid=".$this->appId."&redirect_uri=".$redirect_uri."&response_type=code&scope=snsapi_userinfo&state=".$state."#wechat_redirect ");

   }else{
      $url="https://api.weixin.qq.com/sns/oauth2/access_token?appid=".$this->appId."&secret=".$this->appSecret."&code=".$_GET['code']."&grant_type=authorization_code";

      $res=$this->httpGet($url);

      //var_dump($res);exit();

      $json=json_decode($res, true);

      $url_info = "https://api.weixin.qq.com/sns/userinfo?access_token=".$json['access_token']."&openid=".$json['openid']."&lang=zh_CN";

      $result=$this->httpGet($url_info);

      $userinfo=json_decode($result, true);
      return $userinfo;
   }



  }

    public function getOpenid($state=0){

    if (!isset($_GET['code'])){

     $redirect_uri = urlencode("http://".$_SERVER['SERVER_NAME'].$_SERVER['PHP_SELF']."/");

     Header("Location:https://open.weixin.qq.com/connect/oauth2/authorize?appid=".$this->appId."&redirect_uri=".$redirect_uri."&response_type=code&scope=snsapi_userinfo&state=".$state."#wechat_redirect ");

   }else{

      $url="https://api.weixin.qq.com/sns/oauth2/access_token?appid=".$this->appId."&secret=".$this->appSecret."&code=".$_GET['code']."&grant_type=authorization_code";

      $res=$this->httpGet($url);

      //var_dump($res);exit();

      $json=json_decode($res, true);

      return $json['openid'];

   }



  }

  public function getSignPackage() {

    $jsapiTicket = $this->getJsApiTicket();

    $url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

    $timestamp = time();

    $nonceStr = $this->createNonceStr();

    // 这里参数的顺序要按照 key 值 ASCII 码升序排序

    $string = "jsapi_ticket=$jsapiTicket&noncestr=$nonceStr&timestamp=$timestamp&url=$url";

    $signature = sha1($string);

    $signPackage = array(

      "appId"     => $this->appId,

      "nonceStr"  => $nonceStr,

      "timestamp" => $timestamp,

      "url"       => $url,

      "signature" => $signature,

      "rawString" => $string

    );

    return $signPackage;

  }

  public function createNonceStr($length = 16) {

    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";

    $str = "";

    for ($i = 0; $i < $length; $i++) {

      $str .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);

    }

    return $str;

  }

  public function getJsApiTicket() {

    // jsapi_ticket 应该全局存储与更新，以下代码以写入到文件中做示例

        $ticket =S('ticket');

        if($ticket){



        }else{

          $accessToken = $this->getAccessToken();

          $url = "https://api.weixin.qq.com/cgi-bin/ticket/getticket?type=jsapi&access_token=$accessToken";

          $res = json_decode($this->httpGet($url));

          $ticket = $res->ticket;

          S('ticket',$ticket,7000);

        }

    return $ticket;

  }

  public function getAccessToken() {



    $access_token =S('access_token');

    if($access_token){



    }else{

      $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$this->appId&secret=$this->appSecret";

      $res = json_decode($this->httpGet($url));

      $access_token = $res->access_token;

      S('access_token',$access_token,7000);

      // echo  $access_token;

    }

    // $save["sss"]=S('access_token');

    // M("Sss")->where("id=1")->save($save);

    return $access_token;

  }



  //  //添加图片

  //  public function addImg($ul){

  //      $accessToken = $this->getAccessToken();

  //      $url="https://api.weixin.qq.com/cgi-bin/media/uploadimg?access_token=$accessToken";

  //      $data["buffer"]="@".$_SERVER["DOCUMENT_ROOT"]."/Public".$ul;

  //      $res=json_decode($this->httpPost($url,$data),true);

  //      return $res;

  // }

  public function httpGet($url) {

    $curl = curl_init();

    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    curl_setopt($curl, CURLOPT_TIMEOUT, 500);

    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);

    curl_setopt($curl, CURLOPT_URL, $url);

    $res = curl_exec($curl);

    curl_close($curl);

    return $res;

  }

  public function httpPost($url,$postData){

    $ch = curl_init();

    curl_setopt ($ch, CURLOPT_URL, $url);

    curl_setopt ($ch, CURLOPT_POST, 1);

    curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);

    curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);

    curl_setopt($ch, CURLOPT_TIMEOUT, 30);

    curl_setopt ( $ch, CURLOPT_HEADER, 0 );

    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,false);

    $result = curl_exec($ch);

    curl_close($ch);

    return $result;

  }

  public function getSign($result){

        ksort($result);

        foreach ($result as $key => $value) {

            if($key!="sign"){

               $stringA.=$key."=".$value."&";

            }

        }

        $stringSignTemp=$stringA."key=".$this->key;

        $sign=MD5($stringSignTemp);

        $sign=strtoupper($sign);

        return $sign;

  }

      /**

     *  作用：将array转为xml

     */

    public function arrayToXml($data)

    {

        $xml = "<xml>";

        foreach ($data as $key=>$val)

        {

            if (is_numeric($val)){

                $xml.="<".$key.">".$val."</".$key.">";

            }else{

                $xml.="<".$key."><![CDATA[".$val."]]></".$key.">";

            }

        }

        $xml.="</xml>";

        return $xml;

    }





    /**

     *  作用：将xml转为array

     */

    public function xmlToArray($xml){

        //将XML转为array

        $array_data = json_decode(json_encode(simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA)), true);

        return $array_data;

    }



    public function morePost($url,$connomains){

            // $data1=array(

            //   "quantity"=>1, //个数

            //   "apply_reason"=>"我的1",

            //   "comment"=>"测试专用",

            //   "poi_id"=>402439941,  //门店id

            // );

            // $data2=array(

            //   "quantity"=>1, //个数

            //   "apply_reason"=>"我的2",

            //   "comment"=>"测试专用",

            //   "poi_id"=>402439941,  //门店id

            // );

            // $connomains = array($data1,$data2);

      // return $connomains;

            $mh = curl_multi_init();

            foreach ($connomains as $i => $postData) {

            $postData=json_encode($postData,JSON_UNESCAPED_UNICODE);

            $conn[$i]=curl_init($url);

            curl_setopt($conn[$i],CURLOPT_RETURNTRANSFER,1);

            curl_setopt ($conn[$i], CURLOPT_URL, $url);

            curl_setopt ($conn[$i], CURLOPT_POST, 1);

            curl_setopt($conn[$i], CURLOPT_POSTFIELDS, $postData);

            curl_setopt ($conn[$i], CURLOPT_RETURNTRANSFER, true);

            curl_setopt($conn[$i], CURLOPT_TIMEOUT, 30);

            curl_setopt ( $conn[$i], CURLOPT_HEADER, 0 );

            curl_setopt($conn[$i], CURLOPT_SSL_VERIFYPEER,false);

            curl_multi_add_handle ($mh,$conn[$i]);

            }



            do { $n=curl_multi_exec($mh,$active); } while ($active);

              foreach ($connomains as $i => $postData) {

              $res[$i]=json_decode(curl_multi_getcontent($conn[$i]),true);

              curl_close($conn[$i]);

            }

            return $res;

    }

}