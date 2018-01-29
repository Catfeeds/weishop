<?php
namespace Admin\Controller;
use Think\Controller;
class ShopperController extends CommonController {

	/****
	*配送员列表
	*****/
	public function Index()
	{
    		$MODEL=M("p");
      	$page_no = I('get.p') ? I('get.p') : 1;
      	$page_size=10;
      	$data=$MODEL->page($page_no,$page_size)->select();
      	$count =$MODEL->count();
        if (I('post.so')!="") {
            $search=I("post.so");
            $map["name"]= array('like','%'.$search.'%');
            $map["tel"]= array('like','%'.$search.'%');
            $map['_logic'] = 'or';
            $data=$MODEL->page($page_no,$page_size)->where($map)->select();
            $count=$MODEL->where($map)->count();
            // dump($s_data);
            // exit();
        }
      	$Page = new \AntAge\Page($count,$page_size);
        $show = $Page->show();
        $this->assign('count', $count);
        $this->assign('page', $show);
      	$this->assign('data', $data);
    		$this->display();
	}

	/****
	*修改配送员信息
	*****/
	public function info()
	{
        if (IS_AJAX) {
           $MODEL=M('p');
           if (I('post.id')=="") {
              $data=$MODEL->create($_POST);
              $res=$MODEL->add($data);
              if ($res>0) {
                  $this->ajaxReturn(1);
              }else $this->ajaxReturn();
           }
           $data=$MODEL->create($_POST);
           $res=$MODEL->save($data);
           if ($res!==false) {
               $this->ajaxReturn(1);
           }
           $this->ajaxReturn();
        }
		$data=M('p')->where(array('id'=>I('get.id')))->find();
		$this->assign('data',$data);
		$this->display();
	}

    /****
    *删除配送员
    *****/
    public function del()
    {
        $res=M('p')->where(array('id'=>I('get.id')))->delete();
        if ($res!==false) {
                $this->ajaxReturn(1);
        }
        $this->ajaxReturn(2);
    }


}
?>