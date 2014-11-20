<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>首页 - 管理后台 </title>
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <link rel="stylesheet" href="__PUBLIC__/assets/lib/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="__PUBLIC__/assets/stylesheets_default/theme.css">
    <link rel="stylesheet" href="__PUBLIC__/assets/lib/font-awesome/css/font-awesome.css">
	<link rel="stylesheet" href="__PUBLIC__/assets/css/other.css">
	<link rel="stylesheet" href="__PUBLIC__/assets/css/jquery-ui.css" />
	<link rel="stylesheet" href="__PUBLIC__/colorbox/colorbox.css" />
	<link rel="stylesheet" href="__PUBLIC__/editor/themes/default/default.css" />
<link rel="stylesheet" href="__PUBLIC__/editor/plugins/code/prettify.css" />
<script charset="utf-8" src="__PUBLIC__/editor/kindeditor.js"></script>
<script charset="utf-8" src="__PUBLIC__/editor/lang/zh_CN.js"></script>
<script charset="utf-8" src="__PUBLIC__/editor/plugins/code/prettify.js"></script>
    <script src="__PUBLIC__/assets/lib/jquery-1.8.1.min.js" ></script>
	<script src="__PUBLIC__/assets/lib/jquery.cookie.js" ></script>
	<script src="__PUBLIC__/assets/lib/bootstrap/js/bootbox.min.js"></script>
	<script src="__PUBLIC__/assets/lib/bootstrap/js/bootstrap-modal.js"></script>
	<script src="__PUBLIC__/assets/js/other.js"></script>
	<script src="__PUBLIC__/assets/js/jquery-ui.js"></script>
	<script src="__PUBLIC__/colorbox/jquery.colorbox.js"></script>
    <!-- Demo page code -->

    <style type="text/css">
        #line-chart {
            height:300px;
            width:800px;
            margin: 0px auto;
            margin-top: 1em;
        }
        .brand { font-family: georgia, serif; }
        .brand .first {
            color: #ccc;
            font-style: italic;
        }
        .brand .second {
            color: #fff;
            font-weight: bold;
        }
    </style>

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="__PUBLIC__/assets/js/html5.js"></script>
    <![endif]-->

  </head>
<script language="JavaScript">
<!--
//指定当前组模块URL地址 
var URL = '__URL__';
var APP	 =	 '__APP__';
var PUBLIC = '__PUBLIC__';
//-->
</script>
  <!--[if lt IE 7 ]> <body class="ie ie6"> <![endif]-->
  <!--[if IE 7 ]> <body class="ie ie7 "> <![endif]-->
  <!--[if IE 8 ]> <body class="ie ie8 "> <![endif]-->
  <!--[if IE 9 ]> <body class="ie ie9 "> <![endif]-->
  <!--[if (gt IE 9)|!(IE)]><!--> 
  <body class="http-error"> 
  <!--<![endif]-->
    
<div class="row-fluid">
    <div class="http-error">
        <h1><?php if(isset($message)): echo ($message); else: echo ($error); endif; ?></h1>
        <p class="info"><?php echo ($msgTitle); ?></p>
        <p><i class="icon-home"></i></p>
        <p><a id="href" href="<?php echo ($jumpUrl); ?>">页面将在 <span id="wait" style="color:red;font-weight:bold"><?php echo ($waitSecond); ?></span> 秒后返回，直接点击这里关闭</a></p>
    </div>
</div>

<script type="text/javascript">
(function(){
var wait = document.getElementById('wait'),href = document.getElementById('href').href;
var interval = setInterval(function(){
	var time = --wait.innerHTML;
	(time == 0) && (location.href = href);
}, 1000);	
})();
</script>
  </body>
</html>