<?php
define('IN_ECS', true);



require(dirname(__FILE__) . '/includes/init.php');
$exc = new exchange($ecs->table("fw"), $db, 'id', 'name');

/*------------------------------------------------------ */
//-- 品牌列表
/*------------------------------------------------------ */
if ($_REQUEST['act'] == 'list')
{
    $smarty->assign('ur_here',      $_LANG['06_fw_list']);
    $smarty->assign('full_page',    1);

    $brand_list = get_brandlist();

    $smarty->assign('brand_list',   $brand_list['brand']);
    $smarty->assign('filter',       $brand_list['filter']);
    $smarty->assign('record_count', $brand_list['record_count']);
    $smarty->assign('page_count',   $brand_list['page_count']);

    assign_query_info();
    $smarty->display('fw_list.htm');
}

elseif ($_REQUEST['act'] == 'edit')
{
    $sql = "SELECT * FROM " .$ecs->table('fw'). " WHERE id='$_REQUEST[fw_id]'";
    $brand = $db->GetRow($sql);
	
	
		if($brand['status']==0)$brand['statuss']= '待确认';
		if($brand['status']==1)$brand['statuss']= '已预约';
		if($brand['status']==2)$brand['statuss']= '已服务';
		if($brand['status']==3)$brand['statuss']= '已取消';
		if($brand['sex']==1)$brand['sex']= '先生';
		if($brand['sex']==2)$brand['sex']= '女士';
		if($brand['fp']==0)$brand['fp']= '不需要';
		if($brand['fp']==1)$brand['fp']= '需要';

        /* 取得区域名 */
    $sql = "SELECT concat(IFNULL(c.region_name, ''), '  ', IFNULL(p.region_name, ''), " .
                "'  ', IFNULL(t.region_name, ''), '  ', IFNULL(d.region_name, '')) AS region " .
            "FROM " . $ecs->table('fw') . " AS o " .
                "LEFT JOIN " . $ecs->table('region') . " AS c ON o.country = c.region_id " .
                "LEFT JOIN " . $ecs->table('region') . " AS p ON o.province = p.region_id " .
                "LEFT JOIN " . $ecs->table('region') . " AS t ON o.city = t.region_id " .
                "LEFT JOIN " . $ecs->table('region') . " AS d ON o.district = d.region_id " .
            "WHERE o.id = '$brand[id]'";
    $brand['region'] = $db->getOne($sql);
	
	
	$smarty->assign('ur_here',     $_LANG['brand_edit']);
    $smarty->assign('action_link', array('text' => $_LANG['06_fw_list'], 'href' => 'fw.php?act=list&' . list_link_postfix()));
    $smarty->assign('brand',       $brand);
    $smarty->assign('form_action', 'updata');

    assign_query_info();
    $smarty->display('fw_info.htm');
}
elseif ($_REQUEST['act'] == 'updata')
{
    admin_priv('brand_manage');
    if ($_POST['brand_name'] != $_POST['old_brandname'])
    {
        /*检查品牌名是否相同*/
        $is_only = $exc->is_only('brand_name', $_POST['brand_name'], $_POST['id']);

        if (!$is_only)
        {
            sys_msg(sprintf($_LANG['brandname_exist'], stripslashes($_POST['brand_name'])), 1);
        }
    }

    /*对描述处理*/
    if (!empty($_POST['brand_desc']))
    {
        $_POST['brand_desc'] = $_POST['brand_desc'];
    }

    $is_show = isset($_REQUEST['is_show']) ? intval($_REQUEST['is_show']) : 0;
     /*处理URL*/
    $site_url = sanitize_url( $_POST['site_url'] );

    /* 处理图片 */
    $img_name = basename($image->upload_image($_FILES['brand_logo'],'brandlogo'));
    $param = "brand_name = '$_POST[brand_name]',  site_url='$site_url', brand_desc='$_POST[brand_desc]', is_show='$is_show', sort_order='$_POST[sort_order]' ";
    if (!empty($img_name))
    {
        //有图片上传
        $param .= " ,brand_logo = '$img_name' ";
    }

    if ($exc->edit($param,  $_POST['id']))
    {
        /* 清除缓存 */
        clear_cache_files();

        admin_log($_POST['brand_name'], 'edit', 'brand');

        $link[0]['text'] = $_LANG['back_list'];
        $link[0]['href'] = 'brand.php?act=list&' . list_link_postfix();
        $note = vsprintf($_LANG['brandedit_succed'], $_POST['brand_name']);
        sys_msg($note, 0, $link);
    }
    else
    {
        die($db->error());
    }
}

/*------------------------------------------------------ */
//-- 删除品牌
/*------------------------------------------------------ */
elseif ($_REQUEST['act'] == 'remove')
{
    check_authz_json('brand_manage');

    $id = intval($_GET['id']);    	
	
	$sql = "SELECT * FROM " .$ecs->table('fw'). " WHERE id = '$id'";
    $back = $db->getRow($sql);
	
	@unlink(ROOT_PATH . $back['pic1']);
	@unlink(ROOT_PATH . $back['pic2']);
	@unlink(ROOT_PATH . $back['pic3']);
	@unlink(ROOT_PATH . $back['pic4']);
	
	$exc->drop($id);

    $url = 'fw.php?act=query&' . str_replace('act=remove', '', $_SERVER['QUERY_STRING']);

    ecs_header("Location: $url\n");
    exit;
}

elseif ($_REQUEST['act'] == 'status')
{
    check_authz_json('brand_manage');

    $id = intval($_GET['id']);
	$status = intval($_GET['status']);   
	
	$sql = "update " .$ecs->table('fw'). " set status = $status where id='$id'";
    $db->query($sql);
	
    ecs_header("Location: fw.php?act=list\n");
    exit;
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

    make_json_result($smarty->fetch('fw_list.htm'), '',
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
            $sql = "SELECT COUNT(*) FROM ".$GLOBALS['ecs']->table('fw') .' WHERE name = \''.$_POST['name'].'\'';
        }
        else
        {
            $sql = "SELECT COUNT(*) FROM ".$GLOBALS['ecs']->table('fw');
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
            $sql = "SELECT * FROM ".$GLOBALS['ecs']->table('fw')." WHERE name like '%{$keyword}%' ORDER BY id DESC";
        }
        else
        {
            $sql = "SELECT * FROM ".$GLOBALS['ecs']->table('fw')." ORDER BY id DESC";
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
		if($rows['status']==0)$rows['statuss']= '待确认';
		if($rows['status']==1)$rows['statuss']= '已预约';
		if($rows['status']==2)$rows['statuss']= '已服务';
		if($rows['status']==3)$rows['statuss']= '已取消';
		if($rows['sex']==1)$rows['sex']= '先生';
		if($rows['sex']==2)$rows['sex']= '女士';
		$arr[] = $rows;
    }

    return array('brand' => $arr, 'filter' => $filter, 'page_count' => $filter['page_count'], 'record_count' => $filter['record_count']);
}

?>
