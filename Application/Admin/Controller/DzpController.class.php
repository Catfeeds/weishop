<?php
namespace Admin\Controller;
use Think\Controller;
class DzpController extends Controller {
    public function index(){
        $data=M("View")->select();
        $dzp=M("config")->where("id=1")->getField("dzp");
        $this->assign('data',$data)->assign('dzp',$dzp);
        $this->display();
    }
    public function guanbi(){
        S("myconfig",null);
        $id=I("get.id");
        $s=($id==1)?2:1;
        $data=M("config")->where("id=1")->save(array("dzp"=>$s));
        if($data){
            M("User")->where(1)->save(array("balance"=>0));
            $this->ajaxReturn(1);
        }else{
            $this->ajaxReturn(2);
        }
    }
    public function info(){
        if (IS_POST) {
            $save=array(
                "id"=>I("post.id"),
                "num"=>I("post.num"),
                "prize"=>I("post.prize"),
            );
            M("View")->save($save);
            $this->ajaxReturn(1);
        }
        $id=I("get.id");
        $data=M("View")->where(array("id"=>$id))->find();
        $this->assign('data',$data);
        $this->display();
    }
    public function add(){
        if (IS_POST) {
            $save=array(
                "num"=>I("post.num"),
                "prize"=>I("post.prize"),
            );
            $a=M("View")->add($save);
            if($a){
                 $this->ajaxReturn(1);
             }else{
                $this->ajaxReturn(2);
             }
        }
        $this->display();
    }
    public function del(){
        $id=I("get.id");
        M("View")->delete($id);
        $this->ajaxReturn(1);
    }
    public function Zhongjiang(){
        $page_no = I('get.p') ? I('get.p') : 1;
        $page_size=10;
        if (IS_POST) {
            $where["title"]=array('like','%'.I('post.so').'%');
            $where["phone"]=array('like','%'.I('post.so').'%');
            $where["username"]=array('like','%'.I('post.so').'%');
            $where['_logic']='or';
            $map['_complex']=$where;
        }
        $data=M('Zhongjiang')->page($page_no,$page_size)->where($map)->order(array("status","id"=>"desc"))->select();
        $count=M('Zhongjiang')->where($map)->count();
        $Page = new \AntAge\Page($count,$page_size);
        $show = $Page->show();
        $this->assign('data',$data)->assign('count', $count)->assign('page', $show)->assign('so',I('post.so'));
        $this->display();
    }
    public function fahua(){
         $id=I("get.id");
         M("zhongjiang")->save(array("id"=>$id,"status"=>1));
        $this->ajaxReturn(1);
    }
}