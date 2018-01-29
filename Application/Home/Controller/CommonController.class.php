<?php
namespace Home\Controller;
use Think\Controller;
class CommonController extends Controller
{

    //构造函数
    public function __construct() {
        parent::__construct();
        // $this->check_login();
    }
    //检测管理员登录
    public function check_login() {
        $admin=session('admin');
        if (isset($admin)){
            return 0;
        }
        else {
            $this->error('未登录或登录超时,请重新登录', __MODULE__ . '/System/Login', 5);
        }
    }

}
