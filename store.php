<?php

/**
 * ECSHOP 品牌列表
 * ============================================================================
 * * 版权所有 2005-2012 上海商派网络科技有限公司，并保留所有权利。
 * 网站地址: http://www.zhiyuanit.com；
 * ----------------------------------------------------------------------------
 * 这不是一个自由软件！您只能在不用于商业目的的前提下对程序代码进行修改和
 * 使用；不允许对程序代码以任何形式任何目的的再发布。
 * ============================================================================
 * $Author: liubo $
 * $Id: brand.php 17217 2011-01-19 06:29:08Z liubo $
*/

define('IN_ECS', true);

require(dirname(__FILE__) . '/includes/init.php');

if ((DEBUG_MODE & 2) != 2)
{
    $smarty->caching = true;
}

/*------------------------------------------------------ */
//-- INPUT
/*------------------------------------------------------ */

/* 获得请求的分类 ID */
if (!empty($_REQUEST['id']))
{
    $brand_id = intval($_REQUEST['id']);
}

$action  = $_REQUEST['act'];

if ($action == 'search')
{
        $province  = $_REQUEST['province'];
		$city  = $_REQUEST['city'];
		$district  = $_REQUEST['district'];	
		
		$city  = $_COOKIE['cookcityid'];
		
		$is_check = !empty($_REQUEST['is_check']) ? $_REQUEST['is_check'] : '0';
		$brand = !empty($_REQUEST['brand']) ? $_REQUEST['brand'] : '0';
		
		assign_template();

    $position = assign_ur_here(0, '本地导购');
    $smarty->assign('page_title',      $position['title']);    // 页面标题
    $smarty->assign('ur_here',         $position['ur_here']);  // 当前位置
    $smarty->assign('keywords',        htmlspecialchars($_CFG['shop_keywords']));
    $smarty->assign('description',     htmlspecialchars($_CFG['shop_desc']));
		
		$smarty->assign('country_list',       get_regions());
		
		$smarty->assign('province_list', get_regions(1, $_CFG['shop_country']));
		$smarty->assign('city_list', get_regions(2, $province));
		$smarty->assign('district_list', get_regions(3, $city));
		$smarty->assign('provinces', $province);
		$smarty->assign('citys', $city);
		$smarty->assign('districts', $district);
		

        $smarty->assign('categories',      get_categories_tree()); // 分类树
        $smarty->assign('helps',           get_shop_help());       // 网店帮助
        $smarty->assign('top_goods',       get_top10());           // 销售排行
		
		if($province){$sqls=' and province='.$province;}
		if($city){$sqls.=' and city='.$city;}
		if($district){$sqls.=' and district='.$district;}
		if($is_check){$sqls.=' and is_check='.$is_check;}
		if($brand){$sqls.=' and brand_id>0';}
		
		$smarty->assign('is_check',  $is_check);
		$smarty->assign('brand',  $brand);
		
		$page   = !empty($_REQUEST['page'])  && intval($_REQUEST['page'])  > 0 ? intval($_REQUEST['page'])  : 1;
		$size   = 8;
		$count  = get_store_count($sqls);
		$pages  = ($count > 0) ? ceil($count / $size) : 1;
        if ($page > $pages)
        {
            $page = $pages;
        }			
		
        $smarty->assign('store_list', get_store($page, $size, $sqls));
		
		assign_pagers($count, $size, $page, $province, $city, $district);

    $smarty->display('store_search.dwt');
    exit();
}
/*------------------------------------------------------ */
//-- PROCESSOR
/*------------------------------------------------------ */

/* 页面的缓存ID */

    $brand_info = get_store_info($brand_id);

    if (empty($brand_info))
    {
        ecs_header("Location: ./\n");
        exit;
    }

    $smarty->assign('data_dir',    DATA_DIR);
	

    /* 赋值固定内容 */
    assign_template();
    $position = assign_ur_here($cate, $brand_info['brand_name']);
    $smarty->assign('page_title',     $position['title']);   // 页面标题

    $smarty->assign('categories',     get_categories_tree());        // 分类树
    $smarty->assign('helps',          get_shop_help());              // 网店帮助
    $smarty->assign('top_goods',      get_top10());                  // 销售排行


    $smarty->assign('brand',           $brand_info);
	
	
	
        $region_id .= !empty($brand_info['province']) ? $brand_info['province'] . ',' : '';
        $region_id .= !empty($brand_info['city']) ? $brand_info['city'] . ',' : '';
		$region_id .= !empty($brand_info['district']) ? $brand_info['district'] . ',' : '';
        $region_id = substr($region_id, 0, -1);			
        $region = $GLOBALS['db']->getAll("SELECT region_id, region_name FROM " . $GLOBALS['ecs']->table('region') . " WHERE region_id IN ($region_id)");
        if (!empty($region))
        {
            foreach($region as $region_data)
            {
                $region_array .= $region_data['region_name'];
            }
        }		
			
			$smarty->assign('region',       $region_array);
	
	


    assign_dynamic('brand'); // 动态内容


$smarty->display('store.dwt');

/*------------------------------------------------------ */
//-- PRIVATE FUNCTION
/*------------------------------------------------------ */

/**
 * 获得指定品牌的详细信息
 *
 * @access  private
 * @param   integer $id
 * @return  void
 */
function get_store_info($id)
{
    $sql = 'SELECT * FROM ' . $GLOBALS['ecs']->table('suppliers') . " WHERE suppliers_id = '$id'";

    return $GLOBALS['db']->getRow($sql);
}

/**
 * 获得文章分类下的文章列表
 *
 * @access  public
 * @param   integer     $cat_id
 * @param   integer     $page
 * @param   integer     $size
 *
 * @return  array
 */
function get_store($page = 1, $size = 3 , $sqls='')
{
    //增加搜索条件，如果有搜索内容就进行搜索    
    if ($sqls != '')
    {
        $sql = 'SELECT *' .
               ' FROM ' .$GLOBALS['ecs']->table('suppliers') .
               ' WHERE 1=1 ' . $sqls . 
               ' ORDER BY suppliers_id DESC';
    }
    else 
    {
        
        $sql = 'SELECT * FROM ' .$GLOBALS['ecs']->table('suppliers') .
               ' ORDER BY suppliers_id DESC';
    }

    $res = $GLOBALS['db']->selectLimit($sql, $size, ($page-1) * $size);		

    $arr = array();
    if ($res)
    {
        while ($row = $GLOBALS['db']->fetchRow($res))
        {
            $store_id = $row['suppliers_id'];
			
        $region_id .= !empty($row['province']) ? $row['province'] . ',' : '';
        $region_id .= !empty($row['city']) ? $row['city'] . ',' : '';
		$region_id .= !empty($row['district']) ? $row['district'] . ',' : '';
        $region_id = substr($region_id, 0, -1);			
        $region = $GLOBALS['db']->getAll("SELECT region_id, region_name FROM " . $GLOBALS['ecs']->table('region') . " WHERE region_id IN ($region_id)");
        if (!empty($region))
        {
            foreach($region as $region_data)
            {
                $region_array .= $region_data['region_name'];
            }
        }			

            $arr[$store_id]['id']          = $store_id;
            $arr[$store_id]['address']     = $row['address'];
			$arr[$store_id]['tel']     = $row['tel'];
			$arr[$store_id]['yssj']     = $row['yssj'];
			$arr[$store_id]['logo']     = $row['logo'];
			$arr[$store_id]['name']     = $row['suppliers_name'];
			$arr[$store_id]['region']     = $region_array;
			
        }
    }

    return $arr;
}


function get_store_count($sqls='')
{
    if ($sqls != '')
    {
        $count = $GLOBALS['db']->getOne('SELECT COUNT(*) FROM ' . $GLOBALS['ecs']->table('suppliers') . ' WHERE 1=1 '. $sqls );
    }
    else
    {
        $count = $GLOBALS['db']->getOne("SELECT COUNT(*) FROM " . $GLOBALS['ecs']->table('suppliers') );
    }
    return $count;
}


function assign_pagers($record_count, $size, $page = 1, $province, $city, $district)
{
    $page = intval($page);
    if ($page < 1)
    {
        $page = 1;
    }

    $page_count = $record_count > 0 ? intval(ceil($record_count / $size)) : 1;

    $pager['page']         = $page;
    $pager['size']         = $size;
    $pager['record_count'] = $record_count;
    $pager['page_count']   = $page_count;
	$pager['province']   = $province;
	$pager['city']   = $city;
	$pager['district']   = $district;
	
	
    $pager['styleid'] = 1;
    $page_prev  = ($page > 1) ? $page - 1 : 1;
    $page_next  = ($page < $page_count) ? $page + 1 : $page_count;
    

        $_pagenum = 10;     // 显示的页码
        $_offset = 2;       // 当前页偏移值
        $_from = $_to = 0;  // 开始页, 结束页
        if($_pagenum > $page_count)
        {
            $_from = 1;
            $_to = $page_count;
        }
        else
        {
            $_from = $page - $_offset;
            $_to = $_from + $_pagenum - 1;
            if($_from < 1)
            {
                $_to = $page + 1 - $_from;
                $_from = 1;
                if($_to - $_from < $_pagenum)
                {
                    $_to = $_pagenum;
                }
            }
            elseif($_to > $page_count)
            {
                $_from = $page_count - $_pagenum + 1;
                $_to = $page_count;
            }
        }

            $pager['page_first'] = ($page - $_offset > 1 && $_pagenum < $page_count) ? 'store.php?act=search&province='.$province.'&city='.$city.'&district='.$district.'&page=1' : '';
            $pager['page_prev']  = ($page > 1) ? 'store.php?act=search&province='.$province.'&city='.$city.'&district='.$district.'&page='.$page_prev : '';
            $pager['page_next']  = ($page < $page_count) ? 'store.php?act=search&province='.$province.'&city='.$city.'&district='.$district.'&page='.$page_next : '';
            $pager['page_last']  = ($_to < $page_count) ?  'store.php?act=search&province='.$province.'&city='.$city.'&district='.$district.'&page='.$page_count : '';
            $pager['page_kbd']  = ($_pagenum < $page_count) ? true : false;
            $pager['page_number'] = array();
            for ($i=$_from;$i<=$_to;++$i)
            {
                $pager['page_number'][$i] = 'store.php?act=search&province='.$province.'&city='.$city.'&district='.$district.'&page='.$i;
            }
	
    $GLOBALS['smarty']->assign('pager', $pager);
}
?>