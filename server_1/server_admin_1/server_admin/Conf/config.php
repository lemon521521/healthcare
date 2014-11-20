<?php

$config = array(
	//'配置项'=>'配置值'
    'DB_TYPE'=> 'mysql',          // 数据库类型
	'DB_PREFIX' => '',            // 表前缀

    'DB_HOST'=> 'localhost',		// 数据库服务器地址
    'DB_NAME'=>'medical',					// 数据库名称
    'DB_USER'=>'root',					// 数据库用户名
    'DB_PWD'=>'',			// 数据库密码
    'DB_PORT'=>'3306',
	//模板引擎配置
//	'TMPL_ENGINE_TYPE' =>'smarty',
//    'TMPL_ENGINE_CONFIG' => array(
//		'caching' => TRUE,
//		'template_dir' => TMPL_PATH,
//		'compile_dir' => TEMP_PATH,
//		'cache_dir' => CACHE_PATH,
//		'left_delimiter' => '<{',
//		'right_delimiter' => '}>',
//	),
	//end	
	//session配置
	'SESSION_AUTO_START'=> true,  //关闭系统 "自动开启session" 选项
    'USER_AUTH_KEY'             =>  'authId',	// 用户认证SESSION标记
    'TMPL_ACTION_ERROR'         =>  'Public:showmsg', // 默认错误跳转对应的模板文件
    'TMPL_ACTION_SUCCESS'       =>  'Public:showmsg', // 默认成功跳转对应的模板文件	
//		'SESSION_NAME' => 'ThinkID',   //兼容session版本
//		'SESSION_EXPIRE' =>	300000,
//		'VAR_SESSION_ID' => '', //sessionID的提交变量,不通过get,post提交
//		'SESSION_OPTIONS' => array(
//				'secret_key' => 'F$)#2!',
//				'auto_start' => false,
//				'get_method_state' => 1, // auto_start开时使用, 只允许从header中获取session 见: BaseAction::$session 说明
//				'type' => 'Lsdb',  //session 采用数据库保存,自定义类
//				'use_cookies' => false,
//				'use_trans_sid' => false,
//		),
//		'SESSION_TABLE' => 'session_app',
// end
    'TMPL_ACTION_ERROR'         =>  'Public:showmsg', // 默认错误跳转对应的模板文件
    'TMPL_ACTION_SUCCESS'       =>  'Public:showmsg', // 默认成功跳转对应的模板文件
    //'TMPL_EXCEPTION_FILE'		=>	APP_PATH.'Tpl/manager/Public/errormsg.html', // 定义公共错误模板
    'ERROR_PAGE'=>'/Public/error.html', // 定义错误跳转页面URL地址
);
$path = dirname(__FILE__);
$host = strtolower($_SERVER['SERVER_NAME']);
$host_config = array(
		'localhost'=>'config.local.php',
		'www.server1admin.com'=>'config.local.php'
);
$config_base = require_once $path.'/config.base.php';
if ($config_base) $config = array_merge($config,$config_base);
if (isset($host_config[$host])) {
	$config_other = require_once $path.'/'.$host_config[$host];
	if ($config_other) $config = array_merge($config,$config_other);
}


return $config;
?>