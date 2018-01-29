<?php

namespace Admin\Controller;

use Think\Controller;

class SystemController extends Controller {

    public function login(){

    	if(IS_POST){

    		$Admin=M("Admin")->where(array("name"=>I("post.name"),"password"=>md5(I("post.pwd"))))->find();

    		if($Admin){

    			session("admin",$Admin);

    			$ret[code]=100;

    		}else{

    			$ret[code]=101;

    			$ret[data]="账号或者密码错误！";

    		}

    		  $this->ajaxReturn($ret);

    	}

    	$this->display();

    }

    public function other(){

    	$this->display();

    }
    public function myback(){
        session("admin",null);
        $this->redirect("Login");
    }

        public function del_model(){
        $data=json_decode(file_get_contents("php://input"),true);
        $data1=array(
          "touser"=>$data['openid'],
          "template_id"=>"XpNofJ2FmA4itu2aDokSoffduLZPn599m9_kMNKiPiw",
          "topcolor"=>"#FF0000",
          "data"=>array(
          "first"=>array("value"=>"Dear ".$data['username'].",你的订单已经被取消，请您见谅!","color"=>"#173177"),
          "keyword1"=>array("value"=>date("Y-m-d H:i",$data["add_time"]),"color"=>"#173177"),
          "keyword2"=>array("value"=>$data['total'],"color"=>"#173177"),
          "keyword3"=>array("value"=>$data["Detail"][0]["name"]."...","color"=>"#173177"),
          "keyword4"=>array("value"=>"已取消","color"=>"#173177"),
          "keyword5"=>array("value"=>"超过配送范围","color"=>"#173177"),
          "remark"=>array("value"=>"请您重新下单，或联系服务员，谢谢。","color"=>"#173177"),
        )
        );
        Vendor('Mywx.model');
        $tools = new \model();
        $info=$tools->sendModel($data1);
    }
    public function completemodel(){
        $id=file_get_contents("php://input");
        $data=D('order')->where(array('id'=>$id))->relation(true)->find();
        // $pre=M("config")->where("id=1")->cache("myconfig",72000)->find();
        $data1=array(
        "touser"=>$data['openid'],
        "template_id"=>"dq5CBOVVi03RZMTU2b2TwGLRoVsb4dKPZnmh0f4ReDw",
        "topcolor"=>"#FF0000",
        "data"=>array(
        "first"=>array("value"=>"您好，您的订单已经完成","color"=>"#173177"),
        "keyword1"=>array("value"=>$data["l_id"],"color"=>"#173177"),
        "keyword2"=>array("value"=>date("Y-m-d H:i",$data["add_time"]),"color"=>"#173177"),
        "keyword3"=>array("value"=>date("Y-m-d H:i"),"color"=>"#173177"),
        "remark"=>array("value"=>"感谢您的惠顾","color"=>"#173177"),
        )
        );
        Vendor('Mywx.model');
        $tools = new \model();
        $info=$tools->sendModel($data1);
    }
    public function check_Pmodel(){
            $id=file_get_contents("php://input");
            $data=D('order')->where(array('id'=>$id))->relation(true)->find();
            $pre=M("config")->where("id=1")->cache("myconfig",72000)->find();
              $data1=array(
                "touser"=>$data['openid'],
                "template_id"=>"wssmHitgdAGuW38eZeZX79-PAaBgRKCbUi32weSxsz0",
                "topcolor"=>"#FF0000",
                "data"=>array(
                  "first"=>array("value"=>"耘初已经受理了您的订单，请注意接单","color"=>"#173177"),
                  "keyword1"=>array("value"=>$data['p_name'],"color"=>"#173177"),
                  "keyword2"=>array("value"=>$data['p_tel'],"color"=>"#173177"),
                  "remark"=>array("value"=>"客服电话:".$pre['mobile'],"color"=>"#173177"),
                  )
              );
            Vendor('Mywx.model');
            $tools = new \model();
            $info=$tools->sendModel($data1);
    }

}