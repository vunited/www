<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="Keywords" content="<?php echo $this->_var['keywords']; ?>" />
<meta name="Description" content="<?php echo $this->_var['description']; ?>" />

<title><?php echo $this->_var['page_title']; ?></title>

<link rel="shortcut icon" href="favicon.ico" />
<link href="themes/default/css/zyit.css" rel="stylesheet" type="text/css"  charset="utf-8"> 
<link href="themes/default/css/banner.css" rel="stylesheet" type="text/css"  charset="utf-8"> 

<?php echo $this->smarty_insert_scripts(array('files'=>'common.js,global.js,compare.js')); ?>
</head>
<body>
<?php echo $this->fetch('library/page_header.lbi'); ?>


      <div class="sx">
         <div class="container">
             <div class="local"><?php echo $this->fetch('library/ur_here.lbi'); ?></div>             
           <div class="clear"></div>
             <div class="sxlist">
                <b class="sxtitle">筛选：</b>
                
	 
	  <?php if ($this->_var['brands']['1'] || $this->_var['price_grade']['1'] || $this->_var['filter_attr_list']): ?>
      
			<?php if ($this->_var['brands']['1']): ?>
                    <?php echo $this->_var['lang']['brand']; ?>
                    <select name="brand" onchange="javascript:location.href=this.value;">  
                    <?php $_from = $this->_var['brands']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'brand');if (count($_from)):
    foreach ($_from AS $this->_var['brand']):
?>
                    <option value="<?php echo $this->_var['brand']['url']; ?>" <?php if ($this->_var['brand']['selected']): ?>selected="selected"<?php endif; ?>><?php echo $this->_var['brand']['brand_name']; ?></option>					
                    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                    </select>
			<?php endif; ?>
			<?php if ($this->_var['price_grade']['1']): ?>
                    <?php echo $this->_var['lang']['price']; ?>
                    <select name="price" onchange="javascript:location.href=this.value;">  
                    <?php $_from = $this->_var['price_grade']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'grade');if (count($_from)):
    foreach ($_from AS $this->_var['grade']):
?>
                    <option value="<?php echo $this->_var['grade']['url']; ?>" <?php if ($this->_var['grade']['selected']): ?>selected="selected"<?php endif; ?>><?php echo $this->_var['grade']['price_range']; ?></option>					
                    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                    </select>
			<?php endif; ?>
                    <?php $_from = $this->_var['filter_attr_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'filter_attr_0_47303200_1478158484');if (count($_from)):
    foreach ($_from AS $this->_var['filter_attr_0_47303200_1478158484']):
?>
                    <?php echo htmlspecialchars($this->_var['filter_attr_0_47303200_1478158484']['filter_attr_name']); ?>                    
                    <select name="attr" onchange="javascript:location.href=this.value;">  
                    <?php $_from = $this->_var['filter_attr_0_47303200_1478158484']['attr_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'attr');if (count($_from)):
    foreach ($_from AS $this->_var['attr']):
?>
                    <option value="<?php echo $this->_var['attr']['url']; ?>" <?php if ($this->_var['attr']['selected']): ?>selected="selected"<?php endif; ?>><?php echo $this->_var['attr']['attr_value']; ?></option>					
                    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                    </select>
                    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
      
      
      
	  <?php endif; ?>
	 
                
                
             </div>
             <div class="shopsx prosx position">
             <span class="p3"><?php echo $this->_var['catname']; ?></span>            
             <a href="<?php echo $this->_var['script_name']; ?>.php?id=<?php echo $this->_var['category']; ?>&display=<?php echo $this->_var['pager']['display']; ?>&brand=<?php echo $this->_var['brand_id']; ?>&price_min=<?php echo $this->_var['price_min']; ?>&price_max=<?php echo $this->_var['price_max']; ?>&filter_attr=<?php echo $this->_var['filter_attr']; ?>&page=<?php echo $this->_var['pager']['page']; ?>&sort=shop_price&order=ASC#goods_list" <?php if ($this->_var['pager']['order'] == ASC): ?>class="aaabg"<?php endif; ?>><span class="img5">价格从低到高</span></a>
             <a href="<?php echo $this->_var['script_name']; ?>.php?id=<?php echo $this->_var['category']; ?>&display=<?php echo $this->_var['pager']['display']; ?>&brand=<?php echo $this->_var['brand_id']; ?>&price_min=<?php echo $this->_var['price_min']; ?>&price_max=<?php echo $this->_var['price_max']; ?>&filter_attr=<?php echo $this->_var['filter_attr']; ?>&page=<?php echo $this->_var['pager']['page']; ?>&sort=shop_price&order=DESC#goods_list" <?php if ($this->_var['pager']['order'] == DESC && $this->_var['pager']['sort'] == shop_price): ?>class="aaabg"<?php endif; ?>><span class="img6">价格从高到低</span></a>
             </div>
         </div>
      </div>
      <div class="clear"></div><div class="clear"></div>
      
      
      <?php echo $this->fetch('library/goods_list.lbi'); ?>
  <?php echo $this->fetch('library/pages.lbi'); ?>
  
  
<?php echo $this->fetch('library/page_footer.lbi'); ?>
</body>
</html>
