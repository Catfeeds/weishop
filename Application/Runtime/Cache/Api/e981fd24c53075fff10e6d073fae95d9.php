<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <title></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="maximum-scale=1.0,minimum-scale=1.0,user-scalable=0,width=device-width,initial-scale=1.0"/>
    <link rel="stylesheet" href="/Public/css/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="/Public/css/personinfo/common.css">
    <style type="text/css">
    .top{height: 40px;background-color: #78aab5;width: 100%;position: relative;}
    .top div{line-height: 40px;color: #FFFFFF;}
    .xuxian{height: 10px;width: 100%;background-color: #F8F8F8;}
    .order-id{float: left;margin-left: 14px;}
    .order-status{float: right;margin-right: 14px;}
    .order-status span{color: #FFFFFF;background-color:#78aab5;border-radius: 3px;}
    .order-top{height: 26px;}
    .order-id,.order-status{line-height: 26px;}
    .order-down{border-top: 1px dashed #e0e0e0;height: 50px;}
    .order-down-left{float: left;margin-left: 14px;margin-top: 8px;}
    .order-down-right{float: right;line-height: 48px;margin-right: 14px;}
    .order-down-left span{margin-left: 4px;}
    .fa1{font-size: 16px;}
    .left-time{color: #8e8a8a;}
    .order-down-right span{width: 3.5em;display: inline-block;text-align: right;}
    .hyx-ord :first-child{border:0;}
    </style>
</head>
<body>
<div>
    <div class="top center">
        <div>礼品列表</div>
    </div>
  <div class="hyx-ord">
   <?php if(is_array($gift)): foreach($gift as $key=>$vo): ?><!--         <div class="xuxian"></div>
        <div class="order-top">
            <div class="order-id">订单号：<?php echo ($vo['l_id']); ?></div>
            <div class="order-status">
               <?php if($vo['status'] == 1): ?><span>完成</span>
               <?php else: ?>
                <span>派送中</span><?php endif; ?>
            </div>
        </div> -->
        <div class="order-down" onclick="detail('<?php echo ($vo["gift_id"]); ?>')">
            <div class="order-down-left">
                <div><?php echo ($vo["title"]); ?></div>
                <div class="left-time"><?php echo (date('Y-m-d',$vo['add_time'])); ?><span><?php echo (date('H:i:s',$vo['add_time'])); ?></span></div>
            </div>
            <div class="order-down-right">
              <?php if($vo['status'] == 2): ?><span>完成</span>
              <?php else: ?>
                <span>配送中</span><?php endif; ?>
            </div>
        </div><?php endforeach; endif; ?>
  </div>
    <div class="xuxian"></div>
</div>
</body>
<script type="text/javascript" src="/Public/js/jquery-2.1.1.min.js"></script>
<script type="text/javascript">
    function detail (id) {
        window.location.href="<?php echo U('Api/PersonInfo/Gift_detail/id/"+id+"');?>";
    }
</script>
</html>