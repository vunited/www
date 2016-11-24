<?php

/**
 * ECSHOP 管理中心品牌管理
 * ============================================================================
 * * 版权所有 2005-2012 上海商派网络科技有限公司，并保留所有权利。
 * 网站地址: http://www.ecshop.com；
 * ----------------------------------------------------------------------------
 * 这不是一个自由软件！您只能在不用于商业目的的前提下对程序代码进行修改和
 * 使用；不允许对程序代码以任何形式任何目的的再发布。
 * ============================================================================
 * $Author: liubo $
 * $Id: brand.php 17217 2011-01-19 06:29:08Z liubo $
*/

define('IN_ECS', true);

require(dirname(__FILE__) . '/includes/init.php');
include_once(ROOT_PATH . 'includes/cls_image.php');
$image = new cls_image($_CFG['bgcolor']);
require_once(ROOT_PATH . '/' . ADMIN_PATH . '/includes/lib_goods.php');

$exc = new exchange($ecs->table("store"), $db, 'store_id', 'name');

/*------------------------------------------------------ */
//-- 品牌列表
/*------------------------------------------------------ */
if ($_REQUEST['act'] == 'list')
{
    $smarty->assign('ur_here',      $_LANG['06_goods_store_list']);
    $smarty->assign('action_link',  array('text' => $_LANG['07_store_add'], 'href' => 'store.php?act=add'));
    $smarty->assign('full_page',    1);

    $brand_list = get_brandlist();

    $smarty->assign('brand_list',   $brand_list['brand']);
    $smarty->assign('filter',       $brand_list['filter']);
    $smarty->assign('record_count', $brand_list['record_count']);
    $smarty->assign('page_count',   $brand_list['page_count']);

    assign_query_info();
    $smarty->display('store_list.htm');
}
/*------------------------------------------------------ */
//-- 添加品牌
/*------------------------------------------------------ */
elseif ($_REQUEST['act'] == 'add')
{
    /* 权限判断 */
    admin_priv('brand_manage');

    $smarty->assign('ur_here',     $_LANG['07_store_add']);
    $smarty->assign('action_link', array('text' => $_LANG['06_goods_store_list'], 'href' => 'store.php?act=list'));
    $smarty->assign('form_action', 'insert');
	$smarty->assign('country_list', get_regions());
	$smarty->assign('parent_ids',    get_parent_list());

    assign_query_info();
    $smarty->assign('brand', array('sort_order'=>50, 'is_show'=>1));
    $smarty->display('store_info.htm');
}
elseif ($_REQUEST['act'] == 'insert')
{
    /*检查品牌名是否重复*/
    admin_priv('brand_manage');

    $is_show = isset($_REQUEST['is_show']) ? intval($_REQUEST['is_show']) : 0;

    $is_only = $exc->is_only('name', $_POST['brand_name']);

    if (!$is_only)
    {
        sys_msg(sprintf($_LANG['brandname_exist'], stripslashes($_POST['brand_name'])), 1);
    }

    /*对描述处理*/
    if (!empty($_POST['store_desc']))
    {
        $_POST['store_desc'] = $_POST['store_desc'];
    }
	
	$img_name = basename($image->upload_image($_FILES['brand_logo'],'brandlogo'));
	
    /*插入数据*/
	$time = gmtime();
	
	$position = explode(',',$_POST[position]); 
	$longitude=$position[0];
	$latitude=$position[1];

    $sql = "INSERT INTO ".$ecs->table('store')."(name, tel, store_desc, store_logo, is_show, sort_order, address, yssj, gjxl, dtxl, add_time, country, province, city, district, position, longitude, latitude, user_id ) ".
           "VALUES ('$_POST[brand_name]', '$_POST[tel]', '$_POST[store_desc]', '$img_name', '$is_show', '$_POST[sort_order]', '$_POST[address]', '$_POST[yssj]', '$_POST[gjxl]', '$_POST[dtxl]', '$time', '$_POST[country]', '$_POST[province]', '$_POST[city]', '$_POST[district]', '$_POST[position]', '$longitude', '$latitude', '$_POST[user_id]')";
    $db->query($sql);

    admin_log($_POST['brand_name'],'add','store');

    /* 清除缓存 */
    clear_cache_files();

    $link[0]['text'] = $_LANG['continue_add'];
    $link[0]['href'] = 'store.php?act=add';

    $link[1]['text'] = $_LANG['back_list'];
    $link[1]['href'] = 'store.php?act=list';

    sys_msg($_LANG['brandadd_succed'], 0, $link);
}

/*------------------------------------------------------ */
//-- 编辑品牌
/*------------------------------------------------------ */
elseif ($_REQUEST['act'] == 'edit')
{
    /* 权限判断 */
    admin_priv('brand_manage');
    $sql = "SELECT * FROM " .$ecs->table('store'). " WHERE store_id='$_REQUEST[id]'";
    $brand = $db->GetRow($sql);

    $smarty->assign('ur_here',     $_LANG['brand_edit']);
    $smarty->assign('action_link', array('text' => $_LANG['06_goods_store_list'], 'href' => 'store.php?act=list&' . list_link_postfix()));
    $smarty->assign('brand',       $brand);
    $smarty->assign('form_action', 'updata');
	
	
	
	$smarty->assign('parent_ids',    get_parent_list());
	
	$smarty->assign('country_list', get_regions());
	
            if ($brand['country'] > 0)
            {
                /* 取得省份 */
                $smarty->assign('province_list', get_regions(1, $brand['country']));
                if ($brand['province'] > 0)
                {
                    /* 取得城市 */
                    $smarty->assign('city_list', get_regions(2, $brand['province']));
                    if ($brand['city'] > 0)
                    {
                        /* 取得区域 */
                        $smarty->assign('district_list', get_regions(3, $brand['city']));
                    }
                }
            }
	

    assign_query_info();
    $smarty->display('store_info.htm');
}
elseif ($_REQUEST['act'] == 'updata')
{
    admin_priv('brand_manage');

	
    if ($_POST['brand_name'] != $_POST['old_brandname'])
    {
        /*检查品牌名是否相同*/
        $is_only = $exc->is_only('name', $_POST['brand_name'], $_POST['id']);

        if (!$is_only)
        {
            sys_msg(sprintf($_LANG['brandname_exist'], stripslashes($_POST['brand_name'])), 1);
        }
    }

    /*对描述处理*/
    if (!empty($_POST['store_desc']))
    {
        $_POST['store_desc'] = $_POST['store_desc'];
    }

    $is_show = isset($_REQUEST['is_show']) ? intval($_REQUEST['is_show']) : 0;
	/* 处理图片 */
    $img_name = basename($image->upload_image($_FILES['brand_logo'],'brandlogo'));
	
	$position = explode(',',$_POST[position]); 
	$longitude=$position[0];
	$latitude=$position[1];
	
    $param = "name = '$_POST[brand_name]', tel='$_POST[tel]', address='$_POST[address]', yssj='$_POST[yssj]', gjxl='$_POST[gjxl]', dtxl='$_POST[dtxl]', store_desc='$_POST[store_desc]', is_show='$is_show', sort_order='$_POST[sort_order]', country='$_POST[country]', province='$_POST[province]', city='$_POST[city]', district='$_POST[district]', position='$_POST[position]', longitude='$longitude', latitude='$latitude', user_id='$_POST[user_id]' ";
	
    if (!empty($img_name))
    {
        //有图片上传
        $param .= " ,store_logo = '$img_name' ";
    }
	

    if ($exc->edit($param,  $_POST['id']))
    {
        /* 清除缓存 */
        clear_cache_files();

        admin_log($_POST['brand_name'], 'edit', 'brand');

        $link[0]['text'] = $_LANG['back_list'];
        $link[0]['href'] = 'store.php?act=list&' . list_link_postfix();
        $note = vsprintf($_LANG['brandedit_succed'], $_POST['brand_name']);
        sys_msg($note, 0, $link);
    }
    else
    {
        die($db->error());
    }
}

/*------------------------------------------------------ */
//-- 编辑品牌名称
/*------------------------------------------------------ */
elseif ($_REQUEST['act'] == 'edit_brand_name')
{
    check_authz_json('brand_manage');

    $id     = intval($_POST['id']);
    $name   = json_str_iconv(trim($_POST['val']));

    /* 检查名称是否重复 */
    if ($exc->num("name",$name, $id) != 0)
    {
        make_json_error(sprintf($_LANG['brandname_exist'], $name));
    }
    else
    {
        if ($exc->edit("name = '$name'", $id))
        {
            admin_log($name,'edit','store');
            make_json_result(stripslashes($name));
        }
        else
        {
            make_json_result(sprintf($_LANG['brandedit_fail'], $name));
        }
    }
}

/*------------------------------------------------------ */
//-- 编辑排序序号
/*------------------------------------------------------ */
elseif ($_REQUEST['act'] == 'edit_brand_order')
{
    check_authz_json('brand_manage');

    $id     = intval($_POST['id']);
    $order  = intval($_POST['val']);
    $name   = $exc->get_name($id);

    if ($exc->edit("sort_order = '$order'", $id))
    {
        admin_log(addslashes($name),'edit','store');

        make_json_result($order);
    }
    else
    {
        make_json_error(sprintf($_LANG['brandedit_fail'], $name));
    }
}

/*------------------------------------------------------ */
//-- 切换是否显示
/*------------------------------------------------------ */
elseif ($_REQUEST['act'] == 'toggle_show')
{
    check_authz_json('brand_manage');

    $id     = intval($_POST['id']);
    $val    = intval($_POST['val']);

    $exc->edit("is_show='$val'", $id);

    make_json_result($val);
}

/*------------------------------------------------------ */
//-- 删除品牌
/*------------------------------------------------------ */
elseif ($_REQUEST['act'] == 'remove')
{
    check_authz_json('brand_manage');

    $id = intval($_GET['id']);


    $exc->drop($id);



    $url = 'store.php?act=query&' . str_replace('act=remove', '', $_SERVER['QUERY_STRING']);

    ecs_header("Location: $url\n");
    exit;
}

/*------------------------------------------------------ */
//-- 删除图片
/*------------------------------------------------------ */
elseif ($_REQUEST['act'] == 'drop_image')
{
    check_authz_json('goods_manage');

    $img_id = empty($_REQUEST['img_id']) ? 0 : intval($_REQUEST['img_id']);

    /* 删除图片文件 */
    $sql = "SELECT img_url, thumb_url, img_original " .
            " FROM " . $GLOBALS['ecs']->table('store_gallery') .
            " WHERE img_id = '$img_id'";
    $row = $GLOBALS['db']->getRow($sql);

    if ($row['img_url'] != '' && is_file('../' . $row['img_url']))
    {
        @unlink('../' . $row['img_url']);
    }
    if ($row['thumb_url'] != '' && is_file('../' . $row['thumb_url']))
    {
        @unlink('../' . $row['thumb_url']);
    }
    if ($row['img_original'] != '' && is_file('../' . $row['img_original']))
    {
        @unlink('../' . $row['img_original']);
    }

    /* 删除数据 */
    $sql = "DELETE FROM " . $GLOBALS['ecs']->table('store_gallery') . " WHERE img_id = '$img_id' LIMIT 1";
    $GLOBALS['db']->query($sql);

    clear_cache_files();
    make_json_result($img_id);
}


/*------------------------------------------------------ */
//-- 排序、分页、查询
/*------------------------------------------------------ */
elseif ($_REQUEST['act'] == 'query')
{
    $brand_list = get_brandlist();
    $smarty->assign('brand_list',   $brand_list['brand']);
    $smarty->assign('filter',       $brand_list['filter']);
    $smarty->assign('record_count', $brand_list['record_count']);
    $smarty->assign('page_count',   $brand_list['page_count']);

    make_json_result($smarty->fetch('store_list.htm'), '',
        array('filter' => $brand_list['filter'], 'page_count' => $brand_list['page_count']));
}

/**
 * 获取品牌列表
 *
 * @access  public
 * @return  array
 */
function get_brandlist()
{
    $result = get_filter();
    if ($result === false)
    {
        /* 分页大小 */
        $filter = array();

        /* 记录总数以及页数 */
        if (isset($_POST['name']))
        {
            $sql = "SELECT COUNT(*) FROM ".$GLOBALS['ecs']->table('store') .' WHERE name = \''.$_POST['name'].'\'';
        }
        else
        {
            $sql = "SELECT COUNT(*) FROM ".$GLOBALS['ecs']->table('store');
        }

        $filter['record_count'] = $GLOBALS['db']->getOne($sql);

        $filter = page_and_size($filter);

        /* 查询记录 */
        if (isset($_POST['name']))
        {
            if(strtoupper(EC_CHARSET) == 'GBK')
            {
                $keyword = iconv("UTF-8", "gb2312", $_POST['name']);
            }
            else
            {
                $keyword = $_POST['name'];
            }
            $sql = "SELECT * FROM ".$GLOBALS['ecs']->table('store')." WHERE name like '%{$keyword}%' ORDER BY sort_order ASC";
        }
        else
        {
            $sql = "SELECT * FROM ".$GLOBALS['ecs']->table('store')." ORDER BY sort_order ASC";
        }

        set_filter($filter, $sql);
    }
    else
    {
        $sql    = $result['sql'];
        $filter = $result['filter'];
    }
    $res = $GLOBALS['db']->selectLimit($sql, $filter['page_size'], $filter['start']);

    $arr = array();
    while ($rows = $GLOBALS['db']->fetchRow($res))
    {
        $arr[] = $rows;
    }

    return array('brand' => $arr, 'filter' => $filter, 'page_count' => $filter['page_count'], 'record_count' => $filter['record_count']);
}


function get_kqlist()
{
    $result = get_filter();
    if ($result === false)
    {
        /* 分页大小 */
        $filter = array();

        /* 记录总数以及页数 */
		
		$user_id = $GLOBALS['db']->getOne("SELECT user_id FROM ".$GLOBALS['ecs']->table('store') ." WHERE store_id = ".$_GET['id']);
		
		if($user_id){
		$user_ids= $GLOBALS['db']->getAll("SELECT user_id FROM ".$GLOBALS['ecs']->table('users') ." WHERE parent_id = ".$user_id);		
		foreach ($user_ids AS $key => $val)
		{
		    $user_id.=','.$val['user_id'];
		}
		}

        $sql = "SELECT COUNT(*) FROM ".$GLOBALS['ecs']->table('users_m') ." WHERE user_id>0 and user_id in (".$user_id.")";
        $filter['record_count'] = $GLOBALS['db']->getOne($sql);

        $filter = page_and_size($filter);
        
        $sql = "SELECT m.time,u.user_name,m.type FROM ".$GLOBALS['ecs']->table('users_m')." m LEFT JOIN " . $GLOBALS['ecs']->table('users') . " u ON m.user_id = u.user_id WHERE m.user_id>0 and m.user_id in (".$user_id.")"; 

        set_filter($filter, $sql);
		
    }
    else
    {
        $sql    = $result['sql'];
        $filter = $result['filter'];
    }
    $res = $GLOBALS['db']->selectLimit($sql, $filter['page_size'], $filter['start']);


	$arr = array();
    while ($rows = $GLOBALS['db']->fetchRow($res))
    {
        $rows['time'] = local_date($GLOBALS['_CFG']['time_format'], $rows['time']);
		$arr[] = $rows;
    }

    return array('brand' => $arr, 'filter' => $filter, 'page_count' => $filter['page_count'], 'record_count' => $filter['record_count']);
}

function get_parent_list($is_special = false)
{
    $rank_list = array();
    $sql = 'SELECT user_id, user_name FROM ' . $GLOBALS['ecs']->table('users');
	
    $sql .= ' WHERE user_rank = 3';

    $res = $GLOBALS['db']->query($sql);

    while ($row = $GLOBALS['db']->fetchRow($res))
    {
		$rank_list[$row['user_id']] = $row['user_name'];
    }

    return $rank_list;
}

function export_csv($filename,$data)   
{   
    header("Content-type:text/csv");   
    header("Content-Disposition:attachment;filename=".$filename);   
    header('Cache-Control:must-revalidate,post-check=0,pre-check=0');   
    header('Expires:0');   
    header('Pragma:public');   
    echo $data;   
} 
?>
