<?php

/**
 * ECSHOP 首页文件
 * ============================================================================
 * * 版权所有 2005-2012 上海商派网络科技有限公司，并保留所有权利。
 * 网站地址: http://www.ecshop.com；
 * ----------------------------------------------------------------------------
 * 这不是一个自由软件！您只能在不用于商业目的的前提下对程序代码进行修改和
 * 使用；不允许对程序代码以任何形式任何目的的再发布。
 * ============================================================================
 * $Author: liubo $
 * $Id: index.php 17217 2011-01-19 06:29:08Z liubo $
*/

define('IN_ECS', true);

require(dirname(__FILE__) . '/includes/init.php');
require(ROOT_PATH . 'includes/lib_order.php');
include(ROOT_PATH . 'includes/lib_clips.php');
require(ROOT_PATH . 'includes/lib_payment.php');

    $position = assign_ur_here(0, '装灯大师服务');
    $smarty->assign('page_title',      $position['title']);    // 页面标题
    $smarty->assign('ur_here',         $position['ur_here']);  // 当前位置
    $smarty->assign('keywords',        htmlspecialchars($_CFG['shop_keywords']));
    $smarty->assign('description',     htmlspecialchars($_CFG['shop_desc']));

if ($_SESSION['user_id'] > 0)
{
	$smarty->assign('user_name', $_SESSION['user_name']);
}

$sql = "SELECT * FROM " .$ecs->table('fw'). " WHERE id='$_REQUEST[id]'";
$fw = $db->GetRow($sql);


assign_template();



    if ($fw['order_amount'] > 0)
    {
        $payment = payment_info($fw['pay_id']);

        include_once('includes/modules/payment/' . $payment['pay_code'] . '.php');

        $pay_obj    = new $payment['pay_code'];
        $pay_online = $pay_obj->get_code($fw, unserialize_config($payment['pay_config']));

        $fw['pay_desc'] = $payment['pay_desc'];

        $smarty->assign('pay_online', $pay_online);
    }

$smarty->assign('fw', $fw);
$smarty->display('xd_ok.dwt');


?>