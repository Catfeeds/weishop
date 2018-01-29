<?php
namespace Admin\Model;
use Think\Model\ViewModel;
class OrderViewModel extends ViewModel {
    public $viewFields = array(
            'Order'=>array(
                               'id','l_id','user_id','total','add_time','status','p_id','o_address','o_tel',
                               '_as'=>'orders',
                               '_type'=>'LEFT',
                            ),
            /****
            *TP视图 视图关联 如果主表关联附表 第一个附表id为空将无法获取数据
            *故将自关联 一次
            ****/
            // 'r'=>array( /**第一个附表**/
            //                    '_table'=>"__ORDER__",
            //                    '_type'=>'LEFT',
            //                    '_on'=>'orders.id=r.id'
            //                 ),
            'P'=>array( /**第二个附表**/
                          'name'=>'p_name',
                          '_type'=>'LEFT',
                          '_on'=>'orders.p_id=P.id'),
            'User'=>array( /**第三个附表**/
                    'username',
                    '_type'=>'LEFT',
                    '_on'=>'orders.user_id=User.id'),
        );
    }
?>