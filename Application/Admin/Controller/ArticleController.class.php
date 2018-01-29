<?php
namespace Admin\Controller;
use Think\Controller;
class ArticleController extends CommonController {
	/**
	 * [index 文章列表]
	 * @return [type] [description]
	 */
    public function index()
    {
    	$MODEL=D("ArticleView");
    	$page_no = I('get.p') ? I('get.p') : 1;
    	$page_size=10;
    	if(I("post.so")){
            $search=I("post.so");
            $map["myclass"]=array('like','%'.I('post.so').'%');
            $map["type"]=array('like','%'.I('post.so').'%');
            $map["title"]=array('like','%'.I('post.so').'%');
            $map["title2"]=array('like','%'.I('post.so').'%');
            $map['_logic'] = 'or';
        }
    	$data=$MODEL->page($page_no,$page_size)->where($map)->order('id desc')->select();
    	$count =$MODEL->count();
    	$Page = new \AntAge\Page($count,$page_size);
        $show = $Page->show();
        $this->assign('count', $count);
        $this->assign('page', $show);
    	$this->assign('data', $data);
    	$this->assign('so',I('post.so'));
		$this->display();
    }
    
    /**
     * [del 删除文章]
     * @return [type] [description]
     */
    public function del()
    {
    	$res=M('article')->where(array('id'=>I('get.id')))->delete();
        if ($res!==false) {
                $this->ajaxReturn(1);
        }
        $this->ajaxReturn(2);
    }

    public function info()
    {
    	$articleModel=M('article');
    	$article_typeModel=M('article_type');
      $article_classModel=M('article_class');
    	if (IS_POST) {
          $img=com_upload("Article","img");
          // 简介图片不为空
          if (!is_null($img["photo"])) {
            $_POST['img']=$img["photo"];
          }
          $data=$articleModel->create($_POST);
          // 新增商品
          if (trim(I('post.id'))=="") {
              $addres=$articleModel->add($data);
              if ($addres>0) {
                $this->ajaxReturn(1);
              }
              $this->ajaxReturn(2);
          }
            $saveRes=$articleModel->save($data);
            if ($saveRes!==false) {
              // 成功
              $this->ajaxReturn(1);
            }
            $this->ajaxReturn(2);
        }
    	$data=$articleModel->where(array('id'=>I('get.id')))->find();
      if (trim(I('get.id'))!="") {
        $where['id']=$data['article_type_id'];
      }
      $type1=$article_typeModel->where($where)->find();
    	$type=$article_typeModel->where(array('class_id'=>$type1['class_id']))->order('orderby desc')->select();
      $class=$article_classModel->select();
    	$this->assign('data',$data)->assign('type',$type)->assign('class',$class)->assign('type1',$type1);
    	$this->display();
    }
    
    /**
     * [show 上架广告]
     * @return [type] [description]
     */
    public function show()
    {
    	$MODEL=M('article');
    	$where['id']=I('post.id');
        $data['ad']=I('post.ad');
        $res=$MODEL->where($where)->save($data);
        if ($res!==false) {
            $data=$MODEL->where($where)->find();
            $this->ajaxReturn($data);
        }
        $this->ajaxReturn(1);
    }
    
    /**
     * [article_type 文章类型列表]
     * @return [type] [description]
     */
    public function article_type()
    {
    	$MODEL=M('article_type');
    	$page_no = I('get.p') ? I('get.p') : 1;
        $page_size=10;
        if (IS_POST) {
          $map["classname"]=array('like','%'.I('post.so').'%');
        }
        $data=$MODEL->field('*,at_article_type.id')->join('right join __ARTICLE_CLASS__  on __ARTICLE_TYPE__.class_id=__ARTICLE_CLASS__.id')->page($page_no,$page_size)->where($map)->order('at_article_type.id desc')->select();
        // dump($data);
        // exit();
        $count=$MODEL->where($map)->count();
        $Page = new \AntAge\Page($count,$page_size);
        $show = $Page->show();
        $this->assign('data',$data)->assign('count', $count)->assign('page', $show)->assign('so',I('post.so'));
        $this->display();
    }

    /**
     * [Article_typeinfo 文章类别信息]
     */
    public function Article_typeinfo()
    {
    	$MODEL=M('article_type');
      $mokuaiModel=M('article_class');
    	if (IS_POST) {
          $data=$MODEL->create($_POST);
          // 新增商品
          if (trim(I('post.id'))=="") {
              $addres=$MODEL->add($data);
              if ($addres>0) {
                $this->ajaxReturn(1);
              }
              $this->ajaxReturn(2);
          }
            $saveRes=$MODEL->save($data);
            if ($saveRes!==false) {
              // 成功
              $this->ajaxReturn(1);
            }
            $this->ajaxReturn(2);
        }
        $data=$MODEL->where(array('id'=>I('get.id')))->find();
        $mokuai=$mokuaiModel->select();
        $this->assign('data',$data)->assign('mokuai',$mokuai);
        $this->display();
    }
    
    /**
     * [Article_type_del 删除类别]
     */
    public function Article_type_del()
    {
    	$res=M('article_type')->where(array('id'=>I('get.id')))->delete();
        if ($res!==false) {
                $this->ajaxReturn(1);
        }
        $this->ajaxReturn(2);
    }
    
    /**
     * [mokuai 模块]
     * @return [type] [description]
     */
    public function mokuai()
    {
      $MODEL=M('article_class');
      $page_no = I('get.p') ? I('get.p') : 1;
        $page_size=10;
        if (IS_POST) {
          $map["myclass"]=array('like','%'.I('post.so').'%');
        }
        $data=$MODEL->page($page_no,$page_size)->where($map)->order('id desc')->select();
        $count=$MODEL->where($map)->count();
        $Page = new \AntAge\Page($count,$page_size);
        $show = $Page->show();
        $this->assign('data',$data)->assign('count', $count)->assign('page', $show)->assign('so',I('post.so'));
      $this->display();
    }
    
    /**
     * [classinfo 修改信息]
     * @return [type] [description]
     */
    public function classinfo()
    {
      $MODEL=M('article_class');
      if (IS_POST) {
          $data=$MODEL->create($_POST);
          // 新增商品
          if (trim(I('post.id'))=="") {
              $addres=$MODEL->add($data);
              if ($addres>0) {
                $this->ajaxReturn(1);
              }
              $this->ajaxReturn(2);
          }
            $saveRes=$MODEL->save($data);
            if ($saveRes!==false) {
              // 成功
              $this->ajaxReturn(1);
            }
            $this->ajaxReturn(2);
        }
      $data=$MODEL->where(array('id'=>I('get.id')))->find();
      $this->assign('data',$data);
      $this->display();
    }
    
    /**
     * [classdel 删除模块]
     * @return [type] [description]
     */
    public function classdel()
    {
      $res=M('article_class')->where(array('id'=>I('get.id')))->delete();
        if ($res!==false) {
                $this->ajaxReturn(1);
        }
      $this->ajaxReturn(2);
    }

    /**
     * [mkchange 模块选择]
     * @return [type]        [description]
     */
    public function mkchange()
    {
      $MODEL=M('article_type');
      if (IS_AJAX) {
        $data=$MODEL->where(array('class_id'=>I('post.class_id')))->select();
        $this->ajaxReturn($data);
      }
    }
}