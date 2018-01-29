<?php

require_once "common.php";

class model extends common{
    //添加活动
    public function sendModel($data){
      $accessToken = $this->getAccessToken();
      $url="https://api.weixin.qq.com/cgi-bin/message/template/send?access_token=$accessToken";
      $post=$this->encode_json($data);
      $res=json_decode($this->httpPost($url,$post),true);
      return $res;
  }
   public function encode_json($str){
    $code = json_encode($str);
    return preg_replace("#\\\u([0-9a-f]+)#ie", "iconv('UCS-2', 'UTF-8', pack('H4', '\\1'))", $code);
  }
}