<?php
namespace Api\Controller;
use Think\Controller;
class ArticleController extends CommonController {
    public function Article(){
        $class_id=I("get.id");
        $type=M("ArticleType")->where(array("class_id"=>$class_id))->order("orderby desc")->limit(4)->select();
        $type_id=I("get.type",$type[0]['id']);
        $page=I("get.page",1);
        $data=M('Article')->where(array("article_type_id"=>$type_id))->order("hot")->page($page,10)->select();
        if(IS_AJAX){
            $this->ajaxReturn($data);
        }
        foreach ($type as $key => $value) {
            $ids[]=$value['id'];
        }

        $ad=M('Article')->where(array("ad"=>1,'article_type_id'=>array("in",$ids)))->field('id,img,ad,title,content')->select();

        $this->assign('ad',$ad)->assign('type',$type)->assign('data',$data);
        $this->display();
    }
    public function Info(){
        $id=I("get.id");
        $data=M('Article')->where(array("id"=>$id))->field("id,title,content")->find();
        $this->assign('data',$data);
        $this->display();
    }
}