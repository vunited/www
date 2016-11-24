<?php

/**
 * ECSHOP 微信扫码支付插件
 * 可以自由发布
 *
 * $Author: church $
 * $Id: wxpay.php 17217 2015-08-17 06:29:08Z church $
 */
error_reporting(E_ALL & ~E_NOTICE); 
if (!defined('IN_ECS'))
{
    die('Hacking attempt');
}

$payment_lang = ROOT_PATH . 'languages/' .$GLOBALS['_CFG']['lang']. '/payment/wxpay.php';


if (file_exists($payment_lang))
{
    global $_LANG;

    include_once($payment_lang);
}

/* 模块的基本信息 */
if (isset($set_modules) && $set_modules == TRUE)
{
    $i = isset($modules) ? count($modules) : 0;

    /* 代码 */
    $modules[$i]['code']    = basename(__FILE__, '.php');

    /* 描述对应的语言项 */
    $modules[$i]['desc']    = 'wxpay_desc';

    /* 是否支持货到付款 */
    $modules[$i]['is_cod']  = '0';

    /* 是否支持在线支付 */
    $modules[$i]['is_online']  = '1';

    /* 作者 */
    $modules[$i]['author']  = 'zhiyuan';

    /* 网址 */
    $modules[$i]['website'] = 'http://weixin.qq.com';

    /* 版本号 */
    $modules[$i]['version'] = '1.0.0';

    /* 配置信息 */
    $modules[$i]['config']  = array(
        array('name' => 'app_id',           'type' => 'text',   'value' => ''),
		array('name' => 'app_secret',       'type' => 'text',   'value' => ''),
        array('name' => 'mch_id',           'type' => 'text',   'value' => ''),		
		array('name' => 'wxpay_key',        'type' => 'text',   'value' => ''),
		array('name' => 'wxpay_signtype',   'type' => 'text',   'value' => ''),
    );

    return;
}
function isMobiles() {
$user_agent = $_SERVER['HTTP_USER_AGENT'];
if (strpos($user_agent, 'MicroMessenger') === false) {
   return false;
} else {
   return true;  
}
}
/**
 * 类
 */
$info=isMobiles();


if($info)
{


/**
 * 类
 */
class WxPayConf_pub
{
	public $wxpay_app_id;
	public $wxpay_app_secret;
	public $wxpay_mchid;
	public $wxpay_key;
	public $notifyurl='http://www.zhuangdeng.net/mobile/respond.php';	
	public $successurl='http://www.zhuangdeng.net/mobile/user.php?act=order_info&id=';
	public $curltimeout=30;
	
	function __construct() {
		$payment    = get_payment('wxpay');
		//var_dump($payment);
		if(isset($payment)){
			$this->wxpay_app_id		=       $payment['app_id'];
			$this->wxpay_app_secret	=       $payment['app_secret'];
			$this->wxpay_mchid	    =       $payment['mch_id'];
			$this->wxpay_key	    =       $payment['wxpay_key'];
			$this->notifyurl	    =       'http://www.zhuangdeng.net/mobile/respond.php';
			$this->successurl   	=       'http://www.zhuangdeng.net/mobile/user.php?act=order_info&id=';
		}
		//var_dump($this->wxpay_app_id);
	}
	
}
include_once("wxpay/WxPayPubHelper.php");
include_once("wxpay/log_.php");	
class wxpay
{
    /**
     * 生成支付代码
     * @param   array   $order      订单信息
     * @param   array   $payment    支付方式信息
     */
    function get_code($order, $payment)
    {
    @$openid=$_COOKIE['sopenid'];
	//$openid='oKIVft4Hk9gNczpAyszvsIYeGklU';//测试	
	$unifiedOrder = new UnifiedOrder_pub();	
	$conf = new WxPayConf_pub();	
	//print_r($conf);
	//exit;
	
	$returnrul = $conf->successurl.$order["order_id"];
	$unifiedOrder->setParameter("openid","$openid");
	$unifiedOrder->setParameter("body",'您在装灯网选择的商品');//商品描述
	//$unifiedOrder->setParameter("out_trade_no",$order['order_sn']);//商户订单号 
	$unifiedOrder->setParameter("out_trade_no",$order['order_sn'].'_'.$order['log_id']);//商户订单号 
	$unifiedOrder->setParameter("total_fee",intval($order['order_amount'] * 100));//总金额
	$unifiedOrder->setParameter("notify_url",$conf->notifyurl);//通知地址 
	$unifiedOrder->setParameter("trade_type","JSAPI");//交易类型

	$prepay_id = $unifiedOrder->getPrepayId();
	
	//print_r($unifiedOrder);
	
	
	$jsApi = new JsApi_pub();
	$jsApi->setPrepayId($prepay_id);
	$jsApiParameters = $jsApi->getParameters();
	
	$pay_online=$jsApi->getbutton($jsApiParameters,$returnrul);
        return $pay_online;
    }
	 
}





}else{

require_once("wxpay/WxPay.Api.php");
require_once("wxpay/log.php");

/**
 * 类
 */
class wxpay
{

    /**
     * 构造函数
     *
     * @access  public
     * @param
     *
     * @return void
     */
	 function __construct()
    {
        $this->wxpay();
    }
    function wxpay()
    {
    }

    

    /**
     * 生成支付二维码
     * @param   array   $order      订单信息
     * @param   array   $payment    支付方式信息
     */
    function get_code($order, $payment)
    {
        if (!defined('EC_CHARSET'))
        {
            $charset = 'utf-8';
        }
        else
        {
            $charset = EC_CHARSET;
        }
		
$input = new WxPayUnifiedOrder();
$input->SetBody("您在装灯网选择的商品");
$input->SetAttach("test");
//$input->SetOut_trade_no($order['order_sn']);
$input->SetOut_trade_no($order['order_sn'].'_'.$order['log_id']);
$input->SetTotal_fee($order['order_amount']*100);
$input->SetTime_start(date("YmdHis",time()+8*60*60));
$input->SetTime_expire(date("YmdHis", time()+8*60*60 + 600));
$input->SetGoods_tag("test");
//$input->SetNotify_url("http://www.zhuangdeng.net/wxpay_notify.php");
$input->SetNotify_url("http://www.zhuangdeng.net/respond.php");
$input->SetTrade_type("NATIVE");
$input->SetProduct_id($order['order_sn']);
$result = WxPayApi::unifiedOrder($input);
$url2 = $result["code_url"];

        $url = base64_encode(urlencode($url2));
		
        $button = '<input type="button" onclick="window.open(\'user.php?act=build_qrcode&data='.$url.'&order_sn='.$order['order_sn'].'\')" value="' .$GLOBALS['_LANG']['pay_button']. '" />';

        return $button;
    }

    /**
     * 响应操作
     */
    function respond()
    {
        if (isset($_POST['result_code']) && $_POST['result_code'] == 'SUCCESS') {
			$pay_status = 2;
			
			
			$order_sn = explode('_', $_POST['order_sn']);
			$log_id=$order_sn[1];
			$order_sn = $order_sn[0];
			//order_paid($log_id, 2);	
			
			if($log_id){
			$sql = "SELECT * FROM " . $GLOBALS['ecs']->table('pay_log') . " WHERE log_id = '$log_id'";
			$pay_log = $GLOBALS['db']->getRow($sql);
			
					$sql = "SELECT user_id, amount FROM " . $GLOBALS['ecs']->table('user_account') .
                            " WHERE id = '$pay_log[order_id]' and is_paid = 0";
                    $arr = $GLOBALS['db']->getRow($sql);
                    log_account_change($arr['user_id'], $arr['amount'], 0, 0, 0, '充值', ACT_SAVING);
					
			$sql = 'UPDATE ' . $GLOBALS['ecs']->table('user_account') . " SET paid_time = '" .gmtime(). "', is_paid = 1" . " WHERE id = '$pay_log[order_id]' LIMIT 1";
            $GLOBALS['db']->query($sql);		
			}
			
			
			 /* 取得订单信息 */
			$sql = 'SELECT order_id, user_id, order_sn, consignee, address, tel, shipping_id, extension_code, extension_id, goods_amount ' .
					'FROM ' . $GLOBALS['ecs']->table('order_info') .
				   " WHERE order_sn = '{$order_sn}'";
			$order    = $GLOBALS['db']->getRow($sql);
			$order_id = $order['order_id'];
			$order_sn = $order['order_sn'];

			/* 修改订单状态为已付款 */
			$sql = 'UPDATE ' . $GLOBALS['ecs']->table('order_info') .
						" SET order_status = '" . OS_CONFIRMED . "', " .
							" confirm_time = '" . gmtime() . "', " .
							" pay_status = '$pay_status', " .
							" pay_time = '".gmtime()."', " .
							" money_paid = order_amount," .
							" order_amount = 0 ".
				   "WHERE order_id = '$order_id'";
			$GLOBALS['db']->query($sql);

			/* 修改订单状态为已付款 */
			$sql = 'UPDATE ' . $GLOBALS['ecs']->table('fw') . " SET  pay_status = '$pay_status' WHERE order_sn = '{$order_sn}'";
			$GLOBALS['db']->query($sql);
			

			/* 记录订单操作记录 */
			order_action($order_sn, OS_CONFIRMED, SS_UNSHIPPED, $pay_status, $note, $GLOBALS['_LANG']['buyer']);
			
			file_put_contents(ROOT_PATH.'log.txt', $_POST['order_sn'].'终于成功了');
			return true;
			
        } else {
            return false;
        }
    }
}
}
?>