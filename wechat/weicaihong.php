<?php
/**
 * weicaihong.php UTF8
 * 路径 /wechat/weicaihong.php
 * User: weicaihong.com
 * Date: 14-10-14 17:14
 * Copyright: http://www.weicaihong.com
 */


$verify_token = isset($_GET['token'])  ? $_GET['token']: '';

require('wch_crpt.php');
//验证token
$can = verifyToken($verify_token);

if($can)
{

	//  初始化数据 调用数据配置
	define('IN_ECS', true);
	//    require(dirname(__FILE__) . '/../data/config.php');
	require(dirname(__FILE__) . '/../includes/init.php');
	require(dirname(__FILE__) . '/../data/config.php');

	//引入登录模块
	//require('wch_wxlogin.php');

	// 设置pdo 连接编码 避免sql注入
	if(EC_CHARSET == 'utf-8')
	{
		$ec_charset = 'UTF8';
	}
	else
	{
		$ec_charset = 'GBK';
	}

	$pdo_charset = array(PDO::MYSQL_ATTR_INIT_COMMAND => "set names " . $ec_charset);
	$pdo_db = new PDO("mysql:host=localhost;dbname=$db_name;", $db_user, $db_pass,$pdo_charset);

	// data 相对应的数据
	$post_data = isset($_POST)  ? $_POST : '';


	// 微商城路径
	$w_shop_url = 'http://'.$_SERVER['HTTP_HOST'].'/';

	if(empty($post_data))
	{
		exit('微彩虹数据接口');
	}
	// 根据act 确定调用哪个文件
	$act = $post_data['act'];

	// 商品相关
	if($act == 'goods')
	{
		require('wch_goods.php');
	}
	// 会员相关
	elseif($act == 'member')
	{
		require('wch_member.php');
	}
	// 红包相关
	elseif($act == 'userBonus')
	{
		require('wch_userBonus.php');
	}
	// 积分余额
	elseif($act == 'jfye')
	{
		require('wch_jfye.php');
	}
	// 签到
	elseif($act == 'qiandao')
	{
		require('wch_qiandao.php');
	}
    // 微信支付
    elseif($act == 'wxpay')
    {
        require('wch_wxpay.php');
    }
    // 微信收货地址
    elseif($act == 'consignee')
    {
        require('wch_consignee.php');
    }
    //未知动作
    else
    {
        require('wch_open.php');
    }

}else{
	echo "验证不通过!";
}


