<?php

/**
 * ECSHOP 文章
 * ============================================================================
 * 版权所有 2005-2010 上海商派网络科技有限公司，并保留所有权利。
 * 网站地址: http://www.ecshop.com；
 * ----------------------------------------------------------------------------
 * 这不是一个自由软件！您只能在不用于商业目的的前提下对程序代码进行修改和
 * 使用；不允许对程序代码以任何形式任何目的的再发布。
 * ============================================================================
 * $Author: liubo $
 * $Id: article.php 16455 2009-07-13 09:57:19Z liubo $
*/

define('IN_ECS', true);
define('ECS_ADMIN', true);

require(dirname(__FILE__) . '/includes/init.php');
if ($_SESSION['user_id'] > 0)
{
	$smarty->assign('user_name', $_SESSION['user_name']);
}

if (!function_exists("htmlspecialchars_decode"))
	{
		function htmlspecialchars_decode($string, $quote_style = ENT_COMPAT)
		{
			return strtr($string, array_flip(get_html_translation_table(HTML_SPECIALCHARS, $quote_style)));
		}
	}

/* 文章详细 */

	$a_id = !empty($_GET['id']) ? intval($_GET['id']) : '';
	if ($a_id > 0)
	{
		$article_row = $db->getRow('SELECT title, content,file_url FROM ' . $ecs->table('article') . ' WHERE article_id = ' . $a_id . ' AND cat_id > 0 AND is_open = 1');
		if (!empty($article_row))
		{
			$article_row['title'] = encode_output($article_row['title']);
			$article_row['file_url'] = encode_output($article_row['file_url']);
			$replace_tag = array('<br />' , '<br/>' , '<br>' , '</p>');
			$article_row['content'] = htmlspecialchars_decode(encode_output($article_row['content']));
			$article_row['content'] = str_replace($replace_tag, '{br}' , $article_row['content']);
			//$article_row['content'] = strip_tags($article_row['content']);
			$article_row['content'] = str_replace('{br}' , '<br />' , $article_row['content']);
			$smarty->assign('article_data', $article_row);
		}
	}
	$smarty->assign('footer', get_footer());
	
	
	
	$smarty->assign('titleh',  $article_row['title']);
	$smarty->display('article.dwt');

?>