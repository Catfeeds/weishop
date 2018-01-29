<?php
require_once "common.php";
class red extends common{
//   <xml>
// <sign><![CDATA[E1EE61A91C8E90F299DE6AE075D60A2D]]></sign>
// <mch_billno><![CDATA[0010010404201411170000046545]]></mch_billno>
// <mch_id><![CDATA[10000097]]></mch_id>
// <wxappid><![CDATA[wxcbda96de0b165486]]></wxappid>
// <send_name><![CDATA[send_name]]></send_name>
// <hb_type><![CDATA[NORMAL]]></hb_type>
// <auth_mchid><![CDATA[10000098]]></auth_mchid>
// <auth_appid><![CDATA[wx7777777]]></auth_appid>
// <total_amount><![CDATA[200]]></total_amount>
// <amt_type><![CDATA[ALL_RAND]]></amt_type>
// <total_num><![CDATA[3]]></total_num>
// <wishing><![CDATA[恭喜发财 ]]></wishing>
// <act_name><![CDATA[ 新年红包 ]]></act_name>
// <remark><![CDATA[新年红包 ]]></remark>
// <risk_cntl><![CDATA[NORMAL]]></risk_cntl>
// <nonce_str><![CDATA[50780e0cca98c8c8e814883e5caa672e]]></nonce_str>
// </xml>

  // 增加设备申请
  public function maiRed($data){
     $accessToken = $this->getAccessToken();
    // return $accessToken;
        $data=array(
                "send_name"=>"蚂蚁时代",
                "hb_type"=>"NORMAL",//NORMAL正常GROUP裂变
                "risk_cntl"=>"NORMAL",//NORMAL—正常情况；IGN_FREQ_LMT—忽略防刷限制，强制发放；IGN_DAY_LMT—忽略单用户日限额限制
                "total_amount"=>144,
                "amt_type"=>"ALL_RAND",//裂变红包字段
                "total_num"=>1,
                "wishing"=>"测试",
                "act_name"=>"测试",
                "remark"=>"测试"
        );

              $data["mch_id"]=WxPayConfig::MCHID;
              $data["mch_billno"]=WxPayConfig::MCHID.date(Ymd)+time();
              $data["wxappid"]=WxPayConfig::APPID;
              $data["total_amount"]=$data["total_amount"];
              $data["auth_mchid"]=1000052601;
              $data["auth_appid"]="wxbf42bd79c4391863";
              $data["nonce_str"]=$this->createNonceStr();
              $data["sign"]=$this->getSign($data);
              $url='https://api.mch.weixin.qq.com/mmpaymkttransfers/hbpreorder';
              $data=$this->arrayToXml($data);
              $res=$this->curl_post_ssl($url,$data);
        // $data_arr=$this->rolling_curl($urls,$data,'post',false,3);
        return $res;
  }
 public function rolling_curl($url, $postData) {
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,TRUE);
                curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,2);//严格校验
                curl_setopt($ch, CURLOPT_TIMEOUT, 1);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_HEADER, 0);
                curl_setopt($ch, CURLOPT_NOSIGNAL, true);
                curl_setopt($ch,CURLOPT_SSLCERTTYPE,'PEM');
                curl_setopt($ch,CURLOPT_SSLCERT,APP_PATH.WxPayConfig::WXSSLCERT_PATH);
                curl_setopt($ch,CURLOPT_SSLKEYTYPE,'PEM');
                curl_setopt($ch,CURLOPT_SSLKEY, APP_PATH.WxPayConfig::WX_SSLKEY_PATH);
                curl_setopt($ch, CURLOPT_POST, TRUE);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
              $result = curl_exec($ch);
              curl_close($ch);
              return $result;
    }
function curl_post_ssl($url, $vars){
    $ch = curl_init();
    //超时时间
    curl_setopt($ch,CURLOPT_TIMEOUT,30);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER, 1);
    //这里设置代理，如果有的话
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
    curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
    //cert 与 key 分别属于两个.pem文件
    //请确保您的libcurl版本是否支持双向认证，版本高于7.20.1
    curl_setopt($ch,CURLOPT_SSLCERT,APP_PATH.WxPayConfig::WXSSLCERT_PATH);
    curl_setopt($ch,CURLOPT_SSLKEY,APP_PATH.WxPayConfig::WX_SSLKEY_PATH);
    // if( count($aHeader) >= 1 ){
    //     curl_setopt($ch, CURLOPT_HTTPHEADER, $aHeader);
    // }
    curl_setopt($ch,CURLOPT_POST, 1);
    curl_setopt($ch,CURLOPT_POSTFIELDS,$vars);
    $data = curl_exec($ch);
    if($data){
        curl_close($ch);
        return $data;
    }
    else {
        $error = curl_errno($ch);
        //echo "call faild, errorCode:$error\n";
        curl_close($ch);
        return $error;
    }
}



  //查看设备申请状态
    public function checkToy($id){
      $accessToken = $this->getAccessToken();
      $url="https://api.weixin.qq.com/shakearound/device/applystatus?access_token=$accessToken";
      $data=array(
          "apply_id"=>$id, //批次id
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
          "group_id"=>$id,
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
       $data["group_id"]=$gid;
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
       $data["group_id"]=$gid;
       foreach ($ids as $key => $value) {
          $data["device_identifiers"][$key]['device_id']=$value;
       }
       $postData=json_encode($data);
       $res=json_decode($this->httpPost($url,$postData),true);
       return $res;
  }
}