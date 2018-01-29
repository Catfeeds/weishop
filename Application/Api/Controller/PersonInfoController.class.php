<?php
namespace Api\Controller;
use Think\Controller;
class PersonInfoController extends CommonController {
    /**
    *个人中心
    **/
    public function index(){
        $user_id=session('user.id');
        $data=M('user')->where(array('id'=>$user_id))->find();
        $pre=M("config")->where("id=1")->cache("myconfig",72000)->find();
        $this->assign('vo',$data)->assign('pre',$pre);
        $this->display();
    }
    /**
    *积分详情
    **/
    public function cent()
    {
        $user_id=session('user.id');
        $cent=M('ls')->where(array('user_id'=>$user_id))->order('add_time desc')->select();
        $data=M('user')->where(array('id'=>$user_id))->find();
        $this->assign('cent',$cent)->assign('total',$data['cent']);
        $this->display();
    }
    /**
    *商品详情
    **/
    public function goods_detail($id)
    {
        $goods=M('goods')->where(array('id'=>$id))->find();
        $this->assign('goods',$goods);
        $this->display();
    }
    /**
    *订单列表
    **/
    public function order(){
        $user_id=session('user.id');
        // $order=M('order')->where(array('user_id'=>$user_id))->select();
        $where['user_id']=$user_id;
        if(IS_AJAX) {
         $where['status']=(I('post.status')==4)?array('in',array(4,5)):I('post.status');
         if(I('post.status')==0){
            $where['status']=array('in',array(0,6));
         }
         $order=D('order')->relation('detail')->where($where)->order('id desc')->select();
         $this->ajaxReturn($order);
        }
        $where['status']=(I('get.status')==4)?array('in',array(4,5)):I('get.status');
         if(I('get.status')==0){
            $where['status']=array('in',array(0,6));
         }
        $order=D('order')->relation('detail')->where($where)->order('id desc')->select();
        $this->assign('order',$order)->assign('num',I('get.status'));
        $this->display();
    }
    /**
    *订单详情
    **/
    public function order_details($id){
        $detail=D('order')->relation('detail')->where(array('id'=>$id))->select();
        if($detail[0]['status']==2){
            $qishi=M("P")->where(array("id"=>$detail[0]['p_id']))->find();
            $this->assign('qishi',$qishi);
        }
        $this->assign('detail',$detail[0]);//订单和等单详情一对多 订单详情只取一条
        $this->display();
    }
    /**
    *地址
    **/
    public function address(){
        $user_id=session('user.id');
        $address=M('address')->where(array('user_id'=>$user_id))->select();
        $this->assign('address',$address);
        $this->display();
    }
    public function address1(){
        $user_id=session('user.id');
        $address=M('address')->where(array('user_id'=>$user_id))->select();
        $this->assign('address',$address);
        $this->display();
    }
    public function address2(){
        $user_id=session('user.id');
        $address=M('address')->where(array('user_id'=>$user_id))->select();
        $this->assign('address',$address);
        $this->display();
    }
    /**
    *修改地址
    **/
    public function update_address($id){
        if (IS_AJAX) {
            $data['user_id']=session('user.id');
            $data['address']=trim(I('post.address'));
            $data['sex']=trim(I('post.sex'));
            $data['phone']=trim(I('post.tel'));
            $data['name']=trim(I('post.name'));
            $data['mycity']=trim(I('post.mycity'));
            if (trim(I('post.sex'))!="") {
                $data['sex']=trim(I('post.sex'));
            }
            $res=M('address')->where(array('id'=>$id))->save($data);
            $this->ajaxReturn($res);
        }
        $city=M("City")->cache("city",72000)->select();
        $address=M('address')->where(array('id'=>$id))->find();
        $this->assign('address',$address)->assign('city',$city);;
        $this->display();
    }
    /**
    *删除地址
    **/
    public function del_address()
    {
       if (IS_AJAX) {
           $res=M('address')->where(array('id'=>trim(I('post.id'))))->delete();
           $this->ajaxReturn($res);
       }
    }
    /**
    *添加地址
    **/
    public function add_address(){
        if (IS_AJAX) {
            $data['user_id']=session('user.id');
            $select=M('address')->where(array('user_id'=>$data['user_id']))->select();
            if (!$select) {
                //查询是否存在地址如果没有存在地址将该地址设置为默认
                $data['status']=1;
            }
            $data['address']=trim(I('post.address'));
            $data['sex']=trim(I('post.sex'));
            $data['mycity']=trim(I('post.mycity'));
            $data['phone']=trim(I('post.tel'));
            $data['name']=trim(I('post.name'));
            $res=M('address')->add($data);
            $this->ajaxReturn($res);
        }
        $city=M("City")->cache("city",72000)->select();
        $this->assign('city',$city);
        $this->display();
    }
    /**
    *添加地址
    **/
    public function status()
    {
        if (IS_AJAX) {
            $MODEL=M('address');
            $where['id']=I('post.id');
            $user_id=session('user.id');
            $all=$MODEL->where(array('user_id'=>session('user.id')))->save(array('status'=>0));
            if ($all!==false) {
                $res=$MODEL->where($where)->save(array('status'=>1));
                if ($res!==false) {
                    // 更新成功
                    $this->ajaxReturn(1);
                }
            }
            $this->ajaxReturn(2);
        }
    }
    /**
    *积分商城
    **/
    public function gift()
    {
        $user_id=session('user.id');
        $map="cent desc";
        $where['status']=0;
        $where['count']=array('GT',0);
        if (IS_AJAX) {
            // 升序
            if (I('post.cent')==1){
                $map="cent";
            }elseif(I('post.cent')==2) {
                // 倒序
                $map="cent desc";
            }elseif(I('post.cent')==3){
                // 全部
                $gift=D('GiftView')->where($where)->select();
                $this->ajaxReturn($gift);
            }elseif(I('post.class_id')!=""){
                $where['class_id']=I('post.class_id');
                $gift=D('GiftView')->where($where)->select();
                $this->ajaxReturn($gift);
            }
            $gift=D('GiftView')->where($where)->order($map)->select();
            $this->ajaxReturn($gift);
        }
        $gift=D('GiftView')->where($where)->order($map)->select();
        $udata=M('user')->where(array('id'=>$user_id))->find();
        $class=M('class')->select();
        $this->assign('gift',$gift)->assign('user',$udata)->assign('class',$class);
        $this->display();
    }
    /**
    *购买礼品
    **/
    public function buygift()
    {
         if (IS_AJAX) {
            $user_id=session('user.id');
            $gift=M('gift')->where(array(
                                          'id'=>I('post.id'),
                                          'status'=>0
                                         ))->find();
            // 没有库存
            if ($gift['count']<=0) {
                $status['count']=1;
                $this->ajaxReturn($status);
            }
            $user=M('user')->where(array('id'=>$user_id))->find();
            //积分不够
            if ($user['cent']<$gift['cent']) {
                $status['cent']=1;
                $this->ajaxReturn($status);
            }
            $user['cent']=$user['cent']-$gift['cent'];
            $user['id']=$user_id;
            M('user')->save($user);
            $address=M('address')->where(array('user_id'=>$user_id,'status'=>1))->find();
            $gift['count']=$gift['count']-1;
            $gift['id']=I('post.id');
            M('gift')->save($gift);
            $order_gift['user_id']=$user_id;
            $order_gift['gift_id']=I('post.id');//订单号
            $order_gift['title']=$gift['title'];
            $order_gift['add_time']=time();
            $order_gift['cent']=$gift['cent'];
            $order_gift['class_id']=$gift['class_id'];
            $order_gift['g_address']="厦门市".$address['mycity'].$address['address'];
            $order_gift['g_tel']=$address['phone'];
            $ls['cent']=-$gift['cent'];
            $ls['add_time']=time();
            $ls['title']="兑换";
            $ls['user_id']=$user_id;
            M('ls')->add($ls);
            $status['add']=M('order_gift')->add($order_gift);
            $this->ajaxReturn($status);
         }
    }
    public function gift_address(){
         $id=I("get.id");
         $address=M('address')->where(array("id"=>$id))->find();
         $gid=I("get.gid");
         $sa['g_tel']=$address['phone'];
         $sa['g_address']="厦门市".$address['mycity'].$address['address'];
         M('order_gift')->where(array("id"=>$gid))->save($sa);
         $this->ajaxReturn(1);
    }
    /**
    *礼品详情
    **/
    public function gift_detail($id)
    {
        $gift=M('gift')->where(array('id'=>$id))->find();
        $this->assign('gift',$gift);
        $this->display();
    }
    /**
    *礼品列表
    **/
    public function gift_cart()
    {
        $user_id=session('user.id');
        // $user_id=1;
        $gift=M('OrderGift')->where(array('user_id'=>$user_id))->order('id desc')->select();
        $this->assign('gift',$gift);
        $this->display();
    }
     public function dap_jl(){
       $gift= M("zhongjiang")->where(array("user_id"=>session("user.id")))->select();
       $this->assign('gift',$gift);
       $this->display();
     }
    /**
    *取消订单
    **/
    public function cancel()
    {
        M('order')->where(array('id'=>I('post.id')))->delete();
        M('order_detail')->where(array('order_id'=>I('post.id')))->delete();
        $this->ajaxReturn(1);
    }
    /**
    *退款
    **/
    public function out()
    {
        if (IS_AJAX) {
            $data['id']=I('post.id');
            $res=M('order')->where($data)->find();
            if ($res['status']==1) {
                $data['status']=4;
                $rs=M('order')->save($data);
                if ($rs!==false) {
                    $this->ajaxReturn(1);
                }
            }
        }
        $this->ajaxReturn();
    }
    public function women(){
        $data=M("Women")->where("id=1")->cache("Women",3600)->getField("my");
        $this->assign('data',$data);
        $this->display();
    }
}