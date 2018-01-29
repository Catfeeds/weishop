<?php
namespace Api\Controller;
use Think\Controller;
class CommonController extends Controller
{

    //构造函数
    // protected $appId;
    public function _initialize() {
        // $this->bd();
         $this->check_user();
    }
    public function bd(){
        $data=M("user")->find(6);
        session("user",$data);
    }
    //检测管理员登录
    // public function check_login() {
    //     $admin=session('user');
    //     if (isset($admin)){
    //         return 1;
    //     }
    //     else {
    //          $this->redirect("Api/System/check_user");
    //     }
    // }
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
}
