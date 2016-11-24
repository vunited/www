<?php

/**
 * ECSHOP 微信回调页面
 * 
 * 可自由修改发布
 * $Author: church $
 * $Id: wxpay_notify.php 17217 2015-08-17 06:29:08Z liubo $
 */

define('IN_ECS', true);

require(dirname(__FILE__) . '/includes/init.php');
require(ROOT_PATH . 'includes/lib_payment.php');
require(ROOT_PATH . 'includes/lib_order.php');

//开启调试
define('WXDEBUG', true);

//接收微信xml参数, 并解析
$file_in = $HTTP_RAW_POST_DATA; //接收post数据
$product_id = '';
$xml = new DOMDocument();
$xml->loadXML($file_in);
$productIds = $xml->getElementsByTagName('product_id');
foreach ($productIds as $productId) {
	$product_id = $productId->nodeValue;
}

file_put_contents(ROOT_PATH.'log.txt', $HTTP_RAW_POST_DATA);

//获取微信支付APPID等信息
$sql = "SELECT pay_fee, pay_config FROM ". $ecs->table('payment'). " WHERE pay_code=wxpay";		//这里的pay_code不一定为wxpay, 根据实际情况更改
$wxpayInfo = $db->getRow($sql);
$payConfig = unserialize($wxpayInfo['pay_config']);
foreach($payConfig as $value) {
	${$value['name']} = $value['value'];
}


//根据微信返回的productId获取商品信息
$sql = "SELECT * FROM ". $ecs->table('order_info'). "WHERE order_sn='$product_id'";
$orderInfo = $db->getRow($sql);

//获取本地IP
if ($_SERVER['REMOTE_ADDR']) {
	$cip = $_SERVER['REMOTE_ADDR'];
} elseif (getenv("REMOTE_ADDR")) {
	$cip = getenv("REMOTE_ADDR");
} elseif (getenv("HTTP_CLIENT_IP")) {
	$cip = getenv("HTTP_CLIENT_IP");
}


//初始化数据
$params = array(
	'appid' 			=> 	$appid,										
	'mch_id'			=> 	$mch_id,
	'device_info' 		=> 	'WEB',
	'nonce_str' 		=> 	strtolower(md5(mt_rand())),
	'body'				=> 	'ceshi',									//这里填你的商户信息， 比如说百度
	'out_trade_no'		=> 	$orderInfo['order_sn'],
	'fee_type'			=>	'CNY',
	'total_fee'			=>	intval($orderInfo['order_amount'] * 100),
	'spbill_create_ip'	=>	$cip,
	'notify_url'		=>	'http://www.zhuangdeng.net/respond.php',				//记得改这里
	'trade_type'		=>	'NATIVE',
	'product_id'		=>	$product_id,
);	

ksort($params);

//对数据进行签名
$signString = '';
$signArrTemp = array_merge($params, array('key'=>$app_secret));
$paramString = '';
foreach ($signArrTemp as $key=>$value) {
	$paramString .= "$key=$value".'&';
}
$paramString = rtrim($paramString, '&');
$sign = strtoupper(md5($paramString));

//组装xmlData
$params = array_merge($params, array('sign'=>$sign));
$xmlData = '<xml>';
foreach ($params as $key=>$value) {
	$xmlData .= "<$key>".$value."<$key>";
}
$xmlData .= '</xml>';



//提交数据到微信
$ch = curl_init();
$header =  array("Content-type: text/xml");
$apiUrl = 'https://api.mch.weixin.qq.com/pay/unifiedorder';
curl_setopt_array($ch, array(
	 CURLOPT_URL 				=> 	$apiUrl,
	 CURLOPT_HTTPHEADER			=> 	$header,
	 CURLOPT_POST				=>	true,
	 CURLOPT_SSL_VERIFYPEER		=>	false,
	 CURLOPT_POSTFIELDS			=>	$xmlData
));

$returnString = curl_exec($ch);

if (!curl_error($ch)) {
	file_put_contents(ROOT_PATH.'log.txt', var_export($returnString, true));
	die;
}

exit;