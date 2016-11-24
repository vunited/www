<?php
define('IN_ECS', true);
define('ECS_ADMIN', true);
require(dirname(__FILE__) . '/includes/init.php');
require(ROOT_PATH . 'includes/lib_order.php');

define('DATA_DIR', $ecs->data_dir()); 

$user_id = $_SESSION['user_id'];
if ($_SESSION['user_id'] > 0)
{
	$smarty->assign('user_name', $_SESSION['user_name']);
}

$act = isset($_REQUEST['act']) ? $_REQUEST['act'] : '';
if($act == 'add'){	
	
	if (empty($user_id))
	{
		ecs_header("Location:user.php\n");
	}
	
	$name = isset($_REQUEST['name']) ? $_REQUEST['name'] : '';
	$sex = isset($_REQUEST['sex']) ? $_REQUEST['sex'] : '0';
	$tel = isset($_REQUEST['tel']) ? $_REQUEST['tel'] : '';
	$goods = isset($_REQUEST['goods']) ? $_REQUEST['goods'] : '';
	$store = isset($_REQUEST['store']) ? $_REQUEST['store'] : '';
	$fw_time1 = $_REQUEST['fw_time1'];
	$fw_time2 = $_REQUEST['fw_time2'];
	$fw_time3 = $_REQUEST['fw_time3'];
	$fw_time4 = $_REQUEST['fw_time4']; 	
	$fw_time5 = $_REQUEST['fw_time5'];
	$fw_time=$fw_time1.'-'.$fw_time2.'-'.$fw_time3.' '.$fw_time4.'-'.$fw_time5;	

	$add_time = date('Y-m-d H:i:s',time());
	$sn = strtotime(date('Y-m-d H:i:s',time()))+(rand()*100);	
	
	$sql = 'INSERT INTO '. $ecs->table('xx') . " (`name`, `sex`, `user_id`, `fw_time`, `tel`, `status`, `add_time`, `order_sn`, `goods`, `store`) VALUES ('$name', '$sex', '$user_id', '$fw_time', '$tel', 0, '$add_time', '$sn', '$goods', '$store')";
	$db->query($sql);
	
	$id = $db->insert_id();
	
	ecs_header("Location: xx_ok.php?id=$id\n");
    exit;
	
}else{
$cart_goods_list = cart_goods_list();
$smarty->assign('goods_list', $cart_goods_list);
$sql = 'SELECT * FROM ' . $ecs->table('suppliers') . " WHERE suppliers_id = {$cart_goods_list[0]['store']}";
$store_info=$db->getRow($sql);

	$position = explode(',',$store_info['position']); 	
	$store_info['position']=@$position[1].','.@$position[0];


$smarty->assign('store', $store_info);
$smarty->assign('footer', get_footer());
$smarty->display("xx.dwt");
}


?>