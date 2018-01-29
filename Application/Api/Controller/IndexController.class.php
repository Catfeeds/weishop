<?php
namespace Api\Controller;
use Think\Controller;
class IndexController extends CommonController {
    public function index(){
    	$ad=M('ad')->where(array('status'=>0))->select();
    	$goods=M('goods')->select();
        $this->assign('ad',$ad)->assign('goods',$goods);
        // dump($goods);
        // exit();
    	$this->display();
    }

    // 购物车集合对象
    public function order(){
    	// if (IS_AJAX) {
      $car=I("post.cart");
    	if ($car['Count']=="0") {
            $res['code']=101;
            $res['erro']="购物没有东西";
    		$this->ajaxReturn($res);
    	}
        $address=M('address')->where(array("user_id"=>session("user.id"),"status"=>1))->find();
        if(!$address){
            $res['code']=102;
            $res['erro']="请先填写收货地址";
            $this->ajaxReturn($res);
        }

        $MODEL=M('goods');

        $order['o_address']="厦门市".I("post.address");
        $order['o_tel']=I("post.phone");
        $order['l_id']='AT'.session("user.id").time();//流水号
        $order['user_id']=session("user.id");
        $order['add_time']=time();
        $order['total']=0;//总价
    	//插入订单
	    foreach ($car['Items'] as $value) {
	    	  $goods=$MODEL->where(array('id'=>$value['Id']))->find();
              $order['total']+=($goods['price']*$value['Count']);
	    }
    	$order_id=M('order')->add($order);

    	//订单详情
        foreach ($car['Items'] as $key=>$value) {
	    	  $goods=$MODEL->where(array('id'=>$value['Id']))->find();
	    	  $detail_list[]=array(
  	                              'order_id'=>$order_id,
  	                              'goods_id'=>$goods['id'],
  	                              'price'=>$goods['price'],
  	                              'num'=>$value['Count'],
  	                              'name'=>$goods['title']
  	                              );
        }

        M('order_detail')->addAll($detail_list);

        // $order['total']=$order['total']*100;

        // Vendor('WxpayV3.WxPayPubHelper');
        // $tools = new \JsApiPay();
        // //①、获取用户openid

        // // // $openId = $tools->GetOpenid();
        // // $openId =session("openid");
        // //②、统一下单
        // $input = new \WxPayUnifiedOrder();
        // $input->SetBody("耘初");
        // $input->SetAttach($order['user_id']);
        // $input->SetOut_trade_no($order['l_id']);
        // $input->SetTotal_fee($order['total']);
        // $input->SetTime_start(date("YmdHis"));
        // $input->SetTime_expire(date("YmdHis", time() + 600));
        // $input->SetGoods_tag("耘初付款");
        // $input->SetNotify_url("http://bc.ant-age.com/index.php/Api/System/Wx_pay_ajax_ok");
        // $input->SetTrade_type("JSAPI");
        // $input->SetOpenid(session("user.openid"));

        // $wxorder = \WxPayApi::unifiedOrder($input);
        // $jsApiParameters = $tools->GetJsApiParameters($wxorder);
        if($order_id){
            $res["code"]=100;
            $res["data"]=$order_id;
        }else{
            $res["code"]=101;
            $res["erro"]="订单添加失败！";
        }

        $this->ajaxReturn($res);

    }
    public function souhuo(){
        $id=I("get.order_id");
        $result=M('order')->where(array('id'=>$id))->find();
        if($result){
          if($result["status"]==2){
                $pre=M("config")->where("id=1")->cache("myconfig",7200)->find();
                $money=$result["total"];
                $point=round($pre['point']*$money);
                M("User")->where(array("id"=>$result["user_id"]))->setInc('cent',$point);
                M("User")->where(array("id"=>$result["user_id"]))->setInc('balance');
                $where['user_id']=$result["user_id"];
                $where['cent']=$point;
                $where['add_time']=time();
                $where['title']="购物赠送";
                M("Ls")->add($where);
                M('order')->where(array('id'=>$id))->save(array("status"=>3));

              // $data=D('order')->where(array('id'=>I('post.id')))->relation(true)->find();
              $data1=array(
                "touser"=>session('user.openid'),
                "template_id"=>"dq5CBOVVi03RZMTU2b2TwGLRoVsb4dKPZnmh0f4ReDw",
                "topcolor"=>"#FF0000",
                "data"=>array(
                  "first"=>array("value"=>"您好，您的订单已经完成","color"=>"#173177"),
                  "keyword1"=>array("value"=>$result["l_id"],"color"=>"#173177"),
                  "keyword2"=>array("value"=>date("Y-m-d H:i",$result["addtime"]),"color"=>"#173177"),
                  "keyword3"=>array("value"=>date("Y-m-d H:i"),"color"=>"#173177"),
                  "remark"=>array("value"=>"感谢您的惠顾","color"=>"#173177"),
                  )
              );
              Vendor('Mywx.model');
              $tools = new \model();
              $info=$tools->sendModel($data1);
          }
        }
        return 100;
    }
    public function orderInfo(){
        // $id=I("get.id");
        // $detail=D('order')->relation('detail')->where(array('id'=>$id))->find();
        // $this->assign('detail',$detail);
        $id=I("get.id");
        if($id){
          $address=M('address')->where(array("id"=>$id))->find();
        }else{
          $address=M('address')->where(array("user_id"=>session("user.id"),"status"=>1))->find();
        }
        if(!$address){
          $this->redirect("PersonInfo/Address");
        }
        $this->assign('address',$address);
        $this->display();
    }
    public function Wxpay(){
        $id=I("get.id");
        $data=M('order')->where(array('id'=>$id,'status'=>0))->field("id,total")->find();
        $this->assign('data',$data);
        $this->display();
    }
    public function Order_pay(){
        $id=I("get.order_id");
        $data=M('order')->where(array('id'=>$id,'status'=>0))->find();
        if($data){
            if(!session($data['l_id'])){
              Vendor('WxpayV3.WxPayPubHelper');
              $tools = new \JsApiPay();
              $input = new \WxPayUnifiedOrder();
              $input->SetBody("耘初");
              $input->SetAttach($data['user_id']);
              $input->SetOut_trade_no($data['l_id']);
              $input->SetTotal_fee($data['total']*100);
              $input->SetTime_start(date("YmdHis"));
              $input->SetTime_expire(date("YmdHis", time() + 600));
              $input->SetGoods_tag("耘初付款");
              $input->SetNotify_url("http://bc.ant-age.com/index.php/Api/System/Wx_pay_ajax_ok");
              $input->SetTrade_type("JSAPI");
              $input->SetOpenid(session("user.openid"));
              $wxorder = \WxPayApi::unifiedOrder($input);
              $jsApiParameters = $tools->GetJsApiParameters($wxorder);
              session($data['l_id'],$jsApiParameters);
            }

            $res["code"]=100;
            $res["data"]=session($data['l_id']);
        }else{
            $res['code']=101;
            $res['erro']="订单已支付";
        }
        $this->ajaxReturn($res);
    }

    public function jisuan(){
            $cishu=M("User")->where(array("id"=>session('user.id')))->getField('balance');
            if($cishu>0){
              $fp = fopen('lock.txt', 'w');
              if(flock($fp, LOCK_EX|LOCK_NB)){
                  M("User")->where(array("id"=>session('user.id')))->setDec('balance');
                  $prize_arr=M("view")->select();
                  $rid =$this->get_rand($prize_arr); //根据概率获取奖项id
                  if($rid>0){
                      M("view")->where(array('id'=>$prize_arr[$rid-1]['id']))->setDec('num');
                      $res['code']=100;
                      $res['data']=$rid;
                      if($rid>1){
                         $address=M('address')->where(array("user_id"=>session("user.id"),"status"=>1))->find();
                         $add=array(
                             "user_id"=>session("user.id"),
                              "username"=>$address['name'],
                              "phone"=>$address['phone'],
                              "address"=>"厦门市".$address['mycity'].$address['address'],
                              "title"=>$prize_arr[$rid-1]['prize'],
                              "addtime"=>time(),
                              "status"=>0,
                          );
                        M("zhongjiang")->add($add);
                      }
                  }else{
                      $res['code']=100;
                      $res['data']=1;
                  }
                flock($fp, LOCK_UN);
              }else{
                  $res['code']=102;
                  $res['data']="网络繁忙！";
              }
              fclose($fp);
              $this->ajaxReturn($res);
            }else{
                  $res['code']=101;
                  $res['data']="您没有抽奖机会了！";
                  $this->ajaxReturn($res);
            }
        }
        public function get_rand($proArr) {
          $result = '';
          //概率数组的总概率精度
          $proSum=0;
            foreach ($proArr as $key => $val) {
              $proSum+=$val['num'];
            }
          //概率数组循环
          if($proSum>0){
            foreach ($proArr as $key => $proCur) {
              $randNum = mt_rand(1, $proSum);
              if ($randNum <= $proCur['num']) {
                $result =$key+1;
                break;
              } else {
                $proSum -=$proCur['num'];
              }
            }
            unset ($proArr);
            return $result;
          }else{
            unset ($proArr);
            return false;
          }
        }
    public function Dzp(){
          $cishu=M("User")->where(array("id"=>session('user.id')))->getField('balance');
          $data=M("view")->select();
          foreach ($data as $key => $value) {
              $prize.=$value['prize'].",";
          }
          $prize = substr($prize,0,strlen($prize)-1);
          $this->assign('prize',$prize)->assign('count',count($data))->assign('cishu',$cishu);
          $this->display();
     }

     public function Xianxia(){
          $id=I("get.order_id");
          $data=M('order')->where(array('id'=>$id,'status'=>0))->save(array("pay"=>1,'status'=>6));
          if($data){
              $res["code"]=100;
          }else{
              $res['code']=101;
              $res['erro']="订单状态已变更";
          }
          $this->ajaxReturn($res);
     }

}