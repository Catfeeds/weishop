<?php
namespace Admin\Controller;
use Think\Controller;
class UserController extends CommonController {
    /***
    *用户列表
    ***/
    public function user_list(){
        // D('user')->_link['address']['condition'] ='phone='.'0';
        // // $result = D('user')->relation('address')->select();
        // $data=
        // dump($data);
        // exit();
    	$MODEL=M("User");
    	if(I("post.sogroup")==1){
            $search=I("post.so");
            $map["username"]= array('like','%'.$search.'%');
        }
    	$page_no = I('get.p') ? I('get.p') : 1;
    	$page_size=10;
    	$data=D('user')->page($page_no,$page_size)->where($map)->relation('address')->select();
     	$count =$MODEL->where($map)->count();
        if(I("post.sogroup")==2){
            if (I('post.so')!="") {
                $search=I("post.so");
                $data=M('user')->page($page_no,$page_size)->field('*,at_user.id')->join('right join __ADDRESS__ on __USER__.id=__ADDRESS__.user_id where status=1 and phone="'.$search.'"')->select();
                // dump($data);
                // exit();
                $count =M('user')->join('right join __ADDRESS__ on __USER__.id=__ADDRESS__.user_id where status=1 and phone="'.$search.'"')->count();
            }
        }
    	$Page = new \AntAge\Page($count,$page_size);
        $show = $Page->show();
        $this->assign('count', $count);
        $this->assign('page', $show);
    	$this->assign('data', $data);
        $so_group=I('post.sogroup');
        $so=I('post.so');
    	$this->assign('so_group', $so_group)->assign('so',$so);
    	$this->display();
    }

    /***
    *用户信息
    ***/
    public function info(){
    	if(IS_POST){
    		$user=M("User")->create($_POST);
    		$saveRes=M("User")->save($user);
            $addressD=M('address')->where(array('user_id'=>I('post.id'),'status'=>1))->find();
            $address=M('address')->create($_POST);
            $address['id']=$addressD['id'];
            if (!$addressD) {
                $address['status']=1;
                $address['user_id']=I('post.id');
                $addressA=M("address")->add($address);
            }
            $address=M("address")->save($address);
            if (($saveRes!==false&&$address!==false)||($saveRes!==false&&$addressA>0)) {
                $this->ajaxReturn(2);
            }
            $this->ajaxReturn(1);
    	}
    	$map["id"]=I("get.id");
    	$MODEL=M("User");
    	$data=$MODEL->where($map)->find();
        $where['user_id']=I("get.id");
        $where['status']=1;
        $address=M('address')->where($where)->find();
    	$this->assign('data', $data)->assign('address',$address);
    	$this->display();
    }

    public function del(){
    	$map["id"]=I("get.id");
    	$resu=M("User")->where($map)->delete();
        $resa=M('address')->where($map)->delete();
        if ($resu!==false&&$resa!==false) {
            $this->ajaxReturn(1);
        }
    	$this->ajaxReturn(2);
    }

    public function user_group(){
    	// $MODEL=M("Group");
    	// if(I("post.so")){
     //        $this->assign('so', I("post.so"));
     //        $search=I("post.so");
     //        $map["at_group.title"]= array('like','%'.$search.'%');
     //    }
    	// $f=array("at_group.id,at_group.title,count(*) as num,at_user.del");
    	// $map["at_group.del"]=0;
    	// $page_no = I('get.p') ? I('get.p') : 1;
    	// $page_size=2;
    	// $data=$MODEL->page($page_no,$page_size)->where($map)->join('at_user ON at_group.id = at_user.group_id','LEFT')->field($f)->group("at_group.id")->having("at_user.del=0")->select();

    	// $map1["del"]=0;
    	// $count =$MODEL->where($map1)->count();
    	// $Page = new \AntAge\Page($count,$page_size);
     //    $show = $Page->show();
     //    $this->assign('count', $count);
     //    $this->assign('page', $show);
    	// $this->assign('data', $data);
    	$this->display();
    }

    public function group_del(){
    	$id=I("get.id");
    	$map["group_id"]=1;
    	$del["del"]=1;
    	M("Group")->where(array("id"=>$id))->save($del);
    	M("User")->where(array("group_id"=>$id))->save($map);
    	$ret[code]=100;
    	$this->ajaxReturn($ret);
    }

}