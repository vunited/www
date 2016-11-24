<?php
define('IN_ECS', true);
define('ECS_ADMIN', true);
require(dirname(__FILE__) . '/includes/init.php');
require(ROOT_PATH . 'includes/lib_order.php');
include(ROOT_PATH . 'includes/lib_clips.php');
require(ROOT_PATH . 'includes/lib_payment.php');

if ($_SESSION['user_id'] > 0)
{
	$smarty->assign('user_name', $_SESSION['user_name']);
}

$sql = "SELECT * FROM " .$ecs->table('fw'). " WHERE id='$_REQUEST[id]'";
$fw = $db->GetRow($sql);


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
$smarty->assign('footer', get_footer());
$smarty->display("xd_ok.dwt");

?>
