<?php

/**
 * ECSHOP mobile首页
 * ============================================================================
 * * 版权所有 2005-2012 上海商派网络科技有限公司，并保留所有权利。
 * 网站地址: http://www.zhiyuanit.com；
 * ----------------------------------------------------------------------------
 * 这不是一个自由软件！您只能在不用于商业目的的前提下对程序代码进行修改和
 * 使用；不允许对程序代码以任何形式任何目的的再发布。
 * ============================================================================
 * $Author: liuhui $
 * $Id: index.php 15013 2010-03-25 09:31:42Z liuhui $
*/

define('IN_ECS', true);
define('ECS_ADMIN', true);

require(dirname(__FILE__) . '/includes/init.php');

$act = !empty($_GET['act']) ? $_GET['act'] : '';
if ($act == 'setcity')
{
	setCity($_REQUEST['id']);
}

/* 热门商品 */


$sql = 'SELECT * FROM ' . $GLOBALS['ecs']->table('template') . " where filename='index' ORDER BY sort_order";
$template = $db->GetAll($sql);
$templates = array();
foreach  ($template as $key => $val)
    {		
		if(strstr($val['library'],"best")){
		$templates[$key]['goods'] = get_recommend_goods('best');
		$templates[$key]['name'] = $val['name'];
		$templates[$key]['library'] = 'best';
		}
		if(strstr($val['library'],"hot")){
		$templates[$key]['goods'] = get_recommend_goods('hot');
		$templates[$key]['name'] = $val['name'];
		$templates[$key]['library'] = 'hot';
		}
		if(strstr($val['library'],"new")){
		$templates[$key]['goods'] = get_recommend_goods('new');
		$templates[$key]['name'] = $val['name'];
		$templates[$key]['library'] = 'new';
		}
		
    }
$smarty->assign('template' , $templates);
//print_r($templates);



$brands_array = get_brands();
if (!empty($brands_array))
{
    if (count($brands_array) > 3)
    {
        $brands_array = array_slice($brands_array, 0, 10);
    }
    foreach ($brands_array as $key => $brands_data)
    {
        $brands_array[$key]['brand_name'] = encode_output($brands_data['brand_name']);
    }
    $smarty->assign('brand_array', $brands_array);
}

$article_array = $db->GetALLCached("SELECT article_id, title FROM " . $ecs->table("article") . " WHERE cat_id != 0 AND is_open = 1 AND open_type = 0 ORDER BY article_id DESC LIMIT 0,4");
if (!empty($article_array))
{
    foreach ($article_array as $key => $article_data)
    {
        $article_array[$key]['title'] = encode_output($article_data['title']);
    }
    $smarty->assign('article_array', $article_array);
}
if ($_SESSION['user_id'] > 0)
{
	$smarty->assign('user_name', $_SESSION['user_name']);
	$smarty->assign('user_id', $_SESSION['user_id']);
	/*
	if(!empty($_COOKIE['ecshop_affiliate_uid'])){
		$smarty->assign('user_id', $_COOKIE['ecshop_affiliate_uid']);
	}else{
		$smarty->assign('user_id', $_SESSION['user_id']);
	}
	*/
}

if($_SESSION['user_id']){
if($_GET['u']==$_SESSION['user_id']){
$smarty->assign('show', 'yes');
}
}
$smarty->assign('footer', get_footer());
$smarty->display("index.dwt");

?>