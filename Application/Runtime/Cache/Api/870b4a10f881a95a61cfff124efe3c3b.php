<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="maximum-scale=1.0,minimum-scale=1.0,user-scalable=0,width=device-width,initial-scale=1.0"/>
    <title>个人中心</title>
    <link rel="stylesheet" href="/Public/css/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="/Public/css/common2.css" />
    <link href="/Public/js/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/Public/css/personinfo/common.css">
    <link rel="stylesheet" href="/Public/css/personinfo/index.css">
    <style type="text/css">
    #PersonInfo{color: #78aab5;}
    body{overflow-y:scroll ;overflow-x:hidden;max-width: 100%}


    .ul-color{margin-bottom: 10px;}
    .guajian{position: absolute;width: 50px;height: 50px;top: 10px;right: 10px;z-index: 9999;}
    .guajian img{width: 100%;height: 100%;}
    .donghua{
        -webkit-animation-name: myfirst;
        -webkit-animation-duration: 1s;
        -webkit-animation-timing-function: linear;
        -webkit-animation-delay: 0s;
        -webkit-animation-iteration-count: infinite;
        -webkit-animation-direction: alternate;
        -webkit-animation-play-state: running;
        }
    @-webkit-keyframes myfirst /* Safari and Chrome */
    {
        0%   {width:50px;height: 50px}
        100% {width:55px;height: 55px}
    }
    .col-muen{border-top: none}
    .top{background-image: url(/Public<?php echo ($pre["img"]); ?>);background-size: 100% 100%}
    .order_img{height: 80px;padding: 10px;border-top: 1px solid #e0e0e0;overflow: hidden;}
    .ico{font-size: 12px;color: #e4e4e4;margin-left: 5px}
    .hbox{text-align: center;}
    .img_3{height: 60px;text-align: center;}
    .img_3 img{height: 100%;margin: 0px auto}
    .myxian{border-bottom: 1px solid #e0e0e0;}
    </style>
</head>
<body>
 <?php if($pre[dzp] == 1): if($vo['balance'] > 0 ): ?><div class="guajian donghua" onclick="choujian()">
 <?php else: ?>
    <div class="guajian" onclick="choujian()"><?php endif; ?>

     <img src="/Public/dzp/images/dzp.png">
</div><?php endif; ?>
<div>
    <div class="top">
        <div class="topimg center topimg-padding">
            <div class="final-top-img">
                <div class="img-in-div center">
                    <img src="<?php echo ($vo["img"]); ?>">
                </div>
            </div>
            <div class="user-name"><?php echo ($vo["username"]); ?></div>
        </div>
        <div class="top-s-down">
            <ul class="center ul-color">
               <!--  <li>
                    <a>
                        <div>余额</div>
                        <div class="balance">
                            <?php echo ($vo["balance"]); ?><span>元</span>
                        </div>
                    </a>
                </li> -->
                <li class="center">
                    <a href="<?php echo U('Api/PersonInfo/Cent');?>">
                        <span>积分：</span>
                        <span class="balance">
                            <?php echo ($vo["cent"]); ?>
                        </span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <div class="xuxian"></div>
    <div class="t-muen">
        <div class="col-muen" onclick="go2order(0)">
            <a>
                <span>&nbsp;&nbsp;我的订单</span>

                <i class="right-i">查看全部订单<i class="fa fa-chevron-right fa-lg ico"></i></i>
            </a>
        </div>
        <div class="box order_img" >
            <div class="hbox" onclick="go2order(0)">
                <div class="img_3"><img src="/Public/order1.jpg"></div>

            </div>
            <div class="hbox" onclick="go2order(1)">
                <div class="img_3"><img src="/Public/order2.jpg"></div>

            </div>
            <div class="hbox" onclick="go2order(2)">
                <div class="img_3" ><img src="/Public/order3.jpg"></div>
            </div>
        </div>
         <div class="xuxian"></div>


      <!--   <div class="col-muen myxian" onclick="go2order()">

                <div class="center">
                    <i class="fa  fa-shopping-cart fa-lg col-muen-first-i"></i>
                </div>
                <span>订单</span>
                <i class="fa fa-chevron-right fa-lg right-i"></i>

        </div> -->

        <div class="col-muen myxian" onclick="go2giftcart()">
                <div class="center">
                    <i class="fa  fa-gift fa-lg col-muen-first-i"></i>
                </div>
                <span>礼品</span>
                <i class="fa fa-chevron-right fa-lg right-i"></i>

        </div>


        <div class="col-muen myxian" onclick="go2address()">

                <div class="center">
                    <i class="fa fa-map-marker fa-lg col-muen-first-i"></i>
                </div>
                <span>我的地址</span>
                <i class="fa fa-chevron-right fa-lg right-i"></i>

        </div>

        <?php if($pre[dzp] == 1): ?><div class="col-muen myxian" onclick="choujian()">

                <div class="center">
                    <i class="fa fa-globe fa-lg col-muen-first-i"></i>
                </div>
                <span>大转盘</span>
                <i class="fa fa-chevron-right fa-lg right-i"></i>

        </div>

        <div class="col-muen myxian" onclick="zpjl()">
                <div class="center">
                    <i class="fa  fa-gift fa-lg col-muen-first-i"></i>
                </div>
                <span>转盘奖励</span>
                <i class="fa fa-chevron-right fa-lg right-i"></i>

        </div><?php endif; ?>

        <div class="col-muen" onclick="women()">

                <div class="center">
                    <i class="fa fa-exclamation-circle fa-lg col-muen-first-i"></i>
                </div>
                <span>关于我们</span>
                <i class="fa fa-chevron-right fa-lg right-i"></i>

        </div>
    </div>
    <div class="xuxian"></div>
    <div class="down-phone center">
        <a href="tel:<?php echo ($pre["mobile"]); ?>">
            <i class="fa fa-phone fa-lg"></i>
            <span><?php echo ($pre["mobile"]); ?></span>
        </a>
    </div>
    <div class="xuxian"></div>
    <div class="hhh"></div>
    <style type="text/css">
    .final-bottom{
        position: fixed;
        bottom: 0px;
        background-color: #FFFFFF;
        width: 100%;
        height: 54px;
        border-top: 1px solid #e0e0e0;
    }
    .bottom-muen{
        display: inline-block;
        text-align: center;
        width: 24%;
        margin-top: 5px;
        color: #8e8e8e;
    }
    .bottom-muen div{
        margin: 0 auto;
    }
    .bottom-size{font-size: 10px;}
    .zuih{height:55px;width: 100%;}
    .bottom-num{
        width: 2em;
        position: absolute;
        top: -1px;
        left: 20px;
        color: red;
        font-size: 8px;
        color: #FFFFFF;
        border-radius: 50%;
      /*  border: 1px solid #2c96d2;*/
        padding: 2px;
        background-color:#78aab5;
    }
    .fa-shopping-cart{
        position: relative;
    }
    .gouwuche,.gouwuche0{
        width: 100%;
        height: 100%;
        z-index: 9998;
        position: fixed;
        top: 0;
        display: none;
    }
    .gouwuche0{
      z-index:0;
      opacity: 0.5;
      background-color: #000;
    }
    .neir{
        border-radius: 7px;
        /*width: 100%;*/
        position: fixed;
        z-index: 99999;
        background-color: #FFFFFF;
        left: 6px;
        right: 6px;
        bottom: 10px;
    }
    .neir-bottom,.neir-top{
      height: 39px;
      line-height: 39px;
    }
    .neir-bottom div,.neir-top-ac,.neir-card-ico{
      display: inline-block;
    }
    .neir-top-ac{
      float: right;
      margin-right: 16px;
    }
    .neir-card-ico{margin-left: 16px;}
    .neir-center{
      border-top: 1px solid #e0e0e0;
    }
    .neir-bottom{
      margin-left: 12px;
    }
    .huangse{color: #78aab5;}
    .shop-one{border-bottom: 1px solid #e0e0e0;line-height: 35px;}
    .h-clear{margin-right: 5px;}
    .tc-num{
        width:2em;
        position: absolute;
        top:3px;
        left: 28px;
        font-size: 6px;
        color: #FFFFFF;
        border-radius: 50%;
      /*  border: 1px solid #2c96d2;*/
        background-color:#78aab5;
        height:12px;
        line-height: 12px;
      }
      .box{   display:-moz-box;
              display:-webkit-box;
              display:box;}
     .hbox{ -moz-box-flex:1;
            -webkit-box-flex:1;
             box-flex:1;position: relative;}
     .hbox2{ -moz-box-flex:2;
             -webkit-box-flex:2;
             box-flex:2;position: relative;}
     .hbox3{ -moz-box-flex:3;
             -webkit-box-flex:3;
             box-flex:3;position: relative;}
     .hbox5{ -moz-box-flex:5;
             -webkit-box-flex:5;
             box-flex:5;position: relative;}
      .shop-jj{width:73px;}
      .shop-one-num{width:24px;display: inline-block;display: relative;}
      .center{text-align: center;}
      .shop-name{margin-left: 14px;}
      .jiesuan{float: right;margin-right: 16px;}
      .jiesuan span{background-color:#78aab5;padding-top: 3px;padding-bottom: 3px;padding-left: 14px;padding-right: 14px;color: #fff;border-radius:5px;}
      h1{display:none;}
</style>
<div class="zuih"></div>
<div class="final-bottom">
    <div class="bottom-muen" onclick="go2index()">
        <div id="index" class="fa fa-home fa-2x"></div>
        <div class="bottom-size">首页</div>
    </div>
    <div  class="bottom-muen" onclick="shopCart()">
        <div id="end" class="fa fa-shopping-cart fa-2x">
            <div id="id_cartN" class="bottom-num"></div>
        </div>
        <div class="bottom-size">购物</div>
    </div>
    <div class="bottom-muen" onclick="go2gift()">
        <div id="gift" class="fa fa-gift fa-2x"></div>
        <div  class="bottom-size">积分商城</div>
    </div>
    <div class="bottom-muen" onclick="go2person()">
        <div id="PersonInfo" class="fa fa-user fa-2x"></div>
        <div class="bottom-size">个人中心</div>
    </div>
</div>

<!-- 购物车 -->
<div class="gouwuche0"></div>
<div class="gouwuche"></div>
<script id="script-model" type="text/x-dot-template">
    <div class="neir">
      <div class="neir-top">
        <div class="neir-card-ico">
          <i class="fa fa-shopping-cart fa-lg huangse"></i>
          {{?it.TotalCount>0}}
          <div class="tc-num center">{{=it.TotalCount}}</div>
          {{?}}
        </div>
        <div class="neir-top-ac "><i class="fa fa-trash-o fa-lg huangse h-clear" onclick="clearCart()"></i>清空购物车</div>
      </div>
      <div></div>
      <div class="neir-center"></div>

      <div id="shop_one">
      {{for(var i=0; i<it.Items.length; i++){ }}
      <div class="shop-one  box">
          <div class="shop-name hbox">{{=it.Items[i].Name}}</div>
          <div class="shop-jj">
              <i class="fa fa-minus-square huangse" onclick="footerMinus(this,'{{=it.Items[i].Id}}')"></i>
              <div class="shop-one-num center">{{=it.Items[i].Count}}</div>
              <i class="fa fa-plus-square huangse" onclick="footer_add(this,'{{=it.Items[i].Id}}','{{=it.Items[i].Name}}','{{=it.Items[i].Price}}')"></i>
          </div>
      </div>
      {{ } }}
      </div>

      <div class="neir-bottom">
        {{?it.Total>0}}
        <div id="total">合计：￥{{=it.Total}}</div>
        {{??}}
        <div>合计：￥0.00</div>
        {{?}}
        <div onclick="jiesuan()" class="jiesuan"><span>结算</span></div>
      </div>
    </div>
</script>
<script type="text/javascript" src="/Public/js/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="/Public/js/cookie.js"></script>
<script type="text/javascript" src="/Public/js/jquery.cookie.js"></script>
<script type="text/javascript" src="/Public/js/doT.min.js"></script>
<script type="text/javascript" src="/Public/js/msgalert.js"></script>
<script type="text/javascript">
    $('.gouwuche').bind("click",function(e){
        var target  = $(e.target);
        if(target.closest(".neir").length == 0){
            /*.closest()沿 DOM 树向上遍历，直到找到已应用选择器的一个匹配为止，返回包含零个或一个元素的 jQuery 对象。*/
            $('.gouwuche0').hide();
            $('.gouwuche').hide();
        }
        e.stopPropagation();
      });

    var cart=new CartHelper();//实例化一个购物车助手
    if (cart.Read().Count==0) {
       $('#id_cartN').hide();
    }else{
       $('#id_cartN').show();
       $('#id_cartN').html(cart.Read().TotalCount);
    }

    function go2person(){
        window.location.href="<?php echo U('Api/PersonInfo/Index');?>"
    }

    function go2index(){
        window.location.href="<?php echo U('Api/Index/index');?>"
    }

    //减库存
    function minus(obj,id){
       if (cart.Read().Items[cart.Find(id)].Count>0){
             cart.Change(id,--(cart.Read().Items[cart.Find(id)].Count));
             $(obj).next().children().html(cart.Read().Items[cart.Find(id)].Count);
           if (cart.Read().Items[cart.Find(id)].Count==0) {
             cart.Del(id);
             // $(obj).hide();
             // $(obj).prev().hide();
             // $(obj).prev().prev().css({'border':'1px solid #8e8a8a','background-color':'#FFFFFF'}).children().css({'color':'#FD4C5D'});
           }
       }
       $('#id_cartN').show();
       $('#id_cartN').html(cart.Read().TotalCount);
       if (cart.Read().Items.length==0) $('#id_cartN').hide();
   }

   //弹窗减库存
   function footerMinus(obj,id){
      minus("#sp"+id,id);
      if (cart.Find(id)>-1) {
            if (cart.Read().Items[cart.Find(id)].Count>0){
                   $(obj).next().html(cart.Read().Items[cart.Find(id)].Count);
             }
          }else $(obj).parent().parent().hide();
      if (cart.Read().Items.length==0) $('.tc-num').hide();
      $('.tc-num').html(cart.Read().TotalCount);
      $('#total').html("合计：￥"+cart.Read().Total);
       if (cart.Read().Total==0) {
          $('#total').html("合计：￥0.00");
       }
   }

   //弹窗加库存
   function footer_add(obj,id,name,price){

    if (cart.Find(id)>-1){
        cart.Add(id,name,++(cart.Read().Items[cart.Find(id)].Count),price);
    }else{
        cart.Add(id,name,1,price);
    }
    $('#id_cartN').show();
    $('#id_cartN').html(cart.Read().TotalCount);
    $("#as"+id).prev().children().html(cart.Read().Items[cart.Find(id)].Count);
    // $("#as"+id).css({'color':'#FFFFFF'});
    // $("#as"+id).parent().css({'border':'0','background-color':'#FD4C5D'});
    // $("#as"+id).parent().next(".num-c").show();
    // $("#as"+id).parent().next().next(".minus").show();

    if (cart.Read().Items.length==0) $('.tc-num').hide();
      $('.tc-num').html(cart.Read().TotalCount);
      $('#total').html("合计：￥"+cart.Read().Total);
       if (cart.Read().Total==0) {
          $('#total').html("合计：￥0.00");
       }

     $(obj).prev().html(cart.Read().Items[cart.Find(id)].Count);


   }

   function add_shop(obj,id,name,price,img){
    if (cart.Find(id)>-1){
        cart.Add(id,name,++(cart.Read().Items[cart.Find(id)].Count),price);
    }else{
        cart.Add(id,name,1,price);
    }
    $('#id_cartN').show();
    $('#id_cartN').html(cart.Read().TotalCount);


    $(obj).prev().children().html(cart.Read().Items[cart.Find(id)].Count);


    var offset = $('#end').offset(),flyer = $("<img class='u-flyer' src='/Public/"+img+"' />");
       flyer.fly({
             start: {
                left:event.pageX,
                top: event.pageY-$("body").scrollTop()
           },
             end: {
                left: offset.left,
                top: offset.top-$("body").scrollTop(),
                width: 20,
                height: 20,
            },
            onEnd:function(){
                $('.u-flyer').eq(0).remove();
            }
        });
   }

   // alert(JSON.stringify(cart.Read()));
   // cart.Clear();
   // alert((cart.Read().TotalCount));
   function shopCart(){
    $('.gouwuche0,.gouwuche').show();
    var json=JSON.parse(JSON.stringify(cart.Read()));
    $('.gouwuche').html(doT.template($('#script-model').text())(json));
   }

   function clearCart(){
    $('.num-c').children().html('0');
    $('.minus,.tc-num,#shop_one').hide();
    $('.plus').css({'border':'1px solid #8e8a8a','background-color':'#FFFFFF'}).children().css({'color':'#FD4C5D'});
    $('#id_cartN').hide();
    $('#total').html('合计：￥0.00');
    cart.Clear();
   }

// var pay_json='';  //全局支付参数
// var pay_lock =1;
   function jiesuan() {
       window.location.href="/index.php/Api/Index/OrderInfo"
      // if(pay_lock==0)return false;
      // pay_lock=0
    // alert(JSON.stringify(cart.Read()));
    // return false;
     // var json=JSON.parse(JSON.stringify(cart.Read()));
    //  $.ajax({
    //     type:'POST',
    //     url: "<?php echo U('Api/Index/Order');?>",
    //     // contentType: "application/json",//必须有
    //     // dataType: "json", //表示返回值类型，不必须
    //     data:JSON.stringify(cart.Read()),
    //     success: function(ret){
    //         if(ret.code==100){
    //              clearCart();
    //              window.location.href="/index.php/Api/Index/OrderInfo?id="+ret.data;
    //         }else{
    //            pop_alert(ret.erro,2000);
    //         }
    //       // if(a.code==100){
    //       //   $('.gouwuche0').hide();
    //       //   $('.gouwuche').hide();
    //       //   pop_alert('购买成功')
    //       //   clearCart();
    //       // }
    //     }
    // })
  }

  function go2gift () {
    window.location.href="<?php echo U('Api/PersonInfo/Gift');?>"
  }

  //调用微信JS api 支付
function jsApiCall()
{
  WeixinJSBridge.invoke(
    'getBrandWCPayRequest',
    pay_json,
    function(res){
      pay_lock=1;
      if(res.err_msg == "get_brand_wcpay_request:ok" ) {
          $('.gouwuche0').hide();
          $('.gouwuche').hide();
          pop_alert('购买成功',2000)
          clearCart();
          setTimeout(function() {
              self.location="/index.php/Api/PersonInfo/Order";
          }, 2000);
      }else{
          $('.gouwuche0').hide();
          $('.gouwuche').hide();
          pop_alert('支付失败！',2000)
          clearCart();
          setTimeout(function() {
              self.location="/index.php/Api/PersonInfo/Order";
          }, 2000);
      }
    }
  );
}
function callpay()
{
  if (typeof WeixinJSBridge == "undefined"){
      if( document.addEventListener ){
          document.addEventListener('WeixinJSBridgeReady', jsApiCall(), false);
      }else if (document.attachEvent){
          document.attachEvent('WeixinJSBridgeReady', jsApiCall());
          document.attachEvent('onWeixinJSBridgeReady', jsApiCall());
      }
  }else{
      jsApiCall();
  }
}
</script>
</div>
<script type="text/javascript" src="/Public/js/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="/Public/js/cookie.js"></script>
<script type="text/javascript" src="/Public/js/jquery.cookie.js"></script>
<script type="text/javascript">

    function go2order(id){
         var url="/index.php/Api/PersonInfo/Order?status="+id;
        window.location.href=url;
    }

    function go2address(){
        window.location.href="<?php echo U('Api/PersonInfo/Address');?>"
    }

    function go2giftcart () {
        window.location.href="<?php echo U('Api/PersonInfo/Gift_cart');?>"
    }
    function choujian(){
         window.location.href="<?php echo U('Api/Index/Dzp');?>"
    }
    function women(){
        window.location.href="<?php echo U('Api/PersonInfo/Women');?>"
    }
    function zpjl(){
        window.location.href="<?php echo U('Api/PersonInfo/Dap_jl');?>"
    }

</script>
</body>
</html>