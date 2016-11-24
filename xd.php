<?php

/**
 * ECSHOP 首页文件
 * ============================================================================
 * * 版权所有 2005-2012 上海商派网络科技有限公司，并保留所有权利。
 * 网站地址: http://www.zhiyuanit.com；
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
require(ROOT_PATH . 'includes/lib_payment.php');

include(ROOT_PATH . 'includes/cls_image.php'); 

    $position = assign_ur_here(0, '装灯大师服务');
    $smarty->assign('page_title',      $position['title']);    // 页面标题
    $smarty->assign('ur_here',         $position['ur_here']);  // 当前位置
    $smarty->assign('keywords',        htmlspecialchars($_CFG['shop_keywords']));
    $smarty->assign('description',     htmlspecialchars($_CFG['shop_desc']));

$user_id = $_SESSION['user_id'];
if ($_SESSION['user_id'] > 0)
{
	$smarty->assign('user_name', $_SESSION['user_name']);
}
if (empty($user_id))
	{
		ecs_header("Location:user.php\n");
	}

$act = isset($_REQUEST['act']) ? $_REQUEST['act'] : '';
if($act == 'add'){
	
	
	
	
	$name = $_REQUEST['name'];
	$sex = $_REQUEST['sex'];
	$tel = $_REQUEST['tel'];
	$fwfl = $_REQUEST['fw1'];
	$fwdj = $_REQUEST['fw2'];
	$price1 = $_REQUEST['price1'];
	$price2 = $_REQUEST['price2'];
	$fw_time1 = $_REQUEST['fw_time1'];
	$fw_time2 = $_REQUEST['fw_time2'];
	$fw_time3 = $_REQUEST['fw_time3'];
	$fw_time4 = $_REQUEST['fw_time4']; 	
	$fw_time5 = $_REQUEST['fw_time5'];
	$desc = $_REQUEST['desc']; 	
	$pay_id = $_REQUEST['payment'];
	$fp = $_REQUEST['fp']; 
	
	$consignee = get_consignee($_SESSION['user_id']);	
	
	$amount=$price1+$price2;
	$fw_time=$fw_time1.'-'.$fw_time2.'-'.$fw_time3.' '.$fw_time4.'-'.$fw_time5;	
	
	$upload_size_limit = $GLOBALS['_CFG']['upload_size_limit'] == '-1' ? ini_get('upload_max_filesize') : $GLOBALS['_CFG']['upload_size_limit'];
    $last_char = strtolower($upload_size_limit{strlen($upload_size_limit)-1});
    switch ($last_char)
    {
        case 'm':
            $upload_size_limit *= 1024*1024;
            break;
        case 'k':
            $upload_size_limit *= 1024;
            break;
    }
	
	$pic1 = (isset($_FILES['pic1']['error']) && $_FILES['pic1']['error'] == 0) || (!isset($_FILES['pic1']['error']) && isset($_FILES['pic1']['tmp_name']) && $_FILES['pic1']['tmp_name'] != 'none')
         ? $_FILES['pic1'] : array();
	$pic2 = (isset($_FILES['pic2']['error']) && $_FILES['pic2']['error'] == 0) || (!isset($_FILES['pic2']['error']) && isset($_FILES['pic2']['tmp_name']) && $_FILES['pic2']['tmp_name'] != 'none')
         ? $_FILES['pic2'] : array();
	$pic3 = (isset($_FILES['pic3']['error']) && $_FILES['pic3']['error'] == 0) || (!isset($_FILES['pic3']['error']) && isset($_FILES['pic3']['tmp_name']) && $_FILES['pic3']['tmp_name'] != 'none')
         ? $_FILES['pic3'] : array();
	$pic4 = (isset($_FILES['pic4']['error']) && $_FILES['pic4']['error'] == 0) || (!isset($_FILES['pic4']['error']) && isset($_FILES['pic4']['tmp_name']) && $_FILES['pic4']['tmp_name'] != 'none')
         ? $_FILES['pic4'] : array();
		 
	$image = new cls_image();
	if ($pic1)
    {
		$img_names1 = $image->upload_image($pic1,'fw');
		$img_name1 = $image->make_thumb(ROOT_PATH.$img_names1 , 500,  0,ROOT_PATH.'data/fw/','#000000');
		@unlink(ROOT_PATH . $img_names1);
    }
    else
    {
        $img_name1 = '';
    }
	if ($pic2)
    {
        $img_names2 = $image->upload_image($pic2,'fw');
		$img_name2 = $image->make_thumb(ROOT_PATH.$img_names2 , 500,  0,ROOT_PATH.'data/fw/','#000000');
		@unlink(ROOT_PATH . $img_names2);
    }
    else
    {
        $img_name2 = '';
    }
	if ($pic3)
    {
        $img_names3 = $image->upload_image($pic3,'fw');
		$img_name3 = $image->make_thumb(ROOT_PATH.$img_names3 , 500,  0,ROOT_PATH.'data/fw/','#000000');
		@unlink(ROOT_PATH . $img_names3);
    }
    else
    {
        $img_name3 = '';
    }
	if ($pic4)
    {
        $img_names4 = $image->upload_image($pic4,'fw');
		$img_name4 = $image->make_thumb(ROOT_PATH.$img_names4 , 500,  0,ROOT_PATH.'data/fw/','#000000');
		@unlink(ROOT_PATH . $img_names4);
    }
    else
    {
        $img_name4 = '';
    }
	
	$add_time = date('Y-m-d H:i:s',time());
	$sn = strtotime(date('Y-m-d H:i:s',time()))+(rand()*100);	
	
	$sql = 'INSERT INTO '. $ecs->table('fw') . " (`name`, `sex`, `user_id`, `fp`, `fwfl`, `fwdj`, `fw_time`, `tel`, `order_amount`, `pay_id`, `desc`, `status`, `pic1`, `pic2`, `pic3`, `pic4`, `add_time`, `consignee`, `country`, `province`, `city`, `district`, `address`, `order_sn`) VALUES ('$name','$sex','$user_id','$fp','$fwfl','$fwdj','$fw_time','$tel','$amount','$pay_id','$desc',0,'$img_name1','$img_name2','$img_name3','$img_name4','$add_time','".$consignee['consignee']."','".$consignee['country']."','".$consignee['province']."','".$consignee['city']."','".$consignee['district']."','".$consignee['address']."','$sn')";
	$db->query($sql);
	
	$id = $db->insert_id();
	
	ecs_header("Location: xd_ok.php?id=$id\n");
    exit;
	
}else{
    assign_template();
unset($_SESSION["flow_consignee"]);
	$consignee = get_consignee($_SESSION['user_id']);
	$where = "1";
	if($consignee['city']){
		$where = " region_id = '$consignee[city]'";
	}
	if($consignee['district']){
		$where .= " OR region_id = '$consignee[district]'";
	}
	$sql = 'SELECT region_name FROM ' . $GLOBALS['ecs']->table('region') . " WHERE ".$where;
	$rnarr = $db->GetAll($sql);
	$consignee['addressd'] = $rnarr[0]['region_name'].' '.$rnarr[1]['region_name'].' '.$consignee['address'];
	//end

	$_SESSION['flow_consignee'] = $consignee;
	$smarty->assign('consignee', $consignee);
	
	$cod_fee = 0;

	// 给货到付款的手续费加<span id>，以便改变配送的时候动态显示
	$payment_list = available_payment_list(1, $cod_fee);
	if(isset($payment_list))
	{
		foreach ($payment_list as $key => $payment)
		{
			if ($payment['is_cod'] == '1')
			{
				$payment_list[$key]['format_pay_fee'] = '<span id="ECS_CODFEE">' . $payment['format_pay_fee'] . '</span>';
			}
			/* 如果有易宝神州行支付 如果订单金额大于300 则不显示 */
			if ($payment['pay_code'] == 'yeepayszx' && $total['amount'] > 300)
			{
				unset($payment_list[$key]);
			}
			/* 如果有余额支付 */
			if ($payment['pay_code'] == 'balance')
			{
				/* 如果未登录，不显示 */
				if ($_SESSION['user_id'] == 0)
				{
					unset($payment_list[$key]);
				}
				else
				{
					if ($_SESSION['flow_order']['pay_id'] == $payment['pay_id'])
					{
						$smarty->assign('disable_surplus', 1);
					}
				}
			}
		}
	}
	$smarty->assign('payment_list', $payment_list);


$sql = 'SELECT * FROM ' . $GLOBALS['ecs']->table('fw_fl') . ' ORDER BY id';
$fwfl = $GLOBALS['db']->getAll($sql);
$sql = 'SELECT * FROM ' . $GLOBALS['ecs']->table('fw_dj') . ' ORDER BY id';
$fwdj = $GLOBALS['db']->getAll($sql);


$smarty->assign('fwfl_list', $fwfl);
$smarty->assign('fwdj_list', $fwdj);
$smarty->display('xd.dwt');
}

?>