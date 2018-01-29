<?php

namespace Admin\Controller;

use Think\Controller;

class OrdersController extends CommonController {



    /****

    *订单列表

    *****/

    public function Index()

    {

        $page_no = I('get.p') ? I('get.p') : 1;

        $page_size=10;

        $map['status']=array(array('gt',1),array('lt',4)) ;

        if (IS_POST) {

          $btime=I('post.btime') ? I('post.btime') : 0;

          $etime=I('post.etime')? I('post.etime') : date('Y-m-d',time());

          $map['add_time']=array('between',array(strtotime($btime),strtotime($etime)+86400));

          $where["l_id"]= array('like','%'.I('post.so').'%');

          $where["P.name"]=array('like','%'.I('post.so').'%');

          $where["username"]=array('like','%'.I('post.so').'%');

          $where["o_address"]=array('like','%'.I('post.so').'%');

          $where["o_tel"]=array('like','%'.I('post.so').'%');

          $where['_logic'] = 'or';

          $map['_complex']=$where;

        }

        $data=D('OrderView')->page($page_no,$page_size)->where($map)->order('status')->select();

        $count =D('OrderView')->where($map)->count();

        // dump($data);

        // exit();

        $Page = new \AntAge\Page($count,$page_size);

        $show = $Page->show();

        $this->assign('data',$data)->assign('count', $count)->assign('page', $show)->assign('btime',I('post.btime'))->assign('etime',I('post.etime'))->assign('so',I('post.so'));

        $this->display();

    }



    /****

    *分配订单

    *****/

    public function f_order()

    {


        $page_no = I('get.p') ? I('get.p') : 1;

        $page_size=10;

        $map['status']=array('in',array(0,1,6));

        if (IS_POST) {

          $where["l_id"]= array('like','%'.I('post.so').'%');

          $where["username"]=array('like','%'.I('post.so').'%');

          $where['_logic'] = 'or';

          $map['_complex']=$where;

        }

        $data=D('OrderView')->page($page_no,$page_size)->where($map)->order('status desc')->select();

        $count =D('OrderView')->where($map)->count();

        // dump($data);

        // exit();

        $Page = new \AntAge\Page($count,$page_size);

        $show = $Page->show();

        $p=M('p')->select();

        $this->assign('data',$data)->assign('count', $count)->assign('page', $show)->assign('so',I('post.so'))->assign('p',$p);

        $this->display();

    }



    /****

    *礼品订单

    *****/

    public function gift()

    {

        $page_no = I('get.p') ? I('get.p') : 1;

        $page_size=10;

        if (IS_POST) {

          $where["P.name"]= array('like','%'.I('post.so').'%');

          $where["username"]=array('like','%'.I('post.so').'%');

          $where["title"]=array('like','%'.I('post.so').'%');

          $where["classname"]=array('like','%'.I('post.so').'%');

          $where["g_address"]=array('like','%'.I('post.so').'%');

          $where["g_tel"]=array('like','%'.I('post.so').'%');

          $where['_logic'] = 'or';

          $map['_complex']=$where;

        }

        $data=D('OrderGiftView')->page($page_no,$page_size)->where($map)->order('status,id desc')->select();

        $count =D('OrderGiftView')->where($map)->count();

        // dump($data);

        // exit();

        $Page = new \AntAge\Page($count,$page_size);

        $show = $Page->show();

        $p=M('p')->select();

        $this->assign('data',$data)->assign('count', $count)->assign('page', $show)->assign('so',I('post.so'))->assign('p',$p);

        $this->display();

    }



    /****

    *选择派送员

    *****/

    public function gitfcheck_P()

    {

      if (IS_AJAX) {

          $data['id']=I('post.o_id');

          $data['p_id']=I('post.p_id');

          $data['status']=1;

          $res=M('order_gift')->save($data);

          if ($res!==false) {

            $this->ajaxReturn(1);

          }

          $this->ajaxReturn();

      }

    }



    /****

    *完成礼品订单

    *****/

    public function giftcomplete()

    {

      if (IS_AJAX) {

      $MODEL=M('order_gift');

      $data['status']=2;

      $res=$MODEL->where(array('id'=>I('post.id')))->save($data);

      if ($res!==false) {

          $this->ajaxReturn(1);

      }

      $this->ajaxReturn();

      }

    }



    /****

    *选择派送员

    *****/

    public function check_P()

    {

      if (IS_AJAX) {

          $data['id']=I('post.o_id');

          $data['p_id']=I('post.p_id');

          $data['status']=2;

          $res=M('order')->save($data);

          if ($res) {

            $this->ajaxReturn(1);

          }

          $this->ajaxReturn(2);

      }

    }



    /****

    *完成订单

    *****/

    public function complete()

    {

      if (IS_AJAX) {

      $MODEL=M('order');
      $id=I("post.id");
      $result=$MODEL->where(array('id'=>$id))->find();
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
          }
          $this->ajaxReturn(1);
      }else{
          $this->ajaxReturn();
      }

      // $data['status']=3;

      // $res=$MODEL->where(array('id'=>I('post.id')))->save($data);

      // if ($res!==false) {

      //     $this->ajaxReturn(1);

      // }

      // $this->ajaxReturn();

      }

    }



    /****

    *订单详情信息

    *****/

    public function info()

    {


        $data=M('order')->where(array('id'=>I('get.id')))->find();

        $detail=M('order_detail')->where(array('order_id'=>$data['id']))->select();

        $address=M('address')->where(array('user_id'=>$data['user_id'],'status'=>1))->find();

        $p=M('p')->where(array('id'=>$data['p_id']))->find();

        $this->assign('data',$data)->assign('detail',$detail)->assign('address',$address)->assign('p',$p);

        $this->display();

    }



    /****

    *礼品订单详情信息

    *****/

    public function giftinfo()

    {

        $data=D('OrderGiftView')->where(array('id'=>I('get.id')))->find();

        $address=M('address')->where(array('user_id'=>$data['user_id'],'status'=>1))->find();

        $p=M('p')->where(array('id'=>$data['p_id']))->find();

        $this->assign('data',$data)->assign('address',$address)->assign('p',$p);

        $this->display();

    }


    /****

    *退款详情信息

    *****/

    public function Refund()
    {

        $page_no = I('get.p') ? I('get.p') : 1;

        $page_size=10;

        $map['status']=array('gt',3);

        if (IS_POST) {

          $btime=I('post.btime') ? I('post.btime') : 0;

          $etime=I('post.etime')? I('post.etime') : date('Y-m-d',time());

          $map['add_time']=array('between',array(strtotime($btime),strtotime($etime)+86400));

          $where["l_id"]= array('like','%'.I('post.so').'%');

          $where["username"]=array('like','%'.I('post.so').'%');

          $where["o_address"]=array('like','%'.I('post.so').'%');

          $where["o_tel"]=array('like','%'.I('post.so').'%');

          $where['_logic'] = 'or';

          $map['_complex']=$where;

        }

        $data=D('OrderView')->page($page_no,$page_size)->where($map)->order('status,id desc')->select();

        $count =D('OrderView')->where($map)->count();

        // dump($data);

        // exit();

        $Page = new \AntAge\Page($count,$page_size);

        $show = $Page->show();

        $this->assign('data',$data)->assign('count', $count)->assign('page', $show)->assign('btime',I('post.btime'))->assign('etime',I('post.etime'))->assign('so',I('post.so'));
        $this->display();
    }


    /****

    *退款详情信息

    *****/
    public function rsuccess(){
      $data['id']=I('post.id');
      $data['status']=5;
      $res=M('order')->save($data);
      if ($res!==false) {
        $this->ajaxReturn(1);
      }
      $this->ajaxReturn();
    }

     public function del()
    {
        $data=D('order')->where(array('id'=>I('get.id')))->relation(true)->find();

        $res=M('order')->where(array('id'=>I('get.id')))->delete();
        $res=M('order_detail')->where(array('order_id'=>I('get.id')))->delete();
        if ($res!==false) {
            $data=array(
            "touser"=>$data['openid'],
            "template_id"=>"1KOI1qWYD-8dUjGVH4VqKQ1k39Ig-ZyXTjGq_1EEvFo",
            "topcolor"=>"#FF0000",
            "data"=>array(
              "first"=>array("value"=>"Dear".$data['username'].",你的订单已经被取消，请您见谅","color"=>"#173177"),
              "keyword1"=>array("value"=>"耘初","color"=>"#173177"),
              "keyword2"=>array("value"=>$data['l_id'],"color"=>"#173177"),
              "keyword3"=>array("value"=>time(),"color"=>"#173177"),
              "keyword4"=>array("value"=>$data['total'],"color"=>"#173177"),
              "keyword5"=>array("value"=>"超过配送范围","color"=>"#173177"),
              "remark"=>array("value"=>"请您重新下单，或联系服务员，谢谢。","color"=>"#173177"),
            )
            );
            Vendor('Mywx.model');
            $tools = new \model();
            $info=$tools->sendModel($data);
            $this->ajaxReturn(1);
        }
        $this->ajaxReturn(2);
    }



}

?>