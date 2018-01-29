<?php
require_once "common.php";
class shop extends common{
    //添加图片
    public function addImg($ul){
       $accessToken = $this->getAccessToken();
       $url="https://api.weixin.qq.com/cgi-bin/media/uploadimg?access_token=$accessToken";
       $data["buffer"]=new CURLFile($_SERVER["DOCUMENT_ROOT"]."/Public".$ul);
       $res=json_decode($this->httpPost($url,$data),true);
       return $res;
  }
  //添加门店
  public function addShop($data){
       $accessToken = $this->getAccessToken();
       // return  $accessToken;
       $url="http://api.weixin.qq.com/cgi-bin/poi/addpoi?access_token=$accessToken";
       //数据样式
       // $data=array(
       //      "sid"=>"33788393",
       //      "business_name"=>"景区圈34",
       //      "branch_name"=>"景区圈1号店",
       //      "province"=>"福建省",
       //      "city"=>"厦门市",
       //      "district"=>"思明区", //可选
       //      "address"=>"湖滨东路313号 ",
       //      "telephone"=>"18850224905",
       //      "categories"=>array("美食,小吃快餐"),
       //      "offset_type"=>1,
       //      "longitude"=>118.103886,
       //      "latitude"=>24.489231,
       //      "photo_list"=>array("/img/ww.png"),          //可选
       //      "recommend"=>"麦辣鸡腿堡套餐，麦乐鸡，全家桶", //可选
       //      "special"=>"免费wifi，外卖服务", //可选
       //      "introduction"=>"麦当劳是全球大型跨国连锁餐", //可选
       //      "open_time"=>"8:00-20:00", //可选
       //      "avg_price"=>35
       //  );
        if($data["photo_list"]){
          foreach ($data["photo_list"] as $key => $value) {
              $urllist=$this->addImg($value);
              if($urllist["url"]){
                  $urls[]["photo_url"]=$urllist["url"];
              }else{
                  return $urllist;
              }
          }
        }
       $data["photo_list"]=$urls;
       $post["business"]["base_info"]=$data;
       $post=json_encode($post,JSON_UNESCAPED_UNICODE);
       $res=json_decode($this->httpPost($url,$post),true);
       return $res;
  }
  //搜索一个门店
public function selectShop($id){
       $accessToken = $this->getAccessToken();
       $url="https://api.weixin.qq.com/cgi-bin/poi/getpoi?access_token=$accessToken";
       $data=array(
          "poi_id"=>$id
        );
        $post=json_encode($data);
        $res=json_decode($this->httpPost($url,$post),true);
        return $res;
  }
  //搜索门店列表
  public function selectShops($data){
       $accessToken = $this->getAccessToken();
       $url="https://api.weixin.qq.com/cgi-bin/poi/getpoilist?access_token=$accessToken";
       // $data=array(
       //      "begin"=>0,
       //      "limit"=>10,
       //  );
        $post=json_encode($data);
        $res=json_decode($this->httpPost($url,$post),true);
        return $res;
  }
  //修改门店信息
  public function updataShop($data){
        $accessToken = $this->getAccessToken();
        $url="https://api.weixin.qq.com/cgi-bin/poi/updatepoi?access_token=$accessToken";
        // $data=array(
        //     "poi_id"=>"404390623",
        //     "telephone"=>"18850224905",
        //     "photo_list"=>array("/img/ww.png"),
        //     "recommend"=>"麦辣鸡腿堡套餐，麦乐鸡，全家桶",
        //     "special"=>"免费wifi，外卖服务",
        //     "introduction"=>"麦当劳是全球大型跨国连锁餐",
        //     "open_time"=>"8:00-20:00",
        //     "avg_price"=>35
        // );
        if($data["photo_list"]){
            foreach ($data["photo_list"] as $key => $value) {
                $urllist=$this->addImg($value);
                if($urllist["url"]){
                    $urls[]["photo_url"]=$urllist["url"];
                }else{
                    return $urllist;
                }
            }
            $data["photo_list"]=$urls;
        }
       $post["business"]["base_info"]=$data;
       $post=json_encode($post,JSON_UNESCAPED_UNICODE);
       $res=json_decode($this->httpPost($url,$post),true);
       return $res;
  }
  //删除门店
 public function delShop($id){
        $accessToken = $this->getAccessToken();
        $url="https://api.weixin.qq.com/cgi-bin/poi/delpoi?access_token=$accessToken";
        $data=array(
          "poi_id"=>$id
        );
        $post=json_encode($data);
        // return $post;
        $res=json_decode($this->httpPost($url,$post),true);
        return $res;
  }
  //门店类目表
  public function shopType(){
        $accessToken = $this->getAccessToken();
        $url="http://api.weixin.qq.com/cgi-bin/api_getwxcategory?access_token=$accessToken";
        $res=$this->httpGet($url);
        return $res;
  }
}