            <div class="left">
               <ul class="leftnav">
                  <li><a href="user.php?act=profile" <?php if ($this->_var['action'] == 'profile'): ?>class="leftnavbg"<?php endif; ?>>账号管理</a></li>
                  <li><a href="user.php?act=address_list" <?php if ($this->_var['action'] == 'address_list'): ?>class="leftnavbg"<?php endif; ?>>地址管理</a></li>
                  <li><a href="user.php?act=order_list" <?php if ($this->_var['action'] == 'order_list' || $this->_var['action'] == 'order_detail'): ?>class="leftnavbg"<?php endif; ?>>订单管理</a></li>
                  <li><a href="user.php?act=fw" <?php if ($this->_var['action'] == 'fw'): ?>class="leftnavbg"<?php endif; ?>>服务预约</a></li>
                  <li><a href="user.php?act=order_back" <?php if ($this->_var['action'] == 'order_back' || $this->_var['action'] == 'order_back_search'): ?>class="leftnavbg"<?php endif; ?>>退换货管理</a></li>
                  <li><a href="user.php?act=collection_list" <?php if ($this->_var['action'] == 'collection_list'): ?>class="leftnavbg"<?php endif; ?>>我的收藏</a></li>
                  <li><a href="user.php?act=account_deposit" <?php if ($this->_var['action'] == 'account_deposit'): ?>class="leftnavbg"<?php endif; ?>>账户余额</a></li>
                  <li><a href="user.php?act=affiliate" <?php if ($this->_var['action'] == 'affiliate'): ?>class="leftnavbg"<?php endif; ?>>分享好友</a></li>
                  <li><a href="user.php?act=bonus" <?php if ($this->_var['action'] == 'bonus'): ?>class="leftnavbg"<?php endif; ?>>我的红包</a></li>
                  <li><a href="user.php?act=logout">安全退出</a></li>
               </ul>
            </div>
