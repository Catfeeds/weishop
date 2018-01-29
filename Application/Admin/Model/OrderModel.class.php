<?php
namespace Admin\Model;
use Think\Model\RelationModel;
class OrderModel extends RelationModel{
       protected $_link = array(
        'User' => array(
             'mapping_type' => self::BELONGS_TO,
             'class_name' =>'User',
             'foreign_key' =>'user_id',
             'as_fields' =>'username,openid'
               ),
        'Detail' =>array(
             'mapping_type' => self::HAS_MANY,
             'class_name' =>'order_detail',
             "mapping_fields"=>'name',
             'foreign_key' =>'order_id',
               ),
        'P' =>array(
             'mapping_type' => self::BELONGS_TO,
             'class_name' =>'P',
             'foreign_key' =>'p_id',
             'as_fields' =>'name:p_name,tel:p_tel'
            ),
       );
}
?>