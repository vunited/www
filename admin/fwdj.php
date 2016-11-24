<?php
define('IN_ECS', true);



require(dirname(__FILE__) . '/includes/init.php');
$exc = new exchange($ecs->table("fw_dj"), $db, 'id', 'name');

/*------------------------------------------------------ */
//-- 品牌列表
/*------------------------------------------------------ */
if ($_REQUEST['act'] == 'list')
{
    $smarty->assign('ur_here',      $_LANG['06_fwdj_list']);
    $smarty->assign('action_link',  array('text' => $_LANG['07_fwdj_add'], 'href' => 'fwdj.php?act=add'));
    $smarty->assign('full_page',    1);

    $brand_list = get_brandlist();

    $smarty->assign('brand_list',   $brand_list['brand']);
    $smarty->assign('filter',       $brand_list['filter']);
    $smarty->assign('record_count', $brand_list['record_count']);
    $smarty->assign('page_count',   $brand_list['page_count']);

    assign_query_info();
    $smarty->display('fwdj_list.htm');
}
/*------------------------------------------------------ */
//-- 添加品牌
/*------------------------------------------------------ */
elseif ($_REQUEST['act'] == 'add')
{

    $smarty->assign('ur_here',     $_LANG['07_fwdj_add']);
    $smarty->assign('action_link', array('text' => $_LANG['06_fwdj_list'], 'href' => 'fwdj.php?act=list'));
    $smarty->assign('form_action', 'insert');
	
    $smarty->display('fwdj_info.htm');
}
elseif ($_REQUEST['act'] == 'insert')
{

    $sql = "INSERT INTO ".$ecs->table('fw_dj')."(name,price) "."VALUES ('$_POST[brand_name]','$_POST[price]')";
    $db->query($sql);

    admin_log($_POST['brand_name'],'add','fwdj');

    /* 清除缓存 */
    clear_cache_files();

    $link[0]['text'] = $_LANG['continue_add'];
    $link[0]['href'] = 'fwdj.php?act=add';

    $link[1]['text'] = $_LANG['back_list'];
    $link[1]['href'] = 'fwdj.php?act=list';

    sys_msg($_LANG['brandadd_succed'], 0, $link);
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
            admin_log($name,'edit','fwdj');
            make_json_result(stripslashes($name));
        }
        else
        {
            make_json_result(sprintf($_LANG['brandedit_fail'], $name));
        }
    }
}
elseif ($_REQUEST['act'] == 'edit_price')
{
    check_authz_json('brand_manage');

    $id     = intval($_POST['id']);
    $price   = json_str_iconv(trim($_POST['val']));


        if ($exc->edit("price = '$price'", $id))
        {
            admin_log($name,'edit','fwdj');
            make_json_result(stripslashes($price));
        }
        else
        {
            make_json_result(sprintf($_LANG['brandedit_fail'], $name));
        }
}
/*------------------------------------------------------ */
//-- 删除品牌
/*------------------------------------------------------ */
elseif ($_REQUEST['act'] == 'remove')
{
    check_authz_json('brand_manage');

    $id = intval($_GET['id']);


    $exc->drop($id);



    $url = 'fwdj.php?act=query&' . str_replace('act=remove', '', $_SERVER['QUERY_STRING']);

    ecs_header("Location: $url\n");
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

    make_json_result($smarty->fetch('fwdj_list.htm'), '',
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
            $sql = "SELECT COUNT(*) FROM ".$GLOBALS['ecs']->table('fw_dj') .' WHERE name = \''.$_POST['name'].'\'';
        }
        else
        {
            $sql = "SELECT COUNT(*) FROM ".$GLOBALS['ecs']->table('fw_dj');
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
            $sql = "SELECT * FROM ".$GLOBALS['ecs']->table('fw_dj')." WHERE name like '%{$keyword}%' ORDER BY id DESC";
        }
        else
        {
            $sql = "SELECT * FROM ".$GLOBALS['ecs']->table('fw_dj')." ORDER BY id DESC";
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

?>
