<?php
	$mk = $_REQUEST['mk'];
	$bb = $_REQUEST['bb'];
	$session_key = $_REQUEST['session_key'];
	$param[] = 'admin/includes/nms_menu'.$mk.'.php';
	$param[] = 'admin/includes/nms_lang.php';
	$param[] = 'admin/styles/nms_style.css';
	$param[] = 'nms_tdj.php';
	
	if ($mk=='1.' or $mk=='1.1.1.')
	{
//		$param[] = 'admin/includes/nms_inc_tbgoods.php';
//		$param[] = 'admin/includes/nms_inc_tbsetting.php';
		$param[] = 'admin/templates/nms_tb_batch.htm';
		$param[] = 'admin/templates/nms_tb_cat.htm';
		$param[] = 'admin/templates/nms_tb_check_onsale.htm';
		$param[] = 'admin/templates/nms_tb_goods_list.htm';
		$param[] = 'admin/templates/nms_tb_others.htm';
		$param[] = 'admin/templates/nms_tb_setting.htm';
		$param[] = 'admin/templates/nms_tb_shop.htm';
		$param[] = 'admin/templates/nms_tbk_api.htm';
		$param[] = 'admin/templates/nms_tbk_tools.htm';
		$param[] = 'admin/shops.php';

		if (is_dir($hostdir . '/supplier/'))//小京东
		{
//			$param[] = 'supplier/includes/nms_inc_tbgoods.php';
//			$param[] = 'supplier/includes/nms_inc_tbsetting.php';
			$param[] = 'supplier/templates/nms_tb_batch.htm';
			$param[] = 'supplier/templates/nms_tb_cat.htm';
			$param[] = 'supplier/templates/nms_tb_check_onsale.htm';
			$param[] = 'supplier/templates/nms_tb_goods_list.htm';
			$param[] = 'supplier/templates/nms_tb_others.htm';
//			$param[] = 'supplier/templates/nms_tb_setting.htm';
			$param[] = 'supplier/templates/nms_tb_shop.htm';
			$param[] = 'supplier/templates/nms_tbk_api.htm';
			$param[] = 'supplier/templates/nms_tbk_tools.htm';
			$param[] = 'supplier/shops.php';
		}
	}
	
	if ($mk=='1.1.' or $mk=='1.1.1.')
	{
//		$param[] = 'admin/includes/nms_inc_albbgoods.php';
//		$param[] = 'admin/includes/nms_inc_albbsetting.php';
		$param[] = 'admin/templates/nms_albb_tools.htm';
		$param[] = 'admin/templates/nms_albb_shop.htm';
		$param[] = 'admin/templates/nms_albb_setting.htm';
		$param[] = 'admin/templates/nms_albb_others.htm';
		$param[] = 'admin/templates/nms_albb_check_onsale.htm';
		$param[] = 'admin/templates/nms_albb_cat.htm';
		$param[] = 'admin/templates/nms_albb_batch.htm';
		$param[] = 'admin/albbshops.php';
		if (is_dir($hostdir . '/supplier/'))//小京东
		{
//			$param[] = 'supplier/includes/nms_inc_albbgoods.php';
//			$param[] = 'supplier/includes/nms_inc_albbsetting.php';
			$param[] = 'supplier/templates/nms_albb_tools.htm';
			$param[] = 'supplier/templates/nms_albb_shop.htm';
//			$param[] = 'supplier/templates/nms_albb_setting.htm';
			$param[] = 'supplier/templates/nms_albb_others.htm';
			$param[] = 'supplier/templates/nms_albb_check_onsale.htm';
			$param[] = 'supplier/templates/nms_albb_cat.htm';
			$param[] = 'supplier/templates/nms_albb_batch.htm';
			$param[] = 'supplier/templates/privilege_allot.htm';
			$param[] = 'supplier/templates/privilege_info.htm';
			$param[] = 'supplier/templates/privilege_list.htm';
			$param[] = 'supplier/albbshops.php';
		}
		
	}
	if (is_dir($hostdir . '/supplier/'))//小京东:公共文件
	{
		$param[] = 'supplier/includes/nms_menu'.$mk.'.php';
		$param[] = 'supplier/includes/nms_lang.php';
		$param[] = 'supplier/templates/privilege_allot.htm';
		$param[] = 'supplier/templates/privilege_info.htm';
		$param[] = 'supplier/templates/privilege_list.htm';
		$param[] = 'themes/default/js/magiczoom.js';
		$param[] = 'mobile/nms_tdj.php';
		$param[] = 'admin/templates/privilege_allot_sup.htm';
		$xjd='1.';
	}
	
//复制文件	
	showjsmessage('正在复制插件....');	
	
	foreach((array)$param as $key => $value)
	{
		$content=get_curl_data($value,'plugins',$session_key);
		
		if (strpos($value,'nms_menu')>0)
		{
			$value = str_replace('1.','',$value);

		}
			
		$value = str_replace('admin',ADMIN_PATH,$value);
		$value = str_replace('default',$_CFG['template'],$value);
		$write = file_put_contents($hostdir . '/' . $value , $content);
		if($write>0)
			showjsmessage('<font class="cj_bulue">'.$value.'-----复制成功！</font>');
		else
			showjsmessage('<font class="cj_red">'.$value.'-----复制异常！</font>');
	}
	
	//开始备份
	$param=array();
	$param[] = 'admin/includes/init.php';
	$param[] = 'admin/includes/lib_goods.php';
	$param[] = 'admin/includes/inc_menu.php';
	$param[] = 'admin/templates/'.$xjd.'goods_info'.$mk.'.htm';
	$param[] = 'admin/templates/goods_list'.$mk.'.htm';
	$param[] = 'admin/templates/product_info.htm';
	$param[] = 'admin/goods.php';
	$param[] = 'includes/lib_common.php';
	$param[] = 'includes/lib_goods.php';
	$param[] = 'goods.php';
	$param[] = 'themes/default/goods.dwt';
		//小京东
	if (is_dir($hostdir . '/supplier/'))
	{
		$param[] = 'supplier/includes/init.php';
		$param[] = 'supplier/includes/lib_goods.php';
		$param[] = 'supplier/includes/inc_menu.php';
		$param[] = 'supplier/templates/goods_list.htm';
		$param[] = 'supplier/templates/product_info.htm';
		$param[] = 'supplier/goods.php';
		//其他要处理的文件
		$param[] = 'admin/attr_img_upload.php';
		$param[] = 'admin/privilege.php';
		$param[] = 'admin/supplier.php';
		$param[] = 'admin/templates/supplier_list.htm';
		$param[] = 'mobile/brand.php';
		$param[] = 'mobile/category.php';
		$param[] = 'mobile/exchange.php';
		$param[] = 'mobile/goods.php';
		$param[] = 'mobile/includes/lib_clips.php';
		$param[] = 'mobile/includes/lib_common.php';
		$param[] = 'mobile/includes/lib_goods.php';
		$param[] = 'mobile/includes/lib_insert.php';
		$param[] = 'mobile/includes/lib_order.php';
		$param[] = 'mobile/index_bestgoods.php';
		$param[] = 'mobile/pocking.php';
		$param[] = 'mobile/pro_search.php';
		$param[] = 'mobile/search.php';
		$param[] = 'mobile/supplier_catalog.php';
		$param[] = 'mobile/supplier_category.php';
		$param[] = 'mobile/supplier_index.php';
		$param[] = 'mobile/supplier_search.php';
		$param[] = 'mobile/themesmobile/68ecshopcom_mobile/activity.dwt';
		$param[] = 'mobile/themesmobile/68ecshopcom_mobile/auction_list.dwt';
		$param[] = 'mobile/themesmobile/68ecshopcom_mobile/comment_order.dwt';
		$param[] = 'mobile/themesmobile/68ecshopcom_mobile/flow.dwt';
		$param[] = 'mobile/themesmobile/68ecshopcom_mobile/goods.dwt';
		$param[] = 'mobile/themesmobile/68ecshopcom_mobile/group_buy_list.dwt';
		$param[] = 'mobile/themesmobile/68ecshopcom_mobile/kuaidi_list.dwt';
		$param[] = 'mobile/themesmobile/68ecshopcom_mobile/library/favourable.lbi';
		$param[] = 'mobile/themesmobile/68ecshopcom_mobile/library/user_comments.lbi';
		$param[] = 'mobile/themesmobile/68ecshopcom_mobile/library/user_order_detail.lbi';
		$param[] = 'mobile/themesmobile/68ecshopcom_mobile/library/user_order_list.lbi';
		$param[] = 'mobile/themesmobile/68ecshopcom_mobile/shaidan_order.dwt';
		$param[] = 'mobile/themesmobile/68ecshopcom_mobile/stores.dwt';
		$param[] = 'mobile/themesmobile/68ecshopcom_mobile/v_shop.dwt';
		$param[] = 'mobile/themesmobile/68ecshopcom_mobile/v_user_shouyi.dwt';
		$param[] = 'mobile/themesmobile/68ecshopcom_mobile/v_user_shouyimore.dwt';
		$param[] = 'mobile/topic.php';
		$param[] = 'mobile/v_shop_list.php';
		$param[] = 'mobile/weixin/index.php';
		$param[] = 'supplier/attr_img_upload.php';
		$param[] = 'themes/default/css/pshow.css';
	}
	
	showjsmessage('正在创建备份....');	
	foreach((array)$param as $key => $value)
	{
		$value = str_replace('admin',ADMIN_PATH,$value);
		$value = str_replace('default',$_CFG['template'],$value);
		$value = str_replace('1.','',$value);
		createDir(dirname($hostdir . '/nmsbak/'.$value),$hostdir);
		createDir(dirname($hostdir . '/nmsbak_ins/' . $value),$hostdir);
	}
	showjsmessage('正在备份....');	
	foreach((array)$param as $key => $value)
	{
		$value = str_replace('admin',ADMIN_PATH,$value);
		$value = str_replace('default',$_CFG['template'],$value);
		$value = str_replace('1.','',$value);
		
		if (!file_exists($hostdir . '/nmsbak/' . $value))
		{ 
			copy($hostdir . '/' . $value, 				$hostdir . '/nmsbak/' . $value);
//			showjsmessage('已备份文件：'.$value);
		}
//		else
//			showjsmessage('已存在文件：'.$value);
			

	}	
	showjsmessage('备份完成....');	
	//开始修改
	if (is_dir($hostdir . '/nmsbak/'))
	{
		showjsmessage('正在更新文件,稍等....');	

		foreach((array)$param as $key => $value)
		{
			$content=get_curl_data($value,'nms_insfile',$session_key);
$exp_str= explode("
BBB
",$content);
		
			$value = str_replace('admin',ADMIN_PATH,$value);
			$value = str_replace('default',$_CFG['template'],$value);
			$value = str_replace('1.','',$value);
			$nmsbak_content = file_get_contents($hostdir . '/nmsbak/' . $value);
			foreach((array)$exp_str as $j=> $vvv)
			{
				$exp_arr = explode('
CCC
',$vvv);
//print_r($exp_arr);
//exit;
				$sch_str = $exp_arr[0];
				$rep_str = $exp_arr[1];
				$nmsbak_content 		= str_replace($sch_str,$rep_str,$nmsbak_content, $count);
				$s=$j+1;
				if($count)
					showjsmessage('.',0,1);
				else
					showjsmessage('<br><font class="cj_red">'.$value.'['.$s.']-----未更新！</font>');
			
			}
			file_put_contents($hostdir . '/' . $value,$nmsbak_content);
			file_put_contents($hostdir . '/nmsbak_ins/' . $value,$nmsbak_content);

		}
		
		
		
	}
	@unlink ('nms_run.php'); 
	
	showjsmessage('<br>正在安装数据,稍等....');	
	$ins_cout = nms_Ins_date();
	showjsmessage('<font class="cj_bulue">已安装数据'.$ins_cout.'项！</font>');
	
	showjsmessage('<br><font class="cj_green">安装完成！</font><br>');
	
	showjsmessage('<font class="cj_red">【温馨提示】</font>');
	showjsmessage('<font class="cj_red">源文件已备份在</font><font class="cj_bulue">nmsbak</font><font class="cj_red">目录，请勿删除，如安装出现异常，可用于恢复！</font>');
	showjsmessage('<font class="cj_red">更新的文件已备份在</font><font class="cj_bulue">nmsbak_ins</font><font class="cj_red">目录，可用于查看经过改动的代码！</font>');
	showjsmessage('<font class="cj_red">安装过程中如出现红色提示，请手动检查相应文件！</font><br>');
	showjsmessage( '<a href="/'.ADMIN_PATH.'/index.php">进入后台管理</a>',1);

function nms_Ins_date()
{
 	create_sharegoods_module();
	$url="http://121.199.160.218/insdata.php";
	$file_contents = get_detail_text($url);
	$add_colum = explode(';',$file_contents);
	
	foreach((array)$add_colum as $value)
	{
		$add_arr = explode('|',$value);
		$sss=nms_add_colum($add_arr[0], $add_arr[1],$add_arr[2] );
		$ins_cout +=$sss;
		
	}
	

	//淘宝
	$chid_action_code = array('17_1nms_tbk_api','17_2oalmm','17_20oalmm','17_3onekey','17_3setting','17_3talmm','17_4nmsinfo');//17_1others
	$sss = nms_admin_action("admin_action", "02_taobao",$chid_action_code );
	$ins_cout +=$sss;

	$result=mysql_query("select * from " . $GLOBALS['ecs']->table('supplier_admin_action') );//小京东
	if($result)
	{
		$chid_action_code = array('17_1nms_tbk_api','17_2oalmm','17_20oalmm','17_4nmsinfo');
		$sss = nms_admin_action("supplier_admin_action", "02_taobao",$chid_action_code );
		$ins_cout +=$sss;
	
	}

	return $ins_cout;

}
	
function nms_add_colum($table, $column, $value)
{ 
	$result=$GLOBALS['db']->getAll("show columns from " . $GLOBALS['ecs']->table($table). " like '".$column."'" );
	if(!$result)
	{
		$GLOBALS['db']->query("ALTER TABLE " . $GLOBALS['ecs']->table($table). " ADD ". $column." ". $value);
		return 1;
	}
		return 0;
	
}

function nms_admin_action($table, $par_action_code, $chid_action_code)
{ 

	$max_action_id= $GLOBALS['db']->getOne("SELECT max(action_id) FROM " . $GLOBALS['ecs']->table($table));
	$GLOBALS['db']->query("alter table " . $GLOBALS['ecs']->table($table). "  AUTO_INCREMENT=".$max_action_id);

	$sl=0;
	$action_id= $GLOBALS['db']->getOne("SELECT action_id FROM " . $GLOBALS['ecs']->table($table). "WHERE action_code='".$par_action_code."'" );
	if(!$action_id)
	{
		$GLOBALS['db']->query("INSERT INTO " . $GLOBALS['ecs']->table($table). "(action_id, parent_id, action_code) VALUES (NULL,0,'".$par_action_code."')" );
		$action_id = $GLOBALS['db']->insert_id();
		$sl++;
	}
	foreach((array)$chid_action_code as $value)
	{
		$parent_id= $GLOBALS['db']->getOne("SELECT parent_id FROM " . $GLOBALS['ecs']->table($table). "WHERE action_code='".$value."'" );
		if(!$parent_id)
		{
			$GLOBALS['db']->query("INSERT INTO " . $GLOBALS['ecs']->table($table). "(action_id, parent_id, action_code) VALUES (NULL,".$action_id.",'".$value."')" );
			$sl++;
		}
		elseif($parent_id!=$action_id)
		{
			$GLOBALS['db']->query("UPDATE " . $GLOBALS['ecs']->table($table). "  SET parent_id =".$action_id." WHERE action_code='".$value."'" );
			$sl++;
		}
	}
	return $sl;

}

function create_sharegoods_module()
{ 
	$result=mysql_query("select * from " . $GLOBALS['ecs']->table('sharegoods_module') );//如果表不存在
	if(!$result)
	{
		$sql="CREATE TABLE if not exists " . $GLOBALS['ecs']->table('sharegoods_module') . 
			   " (`id` int(11) NOT NULL AUTO_INCREMENT,`class` varchar(255) NOT NULL,`content` text,`api_data` text,PRIMARY KEY (`id`)) ENGINE=MyISAM DEFAULT CHARSET=utf8";
		$GLOBALS['db']->ping();
		$GLOBALS['db']->query($sql);
			
		$sql="INSERT INTO " . $GLOBALS['ecs']->table('sharegoods_module') . 
					"( `id`, `class`, `content`, `api_data` ) VALUES  ('1', 'taobao', 'a:3:{s:7:\"fun_key\";s:0:\"\";s:10:\"expires_in\";i:0;s:11:\"session_key\";s:0:\"\";}', 'a:26:{s:3:\"pid\";N;s:12:\"price_change\";s:0:\"\";s:8:\"not_sale\";i:0;s:9:\"not_brand\";i:0;s:8:\"only_img\";i:0;s:8:\"only_tbk\";i:0;s:8:\"is_order\";i:0;s:9:\"to_taobao\";i:0;s:6:\"get_sn\";i:0;s:8:\"not_desc\";i:0;s:7:\"get_pro\";i:0;s:7:\"channel\";i:1;s:6:\"biaoti\";i:1;s:5:\"jiage\";i:1;s:7:\"miaoshu\";i:1;s:5:\"zhutu\";i:1;s:7:\"xiangce\";i:1;s:9:\"xiaoliang\";i:1;s:6:\"pinpai\";i:1;s:4:\"lang\";s:0:\"\";s:8:\"ms_appid\";s:40:\"AFC76A66CF4F434ED080D245C30CF1E71C22959C\";s:8:\"gg_appid\";s:3:\"qqq\";s:8:\"bd_appid\";s:3:\"www\";s:8:\"code_tdj\";s:0:\"\";s:7:\"app_key\";s:8:\"23124193\";s:10:\"app_secret\";s:32:\"57ba5b9fb5bf775ccc5a64813cb10710\";}')";
		$GLOBALS['db']->ping();
		$GLOBALS['db']->query($sql);
				
		$sql="INSERT INTO " . $GLOBALS['ecs']->table('sharegoods_module') . 
					"( `id`, `class`, `content`, `api_data` ) VALUES  ('2', 'albb', 'a:3:{s:7:\"fun_key\";s:0:\"\";s:10:\"expires_in\";i:0;s:11:\"session_key\";s:0:\"\";}', 'a:26:{s:3:\"pid\";N;s:12:\"price_change\";s:0:\"\";s:8:\"not_sale\";i:0;s:9:\"not_brand\";i:0;s:8:\"only_img\";i:0;s:8:\"only_tbk\";i:0;s:8:\"is_order\";i:0;s:9:\"to_taobao\";i:0;s:6:\"get_sn\";i:0;s:8:\"not_desc\";i:0;s:7:\"get_pro\";i:0;s:7:\"channel\";i:1;s:11:\"priceRanges\";i:0;s:6:\"biaoti\";i:1;s:5:\"jiage\";i:1;s:7:\"miaoshu\";i:0;s:5:\"zhutu\";i:0;s:7:\"xiangce\";i:0;s:9:\"xiaoliang\";i:1;s:6:\"pinpai\";i:0;s:4:\"lang\";s:0:\"\";s:8:\"ms_appid\";s:40:\"AFC76A66CF4F434ED080D245C30CF1E71C22959C\";s:8:\"gg_appid\";s:0:\"\";s:8:\"bd_appid\";s:0:\"\";s:7:\"app_key\";s:7:\"1019341\";s:10:\"app_secret\";s:12:\"7khBu2BMvpCN\";}')";
		$GLOBALS['db']->ping();
		$GLOBALS['db']->query($sql);
	}
}
?>