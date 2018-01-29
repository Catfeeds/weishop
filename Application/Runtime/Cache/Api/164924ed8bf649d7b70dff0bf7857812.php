<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <title>关于我们</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="maximum-scale=1.0,minimum-scale=1.0,user-scalable=0,width=device-width,initial-scale=1.0"/>
    <link rel="stylesheet" href="/Public/css/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="/Public/css/common2.css" />
    <link href="/Public/js/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/Public/css/personinfo/common.css">
    <style type="text/css">
            .content{padding: 8px;}
            .content img{max-width: 100%}
    </style>
</head>
<body>

       <div class="content">
            <?php echo (htmlspecialchars_decode($data)); ?>
        </div>


</body>
</html>