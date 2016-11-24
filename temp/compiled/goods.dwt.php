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
<link href="themes/default/css/pic.css" rel="stylesheet" type="text/css"  charset="utf-8"> 
<link href="themes/default/css/tab.css" rel="stylesheet" type="text/css"  charset="utf-8"> 
<link href="themes/default/css/lycss.css" rel="stylesheet" type="text/css"  charset="utf-8"> 

<?php if (! $this->_var['goods']['is_taobao']): ?>
<?php echo $this->smarty_insert_scripts(array('files'=>'transport.js')); ?>
<?php endif; ?>
<?php echo $this->smarty_insert_scripts(array('files'=>'common.js')); ?>

<script type="text/javascript">
    (function(win,doc){
        var s = doc.createElement("script"), h = doc.getElementsByTagName("head")[0];
        if (!win.alimamatk_show) {
            s.charset = "gbk";
            s.async = true;
            s.src = "http://a.alimama.cn/tkapi.js";
            h.insertBefore(s, h.firstChild);
        };
        var o = {
            pid: "<?php echo $this->_var['code_tdj']; ?>",/*推广单元ID，用于区分不同的推广渠道*/
            appkey: "",/*通过TOP平台申请的appkey，设置后引导成交会关联appkey*/
            unid: "",/*自定义统计字段*/
            type: "click" /* click 组件的入口标志 （使用click组件必设）*/
        };
        win.alimamatk_onload = win.alimamatk_onload || [];
        win.alimamatk_onload.push(o);
    })(window,document);
</script>
<script type="text/javascript" src="themes/default/js/mzp-packed-me.js"></script>
<script type="text/javascript">
function $id(element) {
  return document.getElementById(element);
}
//切屏--是按钮，_v是内容平台，_h是内容库
function reg(str){
  var bt=$id(str+"_b").getElementsByTagName("li");
  for(var i=0;i<bt.length;i++){
    bt[i].subj=str;
    bt[i].pai=i;
    bt[i].style.cursor="pointer";
    bt[i].onclick=function(){
      $id(this.subj+"_v").innerHTML=$id(this.subj+"_h").getElementsByTagName("blockquote")[this.pai].innerHTML;
      for(var j=0;j<$id(this.subj+"_b").getElementsByTagName("li").length;j++){
        var _bt=$id(this.subj+"_b").getElementsByTagName("li")[j];
        var ison=j==this.pai;
        _bt.className=(ison?"":"current");
      }
    }
  }
  $id(str+"_h").className="none";
  $id(str+"_v").innerHTML=$id(str+"_h").getElementsByTagName("blockquote")[0].innerHTML;
}
function del(){
        var num = document.getElementById("number");        
        var n = parseInt(num.value);        
        if(n-1<=0){
                alert("必须选择一个商品");
        }else{
                num.value = n-1;
        }
		changePrice()
}
function add(){        
        var num = document.getElementById("number");        
        var n = parseInt(num.value);        
        num.value = n+1;  
		changePrice()
}
function changeAtt(t) {
t.lastChild.checked='checked';
for (var i = 0; i<t.parentNode.childNodes.length;i++) {
        if (t.parentNode.childNodes[i].className == 'c4 c4bg') {
            t.parentNode.childNodes[i].className = 'c4';
        }
    }
t.className = "c4 c4bg";
changePrice();
}
</script>
</head>
<body>
<?php echo $this->fetch('library/page_header.lbi'); ?>
<?php echo $this->fetch('library/add_cat.lbi'); ?>



   
      <div class="content">
         <div class="container">
            <div class="local"><?php echo $this->fetch('library/ur_here.lbi'); ?></div>
            <div class="title5"><span class="p6" onclick="javascript:history.go(-1);" style="cursor:pointer"><?php echo $this->_var['goods']['goods_style_name']; ?></span></div>
         </div>
         <div class="clear"></div><div class="clear"></div>
         
            <div class="container">
               
                <div class="procontent-l">
                   <div id="preview">
                      <div class="jqzoom position" id="spec-n1">
                          <?php if ($this->_var['pictures']): ?>
                          <a href="<?php echo $this->_var['pictures']['0']['img_url']; ?>" id="zoom1" class="MagicZoom MagicThumb" title="<?php echo $this->_var['goods']['goods_style_name']; ?>" >
                          <img src="<?php echo $this->_var['pictures']['0']['img_url']; ?>" alt="<?php echo htmlspecialchars($this->_var['goods']['goods_name']); ?>"  id="thumb" width="427" height="427"/>
                          </a>     
                          <?php else: ?>
                          <a href="<?php echo $this->_var['goods']['goods_img']; ?>" id="zoom1" class="MagicZoom MagicThumb" title="<?php echo $this->_var['goods']['goods_style_name']; ?>" >
                          <img src="<?php echo $this->_var['goods']['goods_img']; ?>" alt="<?php echo htmlspecialchars($this->_var['goods']['goods_name']); ?>" width="427" height="427"/>
                          </a>
                          <?php endif; ?>
                          <div class="img3">
                             <?php if ($this->_var['brand_info']): ?><img src="themes/default/images/index20.png" width="57" height="25" /><?php endif; ?>
                             <?php if ($this->_var['goods']['is_new']): ?><img src="themes/default/images/index21.png" width="57" height="25" /><?php endif; ?>
                          </div>
                      </div>
                      <?php echo $this->fetch('library/goods_gallery.lbi'); ?>                      
                  </div> 
                </div>
                         
              
              <form action="javascript:addToCart(<?php echo $this->_var['goods']['goods_id']; ?>)" method="post" name="ECS_FORMBUY" id="ECS_FORMBUY" >
                <div class="procontent-r position">
                   <div class="title11">
                      <?php echo $this->_var['goods']['goods_style_name']; ?>
                   </div>
                   <div class="clear"></div>
                   <div class="cs1">
                      <?php if ($this->_var['goods']['is_promote'] && $this->_var['goods']['gmt_end_time']): ?>
                      <?php echo $this->smarty_insert_scripts(array('files'=>'lefttime.js')); ?>
                      价格&emsp;&emsp;<span class="c1"><b><?php echo $this->_var['goods']['promote_price']; ?></b></span>&emsp;库存<?php if ($this->_var['goods']['goods_number'] == 0): ?><?php echo $this->_var['lang']['stock_up']; ?><?php else: ?><b class="c2"><?php echo $this->_var['goods']['goods_number']; ?></b><?php echo $this->_var['goods']['measure_unit']; ?><?php endif; ?>
                      <p class="c3">折扣商品请尽快下单</p>
                      <p>时间&emsp;&emsp;<span id="leftTime"><?php echo $this->_var['lang']['please_waiting']; ?></span></p>
                      <?php else: ?>
                      价格&emsp;&emsp;<span class="c1"><b style=" background:none"><?php echo $this->_var['goods']['shop_price_formated']; ?></b></span>&emsp;库存<?php if ($this->_var['goods']['goods_number'] == 0): ?><?php echo $this->_var['lang']['stock_up']; ?><?php else: ?><b class="c2"><?php echo $this->_var['goods']['goods_number']; ?></b><?php echo $this->_var['goods']['measure_unit']; ?><?php endif; ?>
                      <?php endif; ?>
                      
                      
                   </div>
                   <div class="cs1">
                      数量&emsp;&emsp;<a href="javascript:add();" class="add"></a><input name="number" type="text" id="number" value="1" onblur="changePrice()" class="num1"/><a href="javascript:del();" class="jian"></a>
                   </div>
                   
<?php $_from = $this->_var['specification']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('spec_key', 'spec');if (count($_from)):
    foreach ($_from AS $this->_var['spec_key'] => $this->_var['spec']):
?>                   
                   <div class="cs1"><?php echo $this->_var['spec']['name']; ?>&emsp;&emsp;
                    <?php if ($this->_var['spec']['attr_type'] == 1): ?>
                      <?php if ($this->_var['cfg']['goodsattr_style'] == 1): ?>
<?php $_from = $this->_var['spec']['values']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'value');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['value']):
?>
  <a <?php if ($this->_var['key'] == 0): ?>class="c4 c4bg"<?php else: ?>class="c4"<?php endif; ?> onclick="changeAtt(this)" <?php if ($this->_var['value']['attr_img']): ?>  rel="zoom1" rev="<?php echo $this->_var['value']['attr_img']; ?>"  href="<?php echo $this->_var['value']['attr_img']; ?>" <?php else: ?>href="javascript:;" <?php endif; ?> name="<?php echo $this->_var['value']['id']; ?>" title="<?php echo $this->_var['value']['label']; ?>">
<?php if ($this->_var['value']['attr_img']): ?>
<img  src="<?php echo $this->_var['value']['attr_thumb']; ?>" width="30" height="30"/>
<?php else: ?>
<?php echo $this->_var['value']['label']; ?>
<?php endif; ?>
<input style="display:none" id="spec_value_<?php echo $this->_var['value']['id']; ?>" type="radio" name="spec_<?php echo $this->_var['spec_key']; ?>" value="<?php echo $this->_var['value']['id']; ?>" <?php if ($this->_var['key'] == 0): ?>checked<?php endif; ?> /></a>
<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>                      
                      <?php endif; ?>
                    <?php endif; ?>
                   </div>
<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                      
                      

                   
                   <div class="btns">
<?php if ($this->_var['goods']['is_taobao']): ?>
	 <a isconvert=1 rel="external nofollow" target="_blank" href="<?php echo $this->_var['goods']['click_url']; ?>"><img src="themes/default/images/bnt_cattb.jpg" /></a>&nbsp;&nbsp;
 <?php else: ?>
                       <a href="javascript:addToCart_choose(<?php echo $this->_var['goods']['goods_id']; ?>)" class="btn8"></a>
                      <a href="javascript:bool=1;addToCart(<?php echo $this->_var['goods']['goods_id']; ?>)" class="btn7"></a>
                      <a href="javascript:collect(<?php echo $this->_var['goods']['goods_id']; ?>)" class="btn9" <?php if ($this->_var['collect']): ?> style="background-image:url(themes/default/images/index49.jpg)"<?php endif; ?>></a>

 <?php endif; ?>
                   </div>
                   <div class="clear"></div>
                   <?php if ($this->_var['goods']['suppliers_id']): ?>
                   <div class="arc">
                      <b>店铺详情</b>
                      <?php echo $this->_var['suppliers']['suppliers_desc']; ?><a href="store.php?id=<?php echo $this->_var['goods']['suppliers_id']; ?>" class="more1">了解详细>></a>
                   </div>
                   <?php endif; ?>
                   
                      <div class="ewm">
                         <p class="p8">扫码微信分享</p>
                         <p><img src="code/code.php?value=<?php echo $this->_var['shopurl']; ?>" width="86" height="86" /></p>
                         <div class="p9">
                            <span class="c5">免费退换货</span>
                            <span class="c6">30天之内</span>
                         </div>
                         <div class="p10">
                            <span class="c5">免费上门安装</span>
                            <span class="c6">免费送货!</span>
                         </div>
                      </div> 
                   
                </div>
              </form>
               
                <div class="clear"></div><div class="clear"></div>
              
                <?php if ($this->_var['brand_info']): ?>
                <div class="pp">
                   <div class="pp-l">
                      <a href="category.php?id=<?php echo $this->_var['goods']['cat_id']; ?>&brand=<?php echo $this->_var['brand_info']['brand_id']; ?>"><img src="data/brandlogo/<?php echo $this->_var['brand_info']['brand_logo']; ?>" width="100%"  /></a>
                   </div>
                   <div class="pp-r">
                      <b><?php echo $this->_var['brand_info']['brand_name']; ?></b>
                      <p class="p7"><?php echo $this->_var['brand_info']['brand_desc']; ?></p>
                   </div>
                </div>
                <?php endif; ?>
             
              <div class="clear"></div><div class="clear"></div><div class="clear"></div>
                 <div style="height: 64px;">
                   <ul class="tabbtn" id="com_b">
                        <li><a href="javascript:void(0);">商品详细</a></li>
                        <li class="current"><a href="javascript:void(0);">商品评价（<?php echo $this->_var['record_count']; ?>）</a></li>
                    </ul>
                 </div>  
            </div>
         
      </div>
            <div class="container">
               <div class="tabcon" id="normalcon">
               <div id="com_v"></div>
                 <div id="com_h">
                 <blockquote>
                 <?php if ($this->_var['properties']): ?>
                 <div class="arc2" style="line-height:24px;">
                 <span style="font-size:16px; font-weight:bold">商品规格</span><br>
                <?php $_from = $this->_var['properties']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'property_group');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['property_group']):
?>
                <?php $_from = $this->_var['property_group']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'property');if (count($_from)):
    foreach ($_from AS $this->_var['property']):
?>
                <?php echo htmlspecialchars($this->_var['property']['name']); ?>：<?php echo $this->_var['property']['value']; ?><br>
                <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                 </div>
                 <?php endif; ?>
                 <div class="arc2">
                 <?php echo $this->_var['goods']['goods_desc']; ?></div></blockquote>
                 <blockquote><div class="sublist"><?php echo $this->fetch('library/comments.lbi'); ?></div></blockquote>
                 </div>
               </div>
            </div>     
     
    <script type="text/javascript">
    <!--
    reg("com");
    //-->
    </script>

  
  
<?php echo $this->fetch('library/page_footer.lbi'); ?>
</body>
<script type="text/javascript">
var goods_id = <?php echo $this->_var['goods_id']; ?>;
var goodsattr_style = <?php echo empty($this->_var['cfg']['goodsattr_style']) ? '1' : $this->_var['cfg']['goodsattr_style']; ?>;
var gmt_end_time = <?php echo empty($this->_var['promote_end_time']) ? '0' : $this->_var['promote_end_time']; ?>;
<?php $_from = $this->_var['lang']['goods_js']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['item']):
?>
var <?php echo $this->_var['key']; ?> = "<?php echo $this->_var['item']; ?>";
<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
var goodsId = <?php echo $this->_var['goods_id']; ?>;
var now_time = <?php echo $this->_var['now_time']; ?>;


onload = function(){
  changePrice();
  fixpng();
  try {onload_leftTime();}
  catch (e) {}
}

/**
 * 点选可选属性或改变数量时修改商品价格的函数
 */
function changePrice()
{
  var attr = getSelectedAttributes(document.forms['ECS_FORMBUY']);
  var qty = document.forms['ECS_FORMBUY'].elements['number'].value;

  Ajax.call('goods.php', 'act=price&id=' + goodsId + '&attr=' + attr + '&number=' + qty, changePriceResponse, 'GET', 'JSON');
}

/**
 * 接收返回的信息
 */
function changePriceResponse(res)
{
  if (res.err_msg.length > 0)
  {
    alert(res.err_msg);
  }
  else
  {
    document.forms['ECS_FORMBUY'].elements['number'].value = res.qty;

    if (document.getElementById('ECS_GOODS_AMOUNT'))
      document.getElementById('ECS_GOODS_AMOUNT').innerHTML = res.result;
	  
	  if (document.getElementById('ECS_SHOPPRICE'))
      document.getElementById('ECS_SHOPPRICE').innerHTML = res.result;
  }
}

</script>
</html>
