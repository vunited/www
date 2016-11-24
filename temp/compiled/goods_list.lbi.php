          <div class="container">
          
                <?php if ($this->_var['brand_info']): ?>
                <div class="pp">
                   <div class="pp-l">
                      <img src="data/brandlogo/<?php echo $this->_var['brand_info']['brand_logo']; ?>" width="154"  />
                   </div>
                   <div class="pp-r">
                      <b><?php echo $this->_var['brand_info']['brand_name']; ?></b>
                      <p class="p7"><?php echo $this->_var['brand_info']['brand_desc']; ?></p>
                      <img src="themes/default/images/index41.jpg" width="997" height="25" />
                   </div>
                </div>
                <?php endif; ?>
          
             <div class="clear"></div><div class="clear"></div>
             <ul class="prolist">
                    <?php $_from = $this->_var['goods_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'goods');if (count($_from)):
    foreach ($_from AS $this->_var['goods']):
?>
                    <li class="position">
                        <a href="<?php echo $this->_var['goods']['url']; ?>"><img width="276" height="276" src="<?php echo $this->_var['goods']['goods_thumb']; ?>" /></a>
                        <a href="<?php echo $this->_var['goods']['url']; ?>" class="proname"><?php echo $this->_var['goods']['goods_name']; ?></a>
                        <p><span><?php if ($this->_var['goods']['promote_price'] != ""): ?><?php echo $this->_var['goods']['promote_price']; ?><?php else: ?><?php echo $this->_var['goods']['shop_price']; ?><?php endif; ?></span></p>
                        <div class="img3">
                           <?php if ($this->_var['goods']['brand_id']): ?><img src="themes/default/images/index20.png" width="57" height="25" /><?php endif; ?>
                           <?php if ($this->_var['goods']['is_new']): ?><img src="themes/default/images/index21.png" width="57" height="25" /><?php endif; ?>
                        </div>
                    </li>
                    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                </ul> 
             <div class="clear"></div><div class="clear"></div><div class="clear"></div>

   
          </div>