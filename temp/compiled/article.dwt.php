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

<?php echo $this->smarty_insert_scripts(array('files'=>'common.js')); ?>
</head>
<body>
<?php echo $this->fetch('library/page_header.lbi'); ?>

      <div class="content">
         <div class="container position">
            <div class="local">您的当前位置 > <a href="index.php">首页</a> > <span><?php echo htmlspecialchars($this->_var['article']['title']); ?></span></div>
            <div class="title5">
               <?php echo htmlspecialchars($this->_var['article']['title']); ?>
            </div>
            <div class="titleinfo">
                <span class="title9">一站式，维护换新一键搞定</span>
                <span class="title10">
                   专业团队—— 装灯大师，专业装灯20年<br>
                   安装时间你来定—— 装灯换灯，一小时上门承诺
                </span>
            </div>
         </div>
          <div class="container position">
              
                 <img src="<?php echo $this->_var['article']['file_url']; ?>" width="1200"  />
               
            <div class="clear"></div><div class="clear"></div>
                 <div class="title7"><span><?php echo htmlspecialchars($this->_var['article']['title']); ?></span></div>  
        </div>
      </div>
        
      <div class="container">
           <div class="arc1">
           <?php if ($this->_var['article']['content']): ?>
           <?php echo $this->_var['article']['content']; ?>
           <?php endif; ?>
           </div>
      </div> 
   
<?php echo $this->fetch('library/page_footer.lbi'); ?>
</body>
</html>
