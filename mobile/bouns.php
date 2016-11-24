<?php
define('IN_ECS', true);
define('ECS_ADMIN', true);

require(dirname(__FILE__) . '/includes/init.php');


$act = isset($_GET['act']) ? $_GET['act'] : '';

if ($act == 'add'){
	
	if (!empty($_REQUEST['type_id']))
	{
    $type_id = intval($_REQUEST['type_id']);
	}
	
	$user_id = $_SESSION['user_id'];
	
	if(!$user_id){		
		$smarty->display('login.dwt');
		//header("location: http://www.baidu.com");
		ecs_header("Location: user.php?act=login&gourl=bouns.php\n");
		exit;
	}
	
	$sql = "SELECT * FROM " .$GLOBALS['ecs']->table('user_bonus') . " WHERE user_id= ".$user_id." and bonus_type_id= ".$type_id;
	$res = $GLOBALS['db']->getOne($sql);
	if($res){
		    $tips = '<br><br>您已经领取过该红包了<br><br><a href="javascript:history.back()" class=red>返回上一页</a>';
            $smarty->assign('tips', $tips);
            $smarty->display('message.dwt');
			exit;
	}
	
	$sql = "SELECT bonus_sn FROM " .$GLOBALS['ecs']->table('user_bonus') . " WHERE user_id=0 and bonus_type_id= ".$type_id." ORDER BY rand() ";
	$res = $GLOBALS['db']->getOne($sql);	
	include_once(ROOT_PATH . 'includes/lib_transaction.php');
	if (add_bonus($user_id, $res))
    {
		    $tips = '<br><br>红包领取成功<br><br><a href="javascript:history.back()" class=red>返回上一页</a>';
            $smarty->assign('tips', $tips);
            $smarty->display('message.dwt');
    }
	
	exit;
}

if (empty($action))
{				
		$timen=time();
		
		$bonus_num = $db->getOne("SELECT COUNT(*) FROM " . $ecs->table('bonus_type') ." where send_type=3 and  use_start_date < ".$timen ." and use_end_date > ".$timen  );
		$page_num = '10';
		$page = !empty($_GET['page']) ? intval($_GET['page']) : 1;
		$pages = ceil($bonus_num / $page_num);
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
		$pagebar = get_wap_pager($bonus_num, $page_num, $page, 'bonus.php', 'page');
		$smarty->assign('pagebar', $pagebar);
		
		$bonus_array = get_bonus($page, $page_num);
		
		$smarty->assign('bonus_list', $bonus_array);
		$smarty->assign('footer', get_footer());
		$smarty->display('bonus_list.dwt');
		exit;
}


function get_bonus($page = 1, $size = 3 , $sqls='')
{
    $timen=time();
	
	$user_id = $_SESSION['user_id'];
	//增加搜索条件，如果有搜索内容就进行搜索    
    if ($sqls != '')
    {
        $sql = 'SELECT *' .
               ' FROM ' .$GLOBALS['ecs']->table('bonus_type') .
               ' WHERE send_type=3 and  use_start_date < '.$timen .' and use_end_date > '.$timen . $sqls ;
    }
    else 
    {
        
        $sql = 'SELECT * FROM ' .$GLOBALS['ecs']->table('bonus_type') .' where send_type=3 and  use_start_date < '.$timen .' and use_end_date > '.$timen ;
    }
    $res = $GLOBALS['db']->selectLimit($sql, $size, ($page-1) * $size);		

    $arr = array();
    if ($res)
    {
        while ($row = $GLOBALS['db']->fetchRow($res))
        {
            $type_id = $row['type_id'];
			
            $arr[$type_id]= $row;			
			$arr[$type_id]['use_start_date'] = local_date($GLOBALS['_CFG']['date_format'], $row['use_start_date']);	
			$arr[$type_id]['use_end_date'] = local_date($GLOBALS['_CFG']['date_format'], $row['use_end_date']);				
			
			$sql = "SELECT bonus_type_id, COUNT(*) AS sent_count".
            " FROM " .$GLOBALS['ecs']->table('user_bonus') .
            " GROUP BY bonus_type_id";
			$res = $GLOBALS['db']->query($sql);
			$sent_arr = array();
			while ($rowa = $GLOBALS['db']->fetchRow($res))
			{
			   $sent_arr[$rowa['bonus_type_id']] = $rowa['sent_count'];
			}
			
			    /* 获得所有红包类型的发放数量 */
			$sql = "SELECT bonus_type_id, COUNT(*) AS used_count".
            " FROM " .$GLOBALS['ecs']->table('user_bonus') .
            " WHERE user_id> 0 ".
            " GROUP BY bonus_type_id";
			$res = $GLOBALS['db']->query($sql);

			$used_arr = array();
			while ($rowb = $GLOBALS['db']->fetchRow($res))
			{
			   $used_arr[$rowb['bonus_type_id']] = $rowb['used_count'];
			}
			
			$arr[$type_id]['send_count'] = isset($sent_arr[$row['type_id']]) ? $sent_arr[$row['type_id']] : 0;
			$arr[$type_id]['use_count'] = isset($used_arr[$row['type_id']]) ? $used_arr[$row['type_id']] : 0;
			$arr[$type_id]['type_money'] = floor($row['type_money']);
			
			
			$arr[$type_id]['zt']=0;
			
			if($user_id){
				
				
			$sql = "SELECT * FROM " .$GLOBALS['ecs']->table('user_bonus') . " WHERE user_id= ".$user_id." and bonus_type_id= ".$row['type_id'];
			$ress = $GLOBALS['db']->getOne($sql);
			if($ress){
				$arr[$type_id]['zt']=1;
			}else{
				$arr[$type_id]['zt']=0;
			}
			}
			
        }
    }
	

    return $arr;
}
?>