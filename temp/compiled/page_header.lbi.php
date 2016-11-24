<meta property="qc:admins" content="3731175170620516745676654" />
<meta name="baidu-site-verification" content="Em8JVKO5Ai" />
<meta property="wb:webmaster" content="b0714e9688d66db1" />
<meta property="wb:webmaster" content="3eeec789707ba69c" />
<script type="text/javascript">
var process_request = "<?php echo $this->_var['lang']['process_request']; ?>";
</script>
<?php echo $this->smarty_insert_scripts(array('files'=>'utils.js')); ?>
   
      <div class="header">
         <div class="container">
            <div class="header-t">
              <div class="logo"><a href="index.php" name="top"><img src="themes/default/images/logo.gif" /></a></div>
              <div class="search">
                 <div class="user">                 
                     <?php 
$k = array (
  'name' => 'member_info',
);
echo $this->_echash . $k['name'] . '|' . serialize($k) . $this->_echash;
?><a href="flow.php" class="shopcar"><span id="ECS_CARTINFO_flows"><?php 
$k = array (
  'name' => 'cart_info',
);
echo $this->_echash . $k['name'] . '|' . serialize($k) . $this->_echash;
?></span></a>
                 </div>
                 <div class="sear">                   
    <script type="text/javascript">
    
    
    function checkSearchForm()
    {
        if(document.getElementById('keyword').value)
        {
            return true;
        }
        else
        {
            alert("<?php echo $this->_var['lang']['no_keywords']; ?>");
            return false;
        }
    }
    
    
    </script>  
    
    
<script type="text/javascript">
function testDisplay()
{

    var divD = document.getElementById("testD");
    if(divD.style.display=="none")
    {
        divD.style.display = "block";
    }
    else
    {
        divD.style.display = "none";
    }

}
</script>
    
    
   
                   <form id="searchForm" name="searchForm" method="get" action="search.php" onSubmit="return checkSearchForm()">
                   <input name="keywords" id="keyword" type="text" value="<?php echo htmlspecialchars($this->_var['search_keywords']); ?>" class="text"/>
                   <input type="submit" value="" class="btn">
                   </form>
                   
                 </div>
              </div>
            </div>
            <div class="header-b">
                  <div class="nav-l">
                    <a href="javascript:;" class="downdrop"  onMouseUp="testDisplay()"><?php 
$k = array (
  'name' => 'cookcity',
);
echo $this->_echash . $k['name'] . '|' . serialize($k) . $this->_echash;
?></a>质量优选 & 本地服务 <a href="xd.php" class="img"><img src="themes/default/images/index06.png" width="145" height="29" /></a>                  
                  </div>                  
               
                  <div class="nav-r">
                     <a href="index.php" style="background: none" <?php if ($this->_var['navigator_list']['config']['index'] == 1): ?>class="abg"<?php endif; ?>><?php echo $this->_var['lang']['home']; ?></a>
                     <?php $_from = $this->_var['navigator_list']['top']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'nav');$this->_foreach['nav_top_list'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['nav_top_list']['total'] > 0):
    foreach ($_from AS $this->_var['nav']):
        $this->_foreach['nav_top_list']['iteration']++;
?>
                     <a href="<?php echo $this->_var['nav']['url']; ?>" <?php if ($this->_var['nav']['opennew'] == 1): ?>target="_blank"<?php endif; ?> <?php if ($this->_var['nav']['active'] == 1): ?>class="abg"<?php endif; ?>><?php echo $this->_var['nav']['name']; ?></a>
                     <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                     
                  </div>
               
            </div>            
            <div id="testD" style="display:none; line-height:24px"><?php 
$k = array (
  'name' => 'city',
);
echo $this->_echash . $k['name'] . '|' . serialize($k) . $this->_echash;
?></div>
            
         </div>
      </div>
   
   