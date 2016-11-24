<?php

/**
 * ECSHOP mobile前台公共函数
 * ============================================================================
 * * 版权所有 2005-2012 上海商派网络科技有限公司，并保留所有权利。
 * 网站地址: http://www.zhiyuanit.com；
 * ----------------------------------------------------------------------------
 * 这不是一个自由软件！您只能在不用于商业目的的前提下对程序代码进行修改和
 * 使用；不允许对程序代码以任何形式任何目的的再发布。
 * ============================================================================
 * $Author: liuhui $
 * $Id: init.php 15013 2008-10-23 09:31:42Z liuhui $
*/

if (!defined('IN_ECS'))
{
    die('Hacking attempt');
}
define('ECS_WAP', true);

error_reporting(E_ALL ^ E_NOTICE);

if (__FILE__ == '')
{
    die('Fatal error code: 0');
}

/* 取得当前ecshop所在的根目录 */
define('ROOT_PATH', str_replace('mobile/includes/init.php', '', str_replace('\\', '/', __FILE__)));

/* 初始化设置 */
@ini_set('memory_limit',          '64M');
@ini_set('session.cache_expire',  180);
@ini_set('session.use_cookies',   1);
@ini_set('session.auto_start',    0);
@ini_set('display_errors',        1);
@ini_set("arg_separator.output","&amp;");

if (DIRECTORY_SEPARATOR == '\\')
{
    @ini_set('include_path',      '.;' . ROOT_PATH);
}
else
{
    @ini_set('include_path',      '.:' . ROOT_PATH);
}

if (file_exists(ROOT_PATH . 'data/config.php'))
{
    include(ROOT_PATH . 'data/config.php');
}
else
{
    include(ROOT_PATH . 'includes/config.php');
}

if (defined('DEBUG_MODE') == false)
{
    define('DEBUG_MODE', 7);
}

if (PHP_VERSION >= '5.1' && !empty($timezone))
{
    date_default_timezone_set($timezone);
}

$php_self = isset($_SERVER['PHP_SELF']) ? $_SERVER['PHP_SELF'] : $_SERVER['SCRIPT_NAME'];
if ('/' == substr($php_self, -1))
{
    $php_self .= 'index.php';
}
define('PHP_SELF', $php_self);

require(ROOT_PATH . 'includes/cls_ecshop.php');
require(ROOT_PATH . 'includes/lib_goods.php');
require(ROOT_PATH . 'includes/lib_base.php');
require(ROOT_PATH . 'includes/lib_common.php');
require(ROOT_PATH . 'includes/lib_time.php');
require(ROOT_PATH . 'includes/lib_main.php');
require(ROOT_PATH . 'mobile/includes/lib_main.php');
require(ROOT_PATH . 'includes/inc_constant.php');
require(ROOT_PATH . 'includes/cls_error.php');

/* 对用户传入的变量进行转义操作。*/
if (!get_magic_quotes_gpc())
{
    if (!empty($_GET))
    {
        $_GET  = addslashes_deep($_GET);
    }
    if (!empty($_POST))
    {
        $_POST = addslashes_deep($_POST);
    }

    $_COOKIE   = addslashes_deep($_COOKIE);
    $_REQUEST  = addslashes_deep($_REQUEST);
}

/* 创建 ECSHOP 对象 */
$ecs = new ECS($db_name, $prefix);

/* 初始化数据库类 */
require(ROOT_PATH . 'includes/cls_mysql.php');
$db = new cls_mysql($db_host, $db_user, $db_pass, $db_name);
$db_host = $db_user = $db_pass = $db_name = NULL;

/* 创建错误处理对象 */
$err = new ecs_error('message.html');




/**/
$user_agent = $_SERVER['HTTP_USER_AGENT'];
if (strpos($user_agent, 'MicroMessenger') === false){}else{

        $appid='wxa3b3f297d0e7c98c';
        $secret = '4e9f3cb3cb41c8d5562c626fbb18503a';
		$urls = $GLOBALS['ecs']->get_domain().$_SERVER['REQUEST_URI'] ;
		$openid=@$_COOKIE['sopenid'];
		
		if(!$openid){
        if(!$_GET['code']){
                $authorization_url = 
"https://open.weixin.qq.com/connect/oauth2/authorize?appid={$appid}&redirect_uri={$urls}&scope=snsapi_base&state=123&response_type=code#wechat_redirect";
                header("Location: {$authorization_url}");
                exit;
        }
        else{
                // 获取网页access_token和openid
                $get_code=$_GET['code'];
                $url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid={$appid}&secret={$secret}&code={$get_code}&grant_type=authorization_code";
                //$access_token_info = json_decode(file_get_contents($url));
                //$openid=$access_token_info->openid;				
                $output = https_request($url);
                $openid=$output['openid'];
                setcookie("sopenid",$openid,time()+864000,'/');	 
				
        }
//echo 'openid='.$openid;
//print_r($output);
//exit;
		}

}


/* 载入系统参数 */
$_CFG = load_config();

/* 初始化session */
require(ROOT_PATH . 'includes/cls_session.php');
$sess = new cls_session($db, $ecs->table('sessions'), $ecs->table('sessions_data'), 'ecsid');
//define('SESS_ID', $sess->get_session_id());


    //判断是否存在user_id的session,避免高版本PHP报错 
    if(isset($_SESSION['user_id'])){  
        //如果存在会员登录  
        if($_SESSION['user_id']>0){  
            //取得对应user_id的session MD5码，后面加入'@lyecs.com'自定义的自符串加密。
            $user_session=md5($_SESSION['user_id'].'@lyecs.com');   //'@lyecs.com'内容可自行修改  
            //取得之前的session_id，www.lyecs.com 老杨ecshop  
            $old_session=$sess->get_session_id();  
            //如果会员的session_id和原先的session_id不同（则为新登录情况），则将购物车内原session_id的商品，更新为会员下的商品！  
            if($user_session != $old_session){  
                $sql="update ".$GLOBALS['ecs']->table('cart')."set session_id='".$user_session."',user_id='".$_SESSION['user_id']."' where session_id='".$old_session."' ";  
                $GLOBALS['db']->query($sql);  
            }  
            //定义新的会员唯一session_id  www.lyecs.com 老杨ecshop  
            define('SESS_ID',$user_session);  
        }else{  
            //不存在会员，继续用原有的session_id  
            define('SESS_ID', $sess->get_session_id());  
        }  
    }else{  

        //不存在会员，继续用原有的session_id  
        define('SESS_ID', $sess->get_session_id());  
    }  



if (!defined('INIT_NO_SMARTY'))
{
    header('Cache-control: private');
    header('Content-type: text/html; charset=utf-8');

    /* 创建 Smarty 对象。*/
    require(ROOT_PATH . 'includes/cls_template.php');
    $smarty = new cls_template;

    $smarty->cache_lifetime = $_CFG['cache_time'];
    $smarty->template_dir   = ROOT_PATH . 'mobile/templates';
    $smarty->cache_dir      = ROOT_PATH . 'temp/caches';
    $smarty->compile_dir    = ROOT_PATH . 'temp/compiled/mobile';

    if ((DEBUG_MODE & 2) == 2)
    {
        $smarty->direct_output = true;
        $smarty->force_compile = true;
    }
    else
    {
        $smarty->direct_output = false;
        $smarty->force_compile = false;
    }
}

if (!defined('INIT_NO_USERS'))
{
    /* 会员信息 */
    $user =& init_users();
	
    if (empty($_SESSION['user_id']))
    {
        if ($user->get_cookie())
        {
            /* 如果会员已经登录并且还没有获得会员的帐户余额、积分以及优惠券 */
            if ($_SESSION['user_id'] > 0 && !isset($_SESSION['user_money']))
            {
                update_user_info();
            }
        }
        else
        {
            $_SESSION['user_id']     = 0;
            $_SESSION['user_name']   = '';
            $_SESSION['email']       = '';
            $_SESSION['user_rank']   = 0;
            $_SESSION['discount']    = 1.00;
        }
    }
	
	//if (isset($_GET['u']))
	if (!empty($_GET['u']))
    {
        set_affiliate();
    }
	
	/* session 不存在，检查cookie */
    if (!empty($_COOKIE['ECS']['user_id']) && !empty($_COOKIE['ECS']['password']))
    {
        // 找到了cookie, 验证cookie信息
        $sql = 'SELECT user_id, user_name, password ' .
                ' FROM ' .$ecs->table('users') .
                " WHERE user_id = '" . intval($_COOKIE['ECS']['user_id']) . "' AND password = '" .$_COOKIE['ECS']['password']. "'";

        $row = $db->GetRow($sql);

        if (!$row)
        {
            // 没有找到这个记录
           $time = time() - 3600;
           setcookie("ECS[user_id]",  '', $time, '/');
           setcookie("ECS[password]", '', $time, '/');
        }
        else
        {
            $_SESSION['user_id'] = $row['user_id'];
            $_SESSION['user_name'] = $row['user_name'];
            update_user_info();
        }
    }
	
}

if ((DEBUG_MODE & 1) == 1)
{
    error_reporting(E_ALL);
}
else
{
    error_reporting(E_ALL ^ E_NOTICE);
}
if ((DEBUG_MODE & 4) == 4)
{
    include(ROOT_PATH . 'includes/lib.debug.php');
}

/* 判断是否支持gzip模式 */
if (gzip_enabled())
{
    ob_start('ob_gzhandler');
}
error_reporting(E_ALL ^ E_NOTICE);
/* wap头文件 */
//if (substr($_SERVER['SCRIPT_NAME'], strrpos($_SERVER['SCRIPT_NAME'], '/')) != '/user.php')
//{}
header("Content-Type:text/html; charset=utf-8");

if (empty($_CFG['wap_config']))
{
    echo "<meta http-equiv='Content-Type' content='text/html; charset=utf-8' /><title>ECShop_mobile</title></head><body><p align='left'>对不起,{$_CFG['shop_name']}暂时没有开启手机购物功能</p></body></html>";
    exit();
}
$GLOBALS['smarty']->assign('shop_name', $_CFG['shop_name']);



?>