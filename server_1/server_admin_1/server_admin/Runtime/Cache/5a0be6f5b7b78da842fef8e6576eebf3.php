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
	<a href="#sidebar_menu_1" class="nav-header collapsed" data-toggle="collapse"><i class="icon-th"></i>管理员管理 <i class="icon-chevron-up"></i></a>
	<ul id="sidebar_menu_1" class="nav nav-list collapse in">
		<li><a href="__APP__/Account/index">账号列表</a></li>
	</ul>
	<a href="#sidebar_menu_2" class="nav-header collapsed" data-toggle="collapse"><i class="icon-th"></i>会员管理 <i class="icon-chevron-up"></i></a>
	<ul id="sidebar_menu_2" class="nav nav-list collapse in">
		<li><a href="__APP__/Member/index">会员列表</a></li>
	</ul>
	
</div>
	 <!--- 以上为左侧菜单栏 sidebar --->

 <div id="content" class="content">
        
        <div class="header">
            <div class="stats">
			<!--<p class="stat">span class="number"></span</p>-->
			</div>

            <h1 class="page-title">会员列表</h1>
        </div>
        
		<ul class="breadcrumb">
			<li class="active">会员列表</li>
        </ul>
<div class="container-fluid">
	<div class="row-fluid">
		<div class="bb-alert alert alert-info" style="display: none;">
			<span>操作成功</span>
		</div>

<!--- START 以上内容不需更改，保证该TPL页内的标签匹配即可 --->
<div style="border:0px;padding-bottom:5px;height:auto">
	<form action="__APP__/Member/index" method="POST" style="margin-bottom:0px">
 <div style="float:left;margin-right:5px">
		<label>会员名称，查询所有会员请留空</label>
		<input type="text" name="name" value="" placeholder="输入会员名称" > 
	</div>
		<div class="btn-toolbar" style="padding-top:25px;padding-bottom:0px;margin-bottom:0px">
		<button type="submit" class="btn btn-primary"><strong>确定</strong></button>
	</div>
	<div style="clear:both;"></div>
	</form>
</div>
<!-- search END -->
    <div class="block">
        <a href="#page-stats" class="block-heading" data-toggle="collapse">会员列表</a>
        <div id="page-stats" class="block-body collapse in">
               <table class="table table-striped">
              <thead>
                <tr>
					<th style="width:80px">会员ID</th>
					<th style="width:80px">昵称</th>
					<th style="width:120px">邮箱</th>
					<th style="width:50px">手机</th>
					<th style="width:50px">真实姓名</th>
					<th style="width:50px">性别</th>
					<th style="width:100px">生日</th>
					<th style="width:150px">注册时间</th>
					<!--<th style="width:80px">操作</th>-->
                </tr>
              </thead>
              <tbody>	
              <?php if(is_array($result_list)): $i = 0; $__LIST__ = $result_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$result_list): $mod = ($i % 2 );++$i;?><tr>
              	<td><?php echo ($result_list["id"]); ?></td>
              	<td><?php echo ($result_list["name"]); ?></td>
              	<td><?php echo ($result_list["email"]); ?></td>
              	<td><?php echo ($result_list["mobile"]); ?></td>
              	<td><?php echo ($result_list["relname"]); ?></td>
              	<td><?php if($result_list["sexy"] == 0): ?>女<?php else: ?>男<?php endif; ?></td>
              	<td><?php echo ($result_list["birthday"]); ?></td>
              	<td><?php echo ($result_list["createtime"]); ?></td>
              <!--<td>
     			<a href="__APP__/Order/detail/trade_no/<?php echo ($result_list["trade_no"]); ?>" >查看详情</a>
			</td>-->	
			</tr><?php endforeach; endif; else: echo "" ;endif; ?>				  
              </tbody>
            </table> 
            <div class="pagination"><ul><?php echo ($page); ?></ul></div>
        </div>
    </div>

<!---操作的确认层，相当于javascript:confirm函数--->
<script>
				$('.icon-pause').click(function(){
						
						var href=$(this).attr('href');
						bootbox.confirm('确定要这样做吗？', function(result) {
							if(result){

								location.replace(href);
							}
						});		
					})
					
				
				$('.icon-play').click(function(){
						
						var href=$(this).attr('href');
						bootbox.confirm('确定要这样做吗？', function(result) {
							if(result){

								location.replace(href);
							}
						});		
					})
					
				
				$('.icon-remove').click(function(){
						
						var href=$(this).attr('href');
						bootbox.confirm('确定要这样做吗？', function(result) {
							if(result){

								location.replace(href);
							}
						});		
					})
					
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