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

if ($_SESSION['user_id'] > 0)
{
	$smarty->assign('user_name', $_SESSION['user_name']);
}

$sql = "SELECT * FROM " .$ecs->table('xx'). " WHERE id='$_REQUEST[id]'";
$fw = $db->GetRow($sql);


assign_template();


$smarty->assign('fw', $fw);
$smarty->display('xx_ok.dwt');


?>