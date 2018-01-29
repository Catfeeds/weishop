<?php
require_once "common.php";
class active extends common{
    //加logo
    public function addImg($ul){
       $accessToken = $this->getAccessToken();
       $url="https://api.weixin.qq.com/shakearound/material/add?access_token=$accessToken";
       $data["media"]=new CURLFile($_SERVER["DOCUMENT_ROOT"]."/Public".$ul);
       $res=json_decode($this->httpPost($url,$data),true);
       return $res;
  }
    //添加活动
    public function addActive($data){
       $accessToken = $this->getAccessToken();
       $url="https://api.weixin.qq.com/shakearound/page/add?access_token=$accessToken";
       // $data=array(
       //    "title"=>"主标题",
       //    "description"=>"副标题",
       //    "page_url"=>"https://bc.ant-age.com",
       //    "comment"=>"50好活动",
       //    "icon_url"=>"/img/logo.png"
       //  );
      if($data["icon_url"]){
        $icon_url=$this->addImg($data["icon_url"]);
        if($icon_url["errcode"]==0){
          $data["icon_url"]=$icon_url["data"]["pic_url"];
        }else{
          return $icon_url;
        }
      }
      $post=json_encode($data,JSON_UNESCAPED_UNICODE);
      $res=json_decode($this->httpPost($url,$post),true);
      return $res;
  }

    //修改活动
    public function updateActive($data){
       $accessToken = $this->getAccessToken();
       $url="https://api.weixin.qq.com/shakearound/page/update?access_token=$accessToken";
       // $data=array(
       //    "page_id"=>2735574,
       //    "title"=>"主标题4",
       //    "description"=>"副标题1",
       //    "page_url"=>"https://bc.ant-age.com",
       //    "comment"=>"50好活动",
       //    "icon_url"=>"/img/logo.png"
       //  );
      if($data["icon_url"]){
        $icon_url=$this->addImg($data["icon_url"]);
        if($icon_url["errcode"]==0){
          $data["icon_url"]=$icon_url["data"]["pic_url"];
        }else{
          return $icon_url;
        }
      }
      $post=json_encode($data,JSON_UNESCAPED_UNICODE);
      $res=json_decode($this->httpPost($url,$post),true);
      return $res;
  }
      //修改活动
    public function selectActive($data){
       $accessToken = $this->getAccessToken();
       $url="https://api.weixin.qq.com/shakearound/page/search?access_token=$accessToken";
      //两种
       // $data=array(
       //    "page_ids"=>array(2735574),
       //  );
       // $data=array(
       //    "begin"=>0,
       //    "count"=>4
       //  );
       if($data["count"]){
          $data["type"]=2;
       }else{
          $data["type"]=1;
       }
      $post=json_encode($data,JSON_UNESCAPED_UNICODE);
      $res=json_decode($this->httpPost($url,$post),true);
      return $res;
  }

    //删除活动
    public function delActive($id){
       $accessToken = $this->getAccessToken();
       $url="https://api.weixin.qq.com/shakearound/page/delete?access_token=$accessToken";
       $data=array(
          "page_id"=>$id,
        );
      $post=json_encode($data,JSON_UNESCAPED_UNICODE);
      $res=json_decode($this->httpPost($url,$post),true);
      return $res;
  }
}