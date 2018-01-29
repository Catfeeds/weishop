<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<head>

	<meta charset="utf-8" />

	<title>Metronic | Login Page</title>

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

	<!-- END GLOBAL MANDATORY STYLES -->

	<!-- BEGIN PAGE LEVEL STYLES -->

	<link href="/Public/media/css/login.css" rel="stylesheet" type="text/css"/>

	<!-- END PAGE LEVEL STYLES -->

	<link rel="shortcut icon" href="/Public/media/image/favicon.ico" />

</head>

<!-- END HEAD -->

<!-- BEGIN BODY -->

<body class="login">

	<!-- BEGIN LOGO -->

	<div class="logo">

		<img src="/Public/media/image/logo-big.png" alt="" />

	</div>

	<!-- END LOGO -->

	<!-- BEGIN LOGIN -->

	<div class="content">

		<!-- BEGIN LOGIN FORM -->

		<form class="form-vertical login-form" method="post">

			<h3 class="form-title">耘初平台登录系统</h3>

			<div class="alert alert-error hide">

				<button class="close" data-dismiss="alert"></button>

				<span>Enter any username and password.</span>

			</div>

			<div class="control-group">

				<!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->

				<label class="control-label visible-ie8 visible-ie9">Username</label>

				<div class="controls">

					<div class="input-icon left">

						<i class="icon-user"></i>

						<input class="m-wrap placeholder-no-fix" type="text" placeholder="Username" name="name"/>

					</div>

				</div>

			</div>

			<div class="control-group">

				<label class="control-label visible-ie8 visible-ie9">Password</label>

				<div class="controls">

					<div class="input-icon left">

						<i class="icon-lock"></i>

						<input class="m-wrap placeholder-no-fix" required  type="password" placeholder="Password" name="pwd"/>

					</div>


				</div>

			</div>

			<div class="form-actions">

				<label class="checkbox">

				<input type="checkbox" name="remember" value="1" />记住密码

				</label>

				<button class="btn green pull-right">

				登录 <i class="m-icon-swapright m-icon-white"></i>

				</button>

			</div>

		</form>
		<!-- END REGISTRATION FORM -->

	</div>

	<!-- END LOGIN -->

	<!-- BEGIN COPYRIGHT -->

	<div class="copyright">

		2015 &copy; XX平台系统

	</div>



	<!-- END COPYRIGHT -->

	<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->

	<!-- BEGIN CORE PLUGINS -->

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


	<script src="/Public/media/js/app.js" type="text/javascript"></script>
	<script src="/Public/js/jquery.validate.js"></script>
	<script src="/Public/js/common.js"></script>
	<script>
		jQuery(document).ready(function() {
		  App.init();
			$('form').validate({
			rules:{name:"required",pwd:"required"},
			messages:{name:"名字必须",pwd:"密码必须"},
			submitHandler: function (form) {
					var data=$(form).serialize();
					yyxajax("/index.php/Admin",data,function(ret){
						// alert(JSON.stringify(ret))
						if(ret.code==100){
							self.location="/index.php/Admin/Index/index";
						}else{
							yyxalert(ret.data)
						}
					})
			},
			errorPlacement: function(error, element) {
					element.parent().after(error);
			}
		});
		});

	</script>
</html>