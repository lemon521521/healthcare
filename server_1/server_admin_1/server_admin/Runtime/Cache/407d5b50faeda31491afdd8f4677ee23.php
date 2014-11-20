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
		<li><a href="__APP__/Product/index">产品列表</a></li>
		<li><a href="__APP__/Area/index">国家列表</a></li>
		<li><a href="__APP__/Hospital/index">医院列表</a></li>
		<li><a href="__APP__/Physician/index">医师列表</a></li>
	</ul>
	<a href="#sidebar_menu_3" class="nav-header collapsed" data-toggle="collapse"><i class="icon-th"></i>广告管理 <i class="icon-chevron-up"></i></a>
	<ul id="sidebar_menu_3" class="nav nav-list collapse in">
		<li><a href="__APP__/Webinfo/index">首页头部轮播</a></li>
		<li><a href="__APP__/Webinfo/ads">广告列表</a></li>
	</ul>
	
</div>
	 <!--- 以上为左侧菜单栏 sidebar --->
<style type="text/css">
#one{width:200px; height:180px; float:left}
#two{width:50px; height:180px; float:left}
#three{width:200px; height:180px; float:left}
.btn{width:50px; height:30px; margin-top:10px; cursor:pointer;}
</style>
<div id="content" class="content">
        
        <div class="header">
            <div class="stats">
			<p class="stat"><!--span class="number"></span--></p>
			</div>

            <h1 class="page-title">编辑医院</h1>
        </div>
        
		<ul class="breadcrumb">
						<li><a href="__URL__/index"> 医院列表 </a> <span class="divider">/</span></li>
			<li class="active">编辑医院</li>
        </ul>
<div class="container-fluid">
	<div class="row-fluid">
		<div class="bb-alert alert alert-info" style="display: none;">
			<span>操作成功</span>
		</div>
<!-- START 以上内容不需更改，保证该TPL页内的标签匹配即可 -->



    
<div class="well">
    <ul class="nav nav-tabs">
      <li class="active"><a href="#home" data-toggle="tab">请填写医院信息</a></li>
    </ul>	
	
	<div id="myTabContent" class="tab-content">
		  <div class="tab-pane active in" id="home">

           <form id="tab" method="post" action="__URL__/edit" autocomplete="off">
           <?php if(is_array($Hospital)): $i = 0; $__LIST__ = $Hospital;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$Hospital): $mod = ($i % 2 );++$i;?><input type="hidden" name="id" value="<?php echo ($Hospital["id"]); ?>">
				<label>医院名</label>
				<input type="text" name="hospital_name" value="<?php echo ($Hospital["hospital_name"]); ?>" class="input-xlarge" autofocus="true" required="true" >
				<label>医院短标题</label>
				<input type="text" name="short_title" value="<?php echo ($Hospital["short_title"]); ?>" class="input-xlarge" autofocus="true" required="true" >
			
				<label>国家</label>				
				<select name='area_id' id="area_id">
				<?php echo ($Hospital["country"]); ?>
				</select>
				<label>医院地址</label>
				<input type="text" name="address" value="<?php echo ($Hospital["address"]); ?>" class="input-xlarge" autofocus="true" required="true" >		
				<label>医院图片</label>
				<?php echo ($Hospital["html_img"]); ?>
				<input type="hidden" id="url3" name="thumb_img" value="<?php echo ($Hospital["hospital_img"]); ?>" /> <input type="button" id="image3" value="选择图片" />			
							
				
				<label>医院LOGO</label>
				<?php echo ($Hospital["html_logo"]); ?>
				<input type="hidden" id="url4" name="thumb_logo" value="<?php echo ($Hospital["hospital_logo"]); ?>" /> <input type="button" id="image4" value="选择图片" />
					<label>医院缩略图</label>
				<?php echo ($Hospital["html_thumb"]); ?>
				<input type="hidden" id="url5" name="thumb" value="<?php echo ($Hospital["thumb_img"]); ?>" /> <input type="button" id="image5" value="选择图片" />										
		  										
		         <div class="control-group">
	             <label class="control-label" for="regular">简介</label>
	             <div class="controls">
	                 <textarea id="introduction" name="introduction" style="width:500px;height:300px;"><?php echo ($Hospital["introduction"]); ?></textarea>
	             </div>
        		 </div>	
				<!-- <label>简介图片</label>
				<input type="hidden" id="J_selectImage" value="批量上传" />
				<div id="J_imageView"></div>
				<input type="hidden" id="bulk_upload" name="bulk_upload" value=""> -->
	        	 <div class="control-group">
	             <label class="control-label" for="regular">荣誉信息</label>
	             <div class="controls">
	                 <textarea id="honor_information" name="honor_information" style="width:500px;height:300px;"><?php echo ($Hospital["honor_information"]); ?></textarea>
	             </div>
        		 </div>	
	        	 <div class="control-group">
	             <label class="control-label" for="regular">特色</label>
	             <div class="controls">
	                 <textarea id="characteristic" name="characteristic" style="width:500px;height:300px;"><?php echo ($Hospital["characteristic"]); ?></textarea>
	             </div>
        		 </div>				
	        	 <div class="control-group">
	             <label class="control-label" for="regular">医疗团队</label>
	             <div class="controls">
	                 <textarea id="medical_team" name="medical_team" style="width:500px;height:300px;"><?php echo ($Hospital["medical_team"]); ?></textarea>
	             </div>
        		 </div>
        		  	<label>自定义标题</label>
				<input type="text" name="high_customers_title" value="<?php echo ($Hospital["high_customers_title"]); ?>" class="input-xlarge" autofocus="true" required="true" >			
							
	        	 <div class="control-group">
	             <label class="control-label" for="regular">自定义内容</label>
	             <div class="controls">
	                 <textarea id="high_customers" name="high_customers" style="width:500px;height:300px;"><?php echo ($Hospital["high_customers"]); ?></textarea>
	             </div>
        		 </div>				
	<!-- 			<label>医院医师</label>	
				
				<div>
        <div>
          <select multiple="multiple" id="select1" style="width:150px;height:200px; float:left; border:4px #A0A0A4 outset; padding:4px; ">
          <?php echo ($Hospital["physician_select"]); ?>
          </select>
        </div>
        <div style="float:left"> <span id="add">
          <input type="button" class="btn" value=">"/>
          </span><br />
         <span id="add_all">
          <input type="button" class="btn" value=">>"/>
          </span> <br /> 
          <span id="remove">
          <input type="button" class="btn" value="<"/>
          </span><br />
           <span id="remove_all">
          <input type="button" class="btn" value="<<"/>
          </span>  </div>
        <div>
          <select multiple="multiple" name="physician_id[]"  id="select2" style="width: 150px;height:200px; float:lfet;border:4px #A0A0A4 outset; padding:4px;">
          <?php echo ($Hospital["select"]); ?>
          </select>
        </div>
      </div> --><?php endforeach; endif; else: echo "" ;endif; ?>		
				<div class="btn-toolbar">
				<button type="submit"  style="width:60px" class="btn btn-primary"><strong>提交</strong></button>
				<div class="btn-group"></div>
			</div>
			</form>
        </div>
      <input type="hidden" value="0" name="n"  id="n">
      <input type="hidden" value="" name="phy_str"  id="phy_str">
    </div>
</div> 
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
<script>
//医院图上传
KindEditor.ready(function(K) {
	var editor = K.editor({
		cssPath : '__PUBLIC__/editor/plugins/code/prettify.css',
		uploadJson : '__PUBLIC__/editor/php/upload_json.php',
		fileManagerJson : '__PUBLIC__/editor/php/file_manager_json.php',
		allowFileManager : true
});
K('#image3').click(function() {
	editor.loadPlugin('image', function() {
		editor.plugin.imageDialog({
			showRemote : false,
			imageUrl : K('#url3').val(),
			clickFn : function(url, title, width, height, border, align) {
				K('#url3').val(url);
				var div = K('#J_imageView');
				div.html(''); 
				//console.log(urlList);
				div.append('<img src="' +url + '" height="100px" width="100px">');
	
				editor.hideDialog();
			}
		});
	});
});
//医院logo上传
K('#image4').click(function() {
	editor.loadPlugin('image', function() {
		editor.plugin.imageDialog({
			showRemote : false,
			imageUrl : K('#url4').val(),
			clickFn : function(url, title, width, height, border, align) {
				K('#url4').val(url);
				var div = K('#J_logo');
				div.html(''); 
				//console.log(urlList);
				div.append('<img src="' +url + '" height="100px" width="100px">');
	
				editor.hideDialog();
			}
		});
	});
});
//医院缩略图上传
K('#image5').click(function() {
	editor.loadPlugin('image', function() {
		editor.plugin.imageDialog({
			showRemote : false,
			imageUrl : K('#url5').val(),
			clickFn : function(url, title, width, height, border, align) {
				K('#url5').val(url);
				var div = K('#J_thumb');
				div.html(''); 
				//console.log(urlList);
				div.append('<img src="' +url + '" height="100px" width="100px">');
	
				editor.hideDialog();
			}
		});
	});
});
});


//下拉框交换JQuery
$(function(){
    //移到右边
    $('#add').click(function() {
    //获取选中的选项，删除并追加给对方
		var	 checkTex1t=$("#select1").find("option:selected").text(); 
		var	 checkText2=$("#select2").find("option:selected").text(); 
		if(checkText2.indexOf(checkTex1t)==-1){
			  $('#select1 option:selected').appendTo('#select2');
		}else{
			return false;
		}
      
    });
    //移到左边
    $('#remove').click(function() {
    	var	 checkTex1t=$("#select1").find("option:selected").text(); 
		var	 checkText2=$("#select2").find("option:selected").text(); 
		if(checkText2.indexOf(checkTex1t)==-1){
			  $('#select1 option:selected').appendTo('#select2');
		}else{
			return false;
		}
        $('#select2 option:selected').appendTo('#select1');
    });
    //双击选项
    $('#select1').dblclick(function(){ //绑定双击事件
        //获取全部的选项,删除并追加给对方
        $("option:selected",this).appendTo('#select2'); //追加给对方
    });
    //双击选项
    $('#select2').dblclick(function(){
       $("option:selected",this).appendTo('#select1');
    });
});
</script>