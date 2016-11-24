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

                    分类
                    <select name="brand" onchange="javascript:location.href=this.value;">  
                    <?php $_from = $this->_var['brand_cat_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'cat');if (count($_from)):
    foreach ($_from AS $this->_var['cat']):
?>
                    <option value="<?php echo $this->_var['cat']['url']; ?>" <?php if ($this->_var['category'] == $this->_var['cat']['cat_id']): ?>selected="selected"<?php endif; ?>><?php echo $this->_var['cat']['cat_name']; ?><?php if ($this->_var['cat']['goods_count']): ?>(<?php echo $this->_var['cat']['goods_count']; ?>)<?php endif; ?></option>					
                    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                    </select>
                    
                    
                
                
             </div>
             <div class="shopsx prosx position">
             <span class="p3"><?php echo $this->_var['brand']['brand_name']; ?></span>
             </div>
         </div>
      </div>
      <div class="clear"></div><div class="clear"></div>
      
          <div class="container">
                <div class="pp">
                   <div class="pp-l">
                      <?php if ($this->_var['brand']['brand_logo']): ?>
                      <img src="data/brandlogo/<?php echo $this->_var['brand']['brand_logo']; ?>" width="154" />
                      <?php endif; ?>
                   </div>
                   <div class="pp-r">
                      <b><?php echo $this->_var['brand']['brand_name']; ?></b>
                      <p class="p7"><?php echo nl2br($this->_var['brand']['brand_desc']); ?></p>
                      <img src="themes/default/images/index41.jpg" width="997" height="25" />
                   </div>
                </div>
          
             <div class="clear"></div><div class="clear"></div>
             
             
             
             
             
             
          </div>
      
      
        <?php echo $this->fetch('library/goods_list.lbi'); ?>
  <?php echo $this->fetch('library/pages.lbi'); ?>
  
<?php echo $this->fetch('library/page_footer.lbi'); ?>
</body>
</html>
