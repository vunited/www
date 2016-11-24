<?php

/**
 * ECSHOP 建行支付插件
 * ============================================================================
 * 版权所有 2005-2010 上海商派网络科技有限公司，并保留所有权利。
 * 网站地址: http://www.zhiyuanit.com；
 * ----------------------------------------------------------------------------
 * 这不是一个自由软件！您只能在不用于商业目的的前提下对程序代码进行修改和
 * 使用；不允许对程序代码以任何形式任何目的的再发布。
 * ============================================================================
 * $Author: Apieye $
 * http://www.apieye.com
 * $Id: ccb.php 2012-05-18 10:21:24 $
 */

if (!defined('IN_ECS'))
{
    die('Hacking attempt');
}

$payment_lang = ROOT_PATH . 'languages/' .$GLOBALS['_CFG']['lang']. '/payment/ccb.php';

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
    $modules[$i]['desc']    = 'ccbpay_desc';

    /* 是否支持货到付款 */
    $modules[$i]['is_cod']  = '0';

    /* 是否支持在线支付 */
    $modules[$i]['is_online']  = '1';

    /* 作者 */
    $modules[$i]['author']  = 'zhiyuan';

    /* 网址 */
    $modules[$i]['website'] = 'http://www.chinabank.com.cn';

    /* 版本号 */
    $modules[$i]['version'] = '1.0';

    /* 配置信息 */
    $modules[$i]['config']  = array(
        array('name' => 'ccbpay_merchantid', 'type' => 'text', 'value' => ''),
        array('name' => 'ccbpay_posid',     'type' => 'text', 'value' => ''),
        array('name' => 'ccbpay_branchid',     'type' => 'text', 'value' => ''),
        array('name' => 'ccbpay_publickey',     'type' => 'text', 'value' => ''),
    );

    return;
}

/**
 * 类
 */
class ccb
{
    /**
     * 构造函数
     *
     * @access  public
     * @param
     *
     * @return void
     */
    function ccb()
    {
    }

    function __construct()
    {
        $this->ccb();
    }

    /**
     * 生成支付代码
     * @param   array   $order  订单信息
     * @param   array   $payment    支付方式信息
     */
    function get_code($order, $payment)
    {        
        //要加密的串
        $datastr = "MERCHANTID=".$payment['ccbpay_merchantid'].
                   "&POSID=".$payment['ccbpay_posid'].
                   "&BRANCHID=".$payment['ccbpay_branchid'].
                   "&ORDERID=".$order['order_sn'].
                   "&PAYMENT=".$order['order_amount'].
                   "&CURCODE=01".
                   "&TXCODE=520100".
                   "&REMARK1=&REMARK2=";
        
        $MAC = md5($datastr); 

        $def_url  = "\n<form action='https://ibsbjstar.ccb.com.cn/app/ccbMain' method='post' target='_blank'>\n";
        $def_url .= "<input type='hidden' name='MERCHANTID' value='".$payment['ccbpay_merchantid']."'>\n";
        $def_url .= "<input type='hidden' name='POSID' value='".$payment['ccbpay_posid']."'>\n";
        $def_url .= "<input type='hidden' name='BRANCHID' value='".$payment['ccbpay_branchid']."'>\n";
        
        $def_url .= "<input type='hidden' name='ORDERID' value='".$order['order_sn']."'>\n"; //订单号
        $def_url .= "<input type='hidden' name='PAYMENT' value='".$order['order_amount']."'>\n";  //金额
        
        $def_url .= "<input type='hidden' name='CURCODE' value='01'>\n";
        $def_url .= "<input type='hidden' name='TXCODE' value='520100'>\n";
        $def_url .= "<input type='hidden' name='REMARK1' value=''>\n";
        $def_url .= "<input type='hidden' name='REMARK2' value=''>\n";
        
        $def_url .= "<input type='hidden' name='MAC' value='".$MAC."'>\n";
        $def_url .= "<input type='submit' value='" . $GLOBALS['_LANG']['pay_button'] . "'>";
        $def_url .= "</form>\n";

        return $def_url;
    }
    /**
     * 响应操作
     */


    function respond()
    {

        //要验签的串
        $datastr = "POSID=".$_REQUEST['POSID'].
                   "&BRANCHID=".$_REQUEST['BRANCHID'].
                   "&ORDERID=".$_REQUEST['ORDERID'].
                   "&PAYMENT=".$_REQUEST['PAYMENT'].
                   "&CURCODE=".$_REQUEST['CURCODE'].
                   "&REMARK1=".$_REQUEST['REMARK1'].
                   "&REMARK2=".$_REQUEST['REMARK2'].
		   "&ACC_TYPE=".$_REQUEST['ACC_TYPE'].
                   "&SUCCESS=".$_REQUEST['SUCCESS'];
        $success = trim($_REQUEST['SUCCESS']); //成功标志 Y－成功；N－失败；E－客户放弃支付
        $sign = trim($_REQUEST['SIGN']); //返回的数字签名
        $pubkey = '30819c300d06092a864886f70d010101050003818a003081860281807a2de7ef3cbda5216bce09703e70ed8ff2ffd33636dde1c5d8fe8ff17211141b0994353583b8bb025fd3e3a21967deed1ec4adcb87d460d6c55148d3024dd0179a532c071087eedb343744d3bb64c8b397f914df32c39ac875518a355b7815e7a5fffd8f83322ff5eee251b28388a7860b5f587e53d5cc22963fb681f12fe825020111'; //商户公钥
		
		
        $rsasig=new COM("CCBRSA.RSASig") or die ("error");
        $rsasig->setpublickey($pubkey);
        $result=$rsasig->StringVerifySigature($sign,$datastr);
        
	$log_id = get_order_id_by_sn($_REQUEST['ORDERID'],true);
        if ($result == "Y" && $success == "Y")
        {
            order_paid($log_id);
	    return true;
        }

        return false;
    }
	
    
}
?>