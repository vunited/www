<div id="append_parent"></div>
<?php if ($this->_var['user_info']): ?>
 <a href="user.php?act=order_list" class="login"><?php echo $this->_var['user_info']['username']; ?></a>|
 <a href="user.php?act=logout"><?php echo $this->_var['lang']['user_logout']; ?></a>
<?php else: ?>
 <a href="user.php" class="login">登陆</a>|
 <a href="user.php?act=register">注册</a>
<?php endif; ?>