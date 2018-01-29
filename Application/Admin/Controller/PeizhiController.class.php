<?php
namespace Admin\Controller;
use Think\Controller;
class PeizhiController extends CommonController {
    public function index(){
        if(IS_POST){
          $model= M("config");
          $model->create();

          $img=com_upload("bg","img");
          if (!is_null($img["img"])) {
            $model->img=$img["img"];
          }

          $model->save();
          $this->ajaxReturn(1);
        }
        $config=M("config")->where("id=1")->find();
        $this->assign('config',$config);
        $this->display();
    }
    public function women(){
        if(IS_POST){
           $model= M("Women");
           $model->create();
           $model->save();
           $this->ajaxReturn(1);
        }
        $data=M("Women")->where("id=1")->getField("my");
        $this->assign('data',$data);
        $this->display();
    }
    public function city(){
        $city=M("City")->select();
        $this->assign('city',$city);
        $this->display();
    }
    public function del(){
        $id=I("get.id");
        M("City")->where(array("id"=>$id))->delete();
        $this->ajaxReturn(100);
    }
    public function add(){
       if(IS_AJAX){
           $add['city']=I("post.city");
           M("City")->add($add);
           $this->ajaxReturn(100);
        }
          $this->display();
    }
    public function info(){
        if(IS_AJAX){
           $model= M("City");
           $model->create();
           $model->save();
           $this->ajaxReturn(100);
        }
        $id=I("get.id");
        $data=M("City")->where(array("id"=>$id))->find();
        $this->assign('data',$data);
        $this->display();
    }

}