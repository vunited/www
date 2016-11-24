<?php if ($this->_var['best_goods']): ?>
            <div class="container">
               <div class="title title1 position">
                  <?php echo $this->_var['best_goodsn']; ?>
                  <a href="search.php?intro=best" class="more">查看更多</a>
               </div>
               <div class="clear"></div>
               <div class="scrolllist s1 position">
		          <a class="abtn aleft" href="javascript:void(0)" title="左移" id="LeftButton"></a>
                  <div class="imglist_w" id="Movie_Box">
                      <ul class="imglist" id="still_scroll_container">
                      <?php $_from = $this->_var['best_goods']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'goods');if (count($_from)):
    foreach ($_from AS $this->_var['goods']):
?>  
                          <li class="position">
                              <a href="<?php echo $this->_var['goods']['url']; ?>"><img width="276" height="276" src="<?php echo $this->_var['goods']['thumb']; ?>" /></a>
                              <a href="<?php echo $this->_var['goods']['url']; ?>" class="proname"><?php echo $this->_var['goods']['short_style_name']; ?></a>
                              <p><span><?php if ($this->_var['goods']['promote_price'] != ""): ?><?php echo $this->_var['goods']['promote_price']; ?><?php else: ?><?php echo $this->_var['goods']['shop_price']; ?><?php endif; ?></span></p>
                              <div class="img3">
                                 <?php if ($this->_var['goods']['brand_id']): ?><img src="themes/default/images/index20.png" width="57" height="25" /><?php endif; ?>
                                 <?php if ($this->_var['goods']['is_new']): ?><img src="themes/default/images/index21.png" width="57" height="25" /><?php endif; ?>
                              </div>
                          </li>
                      <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                      </ul>
                  </div>
		          <a class="abtn aright" href="javascript:void(0)" title="右移" id="RightButton"></a>
	           </div>
            </div>
            <div class="clear"></div><div class="clear"></div>            
<script type="text/javascript">
/*********DIV + CSS左右交替滚动、缓动、默认静止、跳过等待时间改变方向及样式切换实例(将第WaitTime设置成60000，则第DelayTime会起作用)***************/
var MarqueeDivControl = new Marquee(
{
	MSClass	  : ["Movie_Box","still_scroll_container"],
	Direction : 2,
	Step	  : 20,
	Width	  : 1200,
	Height	  : 400,
	Timer	  : 20,
	DelayTime : 3000,
	WaitTime  : 100000,
	ScrollStep: 300,
	SwitchType: 0,
	AutoStart : true
});
$("LeftButton").onclick = function(){MarqueeDivControl.Run("Right")};	//跳过等待时间向左滚动 可以用MarqueeDiv4Control.Run(2)代替
$("RightButton").onclick = function(){MarqueeDivControl.Run("Left")};//跳过等待时间向右滚动
</script> 
<?php endif; ?>