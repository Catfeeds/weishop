<?php
namespace Admin\Controller;
use Think\Controller;
class ScanController extends Controller {
    public function index(){
        if(IS_POST){
            $Scan = M("Scan");
            $num=I("post.num");
            $time=time();
            // $xlsName  = "scan";
            $xlsCell  = array(
                array('sid','序列号'),
                array('url','二维码内容')
            );
            for ($i=0; $i <$num ; $i++) {
                $ii=10000+$i;
                $sid="yyx".dechex($time).$ii;
                $sid=md5($sid);
                $data[$i]["sid"]=$sid;
                $add[$i]["pici"]=$time;
                $add[$i]["sid"]=$sid;
                $data[$i]["url"]="http://bc.ant-age.com/index.php/Admin/Scan/Goods?&sid=".$sid;
            }
            // if ($Scan->autoCheckToken($_POST)){
            $xie=$Scan->where(array("sid"=>$add[0]["sid"]))->find();
            if(!$xie){
                $a=$Scan->addAll($add);
            }
            // }
            $this->exportExcel($time,$xlsCell,$data);
        }
    	$this->display();
    }
    public function Goods(){
        $res["tel"]="0592-5220832";
        $res["email"]="819153385@qq.com";
        $Scan = M("Scan");
        $sid=I("get.sid");
        $data=$Scan->where(array("sid"=>$sid,"del"=>0))->find();
        if($data){
            $res["y"]=100;
            $res["code"]="耘初正品，感恩选购。";
            if($data["status"]==0){
                 $a=$Scan->save(array("status"=>1,"id"=>$data["id"],"addtime"=>time()));
                 $res["tishi"]="本防伪码仅供查询一次，经验证，您所购买的产品为正品，请放心使用。</br></br>长按下方二维码关注耘初，我们将为您及家人提供更多的健康支持。";

            }else{
                 $time=date("Y-m-d H:i",$data["addtime"]);
                 $res["tishi"]="本防伪码已于".$time."被查询，如非本人操作，可在工作时间内（周一至周五09:00-18:00）通过以下方式与我们反馈:";
            }
        }else{
            $res["y"]=101;
            $res["code"]="验证失败";
            $res["tishi"]="您查询的产品并非耘初生产，为了保障您的利益，请您通过正规渠道购买我们的产品。";
        }
        $this->assign('res',$res);
        $this->display();
    }

    public function scan_list(){
        $MODEL=M("Scan");
        if(I("post.so")){
            $this->assign('so', I("post.so"));
            $search=I("post.so");
            $map["pici"]= $search;
        }
        $page_no = I('get.p') ? I('get.p') : 1;
        $page_size=10;
        $f=array("pici","count(pici) as mycount","del");
        $data=$MODEL->page($page_no,$page_size)->where($map)->group("pici")->field($f)->order(array("del","id"=>"desc"))->select();
        $count =M("Scan")->where($map)->group("pici")->field("id")->select();
        $count=count($count);
        $Page = new \AntAge\Page($count,$page_size);
        $show = $Page->show();
        $this->assign('count', $count);
        $this->assign('page', $show);
        $this->assign('data', $data);
        $this->display();
    }
    public function del(){
        $pici=I("get.id");
        $a=M("Scan")->where(array("pici"=>$pici))->save(array("del"=>1));
        $this->ajaxReturn(100);
    }






    public function exportExcel($expTitle,$expCellName,$expTableData){
        $xlsTitle = iconv('utf-8', 'gb2312', $expTitle);//文件名称
        $fileName =  $expTitle.date('YmdHis');//or $xlsTitle 文件名称可根据自己情况设定
        $cellNum = count($expCellName);
        $dataNum = count($expTableData);
        // var_dump($dataNum);exit();
        vendor("PHPExcel.PHPExcel");
        $objPHPExcel = new \PHPExcel();
        $objPHPExcel->getDefaultStyle()->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);//水平居中
        $objPHPExcel->getDefaultStyle()->getAlignment()->setVertical(\PHPExcel_Style_Alignment::VERTICAL_CENTER);//垂直居中
        $cellName = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','AA','AB','AC','AD','AE','AF','AG','AH','AI','AJ','AK','AL','AM','AN','AO','AP','AQ','AR','AS','AT','AU','AV','AW','AX','AY','AZ');
       // var_dump($cellName[$cellNum-1]);exit();
        $objPHPExcel->getActiveSheet(0)->mergeCells('A1:'.$cellName[$cellNum-1].'1');//合并格子
        // $objPHPExcel->getActiveSheet(0)->mergeCells($cellName[$cellNum-2].($dataNum+3).':'.$cellName[$cellNum-1].($dataNum+3));//合并格子
        $objPHPExcel->getActiveSheet(0)->setCellValue('A1',$xlsTitle);//写标题
        //写头
        for($i=0;$i<$cellNum;$i++){
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellName[$i].'2', $expCellName[$i][1]);
        }
        //写身子
        for($i=0;$i<$dataNum;$i++){
          for($j=0;$j<$cellNum;$j++){
            $objPHPExcel->getActiveSheet(0)->setCellValue($cellName[$j].($i+3), $expTableData[$i][$expCellName[$j][0]]);
          }
        }
        header('pragma:public');
        header('Content-type:application/vnd.ms-excel;charset=utf-8;name="'.$xlsTitle.'.xls"');
        header("Content-Disposition:attachment;filename=$fileName.xls");//attachment新窗口打印inline本窗口打印
        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output');
        exit;
    }
/**
     *
     * 导出Excel
     */
    function expUser(){//导出Excel
        $xlsName  = "User";
        $xlsCell  = array(
        array('id','账号序列'),
        array('truename','名字'),
        array('sex','性别'),
        array('remark','备注')
        );
        // $xlsModel = M('Member');

        // $xlsData  = $xlsModel->Field('id,truename,sex,res_id,sp_id,class,year,city,company,zhicheng,zhiwu,jibie,tel,qq,email,honor,remark')->select();
        // foreach ($xlsData as $k => $v)
        // {
        //     $xlsData[$k]['sex']=$v['sex']==1?'男':'女';
        // }
        $xlsData[0]=array("id"=>1,"truename"=>2);
        $xlsData[1]=array("id"=>3,"truename"=>4);
        $this->exportExcel($xlsName,$xlsCell,$xlsData);

    }
}