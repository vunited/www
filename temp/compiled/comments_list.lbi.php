

                     <div class="clear"></div>
                     <ul class="pllist">
                        <?php $_from = $this->_var['comments']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'comment');if (count($_from)):
    foreach ($_from AS $this->_var['comment']):
?>
                        <li>
                          <div class="clear"></div>
                          <div class="pllist-l">                             
                             <?php if ($this->_var['comment']['user_img']): ?>
                             <img src="<?php echo $this->_var['comment']['user_img']; ?>" width="49" height="49" />
                             <?php else: ?>
                             <img src="themes/default/images/t18.png" width="49" height="49" />
                             <?php endif; ?>
                             
                          </div>
                          <div class="pllist-r">
                             <b><?php echo htmlspecialchars($this->_var['comment']['username']); ?></b>
                             <span><?php echo $this->_var['comment']['add_time']; ?></span>
                             <p class="p11"><?php echo $this->_var['comment']['content']; ?></p>
                             <p class="p11">                        
                             <?php if ($this->_var['comment']['pic1']): ?>                             
                               <a href="<?php echo $this->_var['comment']['pic1']; ?>" target="_blank"><img src="<?php echo $this->_var['comment']['pic1']; ?>" width="40" height="40"/></a>                             
                             <?php endif; ?>
                             <?php if ($this->_var['comment']['pic2']): ?>
                               <a href="<?php echo $this->_var['comment']['pic2']; ?>" target="_blank"><img src="<?php echo $this->_var['comment']['pic2']; ?>" width="40" height="40"/></a>   
                             <?php endif; ?>
                             <?php if ($this->_var['comment']['pic3']): ?>
                               <a href="<?php echo $this->_var['comment']['pic3']; ?>" target="_blank"><img src="<?php echo $this->_var['comment']['pic3']; ?>" width="40" height="40"/></a>   
                             <?php endif; ?>
                             </p>
                          </div>
                          <div class="clear"></div>
                        </li>
                        <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                     </ul>
                     <div class="clear"></div><div class="clear"></div>
                     

        <form name="selectPageForm" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get">
        <?php if ($this->_var['pager']['styleid'] == 0): ?>
        <div id="pager" class="page">
          <?php echo $this->_var['lang']['pager_1']; ?><?php echo $this->_var['pager']['record_count']; ?><?php echo $this->_var['lang']['pager_2']; ?><?php echo $this->_var['lang']['pager_3']; ?><?php echo $this->_var['pager']['page_count']; ?><?php echo $this->_var['lang']['pager_4']; ?> <span> <a href="<?php echo $this->_var['pager']['page_first']; ?>"><?php echo $this->_var['lang']['page_first']; ?></a> <a href="<?php echo $this->_var['pager']['page_prev']; ?>"><?php echo $this->_var['lang']['page_prev']; ?></a> <a href="<?php echo $this->_var['pager']['page_next']; ?>"><?php echo $this->_var['lang']['page_next']; ?></a> <a href="<?php echo $this->_var['pager']['page_last']; ?>"><?php echo $this->_var['lang']['page_last']; ?></a> </span>
            <?php $_from = $this->_var['pager']['search']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'item_0_21179100_1478241346');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['item_0_21179100_1478241346']):
?>
            <input type="hidden" name="<?php echo $this->_var['key']; ?>" value="<?php echo $this->_var['item_0_21179100_1478241346']; ?>" />
            <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
        </div>
        <?php else: ?>

        
         <div id="pager" class="page">
          <span class="f_l f6" style="margin-right:10px;"><?php echo $this->_var['lang']['total']; ?> <b><?php echo $this->_var['pager']['record_count']; ?></b> <?php echo $this->_var['lang']['user_comment_num']; ?></span>
          <?php if ($this->_var['pager']['page_first']): ?><a href="<?php echo $this->_var['pager']['page_first']; ?>">1 ...</a><?php endif; ?>
          <?php if ($this->_var['pager']['page_prev']): ?><a class="prev" href="<?php echo $this->_var['pager']['page_prev']; ?>"><?php echo $this->_var['lang']['page_prev']; ?></a><?php endif; ?>
          <?php $_from = $this->_var['pager']['page_number']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'item_0_21216800_1478241346');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['item_0_21216800_1478241346']):
?>
                <?php if ($this->_var['pager']['page'] == $this->_var['key']): ?>
                <span class="page_now"><?php echo $this->_var['key']; ?></span>
                <?php else: ?>
                <a href="<?php echo $this->_var['item_0_21216800_1478241346']; ?>">[<?php echo $this->_var['key']; ?>]</a>
                <?php endif; ?>
            <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>

          <?php if ($this->_var['pager']['page_next']): ?><a class="next" href="<?php echo $this->_var['pager']['page_next']; ?>"><?php echo $this->_var['lang']['page_next']; ?></a><?php endif; ?>
          <?php if ($this->_var['pager']['page_last']): ?><a class="last" href="<?php echo $this->_var['pager']['page_last']; ?>">...<?php echo $this->_var['pager']['page_count']; ?></a><?php endif; ?>
          <?php if ($this->_var['pager']['page_kbd']): ?>
            <?php $_from = $this->_var['pager']['search']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'item_0_21262700_1478241346');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['item_0_21262700_1478241346']):
?>
            <input type="hidden" name="<?php echo $this->_var['key']; ?>" value="<?php echo $this->_var['item_0_21262700_1478241346']; ?>" />
            <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
            <kbd style="float:left; margin-left:8px; position:relative; bottom:3px;"><input type="text" name="page" onkeydown="if(event.keyCode==13)selectPage(this)" size="3" class="B_blue" /></kbd>
            <?php endif; ?>
        </div>
        

        <?php endif; ?>
        </form>
        <script type="Text/Javascript" language="JavaScript">
        <!--
        
        function selectPage(sel)
        {
          sel.form.submit();
        }
        
        //-->
        </script>


