<?php
 namespace Admin\Model;
 use Think\Model\RelationModel;
 class AddressModel extends RelationModel{    
             protected $_link = array(         
                                  'detail'  =>  array(             
                                              'mapping_type' => self::HAS_MANY,             
                                              'class_name' => 'order_detail', 
                                              'foreign_key' =>'order_id'       
                                               ),         
                                      );
 }
?>