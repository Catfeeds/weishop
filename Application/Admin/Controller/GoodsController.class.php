<?php

namespace Admin\Controller;

use Think\Controller;

class GoodsController extends CommonController {



    /****

    *普通商品列表

    *****/

    public function Index()

    {

        $page_no = I('get.p') ? I('get.p') : 1;

        $page_size=10;

        if (IS_POST) {

          $map["title"]=array('like','%'.I('post.so').'%');

        }

        $data=M('goods')->page($page_no,$page_size)->where($map)->order('id desc')->select();

        $count=M('goods')->where($map)->count();

        $Page = new \AntAge\Page($count,$page_size);

        $show = $Page->show();

        $this->assign('data',$data)->assign('count', $count)->assign('page', $show)->assign('so',I('post.so'));

        $this->display();

    }



    /****

    *修改商品信息

    *****/

    public function info()

    {

        if (IS_POST) {

          $img=com_upload("goods","img");

          // 简介图片不为空

          if (!is_null($img["photo"])) {

            $_POST['img']=$img["photo"];

          }

          // 详情图片不为空

          if (!is_null($img["photo1"])) {

            $_POST['d_img']=$img["photo1"];

          }

          $data=M("goods")->create($_POST);

          // 新增商品

          if (trim(I('post.id'))=="") {

              $addres=M('goods')->add($data);

              if ($addres>0) {

                $this->ajaxReturn(1);

              }

              $this->ajaxReturn(2);

          }

            $saveRes=M("goods")->save($data);

            if ($saveRes!==false) {

              // 成功

              $this->ajaxReturn(1);

            }

            $this->ajaxReturn(2);

        }

        $data=M('goods')->where(array('id'=>I('get.id')))->find();

        $this->assign('data',$data);

        $this->display();

    }



    /****

    *删除商品

    *****/

    public function del()

    {

        $res=M('goods')->where(array('id'=>I('get.id')))->delete();

        if ($res!==false) {

                $this->ajaxReturn(1);

        }

        $this->ajaxReturn(2);

    }



    /****

    *积分类别列表

    *****/

    public function centclass()

    {

        $page_no = I('get.p') ? I('get.p') : 1;

        $page_size=10;

        if (IS_POST) {

          $map["classname"]=array('like','%'.I('post.so').'%');

        }

        $data=M('class')->page($page_no,$page_size)->where($map)->select();

        $count=M('class')->where($map)->count();

        $Page = new \AntAge\Page($count,$page_size);

        $show = $Page->show();

        $this->assign('data',$data)->assign('count', $count)->assign('page', $show)->assign('so',I('post.so'));

        $this->display();

    }



    /****

    *修改积分类别列表

    *****/

    public function classinfo()

    {

        if (IS_POST) {

          $data=M("class")->create($_POST);

          // 新增商品

          if (trim(I('post.id'))=="") {

              $addres=M('class')->add($data);

              if ($addres>0) {

                $this->ajaxReturn(1);

              }

              $this->ajaxReturn(2);

          }

            $saveRes=M("class")->save($data);

            if ($saveRes!==false) {

              // 成功

              $this->ajaxReturn(1);

            }

            $this->ajaxReturn(2);

        }

        $data=M('class')->where(array('id'=>I('get.id')))->find();

        $this->assign('data',$data);

        $this->display();

    }



    /****

    *删除类别

    *****/

    public function classdel()

    {

        $res=M('class')->where(array('id'=>I('get.id')))->delete();

        if ($res!==false) {

                $this->ajaxReturn(1);

        }

        $this->ajaxReturn(2);

    }





    /****

    *积分商品列表

    *****/

    public function gift()

    {

        $page_no = I('get.p') ? I('get.p') : 1;

        $page_size=10;

        if (IS_POST) {

          $map["title"]=array('like','%'.I('post.so').'%');

        }

        $data=D('GiftView')->page($page_no,$page_size)->where($map)->order('id desc')->select();

        $count=D('GiftView')->where($map)->count();

        $Page = new \AntAge\Page($count,$page_size);

        $show = $Page->show();

        $this->assign('data',$data)->assign('count', $count)->assign('page', $show)->assign('so',I('post.so'));

        $this->display();

    }



    /****

    *修改积分商品信息

    *****/

    public function giftinfo()

    {

        if (IS_POST) {

          $img=com_upload("gift","img");

          // 简介图片不为空

          if (!is_null($img["photo"])) {

            $_POST['img']=$img["photo"];

          }

          // 详情图片不为空

          if (!is_null($img["photo1"])) {

            $_POST['d_img']=$img["photo1"];

          }

          $data=M("gift")->create($_POST);

          // 新增商品

          if (trim(I('post.id'))=="") {

              $addres=M('gift')->add($data);

              if ($addres>0) {

                $this->ajaxReturn(1);

              }

              $this->ajaxReturn(2);

          }

            $saveRes=M("gift")->save($data);

            if ($saveRes!==false) {

              // 成功

              $this->ajaxReturn(1);

            }

            $this->ajaxReturn(2);

        }

        $data=M('gift')->where(array('id'=>I('get.id')))->find();

        $class=M('class')->select();

        $this->assign('data',$data)->assign('class',$class);

        $this->display();

    }





    /****

    *删除礼品

    *****/

    public function giftdel()

    {

        $res=M('gift')->where(array('id'=>I('get.id')))->delete();

        if ($res!==false) {

                $this->ajaxReturn(1);

        }

        $this->ajaxReturn(2);

    }





}

?>