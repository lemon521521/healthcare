<?php

/**
 * 防止XSS攻击
 * @param string $val
 * @return mixed
 */
function remove_xss($val) {
   $val = preg_replace('/([\x00-\x08,\x0b-\x0c,\x0e-\x19])/', '', $val);
   $search = 'abcdefghijklmnopqrstuvwxyz';
   $search .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
   $search .= '1234567890!@#$%^&*()';
   $search .= '~`";:?+/={}[]-_|\'\\';
   for ($i = 0; $i < strlen($search); $i++) {
      $val = preg_replace('/(&#[xX]0{0,8}'.dechex(ord($search[$i])).';?)/i', $search[$i], $val); // with a ;
      $val = preg_replace('/(&#0{0,8}'.ord($search[$i]).';?)/', $search[$i], $val); // with a ;
   }
 
   $ra1 = array('javascript', 'vbscript', 'expression', 'applet', 'meta', 'xml', 'blink', 'link', 'style', 'script', 'embed', 'object', 'iframe', 'frame', 'frameset', 'ilayer', 'layer', 'bgsound', 'title', 'base');
   $ra2 = array('onabort', 'onactivate', 'onafterprint', 'onafterupdate', 'onbeforeactivate', 'onbeforecopy', 'onbeforecut', 'onbeforedeactivate', 'onbeforeeditfocus', 'onbeforepaste', 'onbeforeprint', 'onbeforeunload', 'onbeforeupdate', 'onblur', 'onbounce', 'oncellchange', 'onchange', 'onclick', 'oncontextmenu', 'oncontrolselect', 'oncopy', 'oncut', 'ondataavailable', 'ondatasetchanged', 'ondatasetcomplete', 'ondblclick', 'ondeactivate', 'ondrag', 'ondragend', 'ondragenter', 'ondragleave', 'ondragover', 'ondragstart', 'ondrop', 'onerror', 'onerrorupdate', 'onfilterchange', 'onfinish', 'onfocus', 'onfocusin', 'onfocusout', 'onhelp', 'onkeydown', 'onkeypress', 'onkeyup', 'onlayoutcomplete', 'onload', 'onlosecapture', 'onmousedown', 'onmouseenter', 'onmouseleave', 'onmousemove', 'onmouseout', 'onmouseover', 'onmouseup', 'onmousewheel', 'onmove', 'onmoveend', 'onmovestart', 'onpaste', 'onpropertychange', 'onreadystatechange', 'onreset', 'onresize', 'onresizeend', 'onresizestart', 'onrowenter', 'onrowexit', 'onrowsdelete', 'onrowsinserted', 'onscroll', 'onselect', 'onselectionchange', 'onselectstart', 'onstart', 'onstop', 'onsubmit', 'onunload');
   $ra = array_merge($ra1, $ra2);
 
   $found = true; // keep replacing as long as the previous round replaced something
   while ($found == true) {
      $val_before = $val;
      for ($i = 0; $i < sizeof($ra); $i++) {
         $pattern = '/';
         for ($j = 0; $j < strlen($ra[$i]); $j++) {
            if ($j > 0) {
               $pattern .= '(';
               $pattern .= '(&#[xX]0{0,8}([9ab]);)';
               $pattern .= '|';
               $pattern .= '|(&#0{0,8}([9|10|13]);)';
               $pattern .= ')*';
            }
            $pattern .= $ra[$i][$j];
         }
         $pattern .= '/i';
         $replacement = substr($ra[$i], 0, 2).'<x>'.substr($ra[$i], 2); // add in <> to nerf the tag
         $val = preg_replace($pattern, $replacement, $val); // filter out the hex tags
         if ($val_before == $val) {
            $found = false;
         }
      }
   }
   return $val;
}

//写文件操作
function writeToFile($file, $content, $pattern='ab'){
	//$file_dir = dirname($file);
	if (!$fp = fopen($file, $pattern))
	{
		return false;
	}
	fwrite($fp, $content);
	fclose($fp);
	return true;
}

function curl_http_request($url, $param,$header=false, $http_method = 'POST'){
	$connect_timeout = 2000;
	$read_timeout = 3000;
	$timeout = $connect_timeout + $read_timeout;
	$user_agent = sprintf('lashou tuangou API 7.0 PHP%s client (curl)', phpversion());

	$ch = curl_init();
	$curl_opts = array( CURLOPT_USERAGENT => $user_agent,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_HEADER => false,
			CURLOPT_FOLLOWLOCATION => false,
			CURLOPT_SSL_VERIFYPEER => false,
			CURLOPT_HTTPHEADER => $header,
	);

	if (defined('CURLOPT_CONNECTTIMEOUT_MS')) {
		$curl_opts[CURLOPT_CONNECTTIMEOUT_MS] = $connect_timeout;
		$curl_opts[CURLOPT_TIMEOUT_MS] = $timeout;
	} else {
		$curl_opts[CURLOPT_CONNECTTIMEOUT] = ceil($connect_timeout / 1000);
		$curl_opts[CURLOPT_TIMEOUT] = ceil($timeout / 1000);
	}
	if ($http_method == 'POST') {
		$curl_opts[CURLOPT_URL] = $url;
		$curl_opts[CURLOPT_POSTFIELDS] = $param;
		$curl_opts[CURLOPT_POST] = 1;
	} else {
		$delimiter = strpos($url, '?') === false ? '?' : '&';
		$curl_opts[CURLOPT_URL] = $url . $delimiter . http_build_query($param, '', '&');
		$curl_opts[CURLOPT_POST] = false;
	}
	curl_setopt_array($ch, $curl_opts);
	$result = curl_exec($ch);
	if ($result === false) {
		$currenttime = date("Y-m-d H:i:s");
		$result = curl_error($ch);
		$log .= $currenttime." curl_error occur:$result\n"; // todo log it
		writeToFile("/tmp/curl.log",$log);
	}
	curl_close($ch);
	return $result;
}

 /**
  * 此方法用于替换一个字符串中指定的值
  +------------------------------------------------------
  * @param $replace 数组  key 为查找字符串$str中将被替换的字符串 ,value 替换的值
  * @param $str 基准字符串
  * @param $left
  * @param $right
  *
  */
 function replace($replace,$str,$left="{",$right="}"){
 	$key = is_array($keys = array_keys($replace))?$keys[0]:"";
 	$search = $key?$left.$key.$right:$key;
 	return ($search && $replace[$key])?str_replace($search, $replace[$key], $str):false;
 }

 function _addslashes($value){
 	$value = is_array($value) ? array_map('_addslashes', $value) : addslashes($value);
 	return $value;
 }

 function randomNum($c=8){
 	$m=min(mt_getrandmax(),pow(10,$c));
 	return str_pad(mt_rand(0,$m-1),$c,'0',STR_PAD_LEFT);
 }

function randomStr($c=4){
	$rchar ='';
	$str = "abcdefghijklmnopqrstuvwxyz";
	for($i=0;$i<$c;$i++){
		$r = rand(0,25);
		$rchar.=substr($str,$r,1);
	}
	return $rchar;
}

function hide_mobile($mobile){
	return preg_replace ( "/^(\d{3})(\d{4})(\d{4})/" , "\\1****\\3" ,$mobile);
}

/**
 *
 * @param  $mobile
 *
 * 手机号验证
 */
function check_mobile($mobile,$pattern = false){

	if(!$pattern){
		$pattern = '/(^1[3458]\d{9}$)/';
	}

	$result = preg_match($pattern, $mobile,$match);

	if(empty($match)){
		return false;
	}

	return true;
}

/*
* 数组转HTTP请求字符串(不进行编码)
*/
function array_build_query(&$param) {
	if (!is_array($param)) return $param;
	$tmp = array();
	foreach($param as $k => $v) {
		$tmp[] = $k."=".$v;
	}
	$str = implode("&", $tmp);
	unset($tmp);
	return $str;
}
/*http 请求字符串转成数组*/
function http_query_str_to_array($query_str){
    $query_str = urlencode($query_str);
    $and = urlencode('&');
    $eq = urlencode('=');

    $result = array();
    try{
        foreach(explode($and,$query_str) as $item){
            $sq = explode($eq,$item);
            $sq[0] = urldecode($sq[0]);
            $sq[1] = urldecode($sq[1]);
            $result[$sq[0]] =$sq[1];
        }
    }catch(Exception $e){
        $result = array();
    }
    return $result;
}


/*
* 转换特殊字符（特殊字符处理）
*/
function specialchars_reverse($str) {
	$return_str = '';
	$specArr = array(
		"\r" => "\n",
		"<br/>" => "\n",
		"<p>" => "\n",
		"<br>" => "\n",
		"+" => "＆",
		"＆amp;" => "＆",
		" " => '',
	);
	$str = str_replace(array_keys($specArr), array_values($specArr), $str);
	$str = strip_tags($str);
	$str = htmlspecialchars($str, ENT_COMPAT);
	$str = preg_replace("#\n\s*\n#", "\n", $str); // 把多个换行替换为一个换行
	$specArr = array(
		"~" => "～",
		"`" => "｀",
		"!" => "！",
		"$" => "＄",
		"<" => "＜",
		">" => "＞",
		"\t" => "",
		"\'" => "'",
		'\"' => '"',
		"'" => "＇",
		'"' => "＂",
		"&" => "＆",
		"%" => "％",
		"/" => "／",
		"\\\\" => "\\",
		"\\" => "＼",
	);
	$str = str_replace(array_keys($specArr), array_values($specArr), $str);
	for($i = 0; $i < strlen($str); $i++) {
		$char = $str{$i};
		if (ord($char) != 10) {
			$return_str .= (32 <= ord($char)) ? $char : "";
		}
	}
	unset($specArr, $str);
	return $return_str;
}

/*
* 验证IP地址有效性
*/
function filter_valid_ip($ip) {
	if (filter_var($ip, FILTER_VALIDATE_IP,
			FILTER_FLAG_IPV4 |
			FILTER_FLAG_IPV6 |
			FILTER_FLAG_NO_PRIV_RANGE |
			FILTER_FLAG_NO_RES_RANGE) === false)
		return false;
	return true;
}

/*
* 获取客户端IP地址
*/
function get_client_ipaddr() {
	if (! empty ( $_SERVER ['HTTP_CLIENT_IP'] ) && filter_valid_ip($_SERVER ['HTTP_CLIENT_IP']))
		return $_SERVER ['HTTP_CLIENT_IP'];
	if (! empty ( $_SERVER ['HTTP_X_FORWARDED_FOR'] )) {
		$iplist = explode ( ',', $_SERVER ['HTTP_X_FORWARDED_FOR'] );
		foreach ( $iplist as $ip ) {
			if (filter_valid_ip($ip))
				return $ip;
		}
	}
	if (! empty ( $_SERVER ['HTTP_X_FORWARDED'] ) && filter_valid_ip($_SERVER ['HTTP_X_FORWARDED']))
		return $_SERVER ['HTTP_X_FORWARDED'];
	if (! empty ( $_SERVER ['HTTP_X_CLUSTER_CLIENT_IP'] ) && filter_valid_ip($_SERVER ['HTTP_X_CLUSTER_CLIENT_IP']))
		return $_SERVER ['HTTP_X_CLUSTER_CLIENT_IP'];
	if (! empty ( $_SERVER ['HTTP_FORWARDED_FOR'] ) && filter_valid_ip($_SERVER ['HTTP_FORWARDED_FOR']))
		return $_SERVER ['HTTP_FORWARDED_FOR'];
	if (! empty ( $_SERVER ['HTTP_FORWARDED'] ) && filter_valid_ip($_SERVER ['HTTP_FORWARDED']))
		return $_SERVER ['HTTP_FORWARDED'];
	return $_SERVER ['REMOTE_ADDR'];
}

function check_pwd($pwd){
	$pwdLength = strlen($pwd);
	if($pwdLength < 6)
		return 12;
	//密码强度
	$score = 0;
	//匹配数字
	if(preg_match("/[0-9]+/",$pwd)){
		$score ++;
	}
	//匹配小写
	if(preg_match("/[a-z]+/",$pwd)){
		$score ++;
	}
	//匹配大写
	if(preg_match("/[A-Z]+/",$pwd)){
		$score ++;
	}
	//匹配特殊符号
	if(preg_match("/[_|\-|+|=|*|!|@|#|$|%|^|&|(|)|'|\"|`]+/",$pwd)){
		$score ++;
	}
	if($score < 2)
		return 13;
	return 0;
}

//中文字符检测
function str_has_chinese($str){
    if(is_string($str)){
        if(mb_strlen($str,'utf8') == strlen($str)){
            return false;
        }
        else {
            return true;
        }
    }
    return false;
}

/**
 * 处理用户名称信息
 * @param string $str
 * @return string
 * @author liubin 2013-10-17
 */
function bodyShowAsterisk($str){
	$len = strlen($str);
	if( $len < 3)
		return $str;
	$strStart = mb_substr($str, 0,1,"utf8");
	$strEnd   = mb_substr($str, -1,1,"utf8");
	$sterisk = '';

	for($i = 0;$i < 3;$i++){
		$sterisk.="*";
	}
	return $strStart.$sterisk.$strEnd;
}


/**
 * 根据返回数据中某个字段进行升序或降序排列
 * @param  $data
 * @param  $orderBy 返回数据中某字段
 * @param  $sortTag(传入0是降序 1是升序)
 * @return array
 * @author liubin 2013-11-22
 */
function sortResult($data,$orderBy,$sortTag){
	$sortTag=(int)$sortTag;
	if(!is_array($data)){
		return $data;
	}
	if(sizeof($data)<=1){
		return $data;
	}
	if(empty($orderBy)){
		return $data;
	}
	//$sortTag:SORT_ASC ,SORT_DESC
	if($sortTag<=0){
		$sortTag=SORT_DESC;
	}else{
		$sortTag=SORT_ASC;
	}
	// 取得列的列表
	foreach ($data as $key => $row) {
		$sortcol[$key]  = $row[$orderBy];
	}
	//把 $data 作为最后一个参数，以通用键排序
	array_multisort($sortcol, $sortTag, $data);
	return $data;
}

function addslashes_deep($value){
	if(get_magic_quotes_gpc()){
		return $value;
	}
	$value = is_array($value) ? array_map('addslashes_deep', $value) : addslashes($value);
	return $value;
}

/**
 * 过滤掉一些特殊字符
 */

function filter_special_chars($str){

    $special_chars = array('&','~','`','＆','％','$',"@");
    $str = str_replace($special_chars, '', $str);
    return $str;
}

function urlsafe_b64encode($string) {
	$data = base64_encode($string);
	$data = str_replace(array('+','/','='),array('-','_','.'),$data);
	return $data;
}

function urlsafe_b64decode($string) {
	$data = str_replace(array('-','_','.'),array('+','/','='),$string);
	$mod4 = strlen($data) % 4;
	if ($mod4) {
		$data .= substr('====', $mod4);
	}
	$d = base64_decode($data);
	return $d;
}

function saveImage($data_id,$fkey = 'jpg',$suffix){
	if (empty($data_id)){
		return false;
	}
	$upload = getUploadObj();
	//保存名称格式'当前时间_参数id_function名称'
	$curr = time();
	$upload->saveRule = $suffix.'_'.$data_id."_".$curr;
	return $upload->uploadOne($_FILES[$fkey]);
}
    
function getUploadObj ($maxsize = 500000){
	import('@.ORG.Net.UploadFile');	
    $upload = new UploadFile();
    $upload->maxsize = $maxsize;
    $upload->allowExts = array('jpg', 'gif', 'png', 'jpeg');
    //$upload->savePath = 'D:/freehost/yushujian/web/Public/cakeimg/';
    $upload->savePath = '/data/img/';
    return $upload;
}

function generateTree($items){
	$tree = array();
	foreach($items as $k=>$item){
		$tree[$item['id']]=$item;
	}
	foreach($tree as $item){
		$tree[$item['pid']]['son'][$item['id']] = &$tree[$item['id']];
	}
		
	return isset($tree[0]['son']) ? $tree[0]['son'] : array();
}

function getTree($list){
	foreach($list as $key=>$value){
		$list[$key]['count']=count(explode(',',$value['bpath']));
	}
	return $list;
}

function getIndexAds($types=0){
	$type = C("BANNER_STATUS");
	return isset($type[$types])?$type[$types]:'无分类';
}
function getOrderStatus($status=0){
	$order_status = C("ORDER_STATUS");
	return isset($order_status[$status])?$order_status[$status]:'';
}

?>