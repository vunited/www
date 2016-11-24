<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="Keywords" content="<?php echo $this->_var['keywords']; ?>" />
<meta name="Description" content="<?php echo $this->_var['description']; ?>" />

<title><?php echo $this->_var['page_title']; ?></title>



<link rel="shortcut icon" href="favicon.ico" />
<link rel="icon" href="animated_favicon.gif" type="image/gif" />
<link rel="alternate" type="application/rss+xml" title="RSS|<?php echo $this->_var['page_title']; ?>" href="<?php echo $this->_var['feed_url']; ?>" />

<link href="themes/default/css/zyit.css" rel="stylesheet" type="text/css"  charset="utf-8"> 
<link href="themes/default/css/banner.css" rel="stylesheet" type="text/css"  charset="utf-8"> 


<?php echo $this->smarty_insert_scripts(array('files'=>'common.js,index.js')); ?>
<script type="text/javascript" src="themes/default/js/MSClass.js"></script>
</head>
<body>
<?php echo $this->fetch('library/page_header.lbi'); ?>
<?php echo $this->fetch('library/index_ad.lbi'); ?>


   
      <div class="container">
         
            <div class="container" style="overflow:hidden">
            <div id="next" style="width:1220px;">
               <?php 
$k = array (
  'name' => 'ads',
  'id' => '4',
  'num' => '2',
);
echo $this->_echash . $k['name'] . '|' . serialize($k) . $this->_echash;
?>
            </div>
            </div>
         
            <div class="clear"></div><div class="clear"></div>   
            

<?php echo $this->fetch('library/recommend_best.lbi'); ?>
<?php echo $this->fetch('library/recommend_new.lbi'); ?>
<?php echo $this->fetch('library/recommend_hot.lbi'); ?>
          
            <?php echo $this->fetch('library/brands.lbi'); ?> 
      </div>
   

<?php echo $this->fetch('library/page_footer.lbi'); ?>
</body>
</html>
