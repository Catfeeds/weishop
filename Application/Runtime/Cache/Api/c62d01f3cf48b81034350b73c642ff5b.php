<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta content="telephone=no" name="format-detection" />
    <meta name="viewport" content="maximum-scale=1.0,minimum-scale=1.0,user-scalable=0,width=device-width,initial-scale=1.0"/>
    <title></title>
    <link rel="stylesheet" href="/Public/css/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="/Public/css/personinfo/common.css">
    <link rel="stylesheet" href="/Public/css/personinfo/index.css">
    <title></title>
    <style type="text/css">
    .address-body{background-color: #E4E4E4;height: 100%;width: 100%;}
    .top{height: 40px;background-color: #FFFFFF;width: 100%;position: relative;}
    .add-address,.address{line-height: 40px;}
    .address{margin-left: 14px;}
    .add-address{float: right;margin-right: 14px;color: #78aab5;}
    .lit{height:10px;width: 100%}
    .address-info{height: 88px;width: 100%;background-color: #FFFFFF;border-bottom: 1px solid #E0E0E0;}
    .address-one-info,.per-info{margin-left: 14px;padding-top: 10px;}
    .per-info{font-size: 12px;color:#8e8a8a;}
    .phone{margin-left: 6px;}
    .sex-css{margin-left: 4px;}
    .address-info-right,.address-info-left{display: inline-block;}
    /*.address-info-left{float:left;}*/
    .address-info-right{float: right;margin-top: 20px;}
    .address{margin-left: 2em;}
    .moren{margin-left:14px;margin-top: 10px;color: #8e8a8a}
    .mrinput{margin-top: 10px;}
    .mrcheck{color: #78aab5;}
    </style>
</head>
<body>
<div class="address-body">
    <div class="top center">
        <span class="address">我的收货地址</span>
        <div class="add-address" onclick="go2AddAddress()">新增</div>
    </div>
    <div class="lit"></div>
<?php if(is_array($address)): foreach($address as $key=>$vo): ?><div class="address-info">
        <div class="address-info-left"  onclick="go2update_address('<?php echo ($vo["id"]); ?>')">
            <div class="text-overflow address-one-info">
               厦门市<?php echo ($vo["mycity"]); echo ($vo["address"]); ?>
            </div>
            <div class="per-info">
                <span><?php echo ($vo["name"]); ?></span>
            <?php if($vo["sex"] == 1): ?><span class="sex-css">先生</span>
            <?php else: ?>
                <span class="sex-css">女士</span><?php endif; ?>
                <span class="phone"><?php echo ($vo["phone"]); ?></span>
            </div>
        </div>
        <div class="address-info-right"  onclick="go2update_address('<?php echo ($vo["id"]); ?>')">
             <i class="fa fa-chevron-right right-i"></i>
        </div>
       <?php if($vo["status"] == 1): ?><div class="moren mrcheck"><input onclick="ss(this,'<?php echo ($vo["id"]); ?>','<?php echo ($vo["status"]); ?>')" name="status" checked='true' type="radio"/>&nbsp<span>默认地址</span></div>
       <?php else: ?>
        <div class="moren"><input onclick="ss(this,'<?php echo ($vo["id"]); ?>','<?php echo ($vo["status"]); ?>')" name="status"  type="radio"/>&nbsp<span>设为默认</span></div><?php endif; ?>
    </div><?php endforeach; endif; ?>

</div>
<script type="text/javascript" src="/Public/js/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="/Public/js/cookie.js"></script>
<script type="text/javascript" src="/Public/js/jquery.cookie.js"></script>
<script type="text/javascript" src="/Public/js/msgalert.js"></script>
<script type="text/javascript">
   var timestamp = Date.parse(new Date());
   function go2update_address(id){
    var url="<?php echo U('Api/PersonInfo/Update_address/id/"+id+"');?>";
    window.location.href=url;
   }

   function go2AddAddress(){
    window.location.href="<?php echo U('Api/PersonInfo/Add_address');?>"
   }

   function ss(obj,id,status){
    $('input[name=status]').next().css('color','#8e8a8a');
    $('input[name=status]').next().html('设为默认');
    $(obj).next().html('默认地址');
    $(obj).next().css('color','#ff6600');
    $.ajax({
        type:'post',
        url:"<?php echo U('Api/PersonInfo/Status');?>",
        data:{'id':id},
        success:function(data){
           if (data==1) {
            pop_alert('设置成功');
           }else pop_alert('网络繁忙')
        }
    })

   }
</script>
</body>
</html>