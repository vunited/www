<?php

define('IN_ECS', true);
require(dirname(__FILE__) . '/includes/init.php');

include_once(ROOT_PATH . 'includes/cls_json.php');
$json = new JSON;

$mobile = $_POST['mobile'] ? $_POST['mobile'] : '';
$mobile_code = $_POST['mobile_code'] ? $_POST['mobile_code'] : '';

if($_GET['act']=='check'){
	if($mobile!=$_SESSION['mobile'] or $mobile_code!=$_SESSION['mobile_code']){
		$result['msg'] = '手机验证码输入错误。';
		die($json->encode($result));
	}else{
		$result['code'] = 2;
		die($json->encode($result));
	}
}

if($_GET['act']=='send'){

	if(empty($mobile)){
		$result['msg'] = '手机号码不能为空';
		die($json->encode($result));
	}
	
	$preg='/^1[0-9]{10}$/';//简单的方法
	if(!preg_match($preg,$mobile)) {
		$result['msg'] = '手机号码格式不正确';
		die($json->encode($result));
	}	

	
	$sql_get_mobile = "select user_id from ecs_users where user_name = '".$mobile."'";
	if($GLOBALS['db']->getOne($sql_get_mobile)){
		$result['msg'] = '该手机号已被使用，请更换！';
		die($json->encode($result));
	}
	
	/*q请求地址*/
	$target = "http://106.ihuyi.cn/webservice/sms.php?method=Submit";
	
	$mobile_code = random(4,1);
	/* if(empty($_SESSION['mobile_code']) or $mobile_code!=$_SESSION['mobile_code']){
		//防用户恶意请求
		$result['msg'] = '请求超时，请刷新页面后重试';
		die($json->encode($result));
	} */

	$post_data = "account=cf_zhuangdengwang&password=".md5('zhuangdengwang')."&mobile=".$mobile."&content=".rawurlencode("您的验证码是：".$mobile_code."。请不要把验证码泄露给其他人。");
	//密码可以使用明文密码或使用32位MD5加密
	$gets =  xml_to_array(Post($post_data, $target));
	
	if($gets['SubmitResult']['code']==2){
		$_SESSION['mobile'] = $mobile;
		$_SESSION['mobile_code'] = $mobile_code;
		
		$result['code'] = 2;
		die($json->encode($result));
	}else{
		$result['msg'] = '手机短信发送失败。';
		//$result['msg'] = $gets['SubmitResult']['msg'];
		die($json->encode($result));
	}
	//end
}elseif($_GET['act']=='send_get'){
	if(empty($mobile)){
		$result['msg'] = '手机号码不能为空';
		die($json->encode($result));
	}
	
	$preg='/^1[0-9]{10}$/';//简单的方法
	if(!preg_match($preg,$mobile)) {
		$result['msg'] = '手机号码格式不正确';
		die($json->encode($result));
	}
	
	/*q请求地址*/
	$target = "http://106.ihuyi.cn/webservice/sms.php?method=Submit";
	
	$mobile_code = random(4,1);
	/* if(empty($_SESSION['mobile_code']) or $mobile_code!=$_SESSION['mobile_code']){
		//防用户恶意请求
		$result['msg'] = '请求超时，请刷新页面后重试';
		die($json->encode($result));
	} */

	$post_data = "account=cf_zhuangdengwang&password=".md5('zhuangdengwang')."&mobile=".$mobile."&content=".rawurlencode("您的验证码是：".$mobile_code."。请不要把验证码泄露给其他人。");
	//密码可以使用明文密码或使用32位MD5加密
	$gets =  xml_to_array(Post($post_data, $target));
	
	if($gets['SubmitResult']['code']==2){
		$_SESSION['mobile'] = $mobile;
		$_SESSION['mobile_code'] = $mobile_code;
		
		$result['code'] = 2;
		die($json->encode($result));
	}else{
		$result['msg'] = '手机短信发送失败。';
		//$result['msg'] = $gets['SubmitResult']['msg'];
		die($json->encode($result));
	}
}


function Post($curlPost,$url){
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_HEADER, false);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_NOBODY, true);
		curl_setopt($curl, CURLOPT_POST, true);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $curlPost);
		$return_str = curl_exec($curl);
		curl_close($curl);
		return $return_str;
}
function xml_to_array($xml){
	$reg = "/<(\w+)[^>]*>([\\x00-\\xFF]*)<\\/\\1>/";
	if(preg_match_all($reg, $xml, $matches)){
		$count = count($matches[0]);
		for($i = 0; $i < $count; $i++){
		$subxml= $matches[2][$i];
		$key = $matches[1][$i];
			if(preg_match( $reg, $subxml )){
				$arr[$key] = xml_to_array( $subxml );
			}else{
				$arr[$key] = $subxml;
			}
		}
	}
	return $arr;
}
function random($length = 6 , $numeric = 0) {
	PHP_VERSION < '4.2.0' && mt_srand((double)microtime() * 1000000);
	if($numeric) {
		$hash = sprintf('%0'.$length.'d', mt_rand(0, pow(10, $length) - 1));
	} else {
		$hash = '';
		$chars = 'ABCDEFGHJKLMNPQRSTUVWXYZ23456789abcdefghjkmnpqrstuvwxyz';
		$max = strlen($chars) - 1;
		for($i = 0; $i < $length; $i++) {
			$hash .= $chars[mt_rand(0, $max)];
		}
	}
	return $hash;
}


?>
