<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="Keywords" content="<?php echo $this->_var['keywords']; ?>" />
<meta name="Description" content="<?php echo $this->_var['description']; ?>" />

<title><?php echo $this->_var['page_title']; ?></title>

<link rel="shortcut icon" href="favicon.ico" />
<link rel="icon" href="animated_favicon.gif" type="image/gif" />
<link href="themes/default/css/zyit.css" rel="stylesheet" type="text/css"  charset="utf-8"> 

<?php echo $this->smarty_insert_scripts(array('files'=>'common.js,user.js,transport.js,sms.js')); ?>

<body>
<?php echo $this->fetch('library/page_header.lbi'); ?>
       <div class="login1">
          <div class="container">

<?php if ($this->_var['action'] == 'login'): ?>
             <div class="register">
                <ul>
                   <li><a href="user.php?act=register" style="color:#333333">会员注册</a></li>
                   <li class="on">会员登录</li>
                </ul>
                
                <div class="regcon on">
                   <div class="clear"></div>
                   <form name="formLogin" action="user.php" method="post" onSubmit="return userLogin()">
                   <table width="372" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="64" height="62">用&ensp;户&ensp;名</td>
                        <td colspan="2"><input name="username" type="text" placeholder="用户名" class="text10"/></td>
                      </tr>
                      <tr>
                        <td width="64"></td>
                        <td colspan="2" style="color: #ff6600; font-size:12px;"></td>
                      </tr>
                      <tr>
                        <td width="64" height="62">密&emsp;&emsp;码</td>
                        <td colspan="2">
                           <input name="password" type="password" placeholder="请输入密码" class="text10 text11"/>
                        </td>
                      </tr>
                       <tr>
                        <td width="64"></td>
                        <td colspan="2" style="color: #ff6600; font-size:12px;"></td>
                      </tr>
                      
<?php if ($this->_var['enabled_captcha']): ?>
                      <tr>
                        <td width="64" height="62">验&ensp;证&ensp;码</td>
                        <td colspan="2">
                           <input type="text" name="captcha" placeholder="请输入验证码" class="text10 text11"/>
                           <img src="captcha.php?is_login=1&<?php echo $this->_var['rand']; ?>" class="yzm" onClick="this.src='captcha.php?is_login=1&'+Math.random()" />
                        </td>
                      </tr>
          <?php endif; ?>
                       <tr>
                        <td width="64"></td>
                        <td colspan="2" style="color: #ff6600; font-size:12px;"></td>
                      </tr>
                      <tr>
                        <td width="64" height="62"><input type="hidden" value="1" name="remember" id="remember"/></td>
                        <td width="117">
                           <input type="hidden" name="act" value="act_login" /><input type="hidden" name="back_act" value="<?php echo $this->_var['back_act']; ?>" />
                           <input type="submit" value="" class="btn14 btn15" /></td>
                        <td width="191"><a href="user.php?act=register" class="btn14" style=" display:block;"/></a></td>
                      </tr>
                      <tr>
                        <td width="64" height="25"></td>
                        <td colspan="2">                           
                           <a href="user.php?act=oath&type=qq"><img src="themes/default/images/qq_login.gif"/></a>
                        <a href="user.php?act=oath&type=weibo"><img src="themes/default/images/sina_login.gif"/></a></td>
                      </tr>
                      <tr>
                        <td width="64" height="25"></td>
                        <td colspan="2"><a href="" class="c21">忘记密码？</a><a href="user.php?act=get_password" class="c22">找回密码</a></td>
                      </tr>
                   </table>
               </form>
                   <div class="clear"></div>
                </div>
             </div>
<?php endif; ?>



    <?php if ($this->_var['action'] == 'register'): ?>
    <?php echo $this->smarty_insert_scripts(array('files'=>'utils.js')); ?>
    
    
             <div class="register">
                <ul>
                   <li class="on">会员注册</li>
                   <li><a href="user.php" style="color:#333333">会员登录</a></li>
                </ul>
                <div class="regcon on">
                   <div class="clear"></div>
                   <form action="user.php" method="post" name="formUser" onsubmit="return register();">
                   <table width="372" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="64" height="62">用&ensp;户&ensp;名</td>
                        <td width="308"><input name="username" type="text" id="username" onblur="is_registered(this.value);"  placeholder="用户名" class="text10"/></td>
                      </tr>
					  <tr>
                        <td width="64"></td>
                        <td width="308" id="username_notice" style="color: #ff6600; font-size:12px;"></td>
                      </tr>
					  <tr>
                        <td width="64" height="62">手机号码</td>
                        <td width="308"><input name="extend_field5" type="text" id="extend_field5" placeholder="手机号" onblur="check_mobile(this.value);" class="text10"/></td>
                      </tr>
                      <tr>
                        <td width="64"></td>
                        <td width="308" id="mobile_notice" style="color: #ff6600; font-size:12px;"></td>
                      </tr>
					  
					  <tr>
                        <td width="64" height="62">验&ensp;证&ensp;码</td>
                        <td width="308">
                           <input type="text" name="mobile_code" id="mobile_code" placeholder="请输入验证码" class="text10 text11"/>
                           <a href="javascript:void(0)" id="zphone" onclick="sendsms();" class="send">发送验证码</a>
                        </td>
                      </tr>
					  <tr>
                        <td width="64"></td>
                        <td width="308" id="mobile_code_notice" style="color: #ff6600; font-size:12px;"></td>
                      </tr>
                       
                      <tr>
                        <td width="64" height="62">设置密码</td>
                        <td width="308">
                           <input type="password"  name="password" id="password1" onblur="check_password(this.value);" placeholder="请输入密码" class="text10"/>
                        </td>
                      </tr>
                      <tr>
                        <td width="64"></td>
                        <td width="308" id="password_notice" style="color: #ff6600; font-size:12px;"></td>
                      </tr>
                      <tr>
                        <td width="64" height="62">确认密码</td>
                        <td width="308">
                           <input name="confirm_password" type="password" id="conform_password" onblur="check_conform_password(this.value);" placeholder="请确认密码" class="text10" />
                        </td>
                      </tr>
                      <tr>
                        <td width="64"></td>
                        <td width="308" id="conform_password_notice" style="color: #ff6600; font-size:12px;"></td>
                      </tr>

                      
                      
	<?php $_from = $this->_var['extend_info_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'field');if (count($_from)):
    foreach ($_from AS $this->_var['field']):
?>
	<?php if ($this->_var['field']['id'] == 6): ?>
        <tr>
          <td align="right"><?php echo $this->_var['lang']['passwd_question']; ?></td>
          <td>
          <select name='sel_question'>
	  <option value='0'><?php echo $this->_var['lang']['sel_question']; ?></option>
	  <?php echo $this->html_options(array('options'=>$this->_var['passwd_questions'])); ?>
	  </select>
          </td>
        </tr>
        <tr>
          <td  <?php if ($this->_var['field']['is_need']): ?>id="passwd_quesetion"<?php endif; ?>><?php echo $this->_var['lang']['passwd_answer']; ?></td>
          <td>
	  <input name="passwd_answer" type="text" size="25" class="inputBg" maxlengt='20'/>
          </td>
        </tr>
	<?php elseif ($this->_var['field']['id'] == 5): ?>
    
    <?php else: ?>
        <tr>
          <td <?php if ($this->_var['field']['is_need']): ?>id="extend_field<?php echo $this->_var['field']['id']; ?>i"<?php endif; ?>><?php echo $this->_var['field']['reg_field_name']; ?></td>
          <td>
          <input name="extend_field<?php echo $this->_var['field']['id']; ?>" type="text" class="text10" />
          </td>
        </tr>
	<?php endif; ?>
	<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                      
                      <?php if ($this->_var['enabled_captcha']): ?>
                      <tr>
                        <td width="64" height="62">验&ensp;证&ensp;码</td>
                        <td width="308">
                           <input type="text" name="captcha" placeholder="请输入验证码" class="text10 text11"/>
                           <img src="captcha.php?<?php echo $this->_var['rand']; ?>" alt="captcha" style="vertical-align: middle;cursor: pointer;" onClick="this.src='captcha.php?'+Math.random()" />
                        </td>
                      </tr>
                      <?php endif; ?> 
                      <tr>
                        <td width="64" height="40"></td>
                        <td width="308">
                           <input name="agreement" type="checkbox" value="1" checked="checked" />&ensp;<a href="article.php?cat_id=-1" target="_blank" style="font-size: 12px; color: #ff6600;">已阅读并同意《装灯网用户服务手册》服务条款</a>
                        </td>
                      </tr>
                      <tr>
                        <td width="64" height="62"></td>
                        <td width="308"><input name="act" type="hidden" value="act_register" ><input type="hidden" name="back_act" value="<?php echo $this->_var['back_act']; ?>" />
                           <input type="submit" value="" class="btn14" />
                        </td>
                      </tr>                      
                   </table>
                   </form>
                   <div class="clear"></div>
                </div>
             </div>


<?php endif; ?>



    <?php if ($this->_var['action'] == 'get_password'): ?>
    <?php echo $this->smarty_insert_scripts(array('files'=>'utils.js')); ?>
    <script type="text/javascript">
    <?php $_from = $this->_var['lang']['password_js']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['item']):
?>
      var <?php echo $this->_var['key']; ?> = "<?php echo $this->_var['item']; ?>";
    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
    </script>



             <div class="register">
                <div class="find">
                   <span class="on">找回密码</span>
                </div>
                <div class="regcon on">
                   <div class="clear"></div>
                   <form action="user.php" method="post" name="getPassword">
                   <table width="372" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="64" height="62">用&ensp;户&ensp;名</td>
                        <td width="308"><input type="text" name="username" id="username" placeholder="用户名" class="text10"/></td>
                      </tr>
                      <!-- <tr>
                        <td width="64" height="62">邮箱地址</td>
                        <td width="308">
                           <input name="email" type="text" placeholder="请输入邮箱地址" class="text10"/>
                        </td>
                      </tr> -->
					  <tr>
                        <td width="64" height="62">手机号码</td>
                        <td width="308"><input type="text" name="extend_field5" id="extend_field5" placeholder="手机号" class="text10"/></td>
                      </tr>
                      <tr>
                        <td width="64" height="62">验&ensp;证&ensp;码</td>
                        <td width="308">
							<input type="text" name="mobile_code" id="mobile_code" placeholder="请输入验证码" class="text10 text11"/>
                           <a href="javascript:void(0)" id="zphone" onclick="sendsms_get();" class="send">请输入验证码</a>
                        </td>
                      </tr>
                      <tr>
                        <td width="64" height="62">设置密码</td>
                        <td width="308">
                           <input type="password"  name="password" id="password1" placeholder="请输入密码" class="text10"/>
                        </td>
                      </tr>
                      <tr>
                        <td width="64" height="62">确认密码</td>
                        <td width="308">
                           <input name="confirm_password" type="password" id="conform_password" placeholder="请确认密码" class="text10" />
                        </td>
                      </tr>
                      <tr>
                        <td width="64" height="62"></td>
                        <td width="308">
                           <input type="submit" value="" class="btn14 btn16" />
                           <input type="hidden" name="act" value="send_pwd_mobile" />
                        </td>
                      </tr>                      
                   </table>
                   </form>
                   <div class="clear"></div>
                </div>
             </div>


<?php endif; ?>


    <?php if ($this->_var['action'] == 'qpassword_name'): ?>
<div class="usBox">
  <div class="usBox_2 clearfix">
    <form action="user.php" method="post">
        <br />
        <table width="70%" border="0" align="center">
          <tr>
            <td colspan="2" align="center"><strong><?php echo $this->_var['lang']['get_question_username']; ?></strong></td>
          </tr>
          <tr>
            <td width="29%" align="right"><?php echo $this->_var['lang']['username']; ?></td>
            <td width="61%"><input name="user_name" type="text" size="30" class="inputBg" /></td>
          </tr>
          <tr>
            <td></td>
            <td><input type="hidden" name="act" value="get_passwd_question" />
              <input type="submit" name="submit" value="<?php echo $this->_var['lang']['submit']; ?>" class="bnt_blue" style="border:none;" />
              <input name="button" type="button" onclick="history.back()" value="<?php echo $this->_var['lang']['back_page_up']; ?>" style="border:none;" class="bnt_blue_1" />
	    </td>
          </tr>
        </table>
        <br />
      </form>
  </div>
</div>
<?php endif; ?>


    <?php if ($this->_var['action'] == 'get_passwd_question'): ?>
<div class="usBox">
  <div class="usBox_2 clearfix">
    <form action="user.php" method="post">
        <br />
        <table width="70%" border="0" align="center">
          <tr>
            <td colspan="2" align="center"><strong><?php echo $this->_var['lang']['input_answer']; ?></strong></td>
          </tr>
          <tr>
            <td width="29%" align="right"><?php echo $this->_var['lang']['passwd_question']; ?>：</td>
            <td width="61%"><?php echo $this->_var['passwd_question']; ?></td>
          </tr>
          <tr>
            <td align="right"><?php echo $this->_var['lang']['passwd_answer']; ?>：</td>
            <td><input name="passwd_answer" type="text" size="20" class="inputBg" /></td>
          </tr>
          <?php if ($this->_var['enabled_captcha']): ?>
          <tr>
            <td align="right"><?php echo $this->_var['lang']['comment_captcha']; ?></td>
            <td><input type="text" size="8" name="captcha" class="inputBg" />
            <img src="captcha.php?is_login=1&<?php echo $this->_var['rand']; ?>" alt="captcha" style="vertical-align: middle;cursor: pointer;" onClick="this.src='captcha.php?is_login=1&'+Math.random()" /> </td>
          </tr>
          <?php endif; ?>
          <tr>
            <td></td>
            <td><input type="hidden" name="act" value="check_answer" />
              <input type="submit" name="submit" value="<?php echo $this->_var['lang']['submit']; ?>" class="bnt_blue" style="border:none;" />
              <input name="button" type="button" onclick="history.back()" value="<?php echo $this->_var['lang']['back_page_up']; ?>" style="border:none;" class="bnt_blue_1" />
	    </td>
          </tr>
        </table>
        <br />
      </form>
  </div>
</div>
<?php endif; ?>

<?php if ($this->_var['action'] == 'reset_password'): ?>
    <script type="text/javascript">
    <?php $_from = $this->_var['lang']['password_js']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['item']):
?>
      var <?php echo $this->_var['key']; ?> = "<?php echo $this->_var['item']; ?>";
    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
    </script>
<div class="usBox">
  <div class="usBox_2 clearfix">
    <form action="user.php" method="post" name="getPassword2" onSubmit="return submitPwd()">
      <br />
      <table width="80%" border="0" align="center">
        <tr>
          <td><?php echo $this->_var['lang']['new_password']; ?></td>
          <td><input name="new_password" type="password" size="25" class="inputBg" /></td>
        </tr>
        <tr>
          <td><?php echo $this->_var['lang']['confirm_password']; ?>:</td>
          <td><input name="confirm_password" type="password" size="25"  class="inputBg"/></td>
        </tr>
        <tr>
          <td colspan="2" align="center">
            <input type="hidden" name="act" value="act_edit_password" />
            <input type="hidden" name="uid" value="<?php echo $this->_var['uid']; ?>" />
            <input type="hidden" name="code" value="<?php echo $this->_var['code']; ?>" />
            <input type="submit" name="submit" value="<?php echo $this->_var['lang']['confirm_submit']; ?>" />
          </td>
        </tr>
      </table>
      <br />
    </form>
  </div>
</div>
<?php endif; ?>

          </div>
       </div>  
<?php echo $this->fetch('library/page_footerr.lbi'); ?>
</body>
<script type="text/javascript">
var process_request = "<?php echo $this->_var['lang']['process_request']; ?>";
<?php $_from = $this->_var['lang']['passport_js']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['item']):
?>
var <?php echo $this->_var['key']; ?> = "<?php echo $this->_var['item']; ?>";
<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
var username_exist = "<?php echo $this->_var['lang']['username_exist']; ?>";
</script>
</html>
