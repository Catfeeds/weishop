<?php
namespace Admin\Controller;
use Think\Controller;
class AdController extends CommonController {

	/****
	*轮播广告
	*****/
	public function Index()
	{
		 $MODEL=M("ad");
    	// if(I("post.so")){
     //        $this->assign('so', I("post.so"));
     //        $search=I("post.so");
     //        $map["at_group.title"]= array('like','%'.$search.'%');
     //    }
    	// $f=array("at_group.id,at_group.title,count(*) as num,at_user.del");
    	// $map["at_group.del"]=0;
    	$page_no = I('get.p') ? I('get.p') : 1;
    	$page_size=10;
    	// $data=$MODEL->page($page_no,$page_size)->where($map)->join('at_user ON at_group.id = at_user.group_id','LEFT')->field($f)->group("at_group.id")->having("at_user.del=0")->select();

    	// $map1["del"]=0;
    	$data=$MODEL->page($page_no,$page_size)->select();
    	$count =$MODEL->count();
    	$Page = new \AntAge\Page($count,$page_size);
        $show = $Page->show();
        $this->assign('count', $count);
        $this->assign('page', $show);
    	$this->assign('data', $data);
		$this->display();
	}


    public function chang_img(){
        $MODEL=M('ad');
        // $this->ajaxReturn(I('post.photo'));
        $img=com_upload("ad","img");
        if (is_null($img["photo"])) {
            // 图片上传失败
            $this->ajaxReturn(1);
        }
        $data['img']=$img["photo"];
        $data['url']=trim(I('post.url'));
        //新增广告
        if (I('post.id')=="") {
            $res1=$MODEL->add($data);
            if ($res1>0) {
                $this->ajaxReturn(2);
            }
            $this->ajaxReturn(3);
        }
        $where['id']=I('post.id');
        $res=$MODEL->where($where)->save($data);
        // 图片上传成功
        if ($res!==false) {
            $this->ajaxReturn(2);
        }
        $this->ajaxReturn(3);
    }

	/****
	*修改轮播广告
	*****/
	public function info()
	{
		$data=M('ad')->where(array('id'=>I('get.id')))->find();
		$this->assign('data',$data);
		$this->display();
	}

    /****
    *删除轮播广告
    *****/
    public function del()
    {
        $res=M('ad')->where(array('id'=>I('get.id')))->delete();
        if ($res!==false) {
                $this->ajaxReturn(1);
        }
        $this->ajaxReturn(2);
    }

    /****
    *上下架轮播广告
    *****/
    public function show()
    {
        $where['id']=I('post.id');
        $data['status']=I('post.status');
        $res=M('ad')->where($where)->save($data);
        if ($res!==false) {
            $data=M('ad')->where($where)->find();
            $this->ajaxReturn($data);
        }
        $this->ajaxReturn(1);
    }

}
?>