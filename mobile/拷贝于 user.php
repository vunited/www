<?php

/**
 * ECSHOP 用户中心
 * ============================================================================
 * * 版权所有 2005-2012 上海商派网络科技有限公司，并保留所有权利。
 * 网站地址: http://www.ecshop.com；
 * ----------------------------------------------------------------------------
 * 这不是一个自由软件！您只能在不用于商业目的的前提下对程序代码进行修改和
 * 使用；不允许对程序代码以任何形式任何目的的再发布。
 * ============================================================================
 * $Author: liubo $
 * $Id: user.php 16643 2009-09-08 07:02:13Z liubo $
*/

define('IN_ECS', true);
define('ECS_ADMIN', true);

require(dirname(__FILE__) . '/includes/init.php');
/* 载入语言文件 */
require_once(ROOT_PATH . 'languages/' .$_CFG['lang']. '/user.php');
if ($_SESSION['user_id'] > 0)
{
	$smarty->assign('user_name', $_SESSION['user_name']);
}
$act = isset($_GET['act']) ? $_GET['act'] : '';
$user_id = $_SESSION['user_id'];

$smarty->assign('act', $act);
$smarty->assign('footer', get_footer());

/* 用户登陆 */
if ($act == 'do_login')
{
	$user_name = !empty($_POST['username']) ? $_POST['username'] : '';
	$pwd = !empty($_POST['pwd']) ? $_POST['pwd'] : '';
	$gourl = !empty($_POST['gourl']) ? $_POST['gourl'] : '';
	
	$remember = isset($_POST['remember']) ? $_POST['remember'] : 0;
	//记住用户名字
	
	if (empty($user_name) || empty($pwd))
	{
		ecs_header("Location:user.php\n");
		$login_faild = 1;
	}
	else
	{
		if ($user->check_user($user_name, $pwd) > 0)
		{
			$user->set_session($user_name);
			$user->set_cookie($user_name, $remember);
			update_user_info();
			//优化登陆跳转
			if($gourl){
				ecs_header("Location:$gourl\n");
				exit;
			}else{
				$sql = "SELECT COUNT(*) FROM " . $ecs->table('cart') . " WHERE session_id = '" . SESS_ID . "' " . "AND parent_id = 0 AND is_gift = 0 AND rec_type = 0";
				if ($db->getOne($sql) > 0){
					ecs_header("Location:cart.php\n");
					exit;
				}else{
					ecs_header("Location:user.php\n");
					exit;
				}
			}
		}
		else
		{
			$login_faild = 1;
		}
	}
	$smarty->assign('login_faild', $login_faild);
	$smarty->display('login.dwt');
	exit;
}


/* 用户登陆 */
if ($act == 'zhaohui')
{
	$smarty->display('zhaohui.dwt');
	exit;
}
if ($act == 'send_pwd_email')
{
	include_once(ROOT_PATH . 'includes/lib_passport.php');

    /* 初始化会员用户名和邮件地址 */
    $user_name = !empty($_POST['user_name']) ? trim($_POST['user_name']) : '';
    $email     = !empty($_POST['email'])     ? trim($_POST['email'])     : '';

    //用户名和邮件地址是否匹配
    $user_info = $user->get_user_info($user_name);

    if ($user_info && $user_info['email'] == $email)
    {
        //生成code
         //$code = md5($user_info[0] . $user_info[1]);

        $code = md5($user_info['user_id'] . $_CFG['hash_code'] . $user_info['reg_time']);
        //发送邮件的函数
        if (send_pwd_emails($user_info['user_id'], $user_name, $email, $code))
        {			
            $tips = '<br><br>邮件已经成功发送到 '.$email.' <br><br><a href="user.php" class=red>返回登陆</a>';
            $smarty->assign('tips', $tips);
            $smarty->display('message.dwt');
            exit;
        }
        else
        {
            //发送邮件出错
            $tips = '<br><br>发送邮件出错<br><br><a href="javascript:history.back()" class=red>返回上一页</a>';
            $smarty->assign('tips', $tips);
            $smarty->display('message.dwt');
            exit;
        }
    }
    else
    {
            //发送邮件出错
            $tips = '<br><br>用户名与邮件地址不匹配<br><br><a href="javascript:history.back()" class=red>返回上一页</a>';
            $smarty->assign('tips', $tips);
            $smarty->display('message.dwt');
            exit;
    }
	exit;
}

/* 微信用户自动登陆 */
elseif ($act == 'weixin_login')
{
	$user_name = !empty($_REQUEST['username']) ? $_GET['username'] : '';
	$pwd = !empty($_GET['pwd']) ? $_GET['pwd'] : '';
	$gourl = !empty($_GET['gourl']) ? $_GET['gourl'] : '';
	
	$remember = isset($_GET['remember']) ? $_GET['remember'] : 0;
	//记住用户名字
	if(!empty($remember)){
		setcookie("ECS[reuser_name]", $user_name, time() + 31536000, '/');
	}
	$reuser_name= isset($_COOKIE['ECS']['reuser_name']) ? $_COOKIE['ECS']['reuser_name'] : '';
	if(!empty($reuser_name)){
		$smarty->assign('reuser_name', $reuser_name);
	}
	
	if (empty($user_name) || empty($pwd))
	{
		ecs_header("Location:user.php\n");
		$login_faild = 1;
	}
	else
	{
		if ($user->check_user($user_name, $pwd) > 0)
		{
			$user->set_session($user_name);
			$user->set_cookie($user_name);
			update_user_info();
			//优化登陆跳转
			if($gourl){
				ecs_header("Location:$gourl\n");
				exit;
			}else{
				$sql = "SELECT COUNT(*) FROM " . $ecs->table('cart') . " WHERE session_id = '" . SESS_ID . "' " . "AND parent_id = 0 AND is_gift = 0 AND rec_type = 0";
				if ($db->getOne($sql) > 0){
					ecs_header("Location:cart.php\n");
					exit;
				}else{
					ecs_header("Location:user.php\n");
					exit;
				}
			}
		}
		else
		{
			$login_faild = 1;
		}
	}
	$smarty->assign('login_faild', $login_faild);
	$smarty->display('login.dwt');
	exit;
}
/* 我的红包列表 */
elseif ($act == 'bonus')
{
    include_once(ROOT_PATH .'includes/lib_transaction.php');

    $page = isset($_REQUEST['page']) ? intval($_REQUEST['page']) : 1;
    $record_count = $db->getOne("SELECT COUNT(*) FROM " .$ecs->table('user_bonus'). " WHERE user_id = '$user_id'");

		$page_num = '10';
		$page = !empty($_GET['page']) ? intval($_GET['page']) : 1;
		$pages = ceil($record_count / $page_num);
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
		$pagebar = get_wap_pager($record_count, $page_num, $page, 'user.php?act=bonus', 'page');		
		$smarty->assign('pagebar' , $pagebar);		
		$bonus = get_user_bouns_list($_SESSION['user_id'], $page_num, $page_num * ($page - 1));	
		$smarty->assign('bonus', $bonus);
		
    $smarty->display('user_bonus.dwt');
}
elseif ($act == 'act_add_bonus')
{
    include_once(ROOT_PATH . 'includes/lib_transaction.php');

    $bouns_sn = isset($_POST['bonus_sn']) ? intval($_POST['bonus_sn']) : '';

    if (add_bonus($user_id, $bouns_sn))
    {
            $tips = '<br><br>添加成功<br><br><a href="user.php?act=bonus" class=red>返回优惠券</a>';
            $smarty->assign('tips', $tips);
            $smarty->display('message.dwt');
            exit;
		
    }
    else
    {
            $tips = '<br><br>添加失败<br><br><a href="javascript:history.back()" class=red>返回上一页</a>';
            $smarty->assign('tips', $tips);
            $smarty->display('message.dwt');
            exit;
    }
}
elseif ($act == 'account_log')
{		
    include_once(ROOT_PATH . 'includes/lib_clips.php');

    $page = isset($_REQUEST['page']) ? intval($_REQUEST['page']) : 1;

    /* 获取记录条数 */
    $sql = "SELECT COUNT(*) FROM " .$ecs->table('user_account').
           " WHERE user_id = '$user_id'" .
           " AND process_type " . db_create_in(array(SURPLUS_SAVE, SURPLUS_RETURN));
    $record_count = $db->getOne($sql);

    //获取剩余余额
    $surplus_amount = get_user_surplus($user_id);
    if (empty($surplus_amount))
    {
        $surplus_amount = 0;
    }
	
		$page_num = '10';
		$page = !empty($_GET['page']) ? intval($_GET['page']) : 1;
		$pages = ceil($record_count / $page_num);
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
		$pagebar = get_wap_pager($record_count, $page_num, $page, 'user.php?act=account_log', 'page');		
		$smarty->assign('pagebar' , $pagebar);

    //获取余额记录
	$account_log = get_account_log($_SESSION['user_id'], $page_num, $page_num * ($page - 1));	
    //模板赋值
    $smarty->assign('surplus_amount', price_format($surplus_amount, false));	
	$smarty->assign('account_log',    $account_log);
	$smarty->display('user_account.dwt');
}
elseif ($act == 'cancel')
{
    include_once(ROOT_PATH . 'includes/lib_clips.php');

    $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
    if ($id == 0 || $user_id == 0)
    {
        ecs_header("Location: user.php?act=account_log\n");
        exit;
    }

    $result = del_user_account($id, $user_id);
    if ($result)
    {
        ecs_header("Location: user.php?act=account_log\n");
        exit;
    }
}
/* 会员通过帐目明细列表进行再付款的操作 */
elseif ($act == 'pay')
{
    include_once(ROOT_PATH . 'includes/lib_clips.php');
    include_once(ROOT_PATH . 'includes/lib_payment.php');
    include_once(ROOT_PATH . 'includes/lib_order.php');

    //变量初始化
    $surplus_id = isset($_GET['id'])  ? intval($_GET['id'])  : 0;
    $payment_id = isset($_GET['pid']) ? intval($_GET['pid']) : 0;

    if ($surplus_id == 0)
    {
        ecs_header("Location: user.php?act=account_log\n");
        exit;
    }

    //如果原来的支付方式已禁用或者已删除, 重新选择支付方式
    if ($payment_id == 0)
    {
        ecs_header("Location: user.php?act=account_deposit&id=".$surplus_id."\n");
        exit;
    }

    //获取单条会员帐目信息
    $order = array();
    $order = get_surplus_info($surplus_id);

    //支付方式的信息
    $payment_info = array();
    $payment_info = payment_info($payment_id);

    /* 如果当前支付方式没有被禁用，进行支付的操作 */
    if (!empty($payment_info))
    {
        //取得支付信息，生成支付代码
        $payment = unserialize_config($payment_info['pay_config']);

        //生成伪订单号
        $order['order_sn'] = $surplus_id;

        //获取需要支付的log_id
        $order['log_id'] = get_paylog_id($surplus_id, $pay_type = PAY_SURPLUS);

        $order['user_name']      = $_SESSION['user_name'];
        $order['surplus_amount'] = $order['amount'];

        //计算支付手续费用
        $payment_info['pay_fee'] = pay_fee($payment_id, $order['surplus_amount'], 0);

        //计算此次预付款需要支付的总金额
        $order['order_amount']   = $order['surplus_amount'] + $payment_info['pay_fee'];

        //如果支付费用改变了，也要相应的更改pay_log表的order_amount
        $order_amount = $db->getOne("SELECT order_amount FROM " .$ecs->table('pay_log')." WHERE log_id = '$order[log_id]'");
        if ($order_amount <> $order['order_amount'])
        {
            $db->query("UPDATE " .$ecs->table('pay_log').
                       " SET order_amount = '$order[order_amount]' WHERE log_id = '$order[log_id]'");
        }

        /* 调用相应的支付方式文件 */
        include_once(ROOT_PATH . 'includes/modules/payment/' . $payment_info['pay_code'] . '.php');

        /* 取得在线支付方式的支付按钮 */
        $pay_obj = new $payment_info['pay_code'];
        $payment_info['pay_button'] = $pay_obj->get_code($order, $payment);

        /* 模板赋值 */
        $smarty->assign('payment', $payment_info);
        $smarty->assign('order',   $order);
        $smarty->assign('pay_fee', price_format($payment_info['pay_fee'], false));
        $smarty->assign('amount',  price_format($order['surplus_amount'], false));
        $smarty->assign('action',  'act_account');
        $smarty->display('user_account.dwt');
    }
    /* 重新选择支付方式 */
    else
    {
        include_once(ROOT_PATH . 'includes/lib_clips.php');

        $smarty->assign('payment', get_online_payment_list());
        $smarty->assign('order',   $order);
        $smarty->assign('action',  'account_deposit');
        $smarty->display('user_account.dwt');
    }
}
elseif ($act == 'act_account')
{
    include_once(ROOT_PATH . 'includes/lib_clips.php');
    include_once(ROOT_PATH . 'includes/lib_order.php');
    $amount = isset($_POST['amount']) ? floatval($_POST['amount']) : 0;
    if ($amount <= 0)
    {
		    $tips = '<br><br>请在“金额”栏输入大于0的数字<br><br><a href="javascript:history.back()" class=red>返回上一页</a>';
            $smarty->assign('tips', $tips);
            $smarty->display('message.dwt');
            exit;
    }

    /* 变量初始化 */
    $surplus = array(
            'user_id'      => $user_id,
            'rec_id'       => !empty($_POST['rec_id'])      ? intval($_POST['rec_id'])       : 0,
            'process_type' => isset($_POST['surplus_type']) ? intval($_POST['surplus_type']) : 0,
            'payment_id'   => isset($_POST['payment_id'])   ? intval($_POST['payment_id'])   : 0,
            'user_note'    => isset($_POST['user_note'])    ? trim($_POST['user_note'])      : '',
            'amount'       => $amount
    );

    /* 退款申请的处理 */
    if ($surplus['process_type'] == 1)
    {
        /* 判断是否有足够的余额的进行退款的操作 */
        $sur_amount = get_user_surplus($user_id);
        if ($amount > $sur_amount)
        {
		    $tips = '<br><br>您要申请提现的金额超过了您现有的余额，此操作将不可进行<br><br><a href="javascript:history.back()" class=red>返回上一页</a>';
            $smarty->assign('tips', $tips);
            $smarty->display('message.dwt');
            exit;
        }

        //插入会员账目明细
        $amount = '-'.$amount;
        $surplus['payment'] = '';
        $surplus['rec_id']  = insert_user_account($surplus, $amount);

        /* 如果成功提交 */
        if ($surplus['rec_id'] > 0)
        {
		    $tips = '<br><br>您的提现申请已成功提交，请等待管理员的审核！<br><br><a href="user.php?act=account_log" class=red>返回帐户明细列表</a>';
            $smarty->assign('tips', $tips);
            $smarty->display('message.dwt');
            exit;
        }
        else
        {
		    $tips = '<br><br>此次操作失败，请返回重试！<br><br><a href="javascript:history.back()" class=red>返回上一页</a>';
            $smarty->assign('tips', $tips);
            $smarty->display('message.dwt');
            exit;
        }
    }
    /* 如果是会员预付款，跳转到下一步，进行线上支付的操作 */
    else
    {
        if ($surplus['payment_id'] <= 0)
        {
		    $tips = '<br><br>请选择支付方式<br><br><a href="javascript:history.back()" class=red>返回上一页</a>';
            $smarty->assign('tips', $tips);
            $smarty->display('message.dwt');
            exit;
        }

        include_once(ROOT_PATH .'includes/lib_payment.php');

        //获取支付方式名称
        $payment_info = array();
        $payment_info = payment_info($surplus['payment_id']);
        $surplus['payment'] = $payment_info['pay_name'];

        if ($surplus['rec_id'] > 0)
        {
            //更新会员账目明细
            $surplus['rec_id'] = update_user_account($surplus);
        }
        else
        {
            //插入会员账目明细
            $surplus['rec_id'] = insert_user_account($surplus, $amount);
        }

        //取得支付信息，生成支付代码
        $payment = unserialize_config($payment_info['pay_config']);

        //生成伪订单号, 不足的时候补0
        $order = array();
        $order['order_sn']       = $surplus['rec_id'];
        $order['user_name']      = $_SESSION['user_name'];
        $order['surplus_amount'] = $amount;

        //计算支付手续费用
        $payment_info['pay_fee'] = pay_fee($surplus['payment_id'], $order['surplus_amount'], 0);

        //计算此次预付款需要支付的总金额
        $order['order_amount']   = $amount + $payment_info['pay_fee'];

        //记录支付log
        $order['log_id'] = insert_pay_log($surplus['rec_id'], $order['order_amount'], $type=PAY_SURPLUS, 0);

        /* 调用相应的支付方式文件 */
        include_once(ROOT_PATH . 'includes/modules/payment/' . $payment_info['pay_code'] . '.php');

        /* 取得在线支付方式的支付按钮 */
        $pay_obj = new $payment_info['pay_code'];
        $payment_info['pay_button'] = $pay_obj->get_code($order, $payment);

        /* 模板赋值 */
        $smarty->assign('payment', $payment_info);
        $smarty->assign('pay_fee', price_format($payment_info['pay_fee'], false));
        $smarty->assign('amount',  price_format($amount, false));
        $smarty->assign('order',   $order);
        $smarty->display('user_account.dwt');
    }
}
elseif ($act == 'account_detail')
{		
    include_once(ROOT_PATH . 'includes/lib_clips.php');

    $page = isset($_REQUEST['page']) ? intval($_REQUEST['page']) : 1;

    $account_type = 'user_money';

    /* 获取记录条数 */
    $sql = "SELECT COUNT(*) FROM " .$ecs->table('account_log').
           " WHERE user_id = '$user_id'" .
           " AND $account_type <> 0 ";
    $record_count = $db->getOne($sql);


		$page_num = '10';
		$page = !empty($_GET['page']) ? intval($_GET['page']) : 1;
		$pages = ceil($record_count / $page_num);
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
		$pagebar = get_wap_pager($record_count, $page_num, $page, 'user.php?act=account_detail', 'page');		
		$smarty->assign('pagebar' , $pagebar);

        //获取剩余余额
    $surplus_amount = get_user_surplus($user_id);
    if (empty($surplus_amount))
    {
        $surplus_amount = 0;
    }
	
	//获取余额记录
    $account_log = array();
    $sql = "SELECT * FROM " . $ecs->table('account_log') .
           " WHERE user_id = '$user_id'" .
           " AND $account_type <> 0 " .
           " ORDER BY log_id DESC";
    $res = $GLOBALS['db']->selectLimit($sql, $page_num, $page_num * ($page - 1));
    while ($row = $db->fetchRow($res))
    {
        $row['change_time'] = local_date($_CFG['date_format'], $row['change_time']);
        $row['type'] = $row[$account_type] > 0 ? $_LANG['account_inc'] : $_LANG['account_dec'];
        $row['user_money'] = price_format(abs($row['user_money']), false);
        $row['frozen_money'] = price_format(abs($row['frozen_money']), false);
        $row['rank_points'] = abs($row['rank_points']);
        $row['pay_points'] = abs($row['pay_points']);
        $row['short_change_desc'] = sub_str($row['change_desc'], 60);
        $row['amount'] = $row[$account_type];
        $account_log[] = $row;
    }
    //模板赋值
    $smarty->assign('surplus_amount', price_format($surplus_amount, false));	
	$smarty->assign('account_log',    $account_log);
	$smarty->display('user_account.dwt');
}
elseif ($act == 'account_raply')
{
	$smarty->display('user_account.dwt');
}
elseif ($act == 'account_deposit')
{
	include_once(ROOT_PATH . 'includes/lib_clips.php');
	$smarty->assign('payment', get_online_payment_list(false));
	$smarty->display('user_account.dwt');
}
elseif ($act == 'order_list')
{
	if(!$_SESSION['user_id']){		
		$smarty->display('login.dwt');
		exit;
	}
	
	$order = isset($_REQUEST['order']) ? intval($_REQUEST['order']) : -1;
	
	$orders=$order;
	if ($order!=-1){
		
		if ($order==1){}//2014-01-16 PM 直接记取条件 取消原 {$orders="1 and shipping_status<3";}//if ($order==1){$orders="1 and shipping_status<1";}
		if ($order==4){$orders="5 and shipping_status>0";}//{$orders="5 and shipping_status=1";}
		if ($order==6){$orders="5 and shipping_status=2";}
		if ($order==7){$orders="5 and shipping_status>0";}
    	$record_count = $db->getOne("SELECT COUNT(*) FROM " .$ecs->table('order_info'). " WHERE user_id = {$_SESSION['user_id']}  and order_status = $orders");
	}else{
		$record_count = $db->getOne("SELECT COUNT(*) FROM " .$ecs->table('order_info'). " WHERE user_id = {$_SESSION['user_id']}  ");	
	}	
	
	
	//$record_count = $db->getOne("SELECT COUNT(*) FROM " .$ecs->table('order_info'). " WHERE user_id = {$_SESSION['user_id']}");
	if ($record_count > 0){
		include_once(ROOT_PATH . 'includes/lib_transaction.php');
		$page_num = '10';
		$page = !empty($_GET['page']) ? intval($_GET['page']) : 1;
		$pages = ceil($record_count / $page_num);
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
		//$pagebar = get_wap_pager($record_count, $page_num, $page, 'user.php?act=order_list', 'page');		
		$pagebar = get_wap_pager($record_count, $page_num, $page, 'user.php?act=order_list&order='.$order, 'page');
		
		$smarty->assign('pagebar' , $pagebar);
		/* 订单状态 */
		$_LANG['os'][OS_UNCONFIRMED] = '未确认';
		$_LANG['os'][OS_CONFIRMED] = '已确认';
		$_LANG['os'][OS_SPLITED] = '已确认';
		$_LANG['os'][OS_SPLITING_PART] = '已确认';
		$_LANG['os'][OS_CANCELED] = '已取消';
		$_LANG['os'][OS_INVALID] = '无效';
		$_LANG['os'][OS_RETURNED] = '退货';

		$_LANG['ss'][SS_UNSHIPPED] = '未发货';
		$_LANG['ss'][SS_PREPARING] = '配货中';
		$_LANG['ss'][SS_SHIPPED] = '已发货';
		$_LANG['ss'][SS_RECEIVED] = '收货确认';
		$_LANG['ss'][SS_SHIPPED_PART] = '已发货(部分商品)';
		$_LANG['ss'][SS_SHIPPED_ING] = '配货中'; // 已分单

		$_LANG['ps'][PS_UNPAYED] = '未付款';
		$_LANG['ps'][PS_PAYING] = '付款中';
		$_LANG['ps'][PS_PAYED] = '已付款';
		$_LANG['cancel'] = '取消订单';
		$_LANG['pay_money'] = '付款';
		$_LANG['view_order'] = '查看订单';
		$_LANG['received'] = '确认收货';
		$_LANG['ss_received'] = '已完成';
		$_LANG['confirm_received'] = '你确认已经收到货物了吗？';
		$_LANG['confirm_cancel'] = '您确认要取消该订单吗？取消后此订单将视为无效订单';

		//$orders = get_user_orders($_SESSION['user_id'], $page_num, $page_num * ($page - 1));		
		$orders = get_user_orders($_SESSION['user_id'], $page_num, $page_num * ($page - 1), $orders);
		
		if (!empty($orders))
		{
			foreach ($orders as $key => $val)
			{
				$orders[$key]['total_fee'] = encode_output($val['total_fee']);
				
$sql = "select goods_name,goods_id,goods_number,goods_price from ".$GLOBALS['ecs']->table('order_goods')." where order_id=".$val['order_id']; 
$goods=$GLOBALS['db']->getAll($sql);
foreach ($goods as $keys => $vals)
{				
    $goods_thumb=$GLOBALS['db'] ->getOne("select goods_thumb from ".$GLOBALS['ecs']->table("goods")." where goods_id =".$vals['goods_id']);
	$goods[$keys]['goods_thumb'] = get_image_path($vals['goods_id'], $goods_thumb, true);
}
				//print_r($goods);
				$orders[$key]['goods']  = $goods;
				
			}
		}
		//$merge  = get_user_merge($_SESSION['user_id']);
		$smarty->assign('orders', $orders);		
	}
	$smarty->assign('order', $order);
	$smarty->display('order_list.dwt');
	exit;
}
/* 订单详情 */
elseif($act=='order_info'){
	if(!$_SESSION['user_id']){
		$smarty->display('login.dwt');
		exit;
	}
	$id= isset($_GET['id']) ? intval($_GET['id']) : 0;
	include_once(ROOT_PATH . 'includes/lib_transaction.php');
	include_once(ROOT_PATH . 'includes/lib_payment.php');
	include_once(ROOT_PATH . 'includes/lib_order.php');
	include_once(ROOT_PATH . 'includes/lib_clips.php');
	/* 订单详情 */
	$order = get_order_detail($id, $_SESSION['user_id']);

	if ($order === false)
	{
		exit("对不起，该订单不存在");
	}
	require_once(ROOT_PATH . 'languages/' .$_CFG['lang']. '/user.php');
	/* 订单商品 */
	$goods_list = order_goods2($id);
	if (empty($goods_list))
	{
	$tips = '<br><br>无效错误订单<br><br><a href=user.php?act=order_list class=red>返回我的订单</a>';
	$smarty->assign('tips', $tips);
	$smarty->display('order_done.dwt');
	exit();
	}
	foreach ($goods_list AS $key => $value)
	{
		$goods_list[$key]['market_price'] = price_format($value['market_price'], false);
		$goods_list[$key]['goods_price']  = price_format($value['goods_price'], false);
		$goods_list[$key]['subtotal']	 = price_format($value['subtotal'], false);
	}

	/* 订单 支付 配送 状态语言项 */
	$order['order_status'] = $_LANG['os'][$order['order_status']];
	$order['pay_status'] = $_LANG['ps'][$order['pay_status']];
	$order['shipping_status'] = $_LANG['ss'][$order['shipping_status']];
	$smarty->assign('order',	  $order);
	$smarty->assign('goods_list', $goods_list);
	$smarty->assign('lang',	   $_LANG);
	$smarty->display('order_info.dwt');
	exit();
}
/* 取消订单 */
elseif ($act == 'cancel_order')
{
	if(!$_SESSION['user_id']){
		$smarty->display('login.dwt');
		exit;
	}
	include_once(ROOT_PATH . 'includes/lib_transaction.php');
	include_once(ROOT_PATH . 'includes/lib_order.php');

	$order_id = isset($_GET['order_id']) ? intval($_GET['order_id']) : 0;
	if (cancel_order($order_id, $_SESSION['user_id']))
	{
		ecs_header("Location: user.php?act=order_list\n");
		exit;
	}
}
elseif ($act == 'comment')
{
	$smarty->display('commentu.dwt');
}
elseif ($act == 'add_comment')
{
    		/* 保存评论内容 */
		$sql = "INSERT INTO " .$GLOBALS['ecs']->table('feedback') .
			   "(user_id, user_name, user_email, msg_type, msg_title, msg_content, msg_time) VALUES " .
			   "('" .$user_id. "', '" .$_SESSION['user_name']. "', '" .$_SESSION['email']. "', '0', '" .$_POST['msg_title']."', '".$_POST['msg_content']."', ".gmtime().")";
		
		$result = $GLOBALS['db']->query($sql);
		if($result){
			$smarty->assign('info', '您的评论已成功发表!');
		}
		$smarty->display('commentu_success.dwt');
}


/* 确认收货 */
elseif ($act == 'affirm_received')
{
	if(!$_SESSION['user_id']){
		$smarty->display('login.dwt');
		exit;
	}
	include_once(ROOT_PATH . 'includes/lib_transaction.php');

	$order_id = isset($_GET['order_id']) ? intval($_GET['order_id']) : 0;
	$_LANG['buyer'] = '买家';
	if (affirm_received($order_id, $_SESSION['user_id']))
	{
		ecs_header("Location: user.php?act=order_list\n");
		exit;
	}

}

/* 个人资料页面 */
elseif ($act == 'profile')
{
	if(!$_SESSION['user_id']){
		$smarty->display('login.dwt');
		exit;
	}
    include_once(ROOT_PATH . 'includes/lib_transaction.php');
    $user_info = get_profile($user_id);
    /* 取出注册扩展字段 */
    $sql = 'SELECT * FROM ' . $ecs->table('reg_fields') . ' WHERE type < 2 AND display = 1 ORDER BY dis_order, id';
    $extend_info_list = $db->getAll($sql);

    $sql = 'SELECT reg_field_id, content ' .
           'FROM ' . $ecs->table('reg_extend_info') .
           " WHERE user_id = $user_id";
    $extend_info_arr = $db->getAll($sql);

    $temp_arr = array();
    foreach ($extend_info_arr AS $val)
    {
        $temp_arr[$val['reg_field_id']] = $val['content'];
    }

    foreach ($extend_info_list AS $key => $val)
    {
        switch ($val['id'])
        {
            case 1:     $extend_info_list[$key]['content'] = $user_info['msn']; break;
            case 2:     $extend_info_list[$key]['content'] = $user_info['qq']; break;
            case 3:     $extend_info_list[$key]['content'] = $user_info['office_phone']; break;
            case 4:     $extend_info_list[$key]['content'] = $user_info['home_phone']; break;
            case 5:     $extend_info_list[$key]['content'] = $user_info['mobile_phone']; break;
            default:    $extend_info_list[$key]['content'] = empty($temp_arr[$val['id']]) ? '' : $temp_arr[$val['id']] ;
        }
    }

    $smarty->assign('extend_info_list', $extend_info_list);

    /* 密码提示问题 */
    $smarty->assign('passwd_questions', $_LANG['passwd_questions']);

    $smarty->assign('profile', $user_info);
    $smarty->display('profile.dwt');
}
/* 个人资料页面 */
elseif ($act == 'profilepw')
{
	if(!$_SESSION['user_id']){
		$smarty->display('login.dwt');
		exit;
	}
    include_once(ROOT_PATH . 'includes/lib_transaction.php');
    $user_info = get_profile($user_id);
    /* 取出注册扩展字段 */
    $sql = 'SELECT * FROM ' . $ecs->table('reg_fields') . ' WHERE type < 2 AND display = 1 ORDER BY dis_order, id';
    $extend_info_list = $db->getAll($sql);

    $sql = 'SELECT reg_field_id, content ' .
           'FROM ' . $ecs->table('reg_extend_info') .
           " WHERE user_id = $user_id";
    $extend_info_arr = $db->getAll($sql);

    $temp_arr = array();
    foreach ($extend_info_arr AS $val)
    {
        $temp_arr[$val['reg_field_id']] = $val['content'];
    }

    foreach ($extend_info_list AS $key => $val)
    {
        switch ($val['id'])
        {
            case 1:     $extend_info_list[$key]['content'] = $user_info['msn']; break;
            case 2:     $extend_info_list[$key]['content'] = $user_info['qq']; break;
            case 3:     $extend_info_list[$key]['content'] = $user_info['office_phone']; break;
            case 4:     $extend_info_list[$key]['content'] = $user_info['home_phone']; break;
            case 5:     $extend_info_list[$key]['content'] = $user_info['mobile_phone']; break;
            default:    $extend_info_list[$key]['content'] = empty($temp_arr[$val['id']]) ? '' : $temp_arr[$val['id']] ;
        }
    }

    $smarty->assign('extend_info_list', $extend_info_list);

    /* 密码提示问题 */
    $smarty->assign('passwd_questions', $_LANG['passwd_questions']);

    $smarty->assign('profile', $user_info);
    $smarty->display('profilepw.dwt');
}
/* 修改个人资料的处理 */
elseif ($act == 'act_edit_profile')
{
	if(!$_SESSION['user_id']){
		$smarty->display('login.dwt');
		exit;
	}
    include_once(ROOT_PATH . 'includes/lib_transaction.php');
    $birthday = trim($_POST['birthdayYear']) .'-'. trim($_POST['birthdayMonth']) .'-'.
    trim($_POST['birthdayDay']);
    $email = trim($_POST['email']);
    $other['msn'] = $msn = isset($_POST['extend_field1']) ? trim($_POST['extend_field1']) : '';
    $other['qq'] = $qq = isset($_POST['extend_field2']) ? trim($_POST['extend_field2']) : '';
    $other['office_phone'] = $office_phone = isset($_POST['extend_field3']) ? trim($_POST['extend_field3']) : '';
    $other['home_phone'] = $home_phone = isset($_POST['extend_field4']) ? trim($_POST['extend_field4']) : '';
    $other['mobile_phone'] = $mobile_phone = isset($_POST['extend_field5']) ? trim($_POST['extend_field5']) : '';
    $sel_question = empty($_POST['sel_question']) ? '' : compile_str($_POST['sel_question']);
    $passwd_answer = isset($_POST['passwd_answer']) ? compile_str(trim($_POST['passwd_answer'])) : '';

    /* 更新用户扩展字段的数据 */
    $sql = 'SELECT id FROM ' . $ecs->table('reg_fields') . ' WHERE type = 0 AND display = 1 ORDER BY dis_order, id';   //读出所有扩展字段的id
    $fields_arr = $db->getAll($sql);

    foreach ($fields_arr AS $val)       //循环更新扩展用户信息
    {
        $extend_field_index = 'extend_field' . $val['id'];
        if(isset($_POST[$extend_field_index]))
        {
            $temp_field_content = strlen($_POST[$extend_field_index]) > 100 ? mb_substr(htmlspecialchars($_POST[$extend_field_index]), 0, 99) : htmlspecialchars($_POST[$extend_field_index]);
            $sql = 'SELECT * FROM ' . $ecs->table('reg_extend_info') . "  WHERE reg_field_id = '$val[id]' AND user_id = '$user_id'";
            if ($db->getOne($sql))      //如果之前没有记录，则插入
            {
                $sql = 'UPDATE ' . $ecs->table('reg_extend_info') . " SET content = '$temp_field_content' WHERE reg_field_id = '$val[id]' AND user_id = '$user_id'";
            }
            else
            {
                $sql = 'INSERT INTO '. $ecs->table('reg_extend_info') . " (`user_id`, `reg_field_id`, `content`) VALUES ('$user_id', '$val[id]', '$temp_field_content')";
            }
            $db->query($sql);
        }
    }

    /* 写入密码提示问题和答案 */
    if ($passwd_answer<>null || $sel_question<>null)
	{
        $sql = 'UPDATE ' . $ecs->table('users') . " SET `passwd_question`='$sel_question', `passwd_answer`='$passwd_answer'  WHERE `user_id`='" . $_SESSION['user_id'] . "'";
        $db->query($sql);
    }

    $profile  = array(
        'user_id'  => $user_id,
        'email'    => isset($_POST['email']) ? trim($_POST['email']) : '',
        'sex'      => isset($_POST['sex'])   ? intval($_POST['sex']) : 0,
        'birthday' => $birthday,
        'other'    => isset($other) ? $other : array()
        );


    if (edit_profile($profile))
    {
		echo"<SCRIPT LANGUAGE='javascript'>alert('".$_LANG['edit_profile_success']."');location.href='user.php'</SCRIPT>";
    }
    else
    {
        if ($user->error == ERR_EMAIL_EXISTS)
        {
            $msg = sprintf($_LANG['email_exist'], $profile['email']);
        }
        else
        {
            $msg = $_LANG['edit_profile_failed'];
        }
		echo"<SCRIPT LANGUAGE='javascript'>alert('".$msg."');history.go(-1);</SCRIPT>";
    }
}

/* 修改会员密码 */
elseif ($act == 'act_edit_password')
{
	if(!$_SESSION['user_id']){
		$smarty->display('login.dwt');
		exit;
	}
    include_once(ROOT_PATH . 'includes/lib_passport.php');

    $old_password = isset($_POST['old_password']) ? trim($_POST['old_password']) : null;
    $new_password = isset($_POST['new_password']) ? trim($_POST['new_password']) : '';
    $comfirm_password = isset($_POST['comfirm_password']) ? trim($_POST['comfirm_password']) : '';
    $user_id      = isset($_POST['uid'])  ? intval($_POST['uid']) : $user_id;
    $code         = isset($_POST['code']) ? trim($_POST['code'])  : '';

    if (strlen($new_password) < 6 || strlen($comfirm_password) < 6 )
    {
    $f = 5;
 	$smarty->assign('f', $f);
    $smarty->display('profile.dwt');
    exit;
    } elseif (md5($new_password)<>md5($comfirm_password)){
    $f = 6;
 	$smarty->assign('f', $f);
    $smarty->display('profile.dwt');
    exit;
	}

    $user_info = $user->get_profile_by_id($user_id); //论坛记录

    if (($user_info && (!empty($code) && md5($user_info['user_id'] . $_CFG['hash_code'] . $user_info['reg_time']) == $code)) || ($_SESSION['user_id']>0 && $_SESSION['user_id'] == $user_id && $user->check_user($_SESSION['user_name'], $old_password)))
    {
		
        if ($user->edit_user(array('username'=> (empty($code) ? $_SESSION['user_name'] : $user_info['user_name']), 'old_password'=>$old_password, 'password'=>$new_password), empty($code) ? 0 : 1))
        {
			$sql="UPDATE ".$ecs->table('users'). "SET `ec_salt`='0' WHERE user_id= '".$user_id."'";
			$db->query($sql);
            $user->logout();
			$user->logout();
			$Loaction = 'user.php';
			ecs_header("Location: $Loaction\n");
        }
        else
        {
            $f = 4;
        }
    }
    else
    {
        $f = 4;
    }
	$smarty->assign('f', $f);
    $smarty->display('profile.dwt');
}

/* 退出会员中心 */
elseif ($act == 'logout')
{
	if (!isset($back_act) && isset($GLOBALS['_SERVER']['HTTP_REFERER']))
	{
		$back_act = strpos($GLOBALS['_SERVER']['HTTP_REFERER'], 'user.php') ? './index.php' : $GLOBALS['_SERVER']['HTTP_REFERER'];
	}
	$user->logout();
	$Loaction = 'index.php';
	ecs_header("Location: $Loaction\n");

}
/* 显示会员注册界面 */
elseif ($act == 'register')
{
	if (!isset($back_act) && isset($GLOBALS['_SERVER']['HTTP_REFERER']))
	{
		$back_act = strpos($GLOBALS['_SERVER']['HTTP_REFERER'], 'user.php') ? './index.php' : $GLOBALS['_SERVER']['HTTP_REFERER'];
	}
	//
	if($_SESSION['user_id'] > 0){
		echo '<meta http-equiv="refresh" content="0;URL='.$back_act.'" />';
		exit;
	}
	/* 取出注册扩展字段 */
	$sql = 'SELECT * FROM ' . $ecs->table('reg_fields') . ' WHERE type < 2 AND display = 1 ORDER BY dis_order, id';
	$extend_info_list = $db->getAll($sql);
	$smarty->assign('extend_info_list', $extend_info_list);
	/* 密码找回问题 */
	$_LANG['passwd_questions']['friend_birthday'] = '我最好朋友的生日？';
	$_LANG['passwd_questions']['old_address']	 = '我儿时居住地的地址？';
	$_LANG['passwd_questions']['motto']		   = '我的座右铭是？';
	$_LANG['passwd_questions']['favorite_movie']  = '我最喜爱的电影？';
	$_LANG['passwd_questions']['favorite_song']   = '我最喜爱的歌曲？';
	$_LANG['passwd_questions']['favorite_food']   = '我最喜爱的食物？';
	$_LANG['passwd_questions']['interest']		= '我最大的爱好？';
	$_LANG['passwd_questions']['favorite_novel']  = '我最喜欢的小说？';
	$_LANG['passwd_questions']['favorite_equipe'] = '我最喜欢的运动队？';
	/* 密码提示问题 */
	$smarty->assign('passwd_questions', $_LANG['passwd_questions']);
	$smarty->display('user_passport.dwt');
}
/* 注册会员的处理 */
elseif ($act == 'act_register')
{
		include_once(ROOT_PATH . 'includes/lib_passport.php');

		$username = isset($_POST['username']) ? trim($_POST['username']) : '';		
		
		$password = isset($_POST['password']) ? trim($_POST['password']) : '';
		$email	= isset($_POST['email']) ? trim($_POST['email']) : '';
		
		$sql = 'SELECT * FROM ' . $ecs->table('users') . " WHERE user_name = '$username'";
        $row = $db->getOne($sql);
		if($row){
	$tips = '<br><br>用户名已存在<br><br><a href="javascript:history.back()" class=red>返回上一页</a>';
	$smarty->assign('tips', $tips);
	$smarty->display('message.dwt');
	exit;
		}
		$sql = 'SELECT * FROM ' . $ecs->table('users') . " WHERE email = '$email'";
        $row = $db->getOne($sql);
		if($row){
	$tips = '<br><br>邮箱已存在<br><br><a href="javascript:history.back()" class=red>返回上一页</a>';
	$smarty->assign('tips', $tips);
	$smarty->display('message.dwt');
	exit;
		}
		
		
		$other['msn'] = isset($_POST['extend_field1']) ? $_POST['extend_field1'] : '';
		$other['qq'] = isset($_POST['extend_field2']) ? $_POST['extend_field2'] : '';
		$other['office_phone'] = isset($_POST['extend_field3']) ? $_POST['extend_field3'] : '';
		$other['home_phone'] = isset($_POST['extend_field4']) ? $_POST['extend_field4'] : '';
		$other['mobile_phone'] = isset($_POST['extend_field5']) ? $_POST['extend_field5'] : '';
		$sel_question = empty($_POST['sel_question']) ? '' : compile_str($_POST['sel_question']);
		$passwd_answer = isset($_POST['passwd_answer']) ? compile_str(trim($_POST['passwd_answer'])) : '';

		$back_act = isset($_POST['back_act']) ? trim($_POST['back_act']) : '';

		if (m_register($username, $password, $email, $other) !== false)
		{
			/*把新注册用户的扩展信息插入数据库*/
			$sql = 'SELECT id FROM ' . $ecs->table('reg_fields') . ' WHERE type = 0 AND display = 1 ORDER BY dis_order, id';   //读出所有自定义扩展字段的id
			$fields_arr = $db->getAll($sql);

			$extend_field_str = '';	//生成扩展字段的内容字符串
			foreach ($fields_arr AS $val)
			{
				$extend_field_index = 'extend_field' . $val['id'];
				if(!empty($_POST[$extend_field_index]))
				{
					$temp_field_content = strlen($_POST[$extend_field_index]) > 100 ? mb_substr($_POST[$extend_field_index], 0, 99) : $_POST[$extend_field_index];
					$extend_field_str .= " ('" . $_SESSION['user_id'] . "', '" . $val['id'] . "', '" . compile_str($temp_field_content) . "'),";
				}
			}
			$extend_field_str = substr($extend_field_str, 0, -1);

			if ($extend_field_str)	  //插入注册扩展数据
			{
				$sql = 'INSERT INTO '. $ecs->table('reg_extend_info') . ' (`user_id`, `reg_field_id`, `content`) VALUES' . $extend_field_str;
				$db->query($sql);
			}

			/* 写入密码提示问题和答案 */
			if (!empty($passwd_answer) && !empty($sel_question))
			{
				$sql = 'UPDATE ' . $ecs->table('users') . " SET `passwd_question`='$sel_question', `passwd_answer`='$passwd_answer'  WHERE `user_id`='" . $_SESSION['user_id'] . "'";
				$db->query($sql);
			}

			$ucdata = empty($user->ucdata)? "" : $user->ucdata;
			$Loaction = 'index.php';
			ecs_header("Location: $Loaction\n");
		}
}
/* 增加收货地址 */
elseif ($act == 'add_address')
{
	include_once('includes/lib_transaction.php');        
	 /* 取得国家列表、商店所在国家、商店所在国家的省列表 */
	$smarty->assign('country_list',       get_regions());
	$smarty->assign('shop_country',       $_CFG['shop_country']);
	$smarty->assign('shop_province_list', get_regions(1, $_CFG['shop_country']));
	
	
	/* 获得用户所有的收货人信息 */
    $consignee_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
	
	if ($consignee_id==0){
		
	//$consignee_list = get_consignee_list($_SESSION['user_id']);
	$consignee_list[] = array();
	  foreach ($consignee_list AS $key => $value)
	  {		
	  $consignee_list[$key]['country']='1';
	  $consignee_list[$key]['province']='18';
	  $consignee_list[$key]['city']='245';
	  }	
	$smarty->assign('action', "user.php?act=add_edit_address");  
	}else{		
	$consignee_listd = get_consignee_listd($_SESSION['user_id'],$_GET['id']);
	$consignee_listq = get_consignee_listq($_SESSION['user_id'],$_GET['id']);	
	$consignee_list = array_merge($consignee_listd,$consignee_listq);
	
	$address_id  = $db->getOne("SELECT address_id FROM " .$ecs->table('users'). " WHERE user_id='$user_id'");
	  foreach ($consignee_list AS $key => $value)
	  {		
	  if ($consignee_list[$key]['address_id']==$address_id){$consignee_list[$key]['address_ids']='1';}	
	  } 
	$smarty->assign('action', "user.php?act=act_edit_address");
	}
	
	

	$smarty->assign('consignee_list', $consignee_list);	
	
	
	/* 取得每个收货地址的省市区列表 */
	$province_list = array();
	$city_list = array();
	$district_list = array();
	foreach ($consignee_list as $region_id => $consignee)
	{
		$consignee['country']  = isset($consignee['country'])  ? intval($consignee['country'])  : 0;
		$consignee['province'] = isset($consignee['province']) ? intval($consignee['province']) : 0;
		$consignee['city']     = isset($consignee['city'])     ? intval($consignee['city'])     : 0;

		$province_list = get_regions(1, $consignee['country']);
		$city_list     = get_regions(2, $consignee['province']);
		$district_list = get_regions(3, $consignee['city']);
	}
	

	
	
	$smarty->assign('province_list', $province_list);
	$smarty->assign('city_list',     $city_list);
	$smarty->assign('district_list', $district_list);	
	$smarty->assign('fun', 'add');
	$smarty->display('address_list.dwt');
}
/* 收货地址列表 */
elseif ($act == 'address_list')
{
	include_once('includes/lib_transaction.php');        
	 /* 取得国家列表、商店所在国家、商店所在国家的省列表 */
	$smarty->assign('country_list',       get_regions());
	$smarty->assign('shop_country',       $_CFG['shop_country']);
	$smarty->assign('shop_province_list', get_regions(1, $_CFG['shop_country']));
    $consignee_list = get_consignee_list($_SESSION['user_id']);
	/* 取得每个收货地址的省市区列表 */
	$province_list = array();
	$city_list = array();
	$district_list = array();
	foreach ($consignee_list as $region_id => $consignee)
	{
		$consignee['country']  = isset($consignee['country'])  ? intval($consignee['country'])  : 0;
		$consignee['province'] = isset($consignee['province']) ? intval($consignee['province']) : 0;
		$consignee['city']     = isset($consignee['city'])     ? intval($consignee['city'])     : 0;

		$province_list = get_regions(1, $consignee['country']);
		$city_list     = get_regions(2, $consignee['province']);
		$district_list = get_regions(3, $consignee['city']);
	}
	$smarty->assign('province_list', $province_list);
	$smarty->assign('city_list',     $city_list);
	$smarty->assign('district_list', $district_list);	
	$smarty->assign('consignee', $consignee_list);
    $smarty->assign('action', "user.php?act=act_edit_address");
    $smarty->assign('subval', '修改送货地址');
    $smarty->assign('fun', 'list');
    $smarty->display('address_list.dwt');
}
/*更新收获地址*/
elseif ($act == 'act_edit_address'){
	
	global $db;
	include_once('includes/lib_transaction.php');
	
	if(empty($_POST['country']) || empty($_POST['province']) || empty($_POST['city']) || empty($_POST['district']))
    {
        echo '<script language=javascript>alert("配送区域不可为空！");history.go(-1);</script>';
        exit;
    }
    if(empty($_POST['address']))
    {
        echo '<script language=javascript>alert("收货地址不可为空！");history.go(-1);</script>';
        exit;
    }
	if(empty($_POST['consignee']))
    {
        echo '<script language=javascript>alert("收货人姓名不可为空！");history.go(-1);</script>';
        exit;
    }
    if(empty($_POST['tel']))
    {
        echo '<script language=javascript>alert("联系电话不可为空！");history.go(-1);</script>';
        exit;
    }
	/*
	 * 保存收货人信息
	 */
	$consignee = array(
		'user_id'		=> $_SESSION['user_id'],
		'address_id'    => empty($_POST['address_id']) ? 0  : intval($_POST['address_id']),
		'consignee'     => empty($_POST['consignee'])  ? '' : trim($_POST['consignee']),
		'country'       => empty($_POST['country'])    ? '' : $_POST['country'],
		'province'      => empty($_POST['province'])   ? '' : $_POST['province'],
		'city'          => empty($_POST['city'])       ? '' : $_POST['city'],
		'district'      => empty($_POST['district'])   ? '' : $_POST['district'],
		'email'         => empty($_POST['email'])      ? '' : $_POST['email'],
		'address'       => empty($_POST['address'])    ? '' : $_POST['address'],
		'zipcode'       => empty($_POST['zipcode'])    ? '' : make_semiangle(trim($_POST['zipcode'])),
		'tel'           => empty($_POST['tel'])        ? '' : make_semiangle(trim($_POST['tel'])),
		'mobile'        => empty($_POST['mobile'])     ? '' : make_semiangle(trim($_POST['mobile'])),
		'sign_building' => empty($_POST['sign_building']) ? '' : $_POST['sign_building'],
		'best_time'     => empty($_POST['best_time'])  ? '' : $_POST['best_time'],
		'default_id'    => empty($_POST['default_id'])  ? '0' : $_POST['default_id'],
	);
	
	$result = update_address($consignee);
	
	$GLOBALS['db']->query("UPDATE " . $GLOBALS['ecs']->table('user_address') . " SET default_id = 0 WHERE default_id != 1 ");
	
	if($result){
        echo '<script language=javascript>alert("修改收货地址成功");location.href="user.php?act=address_list";</script>';
	}
	else{
        echo '<script language=javascript>alert("修改失败");history.go(-1);</script>';
	}
	if ($_SESSION['user_id'] > 0)
    {
        $smarty->assign('user_name', $_SESSION['user_name']);
    }
}
/*增加收获地址*/
elseif ($act == 'add_edit_address'){
	
	global $db;
	include_once('includes/lib_transaction.php');
	
	if(empty($_POST['country']) || empty($_POST['province']) || empty($_POST['city']) || empty($_POST['district']))
    {
        echo '<script language=javascript>alert("配送区域不可为空！");history.go(-1);</script>';
        exit;
    }
    if(empty($_POST['address']))
    {
        echo '<script language=javascript>alert("收货地址不可为空！");history.go(-1);</script>';
        exit;
    }
	if(empty($_POST['consignee']))
    {
        echo '<script language=javascript>alert("收货人姓名不可为空！");history.go(-1);</script>';
        exit;
    }
    if(empty($_POST['tel']))
    {
        echo '<script language=javascript>alert("联系电话不可为空！");history.go(-1);</script>';
        exit;
    }
	/*
	 * 保存收货人信息
	 */
	$consignee = array(
		'user_id'		=> $_SESSION['user_id'],
		'address_id'    => empty($_POST['address_id']) ? 0  : intval($_POST['address_id']),
		'consignee'     => empty($_POST['consignee'])  ? '' : trim($_POST['consignee']),
		'country'       => empty($_POST['country'])    ? '' : $_POST['country'],
		'province'      => empty($_POST['province'])   ? '' : $_POST['province'],
		'city'          => empty($_POST['city'])       ? '' : $_POST['city'],
		'district'      => empty($_POST['district'])   ? '' : $_POST['district'],
		'email'         => empty($_POST['email'])      ? '' : $_POST['email'],
		'address'       => empty($_POST['address'])    ? '' : $_POST['address'],
		'zipcode'       => empty($_POST['zipcode'])    ? '' : make_semiangle(trim($_POST['zipcode'])),
		'tel'           => empty($_POST['tel'])        ? '' : make_semiangle(trim($_POST['tel'])),
		'mobile'        => empty($_POST['mobile'])     ? '' : make_semiangle(trim($_POST['mobile'])),
		'sign_building' => empty($_POST['sign_building']) ? '' : $_POST['sign_building'],
		'best_time'     => empty($_POST['best_time'])  ? '' : $_POST['best_time'],
	);
	
	$result = update_address($consignee);
	ecs_header("Location: user.php?act=address_list\n");
	/*
	if($result){
        echo '<script language=javascript>alert("增加收货地址成功");location.href="user.php?act=address_list";</script>';
	}
	else{
        echo '<script language=javascript>alert("增加收货地址失败");history.go(-1);</script>';
	}
	*/
	if ($_SESSION['user_id'] > 0)
    {
        $smarty->assign('user_name', $_SESSION['user_name']);
    }
}
/* 删除收货人信息*/
elseif ($act == 'drop_address')
{
	include_once('includes/lib_transaction.php');

	$consignee_id = intval($_GET['id']);

	if (drop_consignee($consignee_id))
	{
		ecs_header("Location: user.php?act=address_list\n");
		exit;
	}
}
/* 添加收藏商品(ajax) */
elseif ($act == 'collect')
{
	include_once(ROOT_PATH .'includes/cls_json.php');
	$json = new JSON();
	$result = array('error' => 0, 'message' => '');
	$goods_id = $_GET['id'];

	if (!isset($_SESSION['user_id']) || $_SESSION['user_id'] == 0)
	{
		$result['error'] = 1;
		$result['message'] = "您还没有登录";
		die($json->encode($result));
	}
	else
	{
		/* 检查是否已经存在于用户的收藏夹 */
		$sql = "SELECT COUNT(*) FROM " .$GLOBALS['ecs']->table('collect_goods') .
			" WHERE user_id='$_SESSION[user_id]' AND goods_id = '$goods_id'";
		if ($GLOBALS['db']->GetOne($sql) > 0)
		{
			$result['error'] = 1;
			$result['message'] = "该商品已经存在于您的收藏夹中。";
			die($json->encode($result));
		}
		else
		{
			$time = gmtime();
			$sql = "INSERT INTO " .$GLOBALS['ecs']->table('collect_goods'). " (user_id, goods_id, add_time)" .
					"VALUES ('$_SESSION[user_id]', '$goods_id', '$time')";

			if ($GLOBALS['db']->query($sql) === false)
			{
				$result['error'] = 1;
				$result['message'] = $GLOBALS['db']->errorMsg();
				die($json->encode($result));
			}
			else
			{
				$result['error'] = 0;
				$result['message'] = "该商品已经成功地加入了您的收藏夹。";
				die($json->encode($result));
			}
		}
	}
}
/* 用户中心 */
else
{
	if ($_SESSION['user_id'] > 0)
	{
		show_user_center();
	}
	else
	{
		$reuser_name= isset($_COOKIE['ECS']['reuser_name']) ? $_COOKIE['ECS']['reuser_name'] : '';
		
		$gourl = isset($_GET['gourl']) ? $_GET['gourl'] : '';
		$smarty->assign('gourl', $gourl);
		
		if(!empty($reuser_name)){
			$smarty->assign('reuser_name', $reuser_name);
		}
		$smarty->display('login.dwt');
		exit;
	}
}

/**
 * 用户中心显示
 */
function show_user_center()
{
    include_once(ROOT_PATH .'includes/lib_clips.php');
	$best_goods = get_recommend_goods('best');
	if (count($best_goods) > 0)
	{
		foreach  ($best_goods as $key => $best_data)
		{
			$best_goods[$key]['shop_price'] = encode_output($best_data['shop_price']);
			$best_goods[$key]['name'] = encode_output($best_data['name']);
		}
	}
	//22:18 2013-7-16
	$rank_name = $GLOBALS['db']->getOne('SELECT rank_name FROM ' . $GLOBALS['ecs']->table('user_rank') . ' WHERE rank_id = '.$_SESSION['user_rank']);
	
	$sql = "SELECT COUNT(*) FROM " .$GLOBALS['ecs']->table('order_info')." WHERE  user_id=".$_SESSION['user_id'];
	$GLOBALS['smarty']->assign('order_count',  $GLOBALS['db']->getOne($sql));
	
	$sql = "SELECT COUNT(*) FROM " .$GLOBALS['ecs']->table('collect_goods')." WHERE  user_id=".$_SESSION['user_id'];
	$GLOBALS['smarty']->assign('favorites_count',  $GLOBALS['db']->getOne($sql));
	
	$GLOBALS['smarty']->assign('info', get_user_default($_SESSION['user_id']));
	$GLOBALS['smarty']->assign('rank_name', $rank_name);
	$GLOBALS['smarty']->assign('user_info', get_user_info());
	$GLOBALS['smarty']->assign('best_goods' , $best_goods);
	$GLOBALS['smarty']->assign('footer', get_footer());
	$GLOBALS['smarty']->display('user.dwt');
}

/**
 * 手机注册
 */
function m_register($username, $password, $email, $other = array())
{
	/* 检查username */
	if (empty($username))
	{
		echo '<script>alert("用户名必须填写！");window.location.href="user.php?act=register"; </script>';
		return false;
	}
	if (preg_match('/\'\/^\\s*$|^c:\\\\con\\\\con$|[%,\\*\\"\\s\\t\\<\\>\\&\'\\\\]/', $username))
	{
		echo '<script>alert("用户名错误！");window.location.href="user.php?act=register"; </script>';
		return false;
	}

	/* 检查是否和管理员重名 */
	if (admin_registered($username))
	{
		echo '<script>alert("此用户已存在！");window.location.href="user.php?act=register"; </script>';
		return false;
	}

	if (!$GLOBALS['user']->add_user($username, $password, $email))
	{
		echo '<script>alert("注册失败！");window.location.href="user.php?act=register"; </script>';
		//注册失败
		return false;
	}
	else
	{
		//注册成功

		/* 设置成登录状态 */
		$GLOBALS['user']->set_session($username);
		$GLOBALS['user']->set_cookie($username);
		
		
		/* 注册送积分 */
        if (!empty($GLOBALS['_CFG']['register_points']))
        {
            log_account_change($_SESSION['user_id'], 0, 0, $GLOBALS['_CFG']['register_points'], $GLOBALS['_CFG']['register_points'], $GLOBALS['_LANG']['register_points']);
        }

        /*推荐处理*/
        $affiliate  = unserialize($GLOBALS['_CFG']['affiliate']);
        if (isset($affiliate['on']) && $affiliate['on'] == 1)
        {
            // 推荐开关开启
            $up_uid     = get_affiliate();
            empty($affiliate) && $affiliate = array();
            $affiliate['config']['level_register_all'] = intval($affiliate['config']['level_register_all']);
            $affiliate['config']['level_register_up'] = intval($affiliate['config']['level_register_up']);
            if ($up_uid)
            {
                if (!empty($affiliate['config']['level_register_all']))
                {
                    if (!empty($affiliate['config']['level_register_up']))
                    {
                        $rank_points = $GLOBALS['db']->getOne("SELECT rank_points FROM " . $GLOBALS['ecs']->table('users') . " WHERE user_id = '$up_uid'");
                        if ($rank_points + $affiliate['config']['level_register_all'] <= $affiliate['config']['level_register_up'])
                        {
                            log_account_change($up_uid, 0, 0, $affiliate['config']['level_register_all'], 0, sprintf($GLOBALS['_LANG']['register_affiliate'], $_SESSION['user_id'], $username));
                        }
                    }
                    else
                    {
                        log_account_change($up_uid, 0, 0, $affiliate['config']['level_register_all'], 0, $GLOBALS['_LANG']['register_affiliate']);
                    }
                }

                //设置推荐人
                $sql = 'UPDATE '. $GLOBALS['ecs']->table('users') . ' SET parent_id = ' . $up_uid . ' WHERE user_id = ' . $_SESSION['user_id'];

                $GLOBALS['db']->query($sql);
            }
        }
		
		
		
	}

		//定义other合法的变量数组
		$other_key_array = array('msn', 'qq', 'office_phone', 'home_phone', 'mobile_phone');
		$update_data['reg_time'] = local_strtotime(local_date('Y-m-d H:i:s'));
		if ($other)
		{
			foreach ($other as $key=>$val)
			{
				//删除非法key值
				if (!in_array($key, $other_key_array))
				{
					unset($other[$key]);
				}
				else
				{
					$other[$key] =  htmlspecialchars(trim($val)); //防止用户输入javascript代码
				}
			}
			$update_data = array_merge($update_data, $other);
		}
		$GLOBALS['db']->autoExecute($GLOBALS['ecs']->table('users'), $update_data, 'UPDATE', 'user_id = ' . $_SESSION['user_id']);

		update_user_info();	  // 更新用户信息
        $Loaction = 'user.php?act=user_center';
        ecs_header("Location: $Loaction\n");
		return true;

}

function send_pwd_emails($uid, $user_name, $email, $code)
{
    if (empty($uid) || empty($user_name) || empty($email) || empty($code))
    {
        ecs_header("Location: user.php?act=get_password\n");

        exit;
    }

    /* 设置重置邮件模板所需要的内容信息 */
    $template    = get_mail_template('send_password');
    $reset_email = trim($GLOBALS['ecs']->url(),'wap/') . '/user.php?act=get_password&uid=' . $uid . '&code=' . $code;

    $GLOBALS['smarty']->assign('user_name',   $user_name);
    $GLOBALS['smarty']->assign('reset_email', $reset_email);
    $GLOBALS['smarty']->assign('shop_name',   $GLOBALS['_CFG']['shop_name']);
    $GLOBALS['smarty']->assign('send_date',   date('Y-m-d'));
    $GLOBALS['smarty']->assign('sent_date',   date('Y-m-d'));

    $content = $GLOBALS['smarty']->fetch('str:' . $template['template_content']);

    /* 发送确认重置密码的确认邮件 */
    if (send_mail($user_name, $email, $template['template_subject'], $content, $template['is_html']))
    {
        return true;
    }
    else
    {
        return false;
    }
}
?>