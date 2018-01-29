<?php
namespace Admin\Model;
use Think\Model\RelationModel;
class UserModel extends RelationModel {
		protected $_link = array(
		 	'address'=>array(
			 	'mapping_type'      => self::HAS_ONE,
			 	'class_name'        => 'address',
			 	'foreign_key'   => 'user_id',
			 	'condition' =>'status=1',
		 	),
 		);

}
?>