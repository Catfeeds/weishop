<?php
function com_upload($Path,$name) {
    // dump($name);exit();
    $upload = new \Think\Upload();
     // 实例化上传类
    $upload->maxSize = 3145728;
     // 设置附件上传大小
    $upload->exts = array('jpg', 'gif', 'png', 'jpeg');
     // 设置附件上传类型
    $upload->rootPath ='./Public/';
     // 设置附件上传根目录
    $upload->savePath  ='/Uploads/'.$Path.'/';

    $upload->autoSub = true;
    $upload->subName ="$name";
     // 设置附件上传（子）目录
    $info = $upload->upload();
    if (!$info) {
         // 上传错误提示错误信息
        // $this->error($upload->getError());
    }
    else {
         // 上传成功
        //$this->success('上传成功！');
        foreach ($info as $key =>$file) {
            $url[$key] =$file['savepath'] . $file['savename'];
        }
        //dump($url);exit();
        return $url;
    }

}
?>