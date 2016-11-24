    <?php  
       
     if(isset($_SESSION['user'])){  
         print_r($_SESSION['user']);
     exit;
     }
     $APPID='wxa3b3f297d0e7c98c';
     $REDIRECT_URI='http://www.zhuangdeng.net/mobile/weixin/callback.php';
     //$scope='snsapi_base';
     $scope='snsapi_userinfo';//需要授权
	 $state='123';
    $url='https://open.weixin.qq.com/connect/oauth2/authorize?appid='.$APPID.'&redirect_uri='.urlencode($REDIRECT_URI).'&response_type=code&scope='.$scope.'&state='.$state.'#wechat_redirect';
	 
     header("Location:".$url);
     ?>