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

<?php echo $this->smarty_insert_scripts(array('files'=>'common.js,shopping_flow.js')); ?>
</head>
<body>
<?php echo $this->fetch('library/page_header.lbi'); ?>
<script type="text/javascript" src="themes/default/js/MSClass.js"></script>
      <div class="content">
         <div class="container position">
            <div class="local"><?php echo $this->fetch('library/ur_here.lbi'); ?></div>
         </div>

         



<div class="blank"></div>
<div class="block">
  <?php if ($this->_var['step'] == "cart"): ?>
  
  
  <?php echo $this->smarty_insert_scripts(array('files'=>'showdiv.js')); ?>
  <script type="text/javascript">
  <?php $_from = $this->_var['lang']['password_js']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['item']):
?>
    var <?php echo $this->_var['key']; ?> = "<?php echo $this->_var['item']; ?>";
  <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
  </script>
<script type="text/javascript" charset="utf-8">
function add_num(rec_id,goods_id)
{
document.getElementById("goods_number_"+rec_id+"").value++;
var number = document.getElementById("goods_number_"+rec_id+"").value;
Ajax.call('flow.php', 'step=update_group_cart&rec_id=' + rec_id +'&number=' + number+'&goods_id=' + goods_id, changePriceRespe, 'GET', 'JSON');
}
function red_num(rec_id,goods_id)
{
if (document.getElementById("goods_number_"+rec_id+"").value>1)
{
document.getElementById("goods_number_"+rec_id+"").value--;
}
var number = document.getElementById("goods_number_"+rec_id+"").value;
Ajax.call('flow.php', 'step=update_group_cart&rec_id=' + rec_id +'&number=' + number+'&goods_id=' + goods_id, changePriceRespe, 'GET', 'JSON');
}
function change_price(rec_id,goods_id){
var number = document.getElementById("goods_number_"+rec_id+"").value;
//alert(number);
Ajax.call('flow.php','step=update_group_cart&rec_id=' + rec_id +'&number=' + number+'&goods_id=' + goods_id, changePriceRespe, 'GET', 'JSON');
}
function changePriceRespe(result)
{
//alert(result.number);
if(result.error == 1)
{
alert(result.content);
document.getElementById("goods_number_"+result.rec_id+"").value =result.number;
document.getElementById('subtotal_'+result.rec_id).innerHTML = result.subtotal;//商品总价
document.getElementById('cart_amount_desc').innerHTML = result.cart_amount_desc;//购物车商品总价说明
}
else
{
document.getElementById('subtotal_'+result.rec_id).innerHTML = result.subtotal;//商品总价
document.getElementById('cart_amount_desc').innerHTML = result.cart_amount_desc;//购物车商品总价说明
document.getElementById('market_amount_desc').innerHTML = result.market_amount_desc;//购物车商品总市价说明
document.getElementById('market_amount_desc2').innerHTML = result.market_amount_desc2;
}
}


    </script>  
  
  

  
            <div class="container position">
             <form id="formCart" name="formCart" method="post" action="flow.php">
                 <table width="100%" border="0" cellspacing="0" cellpadding="0" class="tab b-t">
                    <tr>
                      <td height="43" align="center" bgcolor="f5f5f5" class="b-b b-l">&nbsp;</td>
                      <td bgcolor="f5f5f5" width="477" align="left" class="b-b">商品信息</td>
                      <td bgcolor="f5f5f5" width="156" align="left" class="b-b">单价</td>
                      <td bgcolor="f5f5f5" width="207" align="left" class="b-b">数量</td>
                      <td bgcolor="f5f5f5" width="90" align="left" class="b-b">总价</td>
                      <td bgcolor="f5f5f5" width="100" align="center" class="b-b b-r">编辑</td>
                    </tr>
                    <?php $_from = $this->_var['goods_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'goods');if (count($_from)):
    foreach ($_from AS $this->_var['goods']):
?>
                    <tr>
                      <td height="106" align="center" class="b-b b-l"><img src="<?php echo $this->_var['goods']['goods_thumb']; ?>" width="77" height="77" /></td>
                      <td width="477" align="left" class="b-b"><p class="c7"><?php echo $this->_var['goods']['goods_name']; ?><br><?php echo nl2br($this->_var['goods']['goods_attr']); ?></p></td>
                      <td width="156" align="left" class="b-b"><span class="c8"><?php echo $this->_var['goods']['goods_price']; ?></span></td>
                      <td width="207" align="left" class="b-b">
                         <a href="javascript:add_num(<?php echo $this->_var['goods']['rec_id']; ?>,<?php echo $this->_var['goods']['goods_id']; ?>);" class="add"></a><input type="text" name="goods_number[<?php echo $this->_var['goods']['rec_id']; ?>]" id="goods_number_<?php echo $this->_var['goods']['rec_id']; ?>" value="<?php echo $this->_var['goods']['goods_number']; ?>" class="num1" onblur="change_price(<?php echo $this->_var['goods']['rec_id']; ?>,<?php echo $this->_var['goods']['goods_id']; ?>)"/><a href="javascript:red_num(<?php echo $this->_var['goods']['rec_id']; ?>,<?php echo $this->_var['goods']['goods_id']; ?>);" class="jian"></a>
                      </td>
                      <td width="90" align="left" class="b-b"><b class="c9" id="subtotal_<?php echo $this->_var['goods']['rec_id']; ?>"><?php echo $this->_var['goods']['subtotal']; ?></b></td>
                      <td width="100" align="center" class="b-b b-r"><a href="javascript:if (confirm('<?php echo $this->_var['lang']['drop_goods_confirm']; ?>')) location.href='flow.php?step=drop_goods&amp;id=<?php echo $this->_var['goods']['rec_id']; ?>'; "><img src="themes/default/images/index53.png" width="19" height="20" /></a></td>
                    </tr>
                    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                 </table>
                 </form>
                 <div class="p12">
                    <span class="c10">送货安装费用</span>&ensp;<span class="c11">线上限免</span>&emsp;<span class="c12">￥0.00</span>                 
  </div>
                 <div class="js">
                 
              
                 
                    <span class="c15">合计</span>&emsp;<b class="c14 c17" id="cart_amount_desc"><?php echo $this->_var['shopping_money']; ?></b>
                    <a href="flow.php?step=checkout" class="jsbtn">结 算</a>
                 </div>
             <div class="clear"></div><div class="clear"></div>
             <div class="clear"></div><div class="clear"></div>
             <?php echo $this->fetch('library/recommend_best.lbi'); ?>     
          </div>
  
  
  

        
       <?php if ($_SESSION['user_id'] > 0): ?>
       <?php echo $this->smarty_insert_scripts(array('files'=>'transport.js')); ?>
       <script type="text/javascript" charset="utf-8">
        function collect_to_flow(goodsId)
        {
          var goods        = new Object();
          var spec_arr     = new Array();
          var fittings_arr = new Array();
          var number       = 1;
          goods.spec     = spec_arr;
          goods.goods_id = goodsId;
          goods.number   = number;
          goods.parent   = 0;
          Ajax.call('flow.php?step=add_to_cart', 'goods=' + goods.toJSONString(), collect_to_flow_response, 'POST', 'JSON');
        }
        function collect_to_flow_response(result)
        {
          if (result.error > 0)
          {
            // 如果需要缺货登记，跳转
            if (result.error == 2)
            {
              if (confirm(result.message))
              {
                location.href = 'user.php?act=add_booking&id=' + result.goods_id;
              }
            }
            else if (result.error == 6)
            {
              openSpeDiv(result.message, result.goods_id);
            }
            else
            {
              alert(result.message);
            }
          }
          else
          {
            location.href = 'flow.php';
          }
        }
      </script>

  <?php endif; ?>


  </div>
    <div class="blank5"></div>
  <?php endif; ?>

  <?php if ($this->_var['fittings_list']): ?>
  <?php echo $this->smarty_insert_scripts(array('files'=>'transport.js')); ?>
  <script type="text/javascript" charset="utf-8">
  function fittings_to_flow(goodsId,parentId)
  {
    var goods        = new Object();
    var spec_arr     = new Array();
    var number       = 1;
    goods.spec     = spec_arr;
    goods.goods_id = goodsId;
    goods.number   = number;
    goods.parent   = parentId;
    Ajax.call('flow.php?step=add_to_cart', 'goods=' + goods.toJSONString(), fittings_to_flow_response, 'POST', 'JSON');
  }
  function fittings_to_flow_response(result)
  {
    if (result.error > 0)
    {
      // 如果需要缺货登记，跳转
      if (result.error == 2)
      {
        if (confirm(result.message))
        {
          location.href = 'user.php?act=add_booking&id=' + result.goods_id;
        }
      }
      else if (result.error == 6)
      {
        openSpeDiv(result.message, result.goods_id, result.parent);
      }
      else
      {
        alert(result.message);
      }
    }
    else
    {
      location.href = 'flow.php';
    }
  }
  </script>
  <div class="block" >
    <div class="flowBox">
    <h6><span><?php echo $this->_var['lang']['goods_fittings']; ?></span></h6>
    <form action="flow.php" method="post">
        <div class="flowGoodsFittings clearfix">
          <?php $_from = $this->_var['fittings_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'fittings');if (count($_from)):
    foreach ($_from AS $this->_var['fittings']):
?>
            <ul class="clearfix">
              <li class="goodsimg">
                <a href="<?php echo $this->_var['fittings']['url']; ?>" target="_blank"><img src="<?php echo $this->_var['fittings']['goods_thumb']; ?>" alt="<?php echo htmlspecialchars($this->_var['fittings']['name']); ?>" class="B_blue" /></a>
              </li>
              <li>
                <a href="<?php echo $this->_var['fittings']['url']; ?>" target="_blank" title="<?php echo htmlspecialchars($this->_var['fittings']['goods_name']); ?>" class="f6"><?php echo htmlspecialchars($this->_var['fittings']['short_name']); ?></a><br />
                <?php echo $this->_var['lang']['fittings_price']; ?><font class="f1"><?php echo $this->_var['fittings']['fittings_price']; ?></font><br />
                <?php echo $this->_var['lang']['parent_name']; ?><?php echo $this->_var['fittings']['parent_short_name']; ?><br />
                <a href="javascript:fittings_to_flow(<?php echo $this->_var['fittings']['goods_id']; ?>,<?php echo $this->_var['fittings']['parent_id']; ?>)"><img src="themes/default/images/bnt_buy.gif" alt="<?php echo $this->_var['lang']['collect_to_flow']; ?>" /></a>
              </li>
            </ul>
          <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
        </div>
    </form>
    </div>
  </div>
  <div class="blank5"></div>
  <?php endif; ?>

  <?php if ($this->_var['favourable_list']): ?>
  <div class="block">
    <div class="flowBox">
    <h6><span><?php echo $this->_var['lang']['label_favourable']; ?></span></h6>
        <?php $_from = $this->_var['favourable_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'favourable');if (count($_from)):
    foreach ($_from AS $this->_var['favourable']):
?>
        <form action="flow.php" method="post">
          <table width="99%" align="center" border="0" cellpadding="5" cellspacing="1" bgcolor="#dddddd">
            <tr>
              <td align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['favourable_name']; ?></td>
              <td bgcolor="#ffffff"><strong><?php echo $this->_var['favourable']['act_name']; ?></strong></td>
            </tr>
            <tr>
              <td align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['favourable_period']; ?></td>
              <td bgcolor="#ffffff"><?php echo $this->_var['favourable']['start_time']; ?> --- <?php echo $this->_var['favourable']['end_time']; ?></td>
            </tr>
            <tr>
              <td align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['favourable_range']; ?></td>
              <td bgcolor="#ffffff"><?php echo $this->_var['lang']['far_ext'][$this->_var['favourable']['act_range']]; ?><br />
              <?php echo $this->_var['favourable']['act_range_desc']; ?></td>
            </tr>
            <tr>
              <td align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['favourable_amount']; ?></td>
              <td bgcolor="#ffffff"><?php echo $this->_var['favourable']['formated_min_amount']; ?> --- <?php echo $this->_var['favourable']['formated_max_amount']; ?></td>
            </tr>
            <tr>
              <td align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['favourable_type']; ?></td>
              <td bgcolor="#ffffff">
                <span class="STYLE1"><?php echo $this->_var['favourable']['act_type_desc']; ?></span>
                <?php if ($this->_var['favourable']['act_type'] == 0): ?>
                <?php $_from = $this->_var['favourable']['gift']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'gift');if (count($_from)):
    foreach ($_from AS $this->_var['gift']):
?><br />
                  <input type="checkbox" value="<?php echo $this->_var['gift']['id']; ?>" name="gift[]" />
                  <a href="goods.php?id=<?php echo $this->_var['gift']['id']; ?>" target="_blank" class="f6"><?php echo $this->_var['gift']['name']; ?></a> [<?php echo $this->_var['gift']['formated_price']; ?>]
                <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
              <?php endif; ?>          </td>
            </tr>
            <?php if ($this->_var['favourable']['available']): ?>
            <tr>
              <td align="right" bgcolor="#ffffff">&nbsp;</td>
              <td align="center" bgcolor="#ffffff"><input type="image" src="themes/default/images/bnt_cat.gif" alt="Add to cart"  border="0" /></td>
            </tr>
            <?php endif; ?>
          </table>
          <input type="hidden" name="act_id" value="<?php echo $this->_var['favourable']['act_id']; ?>" />
          <input type="hidden" name="step" value="add_favourable" />
        </form>
        <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
  </div>
  </div>
  <?php endif; ?>


        <?php if ($this->_var['step'] == "consignee"): ?>
        
        <?php echo $this->smarty_insert_scripts(array('files'=>'region.js,utils.js')); ?>
        <script type="text/javascript">
          region.isAdmin = false;
          <?php $_from = $this->_var['lang']['flow_js']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['item']):
?>
          var <?php echo $this->_var['key']; ?> = "<?php echo $this->_var['item']; ?>";
          <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>

          
          onload = function() {
            if (!document.all)
            {
              document.forms['theForm'].reset();
            }
          }
           
        </script>
        
        <?php $_from = $this->_var['consignee_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('sn', 'consignee');if (count($_from)):
    foreach ($_from AS $this->_var['sn'] => $this->_var['consignee']):
?>
        <form action="flow.php" method="post" name="theForm" id="theForm" onsubmit="return checkConsignee(this)">
        <?php echo $this->fetch('library/consignee.lbi'); ?>
        </form>
        <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
        <?php endif; ?>

        <?php if ($this->_var['step'] == "checkout"): ?>
<script>
function changeAtt(t) {
t.lastChild.checked='checked';
for (var i = 0; i<t.parentNode.childNodes.length;i++) {
        if (t.parentNode.childNodes[i].className == 'paybg') {
            t.parentNode.childNodes[i].className = '';
        }
    }
t.className = "paybg";
}
</script>
        
        

        
        
        
        <form action="flow.php" method="post" name="theForm" id="theForm" onsubmit="return checkOrderForm(this)">
        <script type="text/javascript">
        var flow_no_payment = "<?php echo $this->_var['lang']['flow_no_payment']; ?>";
        var flow_no_shipping = "<?php echo $this->_var['lang']['flow_no_shipping']; ?>";
        </script>
    <div class="container position">
             <div class="title5"><span class="p6">提交订单</span></div>
             <div class="clear"></div>
                 <div class="addr">&emsp;<span class="c8">默认收货地址</span>
                    <table width="990" border="0" cellspacing="0" cellpadding="0" class="tab1">
                      <tr>
                        <td width="123" height="84"><b class="user1"><?php echo htmlspecialchars($this->_var['consignee']['consignee']); ?></b></td>
                        <td width="177"><span class="tel1"><?php echo $this->_var['consignee']['tel']; ?></span></td>
                        <td width="630"><span class="addr1"><?php echo htmlspecialchars($this->_var['consignee']['address']); ?></span></td>
                        <td width="52" align="center"><a href="flow.php?step=consignee" class="btn10"></a></td>
                      </tr>
                    </table>
                 </div>
             <div class="clear"></div>
                 <table width="100%" border="0" cellspacing="0" cellpadding="0" class="tab b-t">
                    <?php $_from = $this->_var['goods_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'goods');if (count($_from)):
    foreach ($_from AS $this->_var['goods']):
?>
                    <tr>
                      <td width="126" height="106" align="center" class="b-b b-l"><img src="<?php echo $this->_var['goods']['goods_thumb']; ?>" width="77" height="77" /></td>
                      <td width="477" align="left" class="b-b"><a href="goods.php?id=<?php echo $this->_var['goods']['goods_id']; ?>" target="_blank" class="c7"><?php echo $this->_var['goods']['goods_name']; ?><br><?php echo nl2br($this->_var['goods']['goods_attr']); ?></a></td>
                      <td width="85" align="left" class="b-b"><span class="c8"><?php echo $this->_var['goods']['formated_goods_price']; ?></span></td>
                      <td width="85" align="left" class="b-b">
                         <span class="c8">×<?php echo $this->_var['goods']['goods_number']; ?></span>
                      </td>
                      <td width="385" align="right" class="b-b"><b class="c9"><?php echo $this->_var['goods']['formated_subtotal']; ?></b></td>
                      <td width="30" class="b-b b-r">&nbsp;</td>
                    </tr>
                    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                    <tr>
                      <td width="385" height="55" align="right" class="b-b b-l" colspan="5">合计　<b class="c16" id="cart_amount_desc"><?php echo $this->_var['shopping_money']; ?></b></td>
                      <td width="30" class="b-b b-r">&nbsp;</td>
                    </tr>
                 </table>
                 <div class="clear"></div><div class="clear"></div>
                 


                    <div class="pay">
                       <b>支付方式：</b>                       
                       <?php $_from = $this->_var['payment_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'payment');if (count($_from)):
    foreach ($_from AS $this->_var['payment']):
?>
                      <a onclick="changeAtt(this)" href="javascript:;" <?php if ($this->_var['order']['pay_id'] == $this->_var['payment']['pay_id']): ?>class="paybg"<?php endif; ?>><?php echo $this->_var['payment']['pay_name']; ?><input type="radio" name="payment" value="<?php echo $this->_var['payment']['pay_id']; ?>" <?php if ($this->_var['order']['pay_id'] == $this->_var['payment']['pay_id']): ?>checked<?php endif; ?> isCod="<?php echo $this->_var['payment']['is_cod']; ?>" style="display:none "/></a>
                       <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?></div>
                    <div class="pay" style="margin-top:20px;">
                       <b>使用红包：</b> &nbsp;&nbsp;&nbsp;&nbsp; 
                       <select name="bonus" onchange="changeBonus(this.value)" id="ECS_BONUS" style="border:1px solid #ccc;">
                  <option value="0" <?php if ($this->_var['order']['bonus_id'] == 0): ?>selected<?php endif; ?>><?php echo $this->_var['lang']['please_select']; ?></option>
                  <?php $_from = $this->_var['bonus_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'bonus');if (count($_from)):
    foreach ($_from AS $this->_var['bonus']):
?>
                  <option value="<?php echo $this->_var['bonus']['bonus_id']; ?>" <?php if ($this->_var['order']['bonus_id'] == $this->_var['bonus']['bonus_id']): ?>selected<?php endif; ?>><?php echo $this->_var['bonus']['type_name']; ?>[<?php echo $this->_var['bonus']['bonus_money_formated']; ?>]</option>
                  <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                </select>

                <?php echo $this->_var['lang']['input_bonus_no']; ?>
                <input name="bonus_sn" type="text" class="inputBg" size="15" value="<?php echo $this->_var['order']['bonus_sn']; ?>" style="border:1px solid #ccc;" />
                <input name="validate_bonus" type="button" class="btn12bg" value="<?php echo $this->_var['lang']['validate_bonus']; ?>" onclick="validateBonus(document.forms['theForm'].elements['bonus_sn'].value)" />                     
                    </div>
                    <div class="pay" style="margin-top:20px;">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                         <tr bgcolor="#dddddd">
                           <td bgcolor="#ffffff"><b><?php echo $this->_var['lang']['invoice']; ?>:</b>
                             <input name="ECS_NEEDINV" type="checkbox"  class="input" id="ECS_NEEDINV" onclick="changeNeedInv()" value="1" <?php if ($this->_var['order']['need_inv']): ?>checked="true"<?php endif; ?> />
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            <?php if ($this->_var['inv_type_list']): ?>
                <?php echo $this->_var['lang']['invoice_type']; ?>
                <select name="inv_type" id="ECS_INVTYPE" <?php if ($this->_var['order']['need_inv'] != 1): ?>disabled="true"<?php endif; ?> onchange="changeNeedInv()" style="border:1px solid #ccc;">
                <?php echo $this->html_options(array('options'=>$this->_var['inv_type_list'],'selected'=>$this->_var['order']['inv_type'])); ?></select>
                <?php endif; ?>
                <?php echo $this->_var['lang']['invoice_title']; ?>
                <input name="inv_payee" type="text"  class="input" id="ECS_INVPAYEE" size="20" <?php if (! $this->_var['order']['need_inv']): ?>disabled="true"<?php endif; ?> value="<?php echo $this->_var['order']['inv_payee']; ?>" onblur="changeNeedInv()" style="border:1px solid #CCC" />
                <?php echo $this->_var['lang']['invoice_content']; ?>
              <select name="inv_content" id="ECS_INVCONTENT" <?php if ($this->_var['order']['need_inv'] != 1): ?>disabled="true"<?php endif; ?>  onchange="changeNeedInv()" style="border:1px solid #ccc;">

                <?php echo $this->html_options(array('values'=>$this->_var['inv_content_list'],'output'=>$this->_var['inv_content_list'],'selected'=>$this->_var['order']['inv_content'])); ?>

                </select>                             </td>
                         </tr>
                       </table>
                       </div>
<div class="clear"></div><div class="clear"></div>
                 
                 

                    <div class="js">
                    
                    <div class="jsinfo">
                    <?php $_from = $this->_var['shipping_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'shipping');if (count($_from)):
    foreach ($_from AS $this->_var['shipping']):
?>
                    &emsp;<input name="shipping" type="radio" value="<?php echo $this->_var['shipping']['shipping_id']; ?>" <?php if ($this->_var['order']['shipping_id'] == $this->_var['shipping']['shipping_id']): ?>checked="true"<?php endif; ?> supportCod="<?php echo $this->_var['shipping']['support_cod']; ?>" insure="<?php echo $this->_var['shipping']['insure']; ?>" onclick="selectShipping(this)" /> <?php echo $this->_var['shipping']['shipping_name']; ?>：<b class="c14 c16"><?php echo $this->_var['shipping']['format_shipping_fee']; ?></b>  <?php echo $this->_var['shipping']['shipping_desc']; ?>
                    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                    <input name="need_insure" id="ECS_NEEDINSURE" type="checkbox" value="1" <?php if ($this->_var['order']['need_insure']): ?>checked="true"<?php endif; ?> style="display:none" />
                    </div>
                    <span class="c15">实付款：</span><b class="c14 c17" id="ECS_ORDERTOTAL"><?php echo $this->_var['total']['amount_formated']; ?></b> 
                    <input type="hidden" name="step" value="done" />
                    <input type="submit" class="jsbtn" name="button" id="button" value="确认订单" />
                 </div>
             <div class="clear"></div><div class="clear"></div>
             <div class="clear"></div><div class="clear"></div>
             <?php echo $this->fetch('library/recommend_best.lbi'); ?>      
          </div>
          </form>
        <?php endif; ?>

        <?php if ($this->_var['step'] == "done"): ?>
        
        
    <div class="container position">
             <div class="title5"><span class="p6">支付中心</span></div> 
             <div class="b-b b-l b-r arc2">
                <div class="arc3 b-b b-bs">
                  <b><?php echo $this->_var['lang']['remember_order_number']; ?>: <span class="c14"><?php echo $this->_var['order']['order_sn']; ?></span></b>
                </div>
                <div class="arc3">
                
                
                
                  <p><b>订&ensp;单&ensp;号：</b><?php echo $this->_var['order']['order_sn']; ?></p>
                  
                  <?php if ($this->_var['order']['shipping_name']): ?><p><b><?php echo $this->_var['lang']['select_shipping']; ?>:</b><?php echo $this->_var['order']['shipping_name']; ?></p><?php endif; ?>
                  <p><b><?php echo $this->_var['lang']['select_payment']; ?>:</b><?php echo $this->_var['order']['pay_name']; ?></p>
                  <p><b><?php echo $this->_var['lang']['order_amount']; ?>:</b><?php echo $this->_var['total']['amount_formated']; ?></p>
                  
                  <?php if ($this->_var['pay_online']): ?><p class="paybtn"><?php echo $this->_var['pay_online']; ?></p><?php endif; ?>
                  
                </div>
             </div> 
             <div class="clear"></div>
             <div class="b-b b-l b-r b-t arc6">
                <?php echo $this->_var['order_submit_back']; ?>
             </div> 
             <div class="clear"></div><div class="clear"></div>
             <div class="clear"></div><div class="clear"></div>
             <div class="clear"></div><div class="clear"></div>            
          </div>
        <?php endif; ?>
        <?php if ($this->_var['step'] == "login"): ?>
        <?php echo $this->smarty_insert_scripts(array('files'=>'utils.js,user.js')); ?>
        <script type="text/javascript">
        <?php $_from = $this->_var['lang']['flow_login_register']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['item']):
?>
          var <?php echo $this->_var['key']; ?> = "<?php echo $this->_var['item']; ?>";
        <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>

        
        function checkLoginForm(frm) {
          if (Utils.isEmpty(frm.elements['username'].value)) {
            alert(username_not_null);
            return false;
          }

          if (Utils.isEmpty(frm.elements['password'].value)) {
            alert(password_not_null);
            return false;
          }

          return true;
        }

        function checkSignupForm(frm) {
          if (Utils.isEmpty(frm.elements['username'].value)) {
            alert(username_not_null);
            return false;
          }

          if (Utils.trim(frm.elements['username'].value).match(/^\s*$|^c:\\con\\con$|[%,\'\*\"\s\t\<\>\&\\]/))
          {
            alert(username_invalid);
            return false;
          }

          if (Utils.isEmpty(frm.elements['email'].value)) {
            alert(email_not_null);
            return false;
          }

          if (!Utils.isEmail(frm.elements['email'].value)) {
            alert(email_invalid);
            return false;
          }

          if (Utils.isEmpty(frm.elements['password'].value)) {
            alert(password_not_null);
            return false;
          }

          if (frm.elements['password'].value.length < 6) {
            alert(password_lt_six);
            return false;
          }

          if (frm.elements['password'].value != frm.elements['confirm_password'].value) {
            alert(password_not_same);
            return false;
          }
          return true;
        }
        
        </script>
        
        <div class="flowBox">
        <table width="99%" align="center" border="0" cellpadding="5" cellspacing="1" bgcolor="#dddddd">
          <tr>
            <td width="50%" valign="top" bgcolor="#ffffff">
            <h6><span>用户登录：</span></h6>
            <form action="flow.php?step=login" method="post" name="loginForm" id="loginForm" onsubmit="return checkLoginForm(this)">
                <table width="90%" border="0" cellpadding="8" cellspacing="1" bgcolor="#B0D8FF" class="table">
                  <tr>
                    <td bgcolor="#ffffff"><div align="right"><strong><?php echo $this->_var['lang']['username']; ?></strong></div></td>
                    <td bgcolor="#ffffff"><input name="username" type="text" class="inputBg" id="username" /></td>
                  </tr>
                  <tr>
                    <td bgcolor="#ffffff"><div align="right"><strong><?php echo $this->_var['lang']['password']; ?></strong></div></td>
                    <td bgcolor="#ffffff"><input name="password" class="inputBg" type="password" /></td>
                  </tr>
                  <?php if ($this->_var['enabled_login_captcha']): ?>
                  <tr>
                    <td bgcolor="#ffffff"><div align="right"><strong><?php echo $this->_var['lang']['comment_captcha']; ?>:</strong></div></td>
                    <td bgcolor="#ffffff"><input type="text" size="8" name="captcha" class="inputBg" />
                    <img src="captcha.php?is_login=1&<?php echo $this->_var['rand']; ?>" alt="captcha" style="vertical-align: middle;cursor: pointer;" onClick="this.src='captcha.php?is_login=1&'+Math.random()" /> </td>
                  </tr>
                  <?php endif; ?>
                  <tr>
            <td colspan="2"  bgcolor="#ffffff"><input type="checkbox" value="1" name="remember" id="remember" /><label for="remember"><?php echo $this->_var['lang']['remember']; ?></label></td>
          </tr>
                  <tr>
                    <td bgcolor="#ffffff" colspan="2" align="center"><a href="user.php?act=qpassword_name" class="f6"><?php echo $this->_var['lang']['get_password_by_question']; ?></a>&nbsp;&nbsp;&nbsp;<a href="user.php?act=get_password" class="f6"><?php echo $this->_var['lang']['get_password_by_mail']; ?></a></td>
                  </tr>
                  <tr>
                    <td bgcolor="#ffffff" colspan="2"><div align="center">
                        <input type="submit" class="bnt_blue" name="login" value="<?php echo $this->_var['lang']['forthwith_login']; ?>" />
                        <?php if ($this->_var['anonymous_buy'] == 1): ?>
                        <input type="button" class="bnt_blue_2" value="<?php echo $this->_var['lang']['direct_shopping']; ?>" onclick="location.href='flow.php?step=consignee&amp;direct_shopping=1'" />
                        <?php endif; ?>
                        <input name="act" type="hidden" value="signin" />
                      </div></td>
                  </tr>
                </table>
              </form>

              </td>
            <td valign="top" bgcolor="#ffffff">
            <h6><span>用户注册：</span></h6>
            <form action="flow.php?step=login" method="post" name="formUser" id="registerForm" onsubmit="return checkSignupForm(this)">
               <table width="98%" border="0" cellpadding="8" cellspacing="1" bgcolor="#B0D8FF" class="table">
                  <tr>
                    <td bgcolor="#ffffff" align="right" width="25%"><strong><?php echo $this->_var['lang']['username']; ?></strong></td>
                    <td bgcolor="#ffffff"><input name="username" type="text" class="inputBg" id="username" onblur="is_registered(this.value);" /><br />
            <span id="username_notice" style="color:#FF0000"></span></td>
                  </tr>
                  <tr>
                    <td bgcolor="#ffffff" align="right"><strong><?php echo $this->_var['lang']['email_address']; ?></strong></td>
                    <td bgcolor="#ffffff"><input name="email" type="text" class="inputBg" id="email" onblur="checkEmail(this.value);" /><br />
            <span id="email_notice" style="color:#FF0000"></span></td>
                  </tr>
                  <tr>
                    <td bgcolor="#ffffff" align="right"><strong><?php echo $this->_var['lang']['password']; ?></strong></td>
                    <td bgcolor="#ffffff"><input name="password" class="inputBg" type="password" id="password1" onblur="check_password(this.value);" onkeyup="checkIntensity(this.value)" /><br />
            <span style="color:#FF0000" id="password_notice"></span></td>
                  </tr>
                  <tr>
                    <td bgcolor="#ffffff" align="right"><strong><?php echo $this->_var['lang']['confirm_password']; ?></strong></td>
                    <td bgcolor="#ffffff"><input name="confirm_password" class="inputBg" type="password" id="confirm_password" onblur="check_conform_password(this.value);" /><br />
            <span style="color:#FF0000" id="conform_password_notice"></span></td>
                  </tr>
                  <?php if ($this->_var['enabled_register_captcha']): ?>
                  <tr>
                    <td bgcolor="#ffffff" align="right"><strong><?php echo $this->_var['lang']['comment_captcha']; ?>:</strong></td>
                    <td bgcolor="#ffffff"><input type="text" size="8" name="captcha" class="inputBg" />
                    <img src="captcha.php?<?php echo $this->_var['rand']; ?>" alt="captcha" style="vertical-align: middle;cursor: pointer;" onClick="this.src='captcha.php?'+Math.random()" /> </td>
                  </tr>
                  <?php endif; ?>
                  <tr>
                    <td colspan="2" bgcolor="#ffffff" align="center">
                        <input type="submit" name="Submit" class="bnt_blue_1" value="<?php echo $this->_var['lang']['forthwith_register']; ?>" />
                        <input name="act" type="hidden" value="signup" />
                    </td>
                  </tr>
                </table>
              </form>
              </td>
          </tr>
          <?php if ($this->_var['need_rechoose_gift']): ?>
          <tr>
            <td colspan="2" align="center" style="border-top:1px #ccc solid; padding:5px; color:red;"><?php echo $this->_var['lang']['gift_remainder']; ?></td>
          </tr>
          <?php endif; ?>
        </table>
        </div>
        
        <?php endif; ?>




</div>
<div class="blank5"></div>



      </div>
<?php echo $this->fetch('library/page_footer.lbi'); ?>
</body>
<script type="text/javascript">
var process_request = "<?php echo $this->_var['lang']['process_request']; ?>";
<?php $_from = $this->_var['lang']['passport_js']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['item']):
?>
var <?php echo $this->_var['key']; ?> = "<?php echo $this->_var['item']; ?>";
<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
var username_exist = "<?php echo $this->_var['lang']['username_exist']; ?>";
var compare_no_goods = "<?php echo $this->_var['lang']['compare_no_goods']; ?>";
var btn_buy = "<?php echo $this->_var['lang']['btn_buy']; ?>";
var is_cancel = "<?php echo $this->_var['lang']['is_cancel']; ?>";
var select_spe = "<?php echo $this->_var['lang']['select_spe']; ?>";
</script>
</html>
