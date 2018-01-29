<?php
namespace Admin\Model;
use Think\Model\RelationModel;
class GroupModel extends RelationModel {
		protected $_link = array(
		 	'user'=>array(
			 	'mapping_type'      => self::HAS_MANY,
			 	'class_name'        => 'user',
			 	'foreign_key'   => 'group_id',
		 	),
 		);

}
?>