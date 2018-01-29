<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>

<head>

	<meta charset="utf-8" />

	<title>Metronic | Layouts - Blank Page</title>

	<meta content="width=device-width, initial-scale=1.0" name="viewport" />

	<meta content="" name="description" />

	<meta content="" name="author" />

	<!-- BEGIN GLOBAL MANDATORY STYLES -->

	<link href="/Public/media/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>

	<link href="/Public/media/css/bootstrap-responsive.min.css" rel="stylesheet" type="text/css"/>

	<link href="/Public/media/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>

	<link href="/Public/media/css/style-metro.css" rel="stylesheet" type="text/css"/>

	<link href="/Public/media/css/style.css" rel="stylesheet" type="text/css"/>

	<link href="/Public/media/css/style-responsive.css" rel="stylesheet" type="text/css"/>

	<link href="/Public/media/css/default.css" rel="stylesheet" type="text/css" id="style_color"/>

	<link href="/Public/media/css/uniform.default.css" rel="stylesheet" type="text/css"/>
	<link href="/Public/css/common.css" rel="stylesheet" type="text/css"/>

	<!-- END GLOBAL MANDATORY STYLES -->

	<link rel="shortcut icon" href="/Public/media/image/favicon.ico" />



	<script src="/Public/media/js/jquery-1.10.1.min.js" type="text/javascript"></script>

	<script src="/Public/media/js/jquery-migrate-1.2.1.min.js" type="text/javascript"></script>

	<!-- IMPORTANT! Load jquery-ui-1.10.1.custom.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->

	<script src="/Public/media/js/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>

	<script src="/Public/media/js/bootstrap.min.js" type="text/javascript"></script>

	<!--[if lt IE 9]>

	<script src="/Public/media/js/excanvas.min.js"></script>

	<script src="/Public/media/js/respond.min.js"></script>

	<![endif]-->

	<script src="/Public/media/js/jquery.slimscroll.min.js" type="text/javascript"></script>

	<script src="/Public/media/js/jquery.blockui.min.js" type="text/javascript"></script>

	<script src="/Public/media/js/jquery.cookie.min.js" type="text/javascript"></script>

	<script src="/Public/media/js/jquery.uniform.min.js" type="text/javascript" ></script>

	<!-- END CORE PLUGINS -->

	<script src="/Public/media/js/app.js"></script>
	 <script src="/Public/media/js/table-editable.js"></script>
	 <script src="/Public/js/jquery.validate.js"></script>
	 <script src="/Public/js/common.js"></script>
</head>

<!-- END HEAD -->

<!-- BEGIN BODY -->

<body class="page-header-fixed">

	<!-- BEGIN HEADER -->

	<div class="header navbar navbar-inverse navbar-fixed-top">

		<!-- BEGIN TOP NAVIGATION BAR -->

		<div class="navbar-inner">

			<div class="container-fluid">

				<!-- BEGIN LOGO -->

				<a class="brand" href="index.html">

				<img src="/Public/media/image/logo.png" alt="logo" />

				</a>

				<!-- END LOGO -->

				<!-- yyx 小屏幕时候出现菜单 -->

				<a href="javascript:;" class="btn-navbar collapsed" data-toggle="collapse" data-target=".nav-collapse">

				<img src="/Public/media/image/menu-toggler.png" alt="" />

				</a>

				<!-- END RESPONSIVE MENU TOGGLER -->

				<!-- BEGIN TOP NAVIGATION MENU -->

				<ul class="nav pull-right">

					<!--yyx 头部消息 -->

				<!-- 	<li class="dropdown" id="header_notification_bar">

						<a href="#" class="dropdown-toggle" data-toggle="dropdown">

						<i class="icon-warning-sign"></i>

						<span class="badge">6</span>

						</a>

						<ul class="dropdown-menu extended notification">

							<li>

								<p>You have 14 new notifications</p>

							</li>

							<li>

								<a href="#">

								<span class="label label-success"><i class="icon-plus"></i></span>

								New user registered.

								<span class="time">Just now</span>

								</a>

							</li>

							<li>

								<a href="#">

								<span class="label label-important"><i class="icon-bolt"></i></span>

								Server #12 overloaded.

								<span class="time">15 mins</span>

								</a>

							</li>

							<li>

								<a href="#">

								<span class="label label-warning"><i class="icon-bell"></i></span>

								Server #2 not respoding.

								<span class="time">22 mins</span>

								</a>

							</li>

							<li>

								<a href="#">

								<span class="label label-info"><i class="icon-bullhorn"></i></span>

								Application error.

								<span class="time">40 mins</span>

								</a>

							</li>

							<li>

								<a href="#">

								<span class="label label-important"><i class="icon-bolt"></i></span>

								Database overloaded 68%.

								<span class="time">2 hrs</span>

								</a>

							</li>

							<li>

								<a href="#">

								<span class="label label-important"><i class="icon-bolt"></i></span>

								2 user IP blocked.

								<span class="time">5 hrs</span>

								</a>

							</li>

							<li class="external">

								<a href="#">See all notifications <i class="m-icon-swapright"></i></a>

							</li>

						</ul>

					</li> -->

					<!--yyx 用户头像-->

					<li class="dropdown user">

						<a href="#" class="dropdown-toggle" data-toggle="dropdown">

						<img alt="" src="/Public/media/image/avatar1_small.jpg" />

						<span class="username"><?php echo ($_SESSION['admin']['title']); ?></span>

						<i class="icon-angle-down"></i>

						</a>

						<ul class="dropdown-menu">

							<li><a onclick="myback()"><i class="icon-key"></i>退出</a></li>

						</ul>

					</li>

					<!-- END USER LOGIN DROPDOWN -->

				</ul>

				<!-- END TOP NAVIGATION MENU -->

			</div>

		</div>

		<!-- END TOP NAVIGATION BAR -->

	</div>
<script type="text/javascript">
jQuery(document).ready(function() {
	App.init();
	function myback () {
		var url="/index.php/Admin/System/Myback";
        window.location.href=url;
	}
});
</script>
	<!-- END HEADER -->
		<!-- BEGIN CONTAINER -->
	<div class="page-container row-fluid">

		<!-- BEGIN SIDEBAR -->
		<div class="page-sidebar nav-collapse collapse">
			<!-- BEGIN SIDEBAR MENU -->
			<ul class="page-sidebar-menu">
				<li>
					<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
					<div class="sidebar-toggler hidden-phone"></div>
					<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
				</li>
				<li class="start " id="menu-Index">
					<a href="/index.php/Admin/Index/index">
					<i class="icon-home"></i>
					<span class="title">主页</span>
					</a>
				</li>
				<li class="" id="menu-User">
					<a href="javascript:;">
						<i class="icon-user"></i>
						<span class="title">会员管理</span>
						<span class="selected"></span>
						<span class="arrow open"></span>
					</a>
					<ul class="sub-menu">
						<li class="" id="User-User_list">
							<a href="/index.php/Admin/User/User_list">用户列表</a>
						</li>
					<!-- 	<li class="" id="User-User_group">
							<a href="/index.php/Admin/User/User_group">分组列表</a>
						</li> -->
					<!-- 	<li id="Index-Table">
							<a href="/index.php/Admin/Index/Table">表格页</a>
						</li>
						<li id="Index-Info">
							<a href="/index.php/Admin/Index/Info">详情页</a>
						</li> -->
					</ul>
				</li>

				<li class="" id="menu-Article">
					<a href="javascript:;">
						<i class="icon-edit"></i>
						<span class="title">文章管理</span>
						<span class="selected"></span>
						<span class="arrow open"></span>
					</a>
					<ul class="sub-menu">
					    <li id="Article-Mokuai">
							<a href="/index.php/Admin/Article/Mokuai">文章模块列表</a>
						</li>
						<li class="" id="Article-Article_type">
							<a href="/index.php/Admin/Article/Article_type">文章类型列表</a>
						</li>
						<li class="" id="Article-Index">
							<a href="/index.php/Admin/Article/Index">文章列表</a>
						</li>
					<!-- 	<li id="Index-Info">
							<a href="/index.php/Admin/Index/Info">详情页</a>
						</li> -->
					</ul>
				</li>

				<li class="" id="menu-Ad">
					<a href="javascript:;">
						<i class="icon-picture"></i>
						<span class="title">广告管理</span>
						<span class="selected"></span>
						<span class="arrow open"></span>
					</a>
					<ul class="sub-menu">
						<li class="" id="Ad-Index">
							<a href="/index.php/Admin/Ad/Index">广告列表</a>
						</li>
					<!-- 	<li class="" id="User-User_group">
							<a href="/index.php/Admin/User/User_group">分组列表</a>
						</li> -->
					<!-- 	<li id="Index-Table">
							<a href="/index.php/Admin/Index/Table">表格页</a>
						</li>
						<li id="Index-Info">
							<a href="/index.php/Admin/Index/Info">详情页</a>
						</li> -->
					</ul>
				</li>
				<li class="" id="menu-Shopper">
					<a href="javascript:;">
						<i class="icon-user-md"></i>
						<span class="title">配送员管理</span>
						<span class="selected"></span>
						<span class="arrow open"></span>
					</a>
					<ul class="sub-menu">
						<li class="" id="Shopper-Index">
							<a href="/index.php/Admin/Shopper/Index">配送员列表</a>
						</li>
					<!-- 	<li class="" id="User-User_group">
							<a href="/index.php/Admin/User/User_group">分组列表</a>
						</li> -->
					<!-- 	<li id="Index-Table">
							<a href="/index.php/Admin/Index/Table">表格页</a>
						</li>
						<li id="Index-Info">
							<a href="/index.php/Admin/Index/Info">详情页</a>
						</li> -->
					</ul>
				</li>
				<li class="" id="menu-Goods">
					<a href="javascript:;">
						<i class="icon-reorder"></i>
						<span class="title">商品管理</span>
						<span class="selected"></span>
						<span class="arrow open"></span>
					</a>
					<ul class="sub-menu">
					    <li class="" id="Goods-Centclass">
							<a href="/index.php/Admin/Goods/Centclass">积分类别列表</a>
						</li>
						<li class="" id="Goods-Gift">
							<a href="/index.php/Admin/Goods/Gift">积分商品列表</a>
						</li>
						<li class="" id="Goods-Index">
							<a href="/index.php/Admin/Goods/Index">普通商品列表</a>
						</li>
					<!-- 	<li class="" id="User-User_group">
							<a href="/index.php/Admin/User/User_group">分组列表</a>
						</li> -->
					<!-- 	<li id="Index-Table">
							<a href="/index.php/Admin/Index/Table">表格页</a>
						</li>
						<li id="Index-Info">
							<a href="/index.php/Admin/Index/Info">详情页</a>
						</li> -->
					</ul>
				</li>
				<li class="" id="menu-Orders">
					<a href="javascript:;">
						<i class="icon-shopping-cart"></i>
						<span class="title">订单管理</span>
						<span class="selected"></span>
						<span class="arrow open"></span>
					</a>
					<ul class="sub-menu">
						<li class="" id="Orders-F_order">
							<a href="/index.php/Admin/Orders/F_order">分配订单</a>
						</li>
						<li class="" id="Orders-Index">
							<a href="/index.php/Admin/Orders/Index">订单列表</a>
						</li>
						<li class="" id="Orders-Gift">
							<a href="/index.php/Admin/Orders/Gift">积分礼品列表</a>
						</li>
						<li class="" id="Orders-Refund">
							<a href="/index.php/Admin/Orders/Refund">订单退款列表</a>
						</li>
					</ul>
				</li>
				<li class="" id="menu-Dzp">
					<a href="javascript:;">
						<i class="icon-globe"></i>
						<span class="title">游戏管理</span>
						<span class="selected"></span>
						<span class="arrow open"></span>
					</a>
					<ul class="sub-menu">
						<li class="" id="Dzp-Index">
							<a href="/index.php/Admin/Dzp/Index">奖品列表</a>
						</li>
						<li class="" id="Dzp-Zhongjiang">
							<a href="/index.php/Admin/Dzp/Zhongjiang">中奖列表</a>
						</li>
					</ul>
				</li>
				<li class="" id="menu-Scan">
					<a href="javascript:;">
						<i class="icon-file"></i>
						<span class="title">二维码管理</span>
						<span class="selected"></span>
						<span class="arrow open"></span>
					</a>
					<ul class="sub-menu">
						<li class="" id="Scan-Index">
							<a href="/index.php/Admin/Scan/Index">生成二维码</a>
						</li>
						<li class="" id="Scan-Scan_list">
							<a href="/index.php/Admin/Scan/Scan_list">批次列表</a>
						</li>
					</ul>
				</li>
				<li class="" id="menu-Peizhi">
					<a href="javascript:;">
						<i class="icon-cogs"></i>
						<span class="title">系统管理</span>
						<span class="selected"></span>
						<span class="arrow open"></span>
					</a>
					<ul class="sub-menu">
						<li class="" id="Peizhi-Index">
							<a href="/index.php/Admin/Peizhi/Index">系统配置</a>
						</li>
						<li class="" id="Peizhi-Women">
							<a href="/index.php/Admin/Peizhi/Women">关于我们</a>
						</li>
						<li class="" id="Peizhi-City">
							<a href="/index.php/Admin/Peizhi/City">配送区域</a>
						</li>
					</ul>
				</li>
						<li class="" id="menu-Admin">
					<a href="javascript:;">
						<i class="icon-group"></i>
						<span class="title">管理员管理</span>
						<span class="selected"></span>
						<span class="arrow open"></span>
					</a>
					<ul class="sub-menu">
						<li class="" id="Admin-Index">
							<a href="/index.php/Admin/Admin/Index">管理员</a>
						</li>
					<!-- 	<li class="" id="User-User_group">
							<a href="/index.php/Admin/User/User_group">分组列表</a>
						</li> -->
					<!-- 	<li id="Index-Table">
							<a href="/index.php/Admin/Index/Table">表格页</a>
						</li>
						<li id="Index-Info">
							<a href="/index.php/Admin/Index/Info">详情页</a>
						</li> -->
					</ul>
				</li>
			<!-- 	<li class="" id="menu-Index">
					<a href="javascript:;">
						<i class="icon-cogs"></i>
						<span class="title">Layouts</span>
						<span class="selected"></span>
						<span class="arrow open"></span>
					</a>
					<ul class="sub-menu">
						<li class="" id="Index-index">
							<a href="/index.php/Admin/Index/index">空白页</a>
						</li>
						<li id="Index-Table">
							<a href="/index.php/Admin/Index/Table">表格页</a>
						</li>
						<li id="Index-Info">
							<a href="/index.php/Admin/Index/Info">详情页</a>
						</li>
					</ul>
				</li>
 -->
				<!-- <li class="">
					<a href="javascript:;">
					<i class="icon-user"></i>
					<span class="title">UI Features</span>
					<span class="arrow "></span>
					</a>
					<ul class="sub-menu">
						<li >
							<a href="/index.php/Admin/Index/index">1</a>
						</li>
						<li >
							<a href="/index.php/Admin/Index/index">2</a>
						</li>
					</ul>
				</li> -->
				<!-- yyx 三级目录 -->
			<!-- 	<li>
					<a class="active" href="javascript:;">
					<i class="icon-sitemap"></i>
					<span class="title">3 Level Menu</span>
					<span class="arrow "></span>
					</a>
					<ul class="sub-menu">
						<li>
							<a href="javascript:;">
							Item 1
							<span class="arrow"></span>
							</a>
							<ul class="sub-menu">
								<li><a href="#">Sample Link 1</a></li>
								<li><a href="#">Sample Link 2</a></li>
								<li><a href="#">Sample Link 3</a></li>
							</ul>
						</li>
						<li>
							<a href="javascript:;">
							Item 1
							<span class="arrow"></span>
							</a>
							<ul class="sub-menu">
								<li><a href="#">Sample Link 1</a></li>
								<li><a href="#">Sample Link 1</a></li>
								<li><a href="#">Sample Link 1</a></li>
							</ul>
						</li>
						<li>
							<a href="#">
							Item 3
							</a>
						</li>
					</ul>
				</li>
 -->
			</ul>
	</div>
<script type="text/javascript">
//输入 处理数据 输出
//dom  html/css html/css
$(document).ready(function(){
	$('#menu-<?php echo CONTROLLER_NAME; ?>').addClass('active');
	$('#<?php echo CONTROLLER_NAME; ?>-<?php echo ACTION_NAME; ?>').addClass('active');
});
</script>
			<!-- END SIDEBAR MENU -->


		<!-- END SIDEBAR -->

		<!-- BEGIN PAGE -->

		<div class="page-content">

			<!-- BEGIN PAGE CONTAINER-->

			<div class="container-fluid">

				<!-- BEGIN PAGE HEADER-->

				<div class="row-fluid">

					<div class="span12">

						<!-- BEGIN PAGE TITLE & BREADCRUMB-->

						<h3 class="page-title">

							主页 <small>这里是耘初平台管理后台</small>

						</h3>

						<ul class="breadcrumb">

							<li>
								<i class="icon-home"></i>
								<a href="index.html">Home</a>
								<i class="icon-angle-right"></i>
							</li>
							<li>
								<a href="#">Layouts</a>
								<i class="icon-angle-right"></i>
							</li>
							<li><a href="#">Blank Page</a></li>
						</ul>
						<!-- END PAGE TITLE & BREADCRUMB-->
					</div>
				</div>


				<!-- yyx 内容 -->
				<div class="row-fluid">

					<div class="span12">

						Blank page content goes here

					</div>

				</div>




			</div>
		</div>

<script>

</script>

	</div>
	<div class="footer">

		<div class="footer-inner">

			2013 &copy; Metronic by keenthemes.

		</div>

		<div class="footer-tools">

			<span class="go-top">

			<i class="icon-angle-up"></i>

			</span>

		</div>

	</div>

	<!-- END FOOTER -->

	<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->

	<!-- BEGIN CORE PLUGINS -->



	<!-- END JAVASCRIPTS -->

<script type="text/javascript">  var _gaq = _gaq || [];  _gaq.push(['_setAccount', 'UA-37564768-1']);  _gaq.push(['_setDomainName', 'keenthemes.com']);  _gaq.push(['_setAllowLinker', true]);  _gaq.push(['_trackPageview']);  (function() {    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;    ga.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'stats.g.doubleclick.net/dc.js';    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);  })();</script></body>

<!-- END BODY -->

</html>