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
<link href="themes/default/css/banner.css" rel="stylesheet" type="text/css"  charset="utf-8"> 

<?php echo $this->smarty_insert_scripts(array('files'=>'utils.js,common.js,global.js,compare.js')); ?>
</head>
<body>
<?php echo $this->fetch('library/page_header.lbi'); ?>

      <div class="sx">
         <div class="container">
             <div class="local"><?php echo $this->fetch('library/ur_here.lbi'); ?></div>
         </div>
      </div>
      <div class="shopsx prosx position container">
           <a href="<?php echo $this->_var['pager']['url']; ?>?intro=<?php echo $this->_var['intromode']; ?>&category=<?php echo $this->_var['category']; ?>&keywords=<?php echo $this->_var['keywords']; ?>&display=<?php echo $this->_var['pager']['display']; ?>&brand=<?php echo $this->_var['brand_id']; ?>&min_price=<?php echo $this->_var['pager']['search']['min_price']; ?>&max_price=<?php echo $this->_var['pager']['search']['max_price']; ?>&filter_attr=<?php echo $this->_var['filter_attr']; ?>&page=<?php echo $this->_var['pager']['page']; ?>&sort=shop_price&order=ASC#goods_list" <?php if ($this->_var['pager']['search']['order'] == ASC): ?>class="aaabg"<?php endif; ?>><span class="img5">价格从低到高</span></a>
           
           <a href="<?php echo $this->_var['pager']['url']; ?>?intro=<?php echo $this->_var['intromode']; ?>&category=<?php echo $this->_var['category']; ?>&keywords=<?php echo $this->_var['keywords']; ?>&display=<?php echo $this->_var['pager']['display']; ?>&brand=<?php echo $this->_var['brand_id']; ?>&min_price=<?php echo $this->_var['pager']['search']['min_price']; ?>&max_price=<?php echo $this->_var['pager']['search']['max_price']; ?>&filter_attr=<?php echo $this->_var['filter_attr']; ?>&page=<?php echo $this->_var['pager']['page']; ?>&sort=shop_price&order=DESC#goods_list" <?php if ($this->_var['pager']['search']['order'] == DESC && $this->_var['pager']['search']['sort'] == shop_price): ?>class="aaabg"<?php endif; ?>><span class="img6">价格从高到低</span></a>
           

           
      </div>
      <div class="clear"></div>
      
      
      
          <div class="container">
             <ul class="prolist">
                    <?php $_from = $this->_var['goods_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'goods');$this->_foreach['goods_list'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['goods_list']['total'] > 0):
    foreach ($_from AS $this->_var['goods']):
        $this->_foreach['goods_list']['iteration']++;
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
      
      


      <?php echo $this->fetch('library/pages.lbi'); ?>
      
<?php echo $this->fetch('library/page_footer.lbi'); ?>
</body>
</html>
