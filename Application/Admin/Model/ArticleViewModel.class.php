<?php
namespace Admin\Model;
use Think\Model\ViewModel;
class ArticleViewModel extends ViewModel {
    public $viewFields = array(
            'Article'=>array(
                               'id','article_type_id','title','title2','content','hot','ad','img',
                               '_type'=>'LEFT',
                            ),
            'ArticleType'=>array( /**第二个附表**/
                          'id'=>'a_id','type','orderby'=>'_order',
                          '_type'=>'LEFT',
                          '_on'=>'ArticleType.id=Article.article_type_id'),
            'ArticleClass'=>array(
                          'myclass',
                          '_type'=>'LEFT',
                          '_on'=>'ArticleClass.id=ArticleType.class_id',
              )
        );
    }
?>