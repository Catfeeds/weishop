<?php

require_once "common.php";

class scan extends common{


    //上网二维码

    public function getScan($data){


       $accessToken = $this->getAccessToken();

       $url="https://api.weixin.qq.com/cgi-bin/qrcode/create?access_token=$accessToken";
       // $data=array(
       //    "shop_id"=>6094293,
       //    "ssid"=>"jqq5",
       //    "img_id"=>0,
       //  );

      $post=$this->encode_json($data);
 // return $post;
      $res=json_decode($this->httpPost($url,$post),true);

      return $res;

  }
  public function encode_json($str){
    $code = json_encode($str);
    return preg_replace("#\\\u([0-9a-f]+)#ie", "iconv('UCS-2', 'UTF-8', pack('H4', '\\1'))", $code);
  }
}