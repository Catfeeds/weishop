<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="maximum-scale=1.0,minimum-scale=1.0,user-scalable=0,width=device-width,initial-scale=1.0"/>
    <title></title>
    <link rel="stylesheet" href="/Public/css/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="/Public/css/personinfo/common.css">
    <title></title>
    <style type="text/css">
    .address-body{background-color: #E4E4E4;height: 100%;width: 100%;}
    .top{height: 40px;background-color: #FFFFFF;width: 100%;position: relative;}
    .save-address,.address{line-height: 40px;}
    .address{margin-left: 14px;}
    .save-address{float: right;margin-right: 14px;color: #78aab5;}
    .lit{height:10px;width: 100%}
    .address-info{width: 100%;background-color: #FFFFFF;}
    .contact{float: left;margin-left: 14px;}
    .contact-per{margin-left:100px;}
    .contact,.contact-name,.sex-css,.phone{line-height: 40px;}
    .contact-name{border-bottom: 1px solid #e0e0e0;margin-right: 14px;}
    .fa-check-circle{color: #78aab5;}
    .fa-circle-o{color: #E0E0E0;}
    .phone{margin-left: 14px;margin-right: 14px;border-top: 1px solid #e0e0e0;}
    .phone-input{border:none;width: 200px;}
    .phone-no-s{margin-left:40px;}
    .phone-no,.phone-no-s,.r-address{display: inline-block;}
    .address{margin-left: 2em;}
    #female{margin-left: 14px;}
    .r-address{margin-left:26px;}
    .del-addres{background-color: #ffffff;height: 35px;line-height: 35px;color:#78aab5; }
    </style>
</head>
<body>
<div class="address-body">
    <div class="top center">
        <span class="address">编辑地址</span>
        <span class="save-address" onclick="save(<?php echo ($address['id']); ?>)">保存</span>
    </div>
    <div class="lit"></div>
    <div class="address-info">
        <div class="contact">联系人</div>
        <div class="contact-per">
            <div class="contact-name">
                <input id="name" type="text" value="<?php echo ($address['name']); ?>" class="phone-input"/>
            </div>
            <div class="sex-css">
            <?php if($address[sex] == 1): ?><i id="male" class="fa fa-check-circle fa-lg" onclick="checkSex(this)"></i>
                <span>先生</span>
                <i id="female" class="fa fa-circle-o fa-lg" onclick="checkSex(this)"></i>
                <span>女士</span>
            <?php else: ?>
                <i id="male" class="fa fa-circle-o fa-lg" onclick="checkSex(this)"></i>
                <span>先生</span>
                <i id="female" class="fa fa-check-circle fa-lg" onclick="checkSex(this)"></i>
                <span>女士</span><?php endif; ?>
            </div>
        </div>
        <div class="phone">
            <div class="phone-no">手机号</div>
            <div class="phone-no-s">
                <input id="tel" type="text" value="<?php echo ($address['phone']); ?>" class="phone-input"/>
            </div>
        </div>
        <div class="phone">

            <div class="phone-no">城市&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>

            <div class="r-address">

                <i></i>
                <select id="mycity">
                     <?php if(is_array($city)): foreach($city as $key=>$vo): if( $vo['city'] == $address['mycity'] ): ?><option value="<?php echo ($vo["city"]); ?>" selected="">厦门市<?php echo ($vo["city"]); ?></option>
                            <?php else: ?>
                                <option value="<?php echo ($vo["city"]); ?>">厦门市<?php echo ($vo["city"]); ?></option><?php endif; endforeach; endif; ?>
                </select>
              <!--   <input id="address" type="text" value="" class="phone-input"/> -->

            </div>

        </div>
        <div class="phone">
            <div class="phone-no">地址&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
            <div class="r-address">
                <i></i>
                <input id="address" type="text" value="<?php echo ($address['address']); ?>" class="phone-input"/>
            </div>
        </div>
    </div>
    <div class="lit"></div>
    <div class="del-addres center" onclick="del('<?php echo ($address['id']); ?>')">删除该地址</div>
</div>
<script type="text/javascript" src="/Public/js/jquery-2.1.1.min.js"></script>
<script type="text/javascript">
    var sex=""
    function checkSex(i){
        if (!$(i).hasClass('fa-check-circle')) {
            if ($(i).attr('id')=="male"){
                $('#male').removeClass('fa-circle-o');
                $('#male').addClass('fa-check-circle');
                $('#female').removeClass('fa-check-circle');
                $('#female').addClass('fa-circle-o');
                sex=1;
            }else{
                $('#female').removeClass('fa-circle-o');
                $('#female').addClass('fa-check-circle');
                $('#male').removeClass('fa-check-circle');
                $('#male').addClass('fa-circle-o');
                sex=0;
            }
        }
    }

    function save(id) {
        var name=$('#name').val();
        var tel=$('#tel').val();
        var address=$('#address').val();
        var mycity=$('#mycity').val();
        if (name==""||tel==""||address=="") {
            alert('请输入完整信息！');
        }
        if (sex==="") {
            sex=1;
        }
        $.ajax({
            type:'post',
            url: "<?php echo U('Api/PersonInfo/Update_address');?>",
            data:{
                'name':name,
                'tel':tel,
                'address':address,
                'mycity':mycity,
                'sex':sex,
                'id':id
            },
            success:function(data){
                 window.location.href="<?php echo U('Api/PersonInfo/Address');?>";
                // alert(data)
                // if (!data) {
                //     window.location.href="<?php echo U('Api/PersonInfo/Address');?>";
                // }else{
                //     alert('网络繁忙！');
                // }
            }
        })
    }

    function del(id) {
        $.ajax({
            type:'post',
            url:"<?php echo U('Api/PersonInfo/Del_address');?>",
            data:{'id':id},
            success:function(data){
                if (data!=0) {
                    history.go(-1)
                }else{
                    alert('网络繁忙！');
                }
            }
        })
    }
</script>
</body>
</html>