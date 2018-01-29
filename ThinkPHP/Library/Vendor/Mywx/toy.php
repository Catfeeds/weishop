<?php
require_once "common.php";
class toy extends common{

  // 增加设备申请
  public function addToy($data){
      $accessToken = $this->getAccessToken();
      $url="https://api.weixin.qq.com/shakearound/device/applyid?access_token=$accessToken";
      // $data=array(
      //     "quantity"=>2, //个数
      //     "apply_reason"=>"理由",
      //     "comment"=>"测试专用",
      //     "poi_id"=>402439941,  //门店id
      // );
      $post=json_encode($data,JSON_UNESCAPED_UNICODE);
        // return $post;
      $res=json_decode($this->httpPost($url,$post),true);
      return $res;
  }
  //查看设备申请状态
    public function checkToy($id){
      $accessToken = $this->getAccessToken();
      $url="https://api.weixin.qq.com/shakearound/device/applystatus?access_token=$accessToken";
      $data=array(
          "apply_id"=>$id,
      );
      $post=json_encode($data,JSON_UNESCAPED_UNICODE);
        // return $post;
      $res=json_decode($this->httpPost($url,$post),true);
      return $res;
  }
    //查询设备信息
    public function selectToy($data){
      $accessToken = $this->getAccessToken();
      $url="https://api.weixin.qq.com/shakearound/device/search?access_token=$accessToken";
      //id
      // $data=array(
      //     "device_identifiers"=>array(
      //                             array("device_id"=>5478871),
      //                             array("device_id"=>5478872),
      //                           ),
      //     "comment"=>"测试",
      // );

        //列表
        // $data=array(
        //     "last_seen"=>0, //上一次查询的设备id
        //     "count"=>3,
        // );

       //批次
        //  $data=array(
        //     "apply_id"=>309104,
        //     "last_seen"=>0, //上一次查询的设备id
        //     "count"=>3,
        // );

       if($data["count"]){
          if($data["apply_id"]){
               $data["type"]=3;
          }else{
               $data["type"]=2;
          }
       }else{
          $data["type"]=1;
       }

      $post=json_encode($data,JSON_UNESCAPED_UNICODE);
        // return $post;
      $res=json_decode($this->httpPost($url,$post),true);
      return $res;
      // 309104
    }
    //编辑设备信息
    public function edtToy($data){
      $accessToken = $this->getAccessToken();
      $url="https://api.weixin.qq.com/shakearound/device/update?access_token=$accessToken";
      // $data=array(
      //     "device_identifier"=>array("device_id"=>5478871),
      //     "comment"=>"测试",
      // );
      $post=json_encode($data,JSON_UNESCAPED_UNICODE);
        // return $post;
      $res=json_decode($this->httpPost($url,$post),true);
      return $res;
    }

    //绑定门店
    public function shopToy($data){
      $accessToken = $this->getAccessToken();
      $url="https://api.weixin.qq.com/shakearound/device/bindlocation?access_token=$accessToken";
      //本公众号的门店
      // $data=array(
      //     "device_identifier"=>array("device_id"=>5478871),
      //     "poi_id"=>402439941 /门店id
      // );

      //其他公众号的门店
      // $data=array(
      //     "device_identifier"=>array("device_id"=>5478871),
      //     "poi_id"=>402439941,
      //     "type"=>2,
      //     "poi_appid"=>"wxappid" //关联门店所归属的公众账号的APPID
      // );
      $post=json_encode($data,JSON_UNESCAPED_UNICODE);
        // return $post;
      $res=json_decode($this->httpPost($url,$post),true);
      return $res;
    }



//增加设备分组;$name为组名称
 public function addGroup($name){
       $accessToken = $this->getAccessToken();
       $url="https://api.weixin.qq.com/shakearound/device/group/add?access_token=$accessToken";
       $data["group_name"]=$name;
       $postData=json_encode($data,JSON_UNESCAPED_UNICODE);
       $res=json_decode($this->httpPost($url,$postData),true);
       return $res;
  }
  //修改设备分组;$id为组id,$name为组名称
 public function updateGroup($data){
       $accessToken = $this->getAccessToken();
       $url="https://api.weixin.qq.com/shakearound/device/group/update?access_token=$accessToken";
       // $data=array(
       //    "group_id"=>$id,
       //    "group_name"=>$name,
       //  );
       $postData=json_encode($data,JSON_UNESCAPED_UNICODE);
       $res=json_decode($this->httpPost($url,$postData),true);
       return $res;
  }
    //删除设备分组
 public function delGroup($id){
       $accessToken = $this->getAccessToken();
       $url="https://api.weixin.qq.com/shakearound/device/group/delete?access_token=$accessToken";
       $data=array(
          "group_id"=>intval($id),
        );
       $postData=json_encode($data,JSON_UNESCAPED_UNICODE);
       $res=json_decode($this->httpPost($url,$postData),true);
       return $res;
  }

      //查找设备分组
 public function selsectGroup($data){
       $accessToken = $this->getAccessToken();
       $url="https://api.weixin.qq.com/shakearound/device/group/getlist?access_token=$accessToken";
       // $data=array(
       //    "begin"=>$begin,
       //    "count"=>$count
       //  );
       $postData=json_encode($data,JSON_UNESCAPED_UNICODE);
       $res=json_decode($this->httpPost($url,$postData),true);
       return $res;
  }




//设备加入组;gid为组id,ids为设备id数组
  public function joinGroup($gid,$ids){
       $accessToken = $this->getAccessToken();
       $url="https://api.weixin.qq.com/shakearound/device/group/adddevice?access_token=$accessToken";
       $data["group_id"]=$gid;
       foreach ($ids as $key => $value) {
          $data["device_identifiers"][$key]['device_id']=$value;
       }
       $postData=json_encode($data);
       $res=json_decode($this->httpPost($url,$postData),true);
       return $res;
  }
//查询单组设备;gid为组id
    public function oneGroup($gid,$begin=0,$count=1000){
       $accessToken = $this->getAccessToken();
       $url="https://api.weixin.qq.com/shakearound/device/group/getdetail?access_token=$accessToken";
       $data["group_id"]=intval($gid);
       $data["begin"]=$begin;
       $data["count"]=$count;
       $postData=json_encode($data);
       $res=json_decode($this->httpPost($url,$postData),true);
       return $res;
  }
//设备退出分组;gid为组id,ids为设备id数组
  public function backGroup($gid,$ids){
       $accessToken = $this->getAccessToken();
       $url="https://api.weixin.qq.com/shakearound/device/group/deletedevice?access_token=$accessToken";
       $data["group_id"]=intval($gid);
       foreach ($ids as $key => $value) {
          $data["device_identifiers"][$key]['device_id']=$value;
       }
       $postData=json_encode($data);
       $res=json_decode($this->httpPost($url,$postData),true);
       return $res;
  }
  //绑定活动
  public function bdactive($data){
       $accessToken = $this->getAccessToken();
       $url="https://api.weixin.qq.com/shakearound/device/bindpage?access_token=$accessToken";
        // $data["device_identifier"]["device_id"]=intval($device_id);
        // $data["page_ids"]=array($page_id);
       $postData=json_encode($data);
       $res=json_decode($this->httpPost($url,$postData),true);
       return $res;
  }
//把活动绑定到店铺
  public function bdShop($data){
       $accessToken = $this->getAccessToken();
       $url="https://api.weixin.qq.com/shakearound/device/bindpage?access_token=$accessToken";
       $res=$this->morePost($url,$data);
       return $res;
  }
}