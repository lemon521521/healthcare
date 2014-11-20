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
			<!--<p class="stat">span class="number"></span</p>-->
			</div>

            <h1 class="page-title">产品列表</h1>
        </div>
        
		<ul class="breadcrumb">
			<li class="active">产品列表</li>
        </ul>
<div class="container-fluid">
	<div class="row-fluid">
		<div class="bb-alert alert alert-info" style="display: none;">
			<span>操作成功</span>
		</div>

<!--- START 以上内容不需更改，保证该TPL页内的标签匹配即可 --->

<div class="btn-toolbar" style="margin-bottom:2px;">
    <a href="__URL__/add" class="btn btn-primary"><i class="icon-plus"></i> 添加产品</a>
</div>
    <div class="block">
        <a href="#page-stats" class="block-heading" data-toggle="collapse">产品列表</a>
        <div id="page-stats" class="block-body collapse in">
               <table class="table table-striped">
              <thead>
                <tr>
					<th style="width:100px">产品名</th>
					<th style="width:80px">医院名称</th>					
					<th style="width:100px">电话</th>
					<th style="width:100px">VIP电话</th>
					<th style="width:80px">行程天数</th>
					<th style="width:80px">医卖价</th>
					<th style="width:80px">创建时间</th>
					<th style="width:80px">更新时间</th>
					<th style="width:180px">操作</th>
                </tr>
              </thead>
              <tbody>	
              <?php if(is_array($result_list)): $i = 0; $__LIST__ = $result_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$result_list): $mod = ($i % 2 );++$i;?><tr>
              	<td><?php echo ($result_list["title"]); ?></td>
              	<td><?php echo ($result_list["hospital_name"]); ?></td>             
              	<td><?php echo ($result_list["tel"]); ?></td>
              	<td><?php echo ($result_list["vip_tel"]); ?></td>
              	<td><?php echo ($result_list["stroke_number"]); ?></td>
              	<td><?php echo ($result_list["price"]); ?></td>
              	<td><?php echo (date('Y-m-d H:i:s',$result_list["createtime"])); ?></td>
              	<td><?php echo (date('Y-m-d H:i:s',$result_list["updatetime"])); ?></td>              	
              <td>
				<a class="btn" href="__URL__/edit/id/<?php echo ($result_list["id"]); ?>" title= "修改" >修改</a>&nbsp;&nbsp;
				<a class="btn" href="__URL__/del/id/<?php echo ($result_list["id"]); ?>" title= "删除" >删除</a>
				<br>
				<a href="__APP__/Article/pic_edit/id/<?php echo ($result_list["id"]); ?>" title= "编辑图片" class="btn btn-danger" >编辑图片</a>
				
				<a href="__APP__/Travel/index/id/<?php echo ($result_list["id"]); ?>" title= "行程管理" class="btn btn-danger" >行程管理</a>
			</td>	
			</tr><?php endforeach; endif; else: echo "" ;endif; ?>	
             			  
              </tbody>
            </table> 
            <div class="pagination"><ul><?php echo ($page); ?></ul></div>
        </div>
    </div>
    <div style="display:none">
 <div id="sid" style="height:500px;width:300px;">
 <form method="post" action="__URL__/pic_eidt" >
 <table id="pic_edit">
 
</table>
<input type="hidden" id="pro_id"name="product_id" value="">
<input type="submit" value="提交" id="sub" >
</form>
<div style="margin-left:audo;vertical-align:middle;">

</div>
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
					$(".btn-editpic").click(function(){
						var id=$(this).attr("pic");
						$.ajax({
							url:'__APP__/Article/ajax_pic_eidit?id='+id,
							type:'post',		
							dataType:'json',							
							success:function(data){
								if(data){
									//$.colorbox.close();
									$("#pic_edit").html();
									$("#pic_edit").html(data.html);
									$("#pro_id").val(data.product_id);
									$.colorbox({inline:true,width:'80%',height:'80%',href:"#sid", close: true, escKey:false});
																	
								}else{
									alert("未找到图片信息，请先上传图片！");
								}
							}
						})
						
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