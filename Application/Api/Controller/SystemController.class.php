<?php
namespace Api\Controller;
use Think\Controller;
class SystemController extends Controller {
    public function check_user(){
        if(!session("user")){
            Vendor('Mywx.common');
            $tools = new \common();
            $userinfo=$tools->getUserInfo();
            if($userinfo){
                $MODEL=M("User");
                $user=$MODEL->where(array("openid"=>$userinfo["openid"]))->find();
                if($user){
                    session("user",$user);
                }else{
                    $yyx=array(
                        'username' =>$userinfo['nickname'],
                        'openid'   =>$userinfo['openid'],
                        'img'      =>$userinfo['headimgurl'],
                        'balance'  =>0,
                        'cent'     =>0,
                    );
                    $id=M("User")->add($yyx);
                    if($id){
                        $user=$MODEL->find($id);
                        session("user",$user);
                    }
                }
                 return true;
            }else{
                 return false;
            }
        }else{
            return true;
        }
    }
    public function login(){
        if($this->check_user()){
            // var_dump(session("user"));
            $this->redirect("Api/Index/index");
        }
    }
    public function Wx_pay_ajax_ok(){
        $txt=file_get_contents("php://input");
        function r_xml($strXml){
            $pos = strpos($strXml, 'xml');
                if (!$pos) {
                die("不是xml字符串！");
            }
                $obj=simplexml_load_string($strXml,'SimpleXMLElement', LIBXML_NOCDATA);
                if(is_object($obj)){
                $obj=get_object_vars($obj);
            }
            return $obj;
        }
        $xmlstring = <<<XML
<xml>
<return_code><![CDATA[SUCCESS]]></return_code>
<return_msg><![CDATA[OK]]></return_msg>
</xml>
XML;
        $result=r_xml($txt);
        Vendor('Mywx.common');
        $tools = new \common();
        $sign=$tools->getSign($result);
        if($result["sign"]==$sign){
            if($result["result_code"]=="SUCCESS"){
                $gai=M("Order")->where(array("l_id"=>$result["out_trade_no"]))->save(array("status"=>1));
                if($gai){
                    echo $xmlstring;
                }
            }
        }
    }
}