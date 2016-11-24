<?php
//if(!$_COOKIE['cookcity']){
$cookcity=getCity();
print_r($cookcity['city']);
//setcookie('cookcity',$cookcity['city']);
//}

//echo($_COOKIE['cookcity']);

/**
 * 获取 IP  地理位置
 * 淘宝IP接口
 * @Return: array
 */

function getCity($ip = '')
{
	
    if (getenv("HTTP_CLIENT_IP") && strcasecmp(getenv("HTTP_CLIENT_IP"), "unknown"))
        $queryIP = getenv("HTTP_CLIENT_IP");  
    else if (getenv("HTTP_X_FORWARDED_FOR") && strcasecmp(getenv("HTTP_X_FORWARDED_FOR"), "unknown"))
        $queryIP = getenv("HTTP_X_FORWARDED_FOR");
    else if (getenv("REMOTE_ADDR") && strcasecmp(getenv("REMOTE_ADDR"), "unknown"))
        $queryIP = getenv("REMOTE_ADDR");
    else if (isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], "unknown"))
        $queryIP = $_SERVER['REMOTE_ADDR'];
    else
        $queryIP = "unknown";		
	
    if($ip == ''){
        //$url = "http://int.dpool.sina.com.cn/iplookup/iplookup.php?format=json";
		$url = 'http://int.dpool.sina.com.cn/iplookup/iplookup.php?format=json&ip='.$queryIP; 
        $ip=json_decode(file_get_contents($url),true);
        $data = $ip;
    }else{
        $url="http://ip.taobao.com/service/getIpInfo.php?ip=".$ip;
        $ip=json_decode(file_get_contents($url));   
        if((string)$ip->code=='1'){
           return false;
        }
        $data = (array)$ip->data;
    }
    
    return $data;   
}
?>