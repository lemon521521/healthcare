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
<body id="body" class="body">
    <!--<![endif]-->
<div class="navbar">
   <div class="navbar-inner">
   		<ul class="nav pull-right">
			<li class="doSidebarClz"><a href="#" class="hidden-phone visible-tablet visible-desktop" role="button">
			关闭侧栏<i class="icon-step-backward"></i></a></li>
			<li id="fat-menu" class="dropdown">
			<a href="#" role="button" class="dropdown-toggle" data-toggle="dropdown">
			<i class="icon-user"></i> <?php echo ($_SESSION['account_name']); ?> <i class="icon-caret-down"></i></a>
	         <ul class="dropdown-menu">
	             <li><a tabindex="-1" href="__APP__/User/profile/<?php echo ($_SESSION['account_id']); ?>">我的账号</a></li>
	             <li><a tabindex="-1" href="__APP__/Login/loginOut">登出</a></li>
	         </ul>
	         </li>
         </ul>
         <a class="brand" href="#"><span class="first"></span> <span class="second">后台管理系统</span></a>
   </div>
</div>
<div id="sidebar-nav" class="sidebar-nav">
	<a href="#sidebar_menu_1" class="nav-header collapsed" data-toggle="collapse"><i class="icon-th"></i>用户管理 <i class="icon-chevron-up"></i></a>
	<ul id="sidebar_menu_1" class="nav nav-list collapse in">
		<li><a href="__APP__/Account/index">账号列表</a></li>
	</ul>
	<a href="#sidebar_menu_2" class="nav-header collapsed" data-toggle="collapse"><i class="icon-th"></i>系统管理 <i class="icon-chevron-up"></i></a>
	<ul id="sidebar_menu_2" class="nav nav-list collapse in">
		<li><a href="__APP__/Category/index">栏目列表</a></li>
		<li><a href="__APP__/Article/index">产品列表</a></li>
		<li><a href="__APP__/Area/index">国家列表</a></li>
		<li><a href="__APP__/Hospital/index">医院列表</a></li>
		<li><a href="__APP__/Physician/index">医师列表</a></li>
	</ul>
	<a href="#sidebar_menu_3" class="nav-header collapsed" data-toggle="collapse"><i class="icon-th"></i>首页信息管理 <i class="icon-chevron-up"></i></a>
	<ul id="sidebar_menu_3" class="nav nav-list collapse in">
		<li><a href="__APP__/Webinfo/index">首页头部轮播</a></li>
		<li><a href="__APP__/Webinfo/ads">首页广告</a></li>
	</ul>
	
</div>
	 <!--- 以上为左侧菜单栏 sidebar --->
<div id="content" class="content">
        
        <div class="header">
            <div class="stats">
			<p class="stat"><!--span class="number"></span--></p>
			</div>

            <h1 class="page-title"><?php echo ($pinfo["title"]); ?>（编辑行程）</h1>
        </div>
        
		<ul class="breadcrumb">
						<li><a href="__URL__/index/id/<?php echo ($pinfo["id"]); ?>"> 行程列表 </a> <span class="divider">/</span></li>
			<li class="active">新增行程</li>
        </ul>
<div class="container-fluid">
	<div class="row-fluid">
		<div class="bb-alert alert alert-info" style="display: none;">
			<span>操作成功</span>
		</div>
<!-- START 以上内容不需更改，保证该TPL页内的标签匹配即可 -->
<div class="well">
    <ul class="nav nav-tabs">
      <li class="active"><a href="#home" data-toggle="tab">请填写信息</a></li>
    </ul>	
	
	<div id="myTabContent" class="tab-content">
		  <div class="tab-pane active in" id="home">
  <form method="post" action="__URL__/edit" id="tab"  autocomplete="off">
        <input type="hidden" name="product_id" value="<?php echo ($pinfo["id"]); ?>">
        <input type="hidden" name="travel_id" value="<?php echo ($travelList["id"]); ?>">
		<label>行程类型</label>		
		<select name="type" id="type">	
		<option value="1" id="type" <?php if($travelList["type"] == 1): ?>selected<?php endif; ?>>天数行程</option>
		<option value="2" id="type" <?php if($travelList["type"] == 2): ?>selected<?php endif; ?>>阶段行程</option>
		</for>
		</select>           		
		<label>行程名称（PS:第*天或**阶段）</label>				
		<input type="text" name="travel_name" style="height:30px;" value="<?php echo ($travelList["travel_name"]); ?>" class="input-xlarge" autofocus="true" required="true" >
		<label>行程标题</label>				
		<input type="text" name="travel_title" style="height:30px;" value="<?php echo ($travelList["travel_title"]); ?>" class="input-xlarge" autofocus="true" required="true" >
		<label>航班</label>				
		<textarea  name="flight" style="width:300px;height:200px;" class="input-xlarge" autofocus="true" required="true">
		<?php echo ($travelList["flight"]); ?>
		</textarea>
		<label>餐饮</label>				
		<textarea  name="catering" style="width:300px;height:200px;" class="input-xlarge" autofocus="true" required="true">
		<?php echo ($travelList["catering"]); ?>
		</textarea>
		<label>酒店</label>				
		<textarea  name="hotel" style="width:300px;height:200px;" class="input-xlarge" autofocus="true" required="true">
	<?php echo ($travelList["hotel"]); ?>
		</textarea>
		<label>行程</label>				
		<textarea  name="travel" style="width:300px;height:200px;" class="input-xlarge" autofocus="true" required="true">
	<?php echo ($travelList["travel"]); ?>
		</textarea>
		<label>行程图片</label>
		<input type="button" id="J_selectImage" value="批量上传" />
		<?php echo ($travelList["picture"]); ?>
		<input type="hidden" id="bulk_upload" name="travel_img" value="">				
		<label>显示顺序</label>		
		<select name="day" id="day">	
		<?php $__FOR_START__=1;$__FOR_END__=11;for($i=$__FOR_START__;$i < $__FOR_END__;$i+=1){ ?><option value="<?php echo ($i); ?>" id="day" <?php if($travelList["day"] == $i): ?>selected<?php endif; ?>><?php echo ($i); ?></option><?php } ?>
		</select>
		<div class="btn-toolbar">
			<button id="but" type="submit" class="btn btn-primary"><strong>提交</strong></button>
			<div class="btn-group"></div>
		</div>
		</form>
        </div>
    </div>
</div>
<script>

//批量上传图片
KindEditor.ready(function(K) {
				var editor = K.editor({
					cssPath : '__PUBLIC__/editor/plugins/code/prettify.css',
					uploadJson : '__PUBLIC__/editor/php/upload_json.php',
					fileManagerJson : '__PUBLIC__/editor/php/file_manager_json.php',
					allowFileManager : true
				});
				//焦点图批量图片
				K('#J_selectImage').click(function() {
					editor.loadPlugin('multiimage', function() {
						editor.plugin.multiImageDialog({
							clickFn : function(urlList) {
								var div = K('#J_imageView');
								div.html(''); 
								//console.log(urlList);
								var url='';
								K.each(urlList, function(i, data) {	
									//console.log(data);
									div.append('<img src="' + data.url + '" height="100px" width="100px">');
									 
									 url+=data.url+'%';
									//console.log(url);
									
								});
								K("#bulk_upload").val(url);																
								editor.hideDialog();
							}
						});
					});	
					
				});
		
});

</script>
<!--- END 以下内容不需更改，请保证该TPL页内的标签匹配即可 --->
	<footer>
       <hr>
       <p class="pull-right"></p>
   </footer>
</div>
</div>
</div>
<script src="__PUBLIC__/assets/lib/bootstrap/js/bootstrap.js"></script>
	
<!--- + -快捷方式的提示 --->
<script type="text/javascript">	
alertDismiss("alert-success",3);
alertDismiss("alert-info",10);
listenShortCut("icon-plus");
listenShortCut("icon-minus");
doSidebar();
</script>
</body>
</html>