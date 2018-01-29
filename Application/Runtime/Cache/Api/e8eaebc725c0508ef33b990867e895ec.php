<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <title>积分商城</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="maximum-scale=1.0,minimum-scale=1.0,user-scalable=0,width=device-width,initial-scale=1.0"/>
    <link rel="stylesheet" href="/Public/css/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="/Public/css/common2.css" />
    <link href="/Public/js/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/Public/css/personinfo/common.css">
    <link rel="stylesheet" href="/Public/css/personinfo/index.css">
    <style type="text/css">
    #gift{color: #78aab5;}
    .center{text-align: center;}
    .list_item .cont .text-overflow {
                    display:block;/*内联对象需加*/
                    width:10em;
                    word-break:keep-all;/* 不换行 */
                    white-space:nowrap;/* 不换行 */
                    overflow:hidden;/* 内容超出宽度时隐藏超出部分的内容 */
                    text-overflow:ellipsis;/* 当对象内文本溢出时显示省略标记(...) ；需与overflow:hidden;一起使用。*/
    }
    .red{color: #78aab5;}
    .minus{display: none;}
    .u-flyer {display: block;width: 50px;height: 50px;border-radius: 50px;position: fixed;z-index: 9999;}
    .cont h2{margin: 0;}
    .hboximg{width:80px;margin-top: 8px;margin-left: 8px;}
    .hboximg img{width: 100%;height: 79px;}
    .titlem{margin-top:8px; margin-left: 8px;margin-right: 8px;border-bottom: 1px solid #e0e0e0;}
    .hprice{font-weight: 700;}
    .mtitle{font-size: 15px;}
    .ftitle{font-size: 13px;}
    .mtitle,.ftitle{color: #8e8e8e;}
    .num-c{width: 1em;margin-left:10px;margin-right: 10px;}
    .num-c span{float:right;text-align: center;}
    .qing{color: #78aab5;}
    .xx{width: 100%;height:10px;border-bottom: 1px solid #e0e0e0;border-top: 1px solid #e0e0e0;
        margin-top: 8px;background-color: #f5f4f9;}
    .duihuan{line-height: 50px;z-index: 999;}
    .duihuan span,.hyx-jf span,.classname{background-color: #78aab5;color: #fff;padding-top: 3px;padding-bottom: 3px;padding-left: 14px;padding-right: 14px;color: #fff;border-radius:5px;}

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
    .one-shop{margin-top: 8px;}
    .hyx-dhl{height: 45px;border-bottom: 1px solid #e0e0e0;box-shadow:0 0.5px 0 #e0e0e0;text-align: center;line-height: 45px;}
    .hall,.hfl{width: 63px;border-right: 2px solid #e0e0e0;height:22px;margin-top: 13px;line-height: 22px;}
    .hfl{width: 80px;}
    .dhimg{width: 20px;height: 20px;text-align: center;margin-right: 14px;}
    .hjifen{height: 45px;background-color:#f4f5f9;padding-right: 12px;padding-left: 12px;line-height: 45px;}
    .cent1{font-weight: 700;font-size: 15px;color: #78aab5;}
    .detail{color: #78aab5;}
    #gift1{display: none;}
    .f-x{width: 10px;}
    .s-one{margin-top: 10px;color: #8e8e8e;}
    .soneleft{padding:5px 0px 5px 14px;}
    .soneright{padding:5px 14px 5px 0px;}
    .s-one-img{height: 133px;}
    .s-one-img img{height:100%;width: 100%;}
    .t-tile{margin-top:5px;font-size:14px;}
    .row{margin: 0;}
    .hyx-jf{margin-top: 5px;font-size: 11px;}
    .hleft{margin-left: 5px;}
    .fa-sort-up{position:absolute;top:19px;}
    .fa-sort-desc{position:absolute;top:13px;}
    .classlb{background-color: #fff;z-index: 99;width: 100%;border-bottom: 1px solid #e0e0e0;overflow: auto;display: none;}
    .classname{margin-left: 14px;float: left;margin-top:8px;margin-bottom:8px;}
    .yyx_gai{margin-top: 8px;}
    .text1 {
       word-break:break-all;
       display:-webkit-box;
       -webkit-line-clamp:1;
       -webkit-box-orient:vertical;
       overflow:hidden;
    }
    </style>
</head>
<body>
<div class="hshop">
  <div class="hyx-dhl box">
      <div class="hall" id="all">全部</div>
      <div id="fl" class="hfl" onclick="classdesc(this)">分类<i class="fa fa-sort-desc hleft"></i>&nbsp;&nbsp;</div>
      <div class="hbox" onclick="centdesc(this)">按积分排序<i class="fa fa-sort-desc hleft"></i>&nbsp;&nbsp;</div>
      <div><img onclick="changeD(this)" class="dhimg" src="/Public/img/h1.jpg"></div>
  </div>
  <div class="classlb">
    <?php if(is_array($class)): foreach($class as $key=>$vo): ?><span class="classname" data-v="<?php echo ($vo["id"]); ?>"><?php echo ($vo["classname"]); ?></span><?php endforeach; endif; ?>
  </div>
  <div class="box hjifen">
      <div class="hbox">我的可用积分&nbsp<span class="cent1"><?php echo ($user["cent"]); ?></span></div>
      <div class="detail" onclick="go2cent()">详情</div>
  </div>

  <div id="gift1"></div>
  <script id="script-model1" type="text/x-dot-template">
   {{ for(var i=0,l=it.length; i<l; i++){ }}
    <div class="box one-shop" id="gift1{{=it[i].id}}">
        <div class="hboximg" onclick="detail('{{=it[i].id}}')">
            <img class="" src="/Public/{{=it[i].img}}">
        </div>
        <div class="titlem hbox">
            <div class="box">
                <div class="hbox">
                    <div class="mtitle text1">{{=it[i].title}}</div>
                    <div class="ftitle yyx_gai">积分：{{=it[i].cent}}</div>
                </div>
                <div class="duihuan yyx_gai" onclick="fun_dh('{{=it[i].id}}')">
                    <span id="id_dui">兑换</span>
                </div>
            </div>
            <div class="ftitle box">
                <div class="">库存：</div>
                <div id="count1{{=it[i].id}}">{{=it[i].count}}</div>
            </div>
        </div>
    </div>
    {{ } }}
  </script>

  <div id="gift2"></div>

 <script id="script-model2" type="text/x-dot-template">
 {{ for(var i=0,l=it.length; i<l; i++){ }}
  <div class="row">
      <div class="col">
         <div class="s-one soneleft">
             <div class="s-one-img" onclick="detail('{{=it[i].id}}')">
                  <img src="/Public/{{=it[i].img}}">
              </div>
              <div class="t-tile box text1">{{=it[i].title}}</div>
              <div class="t-tile box">
                  <div class="">库存：</div>
                  <div id="count{{=it[i].id}}">{{=it[i].count}}</div>
              </div>
              <div class="box hyx-jf">
                  <div class="hbox">所需积分：{{=it[i].cent}}</div>
                  <div onclick="fun_dh('{{=it[i].id}}')"><span>兑换</span></div>
              </div>
         </div>
      </div>
      <div class="f-x"></div>
      <div class="col">
       {{? it[i+1]!=null }}
         <div class="s-one soneright">
             <div class="s-one-img" onclick="detail('{{=it[++i].id}}')">
                  <img src="/Public/{{=it[i].img}}">
              </div>
              <div class="t-tile">{{=it[i].title}}</div>
              <div class="t-tile box">
                  <div class="">库存：</div>
                  <div id="count{{=it[i].id}}">{{=it[i].count}}</div>
              </div>
              <div class="box hyx-jf">
                  <div class="hbox">所需积分：{{=it[i].cent}}</div>
                  <div onclick="fun_dh('{{=it[i].id}}')"><span>兑换</span></div>
              </div>
         </div>
        {{?}}
      </div>
  </div>
  {{ } }}
</script>

</div>
<!-- 购物车 -->

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
<script type="text/javascript" src="/Public/js/cookie.js"></script>
<script type="text/javascript" src="/Public/js/msgalert.js"></script>
<script type="text/javascript" src="/Public/js/jquery.cookie.js"></script>
<script type="text/javascript">
    var json=<?php echo (json_encode($gift)); ?>;
    $('#gift1').html(doT.template($('#script-model1').text())(json));
    $('#gift2').html(doT.template($('#script-model2').text())(json));


    function centup(obj){
      $(obj).attr('onclick','centdesc(this)');
      $(obj).children().removeClass('fa-sort-up');
      $(obj).children().addClass('fa-sort-desc');
      centajax(1);
    }

    function centdesc(obj){
      $(obj).attr('onclick','centup(this)');
      $(obj).children().removeClass('fa-sort-desc');
      $(obj).children().addClass('fa-sort-up');
      centajax(2);
    }

    $('#all').click(function(){
      centajax(3);
    });

    function centajax(cent){
       $.ajax({
                    type:'post',
                    url:"<?php echo U('Api/PersonInfo/Gift');?>",
                    data:{'cent':cent},
                    success:function(data){
                         $('#gift1').html(doT.template($('#script-model1').text())(data));
                         $('#gift2').html(doT.template($('#script-model2').text())(data));
                    }
                })
    }

    $('.classname').click(function(){
      classup('#fl');
      $.ajax({
                type:'post',
                url:"<?php echo U('Api/PersonInfo/Gift');?>",
                data:{'class_id':$(this).data('v')},
                success:function(data){
                     $('#gift1').html(doT.template($('#script-model1').text())(data));
                     $('#gift2').html(doT.template($('#script-model2').text())(data));
                }
              })
    })

    function classdesc(obj) {
      $(obj).attr('onclick','classup(this)');
      $(obj).children().removeClass('fa-sort-desc');
      $(obj).children().addClass('fa-sort-up');
      $('.classlb').show();
    }

    function classup(obj){
      $(obj).attr('onclick','classdesc(this)');
      $(obj).children().removeClass('fa-sort-up');
      $(obj).children().addClass('fa-sort-desc');
      $('.classlb').hide();
    }

    //双排
     function changeD(obj){
      $('#gift2').hide();
      $('#gift1').show();
      $(obj).attr('src','/Public/img/h2.jpg');
      $(obj).attr('onclick','changeS(this)')
    }

    // 单排
    function changeS(obj){
      $('#gift1').hide();
      $('#gift2').show();
      $(obj).attr('src','/Public/img/h1.jpg');
      $(obj).attr('onclick','changeD(this)')
    }

    function detail (id) {
        window.location.href="<?php echo U('Api/PersonInfo/Gift_detail/id/"+id+"');?>";
    }

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
                    url:"<?php echo U('Api/PersonInfo/Buygift');?>",
                    data:{'id':id},
                    success:function(data){
                        if (data.count==1) {
                            pop_alert('库存不足');
                        }
                        if (data.cent==1) {
                            pop_alert('积分不足');
                        }
                        if (data.add>0) {
                            pop_alert('兑换成功');
                            window.location.href="/index.php/Api/PersonInfo/Address2?id="+data.add
                            // var c=$("#count"+id).html()-1;
                            // $("#count"+id).html(c);
                            // $("#count1"+id).html(c);
                        }
                        bool=true;
                    }
                });
                $('.tc0').hide();
                $('.tc').hide();
        });

        $('#tc_quxiao').one('click',function(){
            $('.tc0').hide();
            $('.tc').hide();
        })
    }


    function go2cent() {
      window.location.href="<?php echo U('Api/PersonInfo/Cent');?>";
    }
</script>
</html>