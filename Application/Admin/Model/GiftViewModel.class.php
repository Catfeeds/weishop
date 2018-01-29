<?php
namespace Admin\Model;
use Think\Model\ViewModel;
class GiftViewModel extends ViewModel {
    public $viewFields = array(
            'Gift'=>array(
                               'id','title','f_title','cent','count','img','content','status',
                               'd_img','class_id',
                               '_type'=>'LEFT',
                            ),
            'Class'=>array(
                          'classname',
                          '_type'=>'LEFT',
                          '_on'=>'Gift.class_id=Class.id'),
        );
    }
?>