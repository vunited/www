<?php if ($this->_var['brand_list']): ?>
            <div class="container">
               <span class="title4"></span>
               <div class="tj">
                  <?php $_from = $this->_var['brand_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'brand');$this->_foreach['brand_foreach'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['brand_foreach']['total'] > 0):
    foreach ($_from AS $this->_var['brand']):
        $this->_foreach['brand_foreach']['iteration']++;
?>
                  <?php if (($this->_foreach['brand_foreach']['iteration'] - 1) <= 11): ?>
                  <a href="brand.php?id=<?php echo $this->_var['brand']['brand_id']; ?>"><img src="data/brandlogo/<?php echo $this->_var['brand']['brand_logo']; ?>" width="158" height="68" /></a>
                  <?php endif; ?>
                  <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
               </div>
            </div>
<?php endif; ?>