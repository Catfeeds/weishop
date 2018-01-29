<?php
namespace Admin\Model;
use Think\Model\RelationModel;
class AdminModel extends Model {
      public function login($name,$pwd){
      		if($name&&$pwd){
      			$Admin=M("Admin")->where(array("name"=>$name,"pwd"=>md5($pwd)))->find();
      			if($Admin){
      				session("Admin",$Admin);
      				return true;
      			}
      		}
      		return false;
      }
}