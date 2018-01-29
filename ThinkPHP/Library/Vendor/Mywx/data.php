<?php
require_once "common.php";
class data extends common{
    //以页面为维度的数据统计接口,count更新的数量
    public function pagedatalist($count){
         // $index=ceil($count/50);
         $accessToken = $this->getAccessToken();
         $url="https://api.weixin.qq.com/shakearound/statistics/pagelist?access_token=$accessToken";
         for ($i=0;$i<$index; $i++) {
              $data[$i]["page_index"]=$i+1;
              $data[$i]["date"]=strtotime("yesterday");
         }
        $res=$this->morePost($url,$data);
        return $res;
    }
    //以页面为维度的数据统计接口,ids设备id数组
    public  function pagedata($ids){
        // $ids=array(5673351,5673353);
        $accessToken = $this->getAccessToken();
        $url="https://api.weixin.qq.com/shakearound/statistics/page?access_token=$accessToken";
        foreach ($ids as  $key=>$value) {
            $data[$key]["page_id"]=$value;
            $data[$key]["begin_date"]=strtotime("yesterday");
            $data[$key]["end_date"]=strtotime("today");
        }
        $res=$this->morePost($url,$data);
        return $res;
    }
    //设备维度
    public  function bcdata($ids){
        // $ids=array(5673351,5673353);
        $accessToken = $this->getAccessToken();
        $url="https://api.weixin.qq.com/shakearound/statistics/device?access_token=$accessToken";
        foreach ($ids as  $key=>$value) {
            $data[$key]["device_identifier"]["device_id"]=$value;
            $data[$key]["begin_date"]=strtotime("yesterday");
            $data[$key]["end_date"]=strtotime("today");
        }
        $res=$this->morePost($url,$data);
        return $res;
    }
        public function bcdatalist($count){
         // $index=ceil($count/50);
         $accessToken = $this->getAccessToken();
         $url="https://api.weixin.qq.com/shakearound/statistics/devicelist?access_token=$accessToken";
         for ($i=0;$i<$index; $i++) {
              $data[$i]["page_index"]=$i+1;
              $data[$i]["date"]=strtotime("yesterday");
         }
         // return $data;
        $res=$this->morePost($url,$data);
        return $res;
    }
}