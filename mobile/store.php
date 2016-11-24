<?php
define('IN_ECS', true);
define('ECS_ADMIN', true);

require(dirname(__FILE__) . '/includes/init.php');
if ($_SESSION['user_id'] > 0)
{
	$smarty->assign('user_name', $_SESSION['user_name']);
}

if (!empty($_REQUEST['id']))
{
    $brand_id = intval($_REQUEST['id']);
}

if (empty($brand_id) and empty($action))
{		
		
		$province = !empty($_REQUEST['province']) ? $_REQUEST['province'] : '';
		$city = !empty($_REQUEST['city']) ? $_REQUEST['city'] : '';
		$city  = $_COOKIE['cookcityid'];
		$district = !empty($_REQUEST['district']) ? $_REQUEST['district'] : '';
		$is_check = !empty($_REQUEST['is_check']) ? $_REQUEST['is_check'] : '0';
		$brand = !empty($_REQUEST['brand']) ? $_REQUEST['brand'] : '0';
		
		
		$sqls='';
		$smarty->assign('country_list',       get_regions());		
		$smarty->assign('province_list', get_regions(1, $_CFG['shop_country']));
		$smarty->assign('city_list', get_regions(2));
		$smarty->assign('district_list', get_regions(3,$city));
		$smarty->assign('provinces', $province);
		$smarty->assign('citys', $city);
		$smarty->assign('districts', $district);
		
		
		if($province){$sqls=' and province='.$province;}
		if($city){$sqls.=' and city='.$city;}
		if($district){$sqls.=' and district='.$district;}
		if($is_check){$sqls.=' and is_check='.$is_check;}
		if($brand){$sqls.=' and brand_id>0';}
		$sqls = !empty($sqls) ? $sqls : '';
				
		$smarty->assign('is_check',  $is_check);
		$smarty->assign('brand',  $brand);
		
		$store_num = $db->getOne("SELECT COUNT(*) FROM " . $ecs->table('suppliers') ." where 1=1 ".$sqls  );
		$page_num = '10';
		$page = !empty($_GET['page']) ? intval($_GET['page']) : 1;
		$pages = ceil($store_num / $page_num);
		if ($page <= 0)
		{
			$page = 1;
		}
		if ($pages == 0)
		{
			$pages = 1;
		}
		if ($page > $pages)
		{
			$page = $pages;
		}
		$pagebar = get_wap_pager($store_num, $page_num, $page, 'store.php?province='.$province.'&city='.$city.'&district='.$district.'&brand='.$brand.'&is_check='.$is_check, 'page');
		$smarty->assign('pagebar', $pagebar);
		
		$store_array = get_store($page, $page_num, $sqls);
		
		$smarty->assign('store_list', $store_array);
		$smarty->assign('footer', get_footer());
		$smarty->assign('titleh',  '本地导购');
		$smarty->display('store_list.dwt');
		exit();
}



    $brand_info = get_store_info($brand_id);
	
	$smarty->assign('brand',           $brand_info);	
	
        $region_id = !empty($brand_info['province']) ? $brand_info['province'] . ',' : '';
        $region_id .= !empty($brand_info['city']) ? $brand_info['city'] . ',' : '';
		$region_id .= !empty($brand_info['district']) ? $brand_info['district'] . ',' : '';
        $region_id = substr($region_id, 0, -1);			
        $region = $GLOBALS['db']->getAll("SELECT region_id, region_name FROM " . $GLOBALS['ecs']->table('region') . " WHERE region_id IN ($region_id)");
        if (!empty($region))
        {
            $ri=0;
			foreach($region as $region_data)
            {
				$ri++;
				if ($ri==1){
				$region_array = $region_data['region_name'];	
				}else{
				$region_array .= $region_data['region_name'];
				}
            }
        }		
			
			$smarty->assign('region',       $region_array);
			//$smarty->assign('pictures',     get_store_gallery($brand_id));
			$smarty->assign('footer', get_footer());
			$smarty->assign('store', $brand_id);
			
			$smarty->assign('titleh',	   $brand_info['suppliers_name']);
			$smarty->display('storev.dwt');




function get_store_info($id)
{
    $sql = 'SELECT * FROM ' . $GLOBALS['ecs']->table('suppliers') . " WHERE suppliers_id = '$id'";

    return $GLOBALS['db']->getRow($sql);
}

function get_store($page = 1, $size = 3 , $sqls='')
{

    
	//增加搜索条件，如果有搜索内容就进行搜索    
    if ($sqls != '')
    {
        $sql = 'SELECT *' .
               ' FROM ' .$GLOBALS['ecs']->table('suppliers') .
               ' WHERE 1=1 ' . $sqls ;
    }
    else 
    {
        
        $sql = 'SELECT * FROM ' .$GLOBALS['ecs']->table('suppliers') ;
    }

    $res = $GLOBALS['db']->selectLimit ($sql, $size, ($page-1) * $size);		

    $arr = array();
    if ($res)
    {
        while ($row = $GLOBALS['db']->fetchRow($res))
        {
            $store_id = $row['suppliers_id'];
		
		
		$region_id = !empty($row['province']) ? $row['province'] . ',' : '';
        $region_id .= !empty($row['city']) ? $row['city'] . ',' : '';
		$region_id .= !empty($row['district']) ? $row['district'] . ',' : '';
        $region_id = substr($region_id, 0, -1);			
        $region = $GLOBALS['db']->getAll("SELECT region_id, region_name FROM " . $GLOBALS['ecs']->table('region') . " WHERE region_id IN ($region_id)");
        if (!empty($region))
        {
            $ri=0;
			foreach($region as $region_data)
            {
                $ri++;
				if ($ri==1){
				$region_array = $region_data['region_name'];	
				}else{
				$region_array .= $region_data['region_name'];
				}
            }
        }	

            $arr[$store_id]['id']          = $store_id;
            $arr[$store_id]['address']     = $row['address'];
			$arr[$store_id]['tel']     = $row['tel'];
			$arr[$store_id]['yssj']     = $row['yssj'];
			$arr[$store_id]['name']     = $row['suppliers_name'];
			$arr[$store_id]['region']     = $region_array;
			$arr[$store_id]['store_logo']     = $row['logo'];
			
			
        }
    }

    return $arr;
}

?>