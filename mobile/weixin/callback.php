<?php
     //http://www.111cn.net/callback.php
       
     $appid = "wxa3b3f297d0e7c98c";  
     $secret = "4e9f3cb3cb41c8d5562c626fbb18503a";  
     $code = $_GET["code"];  
	 
	 
     $get_token_url = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid='.$appid.'&secret='.$secret.'&code='.$code.'&grant_type=authorization_code';
//$json = file_get_contents($get_token_url);  
//$arr = json_decode($json,true);





    $ch = curl_init();  
     curl_setopt($ch,CURLOPT_URL,$get_token_url);  
     curl_setopt($ch,CURLOPT_HEADER,0);  
     curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1 );  
	 curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);//这个是后加。
     curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);  
     $res = curl_exec($ch);  
     curl_close($ch); 	 
	 
     $json_obj = json_decode($res,true);  

     //根据openid和access_token查(www.111cn.net)询用户信息  
     $access_token = $json_obj['access_token'];  
     $openid = $json_obj['openid'];  
     $get_user_info_url = 'https://api.weixin.qq.com/sns/userinfo?access_token='.$access_token.'&openid='.$openid.'&lang=zh_CN';  
       
     $ch = curl_init();  
     curl_setopt($ch,CURLOPT_URL,$get_user_info_url);  
     curl_setopt($ch,CURLOPT_HEADER,0);  
     curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1 ); 
	 curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);//这个是后加。
     curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);  
     $res = curl_exec($ch);  
     curl_close($ch);  
       
     //解析json  
     $user_obj = json_decode($res,true);  
     $_SESSION['user'] = $user_obj;  
     print_r($user_obj);  
       
     ?>  
     