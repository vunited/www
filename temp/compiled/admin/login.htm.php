<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php echo $this->_var['lang']['cp_home']; ?><?php if ($this->_var['ur_here']): ?> - <?php echo $this->_var['ur_here']; ?><?php endif; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<style type="text/css">
    html,body,form
    {
        height: 100%;
	    background-image: url(images/011.gif);
	    background-repeat: repeat-y;
	    background-position: top center;
	    background-color: #dae1e3;
	    margin: 0px;
		color: #666666;
	    font-size: 12px;
    }
    .input {
	    border: none;
	    padding-top: 6px;
	    padding-bottom: 6px;
	    padding-left: 37px;
	    padding-right: 5px;
	    width: 168px;
	    height: 20px;
    }

    .bgname {
	    background: url(images/014.gif) no-repeat
    }

    .bgpwd {
	    background: url(images/015.gif) no-repeat
    }
    </style>

<?php echo $this->smarty_insert_scripts(array('files'=>'../js/utils.js,validator.js')); ?>
<script language="JavaScript">
<!--
// 这里把JS用到的所有语言都赋值到这里
<?php $_from = $this->_var['lang']['js_languages']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['item']):
?>
var <?php echo $this->_var['key']; ?> = "<?php echo $this->_var['item']; ?>";
<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>

if (window.parent != window)
{
  window.top.location.href = location.href;
}

//-->
</script>
</head>
<body style="background: #278296">
<form method="post" action="privilege.php" name='theForm' onsubmit="return validate()">
<table width="100%" height="100%" border="0" cellspacing="0" cellpadding="0" align="center">
            <tr>
                <td align="center" valign="middle">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                            <td align="center" height="124" valign="bottom">
                                <img src="Images/" width="767" height="116" alt="" /></td>
                        </tr>
                    </table>
                    <table width="100%" border="0" cellspacing="0" cellpadding="0" style="background-image: url(Images/);" align="center">
                        <tr>
                            <td height="343" align="center">
                                <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                                    <tr>
                                        <td height="343" style="background-image: url(Images/001.jpg); background-position: center center; background-REPEAT: no-repeat;" align="center">
                                            <table border="0" align="center" cellpadding="0" cellspacing="0">
                                                <tr>
                                                    <td align="center">
                                                        <table border="0" cellpadding="0" cellspacing="0" align="center">
                                                            <tr>
                                                                <td height="50" align="center">用&nbsp;户&nbsp;名：</td>
                                                                <td width="220" height="8" align="left">
                                                                    <input type="text" name="username" maxlength="20" id="username" tabindex="1" class="input bgname" />
                                                                    </td>
                                                            </tr>
                                                            <tr>
                                                              <td height="50" align="center">密&nbsp; &nbsp; 码：</td>
                                                              <td height="8" align="left"><input type="password" name="password" maxlength="16" id="password" tabindex="2" class="input bgpwd" /></td>
                                                            </tr>
                                                            <?php if ($this->_var['gd_version'] > 0): ?>
                                                            <tr>
                                                              <td height="50" align="center">验 证 码：</td>
                                                              <td height="8" align="left"><table border="0" cellspacing="0" cellpadding="0">
                                                              <tr>
                                                                    <td><input type="text" name="captcha" maxlength="4" id="captcha" tabindex="3" class="input bgpwd" style="width:107px;" /></td>
                                                                    <td><img src="index.php?act=captcha&<?php echo $this->_var['random']; ?>" width="60" height="30" alt="CAPTCHA" onclick= this.src="index.php?act=captcha&"+Math.random() title="<?php echo $this->_var['lang']['click_for_another']; ?>" style="border:1px solid #7ea2b8; border-left:none; cursor:pointer" /></td>
                                                                  </tr>
                                                              </table></td>
                                                            </tr>
                                                            <?php endif; ?>
                                                            <tr>
                                                              <td height="50" align="center">&nbsp;</td>
                                                              <td height="8" align="left"><input type="checkbox" value="1" name="remember" id="remember" /><label for="remember"><?php echo $this->_var['lang']['remember']; ?></label></td>
                                                            </tr>
                                                            
                                                        </table></td>
                                                </tr>
                                                <tr>
                                                    <td align="center">
                                                        <table border="0" cellpadding="0" cellspacing="0" align="center">
                                                            <tr>
                                                                <td width="93" height="50" align="center">&nbsp;</td>
                                                                <td height="30" align="left">
                                                                    <input type="image" name="btnSummit" id="btnSummit" tabindex="4" title="登陆" alt="登陆" src="images/016.gif" border="0" onClick="return checkInput();"  />                                                                 
                                                                    </td>
                                                                <td width="6">&nbsp;</td>
                                                                <td height="30" align="left" width="132">&nbsp;</td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                    <br />
                    <table width="100%" align="center" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                            <td height="60" align="center">
                                <span style="font-size: 14px;">&nbsp; &nbsp;装灯网<span style="font-family: Arial; font-size: 14px;">&nbsp; &copy; &nbsp;</span>中灯科技（大连）有限公司</span></td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>	
		<script language="javascript" type="text/javascript" src="http://js.users.51.la/18977604.js"></script>
<noscript><a href="http://www.51.la/?18977604" target="_blank"><img alt="&#x6211;&#x8981;&#x5566;&#x514D;&#x8D39;&#x7EDF;&#x8BA1;" src="http://img.users.51.la/18977604.asp" style="border:none" /></a></noscript>
        
        
        
        
        
        
        
        
  
  <input type="hidden" name="act" value="signin" />
</form>
<script language="JavaScript">
<!--
  document.forms['theForm'].elements['username'].focus();
  
  /**
   * 检查表单输入的内容
   */
  function validate()
  {
    var validator = new Validator('theForm');
    validator.required('username', user_name_empty);
    //validator.required('password', password_empty);
    if (document.forms['theForm'].elements['captcha'])
    {
      validator.required('captcha', captcha_empty);
    }
    return validator.passed();
  }
  
//-->
</script>
</body>