<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends CommonController {
    public function index(){
    	$this->display();
    }
    public function table(){
    	$this->display();
    }
    public function del(){
    	$id=I("get.id");
    	echo "$id";
    }
      public $appId="wx6c9991ef9fad0fff";
  public $appSecret="3372339ec5040970b03d08286e841e0c";
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
      public function addImg(){
       $accessToken = $this->getAccessToken();
       $url="https://api.weixin.qq.com/cgi-bin/material/batchget_material?access_token=$accessToken";
       $data=array(
        "type"=>"news",
        "offset"=>0,
        "count"=>2
        );
         $post=json_encode($data);
       $res=json_decode($this->httpPost($url,$post),true);
      dump($res);
  }
}