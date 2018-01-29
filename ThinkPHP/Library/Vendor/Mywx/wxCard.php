<?php
//注意微信无法接收字符串true false
class wxCard{
    const appId         = "wx4fc0f54e73617136";
    const appSecret     = "b4c44fe7498abba791c160803451f101";
    const mchid         = ""; //商户号
    const privatekey    = ""; //私钥

    /****************************************************
    *微信提交API方法，返回微信指定JSON
    ****************************************************/
    public function wxHttpsRequest($url,$data = null){
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
        if (!empty($data)){
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        }
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($curl);
        curl_close($curl);
        return $output;
    }

    /****************************************************
    *POST多条数据   $url,
    ****************************************************/
    public function morePost($url,$connomains){
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
              $res[$i]=json_decode(curl_multi_getcontent($conn[$i]));
              curl_close($conn[$i]);
            }
            return $res;
    }


    /****************************************************
         *微信获取AccessToken 返回指定微信公众号的at信息
     ****************************************************/
    public function wxAccessToken($appId = NULL , $appSecret = NULL){
        $appId=is_null($appId)?self::appId:$appId;
        $appSecret=is_null($appSecret)?self::appSecret:$appSecret;
        //echo $appId,$appSecret;
        $access_token=S('access_token');
        // if (!$access_token) {
            $url="https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".$appId."&secret=".$appSecret;
            $result=$this->wxHttpsRequest($url);
            //print_r($result);
            $jsoninfo=json_decode($result, true);
            $access_token=$jsoninfo['access_token'];
            S(session('access_token'),$access_token,7000);
        // }
        return $access_token;

        // return M('sss')->where('id=1')->getField('sss');
    }

     /****************************************************
         *微信获取卡卷颜色
     ****************************************************/
     public  function getcolors(){
        $wxAccessToken=$this->wxAccessToken();
        $url="https://api.weixin.qq.com/card/getcolors?access_token=".$wxAccessToken;
        $result=$this->wxHttpsRequest($url);
        $jsoninfo=json_decode($result,true);
        $colors=$jsoninfo['colors'];
        return $colors;
     }

       /*******************************************************
         *      微信卡券：上传LOGO - 需要改写动态功能
         *******************************************************/
     public function wxCardUpdateImg($local_url) {
        $wxAccessToken=$this->wxAccessToken();
        //$data['access_token'] =  $wxAccessToken;
        $data['buffer']=new CURLFile($_SERVER["DOCUMENT_ROOT"]."/Public".$local_url);
        $url="https://api.weixin.qq.com/cgi-bin/media/uploadimg?access_token=".$wxAccessToken;
        $result= $this->wxHttpsRequest($url,$data);
        $jsoninfo=json_decode($result,true);
        if ($jsoninfo['errcode']=="40001") {
            echo "密钥过期请重新登录系统！";
            exit(1);
        }else if(is_null($jsoninfo['url'])){
            echo "创建失败！图片大小限制1MB，像素为300*300，仅支持JPG、PNG格式.";
            exit(1);
        }
        // dump($data['buffer']);
        // dump($jsoninfo);
        // exit();
        return $jsoninfo['url'];
            //array(1) { ["url"]=> string(121) "http://mmbiz.qpic.cn/mmbiz/ibuYxPHqeXePNTW4ATKyias1Cf3zTKiars9PFPzF1k5icvXD7xW0kXUAxHDzkEPd9micCMCN0dcTJfW6Tnm93MiaAfRQ/0" }
        }

     /****************************************************
         *创建微信卡卷  $MODEL参数为不同卡劵字段序列化数组
     ****************************************************/
     public function createCard($MODEL){
        header("Content-Type:text/html;charset=UTF-8");
        $auth=unserialize($MODEL['auth']);     // 解序列化auth
        switch ($MODEL['card_type']) {
            case 'GROUPON':{
                 $data=array(
                    "card"=>array(
                        "card_type"=>$MODEL['card_type'],
                        "groupon"=>array(
                            "base_info"=>$this->base_info($MODEL),
                            "deal_detail"=>$auth['deal_detail']
                            )
                        )
                    );
                 break;
             }
            case 'CASH':{
                 $data=array(
                    "card"=>array(
                        "card_type"=>$MODEL['card_type'],
                        "cash"=>array(
                            "base_info"=>$this->base_info($MODEL),
                            "least_cost"=>$auth['least_cost'],
                            "reduce_cost"=>$auth['reduce_cost']
                            )
                        )
                    );
                 break;
             }
             case 'DISCOUNT':{
                 $data=array(
                    "card"=>array(
                        "card_type"=>$MODEL['card_type'],
                        "discount"=>array(
                            "base_info"=>$this->base_info($MODEL),
                            "discount"=>$auth['discount']
                            )
                        )
                    );
                 break;
             }
             case 'GIFT':{
                 $data=array(
                    "card"=>array(
                        "card_type"=>$MODEL['card_type'],
                        "gift"=>array(
                            "base_info"=>$this->base_info($MODEL),
                            "gift"=>$auth['gift']
                            )
                        )
                    );
                 break;
             }
             case 'GENERAL_COUPON':{
                 $data=array(
                    "card"=>array(
                        "card_type"=>$MODEL['card_type'],
                        "general_coupon"=>array(
                            "base_info"=>$this->base_info($MODEL),
                            "default_detail"=>$auth['default_detail']
                            )
                        )
                    );
                 break;
             }
        }
        $wxAccessToken=$this->wxAccessToken();
        $url="https://api.weixin.qq.com/card/create?access_token=".$wxAccessToken;
        $result=$this->wxHttpsRequest($url,json_encode($data,JSON_UNESCAPED_UNICODE));
        $jsoninfo=json_decode($result,true);
        // dump($jsoninfo);
        // exit();
        if ($jsoninfo['errmsg']!=="ok") {
            echo "创建卡卷失败！";
            exit(1);
        }
        return $jsoninfo['card_id'];
     }

     /*********************************************************
             *卡卷的基础信息
             *****************************************************/
     public function base_info($MODEL){
        $data=array(
                        "brand_name"=>$MODEL['brand_name'],
                        "logo_url"=>$MODEL['logo_url'],
                        "title"=>$MODEL['title'],
                        "sub_title"=>$MODEL['sub_title'],
                        "color"=>$MODEL['color'],
                        "code_type"=>$MODEL['code_type'],
                        "notice"=>$MODEL['notice'],
                        "date_info"=>array(
                            "type"=>$MODEL['type'],
                            "begin_timestamp"=>$MODEL['begin_timestamp'],
                            "end_timestamp"=>$MODEL['end_timestamp'],
                            "fixed_term"=>$MODEL['fixed_term'],
                            "fixed_begin_term"=>$MODEL['fixed_begin_term']
                            ),
                        "sku"=>array(
                            "quantity"=>$MODEL['quantity']
                            ),
                        "get_limit"=>$MODEL['get_limit'],
                        // 使用自带code
                        "use_custom_code"=>false,
                        "can_share"=>$this->isbool($MODEL['can_share']),
                        "can_give_friend"=>$this->isbool($MODEL['can_give_friend']),
                        "bind_openid"=>false,
                        "custom_url_name"=>$MODEL['custom_url_name'],
                        "custom_url_sub_title"=>$MODEL['custom_url_sub_title'],
                        "custom_url"=>$MODEL['custom_url'],
                        "service_phone"=>$MODEL['service_phone'],
                        "description"=>$MODEL['description']
                        //门店id
                        // "location_id_list"=>$MODEL['location_id_list'],
                        );
        return $data;
     }


     public function isbool($bool){
        if ($bool=="false") {
            return false;
        }else if ($bool=="true") {
            return true;
        }
     }

     /***************************************
               *序列化各卡卷独有数据  并返回$RESULT
               其中$result为页面post数据包含了卡卷的基础信息（baseinfo）
               ****************************************/
     public function save_card($result){
        switch ($result['card_type']) {
            case 'GROUPON':{
                $data=array(
                    "deal_detail"=>$result['deal_detail']
                    );
                $result['auth']=serialize($data);
                break;
            }
            case 'CASH':{
                $data=array(
                    "least_cost"=>($result['least_cost']*100),
                    "reduce_cost"=>($result['reduce_cost'])*100
                    );
                $result['auth']=serialize($data);
                break;
            }
            case 'DISCOUNT':{
                $data=array(
                    "discount"=>(100-$result['discount']*10)
                    );
                $result['auth']=serialize($data);
                break;
            }
            case 'GIFT':{
                $data=array(
                    "gift"=>$result['gift']
                    );
                $result['auth']=serialize($data);
                break;
            }
            case 'GENERAL_COUPON':{
                $data=array(
                    "default_detail"=>$result['default_detail']
                    );
                $result['auth']=serialize($data);
                break;
            }
        }
        return $result;
     }

     /**********************************************
            *获取二维码请求(公众号二维码)
            ******************************************/
     public function qr_Card(){
        $data=array(
            "expire_seconds"=>2591000,
            "action_name"=>"QR_SCENE",
            "action_info"=>array(
                "scene"=>array(
                    "scene_id"=>123
                    )
                )
            );
        $url="https://api.weixin.qq.com/cgi-bin/qrcode/create?access_token="."w8OjY7oJwtzcJDOd54QCmxytlV8PhygdjcFutryQV0LWf0R8POuLXOR6ysGVn8fsCqLolcILYJUIGqRZg9DABGSqCzjszAGM7o2ES1NDEBSoR-w6XbIIGw0ig8e8YegSDYNbAGAQLA";
        $result=$this->wxHttpsRequest($url,json_encode($data,JSON_UNESCAPED_UNICODE));
        $jsoninfo=json_decode($result,true);
        return $jsoninfo;
     }

     // //通过ticket换区二维码
     // public function QR(){
     //    // $url="https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket=".;
     //    // $result=$this->wxHttpsRequest($url);
     //    // $jsoninfo=json_decode($result);
     //    return urlencode("gQFQ8DoAAAAAAAAAASxodHRwOi8vd2VpeGluLnFxLmNvbS9xL01VUHlfOGZsVWZzb1JDRGdyRzJjAAIEMN4WVwMEgDoJAA==");
     // }

     /******************************************************
           *开发者可以设置扫描二维码领取单张卡券
           ****************************************************/
     public function cardQr($card_id){
        $data=array(
            "action_name"=>"QR_CARD",
            "expire_seconds"=>1800,
            "action_info"=>array(
                "card"=>array(
                    "card_id"=>$card_id,
                    "is_unique_code"=>false ,
                    "outer_id" =>1
                    )
                )
            );
        $wxAccessToken=$this->wxAccessToken();
        $url="https://api.weixin.qq.com/card/qrcode/create?access_token=".$wxAccessToken;
        $result=$this->wxHttpsRequest($url,json_encode($data,JSON_UNESCAPED_UNICODE));
        $jsoninfo=json_decode($result,true);
        if ($jsoninfo['errmsg']!=="ok") {
            echo "获取二维码失败！";
        }
        return $jsoninfo['show_qrcode_url'];//获取二维码
    }

    /******************************************************
            *查询code接口状态
            **************************************************/
    public function codeStatus(){
        $data=array(
            "card_id"=>"pWHV8uBOz88vnpzW3jCRHUf3hR0o",
            "code"=>"479955963733",
            "check_consume"=>true
            );
        $wxAccessToken=$this->wxAccessToken();
        $url="https://api.weixin.qq.com/card/code/get?access_token=".$wxAccessToken;
        $result=$this->wxHttpsRequest($url,json_encode($data,JSON_UNESCAPED_UNICODE));
        $jsoninfo=json_decode($result);
        return $jsoninfo;
    }

    /*******************************************************
             *核销卡卷(过程不可逆)
             *****************************************************/
    public function delCode($code){
        $data=array(
            "code"=>$code
            );
        $wxAccessToken=$this->wxAccessToken();
        $url="https://api.weixin.qq.com/card/code/consume?access_token=".$wxAccessToken;
        $result=$this->wxHttpsRequest($url,json_encode($data,JSON_UNESCAPED_UNICODE));
        $jsoninfo=json_decode($result);
        return $jsoninfo;
    }

    /*******************************************************
        *查看卡券详情   morepost来完成查看多条卡劵详情
     $data=array(
            "card_id"=>$card_id
            );
        ******************************************************/
    public function card_info($cardIdList,$dbTable){
        $wxAccessToken=$this->wxAccessToken();
        $MODEL=M($dbTable);
        $url="https://api.weixin.qq.com/card/get?access_token=".$wxAccessToken;
        $result=$this->morePost($url,$cardIdList);
        foreach ($result as $value) {
            foreach ($value->card as $card) {
                if (is_null($card->base_info->id)) continue;
                $data['card_id']=$card->base_info->id;
                $data['code_type']=$card->base_info->code_type;
                $data['begin_timestamp']=$card->base_info->date_info->begin_timestamp;
                $data['end_timestamp']=$card->base_info->date_info->end_timestamp;
                $data['service_phone']=$card->base_info->service_phone;
                $data['description']=$card->base_info->description;
                $data['get_limit']=$card->base_info->get_limit;
                $data['can_share']=$card->base_info->can_share;
                $data['can_give_friend']=$card->base_info->can_give_friend;
                $data['status']=$card->base_info->status;
                $data['quantity']=$card->base_info->sku->quantity;
                $data['total_quantity']=$card->base_info->sku->total_quantity;
                $data['custom_url_name']=$card->base_info->custom_url_name;
                $data['custom_url_sub_title']=$card->base_info->custom_url_sub_title;
                $data['custom_url']=$card->base_info->custom_url;
                $data['qrcode_url']=$this->cardQr($data['card_id']);
                $a=$MODEL->where(array('card_id'=>$data['card_id']))->save($data);
            }
        }

    }

    /*******************************************************
        *查看卡券详情   morepost来完成查看多条卡劵详情
        ********************************************************/
    public function oneCard($card_id){
        $wxAccessToken=$this->wxAccessToken();
        $url="https://api.weixin.qq.com/card/get?access_token=".$wxAccessToken;
        $data=array(
            "card_id"=>$card_id
            );
        $result=$this->wxHttpsRequest($url,json_encode($data,JSON_UNESCAPED_UNICODE));
        $jsoninfo=json_decode($result);
        return $jsoninfo;
    }

    /*******************************************************
        *修改库存信息  (参数eq为要修改的库存量)   返回bool类型值
        ******************************************************/
    public function editQuantity($card_id,$eq){
        $wxAccessToken=$this->wxAccessToken();
        $url="https://api.weixin.qq.com/card/modifystock?access_token=".$wxAccessToken;
        $card=$this->oneCard($card_id);
        foreach ($card->card as $value) {
            $quantity=$value->base_info->sku->quantity;//获取此卡卷现有库存
        }
        if ($quantity==$eq) {//无更改值微信报错（data format error hint: [UYo5ga0247ent1] Error before null）
            exit(1);
        }
        if ($quantity<$eq) {
            $increase_stock_value=$eq-$quantity;
            $data=array(
                "card_id"=>$card_id,
                "increase_stock_value"=>$increase_stock_value
                );
        }elseif($quantity>$eq) {
            $reduce_stock_value=$quantity-$eq;
            $data=array(
                "card_id"=>$card_id,
                "reduce_stock_value"=>$reduce_stock_value
                );
        }
        $result=$this->wxHttpsRequest($url,json_encode($data,JSON_UNESCAPED_UNICODE));
        $jsoninfo=json_decode($result,true);
        if ($jsoninfo['errmsg']=="ok") {
            return true;
        }
    }

     /*******************************************************
        *删除卡卷
        ******************************************************/
     public function delCard($card_id){
        $wxAccessToken=$this->wxAccessToken();
        $url="https://api.weixin.qq.com/card/delete?access_token=".$wxAccessToken;
        $data=array(
            "card_id"=>$card_id
            );
        $result=$this->wxHttpsRequest($url,json_encode($data,JSON_UNESCAPED_UNICODE));
        $jsoninfo=json_decode($result,true);
        if ($jsoninfo['errmsg']=="ok") {
            return true;
        }
     }

      /*******************************************************
        *卡卷更新所需数据数据 (parameter为网页post的数据)
        ****注意不包含logo_url字段
        ******************************************************/
      public function updateData($parameter){
        $data['notice']=$parameter['notice'];
        $data['description']=$parameter['description'];
        $data['color']=$parameter['color'];
        // 以上是必须字段 包括logo_url
        $data['service_phone']=$parameter['service_phone'];
        $data['custom_url_name']=$parameter['custom_url_name'];
        $data['custom_url']=$parameter['custom_url'];
        $data['custom_url_sub_title']=$parameter['custom_url_sub_title'];
        $data['code_type']=$parameter['code_type'];
        $data['get_limit']=$parameter['get_limit'];
        $data['can_share']=$parameter['can_share'];
        $data['can_give_friend']=$parameter['can_give_friend'];
        $data['begin_timestamp']=strtotime($parameter['begin_timestamp']);
        $data['end_timestamp']=strtotime($parameter['end_timestamp']);
        return $data;
      }

      /*******************************************************
        *更新卡卷 (先看updateDate_info())  返回bool
        ******************************************************/
      public function wxCardUpdate($data){
        $wxAccessToken=$this->wxAccessToken();
        $url="https://api.weixin.qq.com/card/update?access_token=".$wxAccessToken;
        $res=array(
            "card_id"=>$data['card_id'],
            strtolower($data['card_type'])=>array(
                "base_info"=>array(
                    "logo_url"=>$data['logo_url'],
                    "color"=>$data['color'],
                    "notice"=>$data['notice'],
                    "service_phone"=>$data['service_phone'],
                    "description"=>$data['description'],
                    "custom_url_name"=>$data['custom_url_name'],
                    "custom_url"=>$data['custom_url'],
                    "custom_url_sub_title"=>$data['custom_url_sub_title'],
                    "code_type"=>$data['code_type'],
                    "get_limit"=>$data['get_limit'],
                    "can_share"=>$this->isbool($data['can_share']),
                    "can_give_friend"=>$this->isbool($data['can_give_friend']),
                    "date_info"=>$this->updateDate_info($data)
                    )
                )
            );
        $result=$this->wxHttpsRequest($url,json_encode($res,JSON_UNESCAPED_UNICODE));
        $jsoninfo=json_decode($result,true);
        // dump($jsoninfo);
        // exit();
        if ($jsoninfo['errmsg']=="ok") {
            return true;
        }
      }

    /*******************************************************
        *微信仅支持修改时间格式为（date_info）为1（DATE_TYPE_FIX_TIME_RANGE）的时间格式
        *且（老type==新type）&新开始时间<=老结束时间&老结束时间<=新结束时间
        ******************************************************/
    public function updateDate_info($data){
        if ($data['type']==1) {
            $res=array(
                    "type"=>1,
                    "begin_timestamp"=>$data['begin_timestamp'],
                    "end_timestamp"=>$data['end_timestamp']
                            );
        }else $res=array(
            "type"=>2,
            "fixed_term"=>$data['fixed_term'],
            "fixed_begin_term"=>$data['fixed_begin_term']
            );
        return $res;
    }

    /*******************************************************
        *批量查询卡劵列表   最多获取50张卡劵
        ******************************************************/
    // public function getCardIdLits(){
    //     $wxAccessToken=$this->wxAccessToken();
    //     $url="https://api.weixin.qq.com/card/batchget?access_token=".$wxAccessToken;
    //     $data=array(
    //         "offset"=>0,
    //         "count"=> 50,   //待审核                  审核失败                  通过审核                 卡劵被商家删除
    //         "status_list"=>["CARD_STATUS_NOT_VERIFY","CARD_STATUS_VERIFY_FAIL","CARD_STATUS_VERIFY_OK", "CARD_STATUS_DISPATCH"]
    //         );
    //     $result=$this->wxHttpsRequest($url,json_encode($data,JSON_UNESCAPED_UNICODE));
    //     $jsoninfo=json_decode($result);
    //     dump($jsoninfo);
    //     exit();
    // }















    // 判断html提交卡卷字段是否为空并给出相应的错误信息
    public function isNull($reque,$erro){
        if (!empty($reque)) return true;
        else{
            echo "创建卡卷失败,".$erro;
            exit(1);
        }
    }

    /********判断卡卷类型是否正确*********/
    public function cardType_bool($card_type){
        $arr=array("GROUPON","CASH","DISCOUNT","GIFT","GENERAL_COUPON");
        $isin=in_array($card_type,$arr);
        return $isin;
    }

    // 是否填写商家名称
    public function brand_name_bool($brand_name){
        return self::isNull($brand_name,"请输入商家名称！");
    }

    // 是否上传图片
    public function logo_bool(){}

    // 是否填写了卡卷标题
    public function title_bool($title){
        return self::isNull($title,"请输入卡卷标题！");
    }

    // 是否填写卡卷颜色
    public function color_bool($color){
        $array=array("Color010","Color030","Color020","Color040",
            "Color050","Color060","Color070","Color080","Color081","Color090","Color100","Color101");
        $isin=in_array($color, $array);
        if ($isin) {
           return true;
        }else{
            echo "创建卡卷失败,请选择卡卷颜色！";
            exit(1);
        }
    }

    //验证字段
}
?>