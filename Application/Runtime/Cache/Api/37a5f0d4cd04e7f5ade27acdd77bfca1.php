<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <title>积分商品</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="maximum-scale=1.0,minimum-scale=1.0,user-scalable=0,width=device-width,initial-scale=1.0"/>
    <link rel="stylesheet" href="/Public/css/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="/Public/css/common2.css" />
    <link href="/Public/js/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/Public/css/personinfo/common.css">
    <style type="text/css">
          .topimg{width: 100%;}
          .topimg img{width: 100%;}
          .duihuan{background-color: #78aab5;color: #fff;padding-top: 3px;padding-bottom: 3px;padding-left: 14px;padding-right: 14px;color: #fff;border-radius:5px;line-height: 84px;}
          .detail{margin:8px;}
          .xx{width: 100%;height:10px;border-bottom: 1px solid #e0e0e0;border-top: 1px solid #e0e0e0;
        margin-top: 8px;background-color: #f5f4f9;}
            .tc,.tc0{
            width: 100%;
            height: 100%;
            z-index: 9998;
            position: fixed;
            top: 0;
            display: none;
             }
            .tc0{
              z-index:0;
              opacity: 0.5;
              background-color: #000;
            }
            .nei{
                z-index: 99999;
                text-align: center;
                margin: 0 auto;
                background-color: #fff;
                height: 80px;
                width: 200px;
                margin-top: 200px;
                border-radius: 5px;
            }
            .nei-n{border-top: 1px solid #e0e0e0;padding-top: 10px;}
            .nei-l{border-left: 1px solid #e0e0e0;}
            .tcx{height: 40px;line-height:40px;text-align: center;}
            .red{color: #78aab5;}
            .content{padding: 8px;}
            .content img{max-width: 100%}
            .my_p{margin-bottom: 8px}
    </style>
</head>
<body>
<div class="gift_detail">
    <div class="topimg">
        <img src="/Public/<?php echo ($gift["d_img"]); ?>">
    </div>
    <div class="detail">

        <div class="box">
            <div class="hbox">
                 <div class="my_p"><?php echo ($gift["title"]); ?></div>
                <div class="my_p"><?php echo ($gift["f_title"]); ?></div>
                <div class="my_p"> 积分：<?php echo ($gift["cent"]); ?></div>
            </div>
            <div>
                <span class="duihuan" onclick="fun_dh(<?php echo ($gift["id"]); ?>)">兑换</span>
            </div>
        </div>
    </div>

    <div class="xx"></div>
       <div class="content">
            <?php echo (htmlspecialchars_decode($gift["content"])); ?>
        </div>

</div>
<div class="tc0"></div>
<div class="tc">
    <div class="nei">
        <div class="tcx">确定兑换？</div>
        <div class="box">
            <div id="tc_sure" class="hbox nei-n red">确定</div>
            <div id="tc_quxiao" class="hbox nei-n nei-l">取消</div>
        </div>
    </div>
</div>
</body>
<script type="text/javascript" src="/Public/js/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="/Public/js/msgalert.js"></script>
<script type="text/javascript">
    $('.tc').bind("click",function(e){
            var target  = $(e.target);
            if(target.closest(".nei").length == 0){
                /*.closest()沿 DOM 树向上遍历，直到找到已应用选择器的一个匹配为止，返回包含零个或一个元素的 jQuery 对象。*/
                $('.tc0').hide();
                $('.tc').hide();
            }
            e.stopPropagation();
    });

    var bool=true;
    function fun_dh (id) {
        $('.tc0').show();
        $('.tc').show();
        $('#tc_sure').one('click',function(){
                if (bool) {
                    bool=false;
                }else return false;
                $.ajax({
                    type:'post',
                    url:"<?php echo U('Api/PersonInfo/Gift');?>",
                    data:{'id':id},
                    success:function(data){
                        if (data.count==1) {
                            pop_alert('库存不足');
                        }
                        if (data.cent==1) {
                            pop_alert('积分不足')
                        }
                        if (data.add>0) {
                            pop_alert('兑换成功！')
                        }
                        bool=true;
                    }
                })
                $('.tc0').hide();
                $('.tc').hide();
        });

        $('#tc_quxiao').one('click',function(){
            $('.tc0').hide();
            $('.tc').hide();
        })
    }
</script>
</html>