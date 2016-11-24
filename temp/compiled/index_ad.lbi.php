<style>
#JINGDONGBox{width:1900px;  margin:0 calc(50% - 950px);}

#JINGDONGNumID li:hover,#JINGDONGNumID li.active{background-color:#f96906;}
</style>



<div class="banner">
<div class="fullSlide" style="width:100%; overflow:hidden">

            <div id="JINGDONGBox">
                <ul id="JINGDONGContentID">
                <?php $_from = $this->_var['playerdb']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'play');if (count($_from)):
    foreach ($_from AS $this->_var['play']):
?>
                <li><a href="<?php echo $this->_var['play']['url']; ?>"><img src="<?php echo $this->_var['play']['src']; ?>" width="1900" height="500"/></a></li>
                <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                </ul>                
            </div>
            
            <div class="container position">
                <div class="hd">
                <ul id="JINGDONGNumID">
                <?php $_from = $this->_var['playerdb']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'play');$this->_foreach['play'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['play']['total'] > 0):
    foreach ($_from AS $this->_var['play']):
        $this->_foreach['play']['iteration']++;
?>
                <li><?php echo $this->_foreach['play']['iteration']; ?></li>
                <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                </ul>
                </div>
                <a href="#next" class="btn1" name="a"></a>
            </div>  

</div>   
</div>
      <div class="clear"></div><div class="clear"></div>      
    

<script type="text/javascript">
new Marquee(
{
	MSClassID : "JINGDONGBox",
	ContentID : "JINGDONGContentID",
	TabID	  : "JINGDONGNumID",
	Direction : 2,
	Step	  : 0.2,
	Width	  : 1900,
	Height	  : 500,
	Timer	  : 20,
	DelayTime : 5000,
	WaitTime  : 5000,
	ScrollStep: 0,
	SwitchType: 0,
	AutoStart : 1
})

</script>
  
