<?php

/**
 * 牛模式ECSHOP采集插件:http://niumos.com/(淘宝店：new-modle.taobao.com QQ：303441162)
 * ============================================================================
 * 版权所有 牛模式团队，并保留所有权利。
 * 网站地址: http://www.niumos.com；
 * ----------------------------------------------------------------------------
 * 这不是一个自由软件！您只能在不用于商业目的的前提下对程序代码进行修改和
 * 使用；不允许对程序代码以任何形式任何目的的再发布。
 * ============================================================================
 * $Author: yxn $
 * $Id: nms_menu.php 17217 2016-01-12 yxn $
*/

if (!defined('IN_ECS'))
{
    die('Hacking attempt');
}
/*------------------------------------------------------ */
//-- 菜单项
/*------------------------------------------------------ */

//淘宝天猫
$modules['02_taobao']['17_3setting']                = 'shops.php?act=tb_setting';
//$modules['02_taobao']['17_1others']               = 'shops.php?act=others';
$modules['02_taobao']['17_1nms_tbk_api']    		= 'shops.php?act=nms_tbk_api_colect_view';
$modules['02_taobao']['17_2oalmm']                 	= 'shops.php?act=shopdata';
$modules['02_taobao']['17_20oalmm']               	= 'shops.php?act=batchco';
$modules['02_taobao']['17_3onekey']                 = 'shops.php?act=getAllgoods';
$modules['02_taobao']['17_3talmm']               	= 'shops.php?act=tools';
$modules['02_taobao']['17_4nmsinfo']                = 'http://www.niumos.com/info.php';
/*------------------------------------------------------ */
//-- 权限控制
/*------------------------------------------------------ */

//淘宝数据
$purview['17_3setting']       						= '17_3setting';
$purview['17_1others']       						= '17_1others';
$purview['17_2oalmm']       						= '17_2oalmm';
$purview['17_20oalmm']       						= '17_20oalmm';
$purview['17_3onekey']       						= '17_3onekey';
$purview['17_1nms_tbk_api']      					= '17_1nms_tbk_api';
$purview['17_3talmm']       						= '17_3talmm';
$purview['17_4nmsinfo']       						= '17_4nmsinfo';

//牛模式采集插件:http://niumos.com/(淘宝店：new-modle.taobao.com QQ：303441162)-end
?>
