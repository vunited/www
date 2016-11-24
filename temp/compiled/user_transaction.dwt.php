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
<link href="themes/default/css/user.css" rel="stylesheet" type="text/css"  charset="utf-8"> 

<?php echo $this->smarty_insert_scripts(array('files'=>'common.js,user.js')); ?>
</head>
<body class="bg">
<style>
.table td, .table th{padding:10px;}
</style>
<script type="text/javascript">
function checkdd(na,url){
			 window.location.href=url;
		}
</script>
<?php echo $this->fetch('library/page_header.lbi'); ?>
      <div class="local1">
        <div class="container">
           <span class="l1"><?php echo $this->fetch('library/ur_here.lbi'); ?></span>
           <span class="r1">我的个人中心</span>
        </div>   
      </div>
      <div class="clear"></div><div class="clear"></div>
      
<div class="container">
  <?php echo $this->fetch('library/user_menu.lbi'); ?>
  
  <div class="right">
    <div class="box">
     <div class="box_1">
      <div class="userCenterBox boxCenterList clearfix" style="_height:1%;">
         
         <?php if ($this->_var['action'] == 'profile'): ?>
<style>
td,th{padding:10px;}
</style>
         <?php echo $this->smarty_insert_scripts(array('files'=>'utils.js')); ?>
        <script type="text/javascript">
          <?php $_from = $this->_var['lang']['profile_js']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['item']):
?>
            var <?php echo $this->_var['key']; ?> = "<?php echo $this->_var['item']; ?>";
          <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
        </script>

<script language="javascript">
function setImagePreview(a) {
var docObj=document.getElementById("pic"+a); 
var imgObjPreview=document.getElementById("preview"+a);
if(docObj.files &&docObj.files[0])
{
//火狐下，直接设img属性
//imgObjPreview.style.display = 'block';
imgObjPreview.style.width = '130px';
imgObjPreview.style.height = '130px'; 
//imgObjPreview.src = docObj.files[0].getAsDataURL();
 
//火狐7以上版本不能用上面的getAsDataURL()方式获取，需要一下方式
imgObjPreview.src = window.URL.createObjectURL(docObj.files[0]);
}
else
{
//IE下，使用滤镜
docObj.select();
var imgSrc = document.selection.createRange().text;
var localImagId = document.getElementById("localImag"+a);
//必须设置初始大小
localImagId.style.width = "130px";
localImagId.style.height = "130px";
//图片异常的捕捉，防止用户修改后缀来伪造图片
try{
localImagId.style.filter="progid:DXImageTransform.Microsoft.AlphaImageLoader(sizingMethod=scale)";
localImagId.filters.item("DXImageTransform.Microsoft.AlphaImageLoader").src = imgSrc;
}
catch(e)
{
alert("您上传的图片格式不正确，请重新选择!");
return false;
}
imgObjPreview.style.display = 'none';
document.selection.empty();
}
return true;
}

</script>
     <form action="user.php" method="post" enctype="multipart/form-data" name="formEdit" onSubmit="return userEdit()">
     
     
     
     
     
      <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#cdcdcd">
                <tr>
                  <td width="24%" align="right" bgcolor="#eeeeee"><?php echo $this->_var['lang']['birthday']; ?>： </td>
                  <td width="49%" align="left" bgcolor="#eeeeee"> <?php echo $this->html_select_date(array('field_order'=>'YMD','prefix'=>'birthday','start_year'=>'-60','end_year'=>'+1','display_days'=>'true','month_format'=>'%m','day_value_format'=>'%02d','time'=>$this->_var['profile']['birthday'])); ?> </td>
                  <td width="27%" rowspan="7" align="center" bgcolor="#eeeeee">
                  
						<?php if ($this->_var['profile']['user_img']): ?>             
                            <img id="preview1" src="<?php echo $this->_var['profile']['user_img']; ?>" width="130" height="130" style=" border-radius:100%;" />
						<?php else: ?>    
						    <img id="preview1" src="themes/default/images/index89.png" width="130" height="130" />
                        <?php endif; ?>
                        <div class="clear"></div>
                        <input type="file" name="pic1" id="pic1" onchange="javascript:setImagePreview(1);" />
                        
                        
                        
                        
                  </td>
                </tr>
                <tr>
                  <td width="24%" align="right" bgcolor="#eeeeee"><?php echo $this->_var['lang']['sex']; ?>： </td>
                  <td width="49%" align="left" bgcolor="#eeeeee"><input type="radio" name="sex" value="0" <?php if ($this->_var['profile']['sex'] == 0): ?>checked="checked"<?php endif; ?> />
                    <?php echo $this->_var['lang']['secrecy']; ?>&nbsp;&nbsp;
                    <input type="radio" name="sex" value="1" <?php if ($this->_var['profile']['sex'] == 1): ?>checked="checked"<?php endif; ?> />
                    <?php echo $this->_var['lang']['male']; ?>&nbsp;&nbsp;
                    <input type="radio" name="sex" value="2" <?php if ($this->_var['profile']['sex'] == 2): ?>checked="checked"<?php endif; ?> />
                  <?php echo $this->_var['lang']['female']; ?>&nbsp;&nbsp; </td>
                </tr>
                <tr>
                  <td width="24%" align="right" bgcolor="#eeeeee"><?php echo $this->_var['lang']['email']; ?>： </td>
                  <td width="49%" align="left" bgcolor="#eeeeee"><input name="email" type="text" value="<?php echo $this->_var['profile']['email']; ?>" size="25" class="text16" /><span style="color:#FF0000"> *</span></td>
                </tr>
                
		<?php $_from = $this->_var['extend_info_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'field');if (count($_from)):
    foreach ($_from AS $this->_var['field']):
?>
		<?php if ($this->_var['field']['id'] == 6): ?>
		<tr>
		  <td width="24%" align="right" bgcolor="#eeeeee"><?php echo $this->_var['lang']['passwd_question']; ?>：</td>
		  <td width="49%" align="left" bgcolor="#eeeeee">
		    <select name='sel_question'>
		      <option value='0'><?php echo $this->_var['lang']['sel_question']; ?></option>
		  <?php echo $this->html_options(array('options'=>$this->_var['passwd_questions'],'selected'=>$this->_var['profile']['passwd_question'])); ?>
		  </select>
		    </td>
		  </tr>
		<tr>
		  <td width="24%" align="right" bgcolor="#eeeeee" <?php if ($this->_var['field']['is_need']): ?>id="passwd_quesetion"<?php endif; ?>><?php echo $this->_var['lang']['passwd_answer']; ?>：</td>
		  <td width="49%" align="left" bgcolor="#eeeeee">
		    <input name="passwd_answer" type="text" size="25" class="text16" maxlengt='20' value="<?php echo $this->_var['profile']['passwd_answer']; ?>"/><?php if ($this->_var['field']['is_need']): ?><span style="color:#FF0000"> *</span><?php endif; ?>
		    </td>
		  </tr>
	<?php elseif ($this->_var['field']['id'] == 5): ?>

			<tr>
              <td width="24%" align="right" bgcolor="#eeeeee" id="extend_field5i">手机：</td>
              <td width="49%" align="left" bgcolor="#eeeeee"><span class="c10" ><?php echo $this->_var['field']['content']; ?></span> <a href="user.php?act=edit_mobile_phone"  style="vertical-align:middle;"><img src="themes/default/images/index91.png" width="73" height="27" /></a></td>
			</tr>

                <!-- <tr>
                  <td width="24%" align="right" bgcolor="#eeeeee" id="extend_field5i">手机：</td>
                  <td width="49%" align="left" bgcolor="#eeeeee"><input name="extend_field5" id="extend_field5" type="text" class="text16" value="<?php echo $this->_var['field']['content']; ?>"/><span style="color:#FF0000"> *</span></td>
                </tr> -->
    <?php else: ?>
		<tr>
			<td width="24%" align="right" bgcolor="#eeeeee" <?php if ($this->_var['field']['is_need']): ?>id="extend_field<?php echo $this->_var['field']['id']; ?>i"<?php endif; ?>><?php echo $this->_var['field']['reg_field_name']; ?>：</td>
			<td width="49%" align="left" bgcolor="#eeeeee">
			  <input name="extend_field<?php echo $this->_var['field']['id']; ?>" type="text" class="text16" value="<?php echo $this->_var['field']['content']; ?>"/><?php if ($this->_var['field']['is_need']): ?><span style="color:#FF0000"> *</span><?php endif; ?>
			  </td>
			</tr>
		<?php endif; ?>
		<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                <tr>
                  <td colspan="2" align="center" bgcolor="#eeeeee"><input name="act" type="hidden" value="act_edit_profile" />
                    <input name="submit" type="image" src="themes/default/images/index92.png" />
                  </td>
                </tr>
       </table>
    </form>
    <div class="clear"></div><div class="clear"></div>
     <form name="formPassword" action="user.php" method="post" onSubmit="return editPassword()" >
     <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#cdcdcd">
        <tr>
          <td width="24%" align="right" bgcolor="#eeeeee"><?php echo $this->_var['lang']['old_password']; ?>：</td>
          <td width="76%" align="left" bgcolor="#eeeeee"><input name="old_password" type="password" class="text16" /></td>
        </tr>
        <tr>
          <td width="24%" align="right" bgcolor="#eeeeee"><?php echo $this->_var['lang']['new_password']; ?>：</td>
          <td align="left" bgcolor="#eeeeee"><input name="new_password" type="password" class="text16" /></td>
        </tr>
        <tr>
          <td width="24%" align="right" bgcolor="#eeeeee"><?php echo $this->_var['lang']['confirm_password']; ?>：</td>
          <td align="left" bgcolor="#eeeeee"><input name="comfirm_password" type="password" class="text16" /></td>
        </tr>
        <tr>
          <td colspan="2" align="center" bgcolor="#eeeeee"><input name="act" type="hidden" value="act_edit_password" />
            <input name="submit" type="image" src="themes/default/images/index92.png" />
          </td>
        </tr>
      </table>
    </form>
     <?php endif; ?>
     
	 
	 
	 <?php if ($this->_var['action'] == 'edit_mobile_phone'): ?>
<style>
td,th{padding:10px;}
</style>
         <?php echo $this->smarty_insert_scripts(array('files'=>'utils.js,sms.js')); ?>
        <script type="text/javascript">
          <?php $_from = $this->_var['lang']['profile_js']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['item']):
?>
            var <?php echo $this->_var['key']; ?> = "<?php echo $this->_var['item']; ?>";
          <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
        </script>

     <form name="formPassword" action="user.php" method="post" >
     <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#cdcdcd">
		<tr>
          <td width="24%" align="right" bgcolor="#eeeeee">手机号码：</td>
          <td width="76%" align="left" bgcolor="#eeeeee"><input name="extend_field5" id="extend_field5" type="text" class="text10" style="background-color:#fff;"/></td>
        </tr>
        <tr>
          <td width="24%" align="right" bgcolor="#eeeeee">验&ensp;证&ensp;码：</td>
          <td align="left" bgcolor="#eeeeee">
			<input name="mobile_code" type="text" class="text10 text11" style="float:left;background-color:#fff;"/>
			<a href="javascript:void(0)" id="zphone" onclick="sendsms();" class="send" style="float:left;margin-left:10px;">发送验证码</a>
		  </td>
        </tr>


        <tr>
          <td colspan="2" align="center" bgcolor="#eeeeee"><input name="act" type="hidden" value="act_edit_mobile_phone" />
            <input name="submit" type="image" src="themes/default/images/index92.png" />
          </td>
        </tr>
      </table>
    </form>
     <?php endif; ?>
     
	 
     <?php if ($this->_var['action'] == 'bonus'): ?>
      <script type="text/javascript">
        <?php $_from = $this->_var['lang']['profile_js']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['item']):
?>
          var <?php echo $this->_var['key']; ?> = "<?php echo $this->_var['item']; ?>";
        <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
      </script>
      
       <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#dddddd" class="table">
        <tr>
          <th align="center" bgcolor="#FFFFFF"><?php echo $this->_var['lang']['bonus_sn']; ?></th>
          <th align="center" bgcolor="#FFFFFF"><?php echo $this->_var['lang']['bonus_name']; ?></th>
          <th align="center" bgcolor="#FFFFFF"><?php echo $this->_var['lang']['bonus_amount']; ?></th>
          <th align="center" bgcolor="#FFFFFF"><?php echo $this->_var['lang']['min_goods_amount']; ?></th>
          <th align="center" bgcolor="#FFFFFF"><?php echo $this->_var['lang']['bonus_end_date']; ?></th>
          <th align="center" bgcolor="#FFFFFF"><?php echo $this->_var['lang']['bonus_status']; ?></th>
        </tr>
        <?php if ($this->_var['bonus']): ?>
        <?php $_from = $this->_var['bonus']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['item']):
?>
        <tr>
          <td align="center" bgcolor="#FFFFFF"><?php echo empty($this->_var['item']['bonus_sn']) ? 'N/A' : $this->_var['item']['bonus_sn']; ?></td>
          <td align="center" bgcolor="#FFFFFF"><?php echo $this->_var['item']['type_name']; ?></td>
          <td align="center" bgcolor="#FFFFFF"><?php echo $this->_var['item']['type_money']; ?></td>
          <td align="center" bgcolor="#FFFFFF"><?php echo $this->_var['item']['min_goods_amount']; ?></td>
          <td align="center" bgcolor="#FFFFFF"><?php echo $this->_var['item']['use_enddate']; ?></td>
          <td align="center" bgcolor="#FFFFFF"><?php echo $this->_var['item']['status']; ?></td>
        </tr>
        <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
        <?php else: ?>
        <tr>
          <td colspan="6" bgcolor="#FFFFFF"><?php echo $this->_var['lang']['user_bonus_empty']; ?></td>
        </tr>
        <?php endif; ?>
      </table>
      <div class="blank5"></div>
      <?php echo $this->fetch('library/pages.lbi'); ?>
      <div class="blank5"></div>
      <h5 style="font-size:18px"><span><?php echo $this->_var['lang']['add_bonus']; ?></span></h5>
      <div class="blank"></div>
      <form name="addBouns" action="user.php" method="post" onSubmit="return addBonus()">
        <div style="padding: 15px;">
        <?php echo $this->_var['lang']['bonus_number']; ?>
          <input name="bonus_sn" type="text" size="30" style="border:1px solid #CCC" />
          <input type="hidden" name="act" value="act_add_bonus" class="inputBg" />
          <input type="submit" class="btn12bg" style="border:none;" value="<?php echo $this->_var['lang']['add_bonus']; ?>" />
        </div>
      </form>
    <?php endif; ?>
   
   
	  
       <?php if ($this->_var['action'] == 'order_back'): ?>
<style>
td,th{padding:10px;}
</style>
       
       <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#dddddd">
          <tr align="center">
            <td bgcolor="#ffffff">退换货单号</td>
            <td bgcolor="#ffffff">类别</td>
            <td bgcolor="#ffffff">快递号</td>
            <td bgcolor="#ffffff">订单号</td>
            <td bgcolor="#ffffff">日期</td>
            <td bgcolor="#ffffff">审核状态</td>
            <td bgcolor="#ffffff">操作</td>
          </tr>
          <?php $_from = $this->_var['backs']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['item']):
?>
          <tr>
            <td align="center" bgcolor="#ffffff"><?php echo $this->_var['item']['back_sn']; ?></td>
            <td align="center" bgcolor="#ffffff"><?php echo $this->_var['item']['case']; ?></td>
            <td align="right" bgcolor="#ffffff"><?php echo $this->_var['item']['invoice_no']; ?></td>
            <td align="center" bgcolor="#ffffff"><?php echo $this->_var['item']['order_sn']; ?></td>
            <td align="center" bgcolor="#ffffff"><?php echo $this->_var['item']['add_time']; ?></td>
            <td align="center" bgcolor="#ffffff">
            <font class="f6">
            <?php if ($this->_var['item']['status'] == 1 || $this->_var['item']['status'] == 2): ?>	
            	待审核 <a href="javascript:if(confirm('真的确定取消本次申请吗？')){window.location.href='user.php?act=back_del&back_sn=<?php echo $this->_var['item']['back_sn']; ?>'}" style="text-decoration:none;color:#F00">取消</a>
            <?php elseif ($this->_var['item']['status'] == 3): ?>
                已收货
            <?php elseif ($this->_var['item']['status'] == 4): ?>
                已退款
            <?php else: ?>
            	审核未通过
            <?php endif; ?>
            </font>
            </td>
            <td bgcolor="#ffffff" align="center"><a href="user.php?act=back_detail&back_sn=<?php echo $this->_var['item']['back_sn']; ?>" style="text-decoration:none;color:#F00">查看详情</a></td>
          </tr>
          <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
          </table>
        <div class="blank5"></div>
       <?php echo $this->fetch('library/pages.lbi'); ?>
       <?php endif; ?>
       
	  
       <?php if ($this->_var['action'] == 'order_back_search'): ?>
       <h5><span>退换货列表（退换货申请请点击”我的订单“已确认收货订单后操作中的“申请退货”链接）</span></h5>
        <div class="form-div">
          <form action="user.php" name="searchForm" method="get">
            <img src="themes/default/images/icon_search.gif" width="26" height="22" border="0" alt="SEARCH" />
            退换货号<input name="back_sn" type="text" id="back_sn" value="<?php echo $this->_var['back_sn']; ?>" size="15">
            快递<input name="invoice_no" type="text" id="invoice_no" value="<?php echo $this->_var['invoice_no']; ?>" size="15">
            订单号<input name="order_sn" type="text" id="order_id" value="<?php echo $this->_var['order_sn']; ?>" size="15">
            <input name="act" type="hidden" value="order_back_search">
            <input type="submit" value="<?php echo $this->_var['lang']['button_search']; ?>" class="button" />
          </form>
        </div>
       <div class="blank"></div>
       <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#dddddd">
          <tr align="center">
            <td bgcolor="#ffffff">退换货单号</td>
            <td bgcolor="#ffffff">类别</td>
            <td bgcolor="#ffffff">快递号</td>
            <td bgcolor="#ffffff">订单号</td>
            <td bgcolor="#ffffff">日期</td>
            <td bgcolor="#ffffff">审核状态</td>
          </tr>
          <?php $_from = $this->_var['backs']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['item']):
?>
          <tr>
            <td align="center" bgcolor="#ffffff"><?php echo $this->_var['item']['back_sn']; ?></td>
            <td align="center" bgcolor="#ffffff"><?php echo $this->_var['item']['case']; ?></td>
            <td align="right" bgcolor="#ffffff"><?php echo $this->_var['item']['invoice_no']; ?></td>
            <td align="center" bgcolor="#ffffff"><?php echo $this->_var['item']['order_sn']; ?></td>
            <td align="center" bgcolor="#ffffff"><?php echo $this->_var['item']['add_time']; ?></td>
            <td align="center" bgcolor="#ffffff">
            <font class="f6">
            <?php if ($this->_var['item']['status'] == 1 || $this->_var['item']['status'] == 2): ?>	
            	待审核 <a href="javascript:if(confirm('真的确定取消本次申请吗？')){window.location.href='user.php?act=back_del&back_sn=<?php echo $this->_var['item']['back_sn']; ?>'}" style="text-decoration:none;color:#F00">取消</a>
            <?php elseif ($this->_var['item']['status'] == 3): ?>
                已收货
            <?php elseif ($this->_var['item']['status'] == 4): ?>
                已退款
            <?php else: ?>
            	审核未通过
            <?php endif; ?>
            </font>
            </td>
          </tr>
          <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
          </table>
        <div class="blank5"></div>
       <?php echo $this->fetch('library/pages.lbi'); ?>
       <?php endif; ?>
         
      
     <?php if ($this->_var['action'] == tuihuo): ?>
<style>
td,th{padding:10px;}
</style>

       <form name="back_order" action="user.php" method="post" enctype="multipart/form-data" onsubmit="return checkBack()">
       <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#dddddd">
          <tr align="center">
            <td bgcolor="#ffffff">商品名称</td>
            <td bgcolor="#ffffff">编号</td>
            <td bgcolor="#ffffff">规格</td>
            <td bgcolor="#ffffff">商品总价</td>
            <td bgcolor="#ffffff">购买数量</td>
            <td bgcolor="#ffffff">退货数量</td>
          </tr>
          <script language="javascript">var total = 0;</script>
          <?php $_from = $this->_var['goods_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'goods_list');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['goods_list']):
?>
          <tr>
            <td align="center" bgcolor="#ffffff"><input type="checkbox" name="goods[]" value="<?php echo $this->_var['goods_list']['goods_name']; ?>-<?php echo $this->_var['goods_list']['goods_attr']; ?>-<?php echo $this->_var['goods_list']['goods_prices']; ?>" id="cbox<?php echo $this->_var['key']; ?>" /><?php echo $this->_var['goods_list']['goods_name']; ?></td>
            <td align="center" bgcolor="#ffffff"><?php echo $this->_var['goods_list']['goods_sn']; ?></td>
            <td align="right" bgcolor="#ffffff"><?php echo $this->_var['goods_list']['goods_attr']; ?></td>
            <td align="center" bgcolor="#ffffff"><font style="font-size:14px;font-weight:bold;font-family:Arial, Helvetica, sans-serif">&yen;</font> <?php echo $this->_var['goods_list']['subtotal']; ?></td>
            <td align="center" bgcolor="#ffffff" id="number<?php echo $this->_var['key']; ?>"><?php echo $this->_var['goods_list']['goods_number']; ?></td>
            <td align="center" bgcolor="#ffffff"><input type="hidden" name="goodsid[]" value="<?php echo $this->_var['goods_list']['goods_id']; ?>" /><input type="hidden" name="subtotal[]" value="<?php echo $this->_var['goods_list']['goods_price']; ?>" /><input type="text" name="number[]" style="width:50px; border:1px solid #CCC" id="putnum<?php echo $this->_var['key']; ?>" onchange="checkNum(<?php echo $this->_var['key']; ?>,this.value)" /><input type="hidden" name="act" value="back_submit" /><input type="hidden" name="order_id" value="<?php echo $this->_var['order_id']; ?>" /></td>
          </tr>
          <script language="javascript">total++;</script>
          <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
          <tr>
          	<td bgcolor="#ffffff">选择类型</td>
            <td colspan="5" bgcolor="#ffffff">
            	<select name="casea" id="casea">
                	<option value="退货">退货</option>
                	<option value="换货">换货</option>
                </select>
            </td>
          </tr>
		  <tr>
          	<td bgcolor="#ffffff">快递公司</td>
            <td colspan="5" bgcolor="#ffffff"><input type="text" name="shipping_name" style="border:1px solid #CCC" /> <font color="#FF0000">（请输入寄回的快递公司）</font></td>
          </tr>          
          <tr>
          	<td bgcolor="#ffffff">快递单号</td>
            <td colspan="5" bgcolor="#ffffff"><input type="text" name="invoice_no" style="border:1px solid #CCC" /> <font color="#FF0000">（请输入寄回的快递单号）</font></td>
          </tr>
          <tr>
          	<td bgcolor="#ffffff">理由</td>
            <td colspan="5" bgcolor="#ffffff"><input type="text" name="liyou" style="border:1px solid #CCC" /> <font color="#FF0000">*</font></td>
          </tr>
          <tr>
          	<td bgcolor="#ffffff">上传档案:</td>
          	<td colspan="5" bgcolor="#ffffff">
	      1.<INPUT type="file" name="refund_pic1"/><BR />
	      2.<INPUT type="file" name="refund_pic2"/><BR />
	      3.<INPUT type="file" name="refund_pic3"/>
          	</td>
          </tr>
          <tr>
          	<td bgcolor="#ffffff">备注</td>
            <td colspan="5" bgcolor="#ffffff">
            	<textarea name="beizhu" rows="5" cols="50"></textarea></td>
          </tr>
          <tr>
          	<td bgcolor="#FFFFFF" colspan="6" align="center"><input type="submit" name="sub" class="btn19" value="" /></td>
          </tr>
      </table>
      </form>
         <script language="javascript">
	   		var pase = false;
	   		function checkBack(){
				var shipping_name = document.back_order.shipping_name.value;
				var invoice_no = document.back_order.invoice_no.value;
				var liyou = document.back_order.liyou.value;
				
				if(shipping_name == ""){
					alert("请填写快递公司！");	
					document.back_order.shipping_name.focus();
					return false;
				}
				if(invoice_no == ""){
					alert("请填写快递单号！");	
					document.back_order.invoice_no.focus();
					return false;
				}
				if(liyou == ""){
					alert("请填写退款理由！");	
					document.back_order.liyou.focus();
					return false;
				}
			
				var j = true;
				var k = 0;
				var l = true;
				for(i=0;i<total;i++){
					if(document.getElementById("cbox"+i).checked){
						k = k + 1;								
					}
					if(document.getElementById("cbox"+i).checked && (document.getElementById("putnum"+i).value == "" || parseInt(document.getElementById("putnum"+i).value) == 0)){
						j = false;
					}
					if(!document.getElementById("cbox"+i).checked && parseInt(document.getElementById("putnum"+i).value) > 0){
						l = false;
					}
				}
				if(k == 0){
					alert("请至少选择一个要退货的商品");	
					return false;						
				}				
				if(!j){
					alert("请填写退货商品的退货量！");	
					return false;						
				}	
				if(!l){
					alert("您选择了退货量，请选择对应的商品！");	
					return false;						
				}					
				if(!pase){
					alert("退款数量不能超过购买数量！");	
					return false;						
				}				
			}
			
			function checkNum(key,num){
				if(parseInt(document.getElementById("number"+key).innerHTML) < num){
					alert("退款数量不能超过购买数量！");
					pase = false;
					return false;						
				}else{
					pase = true;	
				}
			}
	   </script>
     <?php endif; ?> 
     
     
     <?php if ($this->_var['action'] == back_detail): ?>
		<h5><span>退货信息详情</span></h5>
       <div class="blank"></div>
       <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#dddddd">
          <tr>
          	<td bgcolor="#ffffff">商品详情</td>
            <td colspan="5" bgcolor="#ffffff">
				<?php echo $this->_var['back']['goods']; ?>
            </td>          	
          </tr>
          <tr>
          	<td bgcolor="#ffffff">选择类型</td>
            <td colspan="5" bgcolor="#ffffff">
            	<?php echo $this->_var['back']['case']; ?>
            </td>
          </tr>
		  <tr>
          	<td bgcolor="#ffffff">快递公司</td>
            <td colspan="5" bgcolor="#ffffff"><?php echo $this->_var['back']['shipping_name']; ?></td>
          </tr>          
          <tr>
          	<td bgcolor="#ffffff">快递单号</td>
            <td colspan="5" bgcolor="#ffffff"><?php echo $this->_var['back']['invoice_no']; ?></td>
          </tr>
          <tr>
          	<td bgcolor="#ffffff">退货理由</td>
            <td colspan="5" bgcolor="#ffffff"><?php echo $this->_var['back']['liyou']; ?></td>
          </tr>
          <tr>
          	<td bgcolor="#ffffff">上传档案</td>
            <td colspan="5" bgcolor="#ffffff">
            <?php if ($this->_var['back']['refund_pic1']): ?><img src="data/feedbackimg/<?php echo $this->_var['back']['refund_pic1']; ?>" /><br><?php endif; ?>
            <?php if ($this->_var['back']['refund_pic2']): ?><img src="data/feedbackimg/<?php echo $this->_var['back']['refund_pic2']; ?>" /><br><?php endif; ?>
            <?php if ($this->_var['back']['refund_pic3']): ?><img src="data/feedbackimg/<?php echo $this->_var['back']['refund_pic3']; ?>" /><br><?php endif; ?></td>
          </tr>
          <tr>
          	<td bgcolor="#ffffff">备注</td>
            <td colspan="5" bgcolor="#ffffff"><?php echo $this->_var['back']['beizhu']; ?></td>
          </tr>
          <tr>
          	<td bgcolor="#ffffff">管理员回复</td>
            <td colspan="5" bgcolor="#ffffff"><?php echo $this->_var['back']['receve']; ?></td>
          </tr>
      </table>
     <?php endif; ?>      
   
   
      
       <?php if ($this->_var['action'] == 'order_list'): ?>


          <?php $_from = $this->_var['orders']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['item']):
?>
               <table width="100%" border="0" cellspacing="0" cellpadding="0" class="b-t1 m-b fs1">
                  <tr>
                    <td width="27" height="44" bgcolor="dfdfdf" class="b-l1 b-b1">&nbsp;</td>
                    <td colspan="5" bgcolor="dfdfdf" class="b-b1"><p class="p14"><b><?php echo $this->_var['item']['order_time']; ?></b>&emsp;订单号：<?php echo $this->_var['item']['order_sn']; ?>&emsp;总计：<b class="c14"><?php echo $this->_var['item']['total_fee']; ?></b></p></td>
                    <td width="154" bgcolor="dfdfdf" align="right" class="b-b1 b-r1">&nbsp;</td>
                  </tr>
                  <?php $_from = $this->_var['item']['goods']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'goods');$this->_foreach['goods'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['goods']['total'] > 0):
    foreach ($_from AS $this->_var['goods']):
        $this->_foreach['goods']['iteration']++;
?>
<tr>
                    <td width="27" height="105" bgcolor="ffffff" class="b-b1 b-l1">&nbsp;</td>
                    <td width="90" bgcolor="ffffff" class="b-b1"><a href="goods.php?id=<?php echo $this->_var['goods']['goods_id']; ?>"><img src="<?php echo $this->_var['goods']['goods_thumb']; ?>" width="77" height="77" /></a></td>
                    <td bgcolor="ffffff" class="b-b1 b-r1"><a href="goods.php?id=<?php echo $this->_var['goods']['goods_id']; ?>" class="c30"><?php echo $this->_var['goods']['goods_name']; ?></a></td>
                    <td width="140" bgcolor="ffffff" align="center" class="b-b1 b-r1"><span class="c26"><?php echo $this->_var['goods']['goods_price']; ?>      ×<?php echo $this->_var['goods']['goods_number']; ?></span></td>
                    <td width="121" bgcolor="ffffff" align="center" class="b-b1 b-r1"><b class="c14"><?php echo $this->_var['goods']['goods_price_fmt']; ?></b></td>
                    <td width="140" bgcolor="ffffff" align="center" class="b-b1 b-r1 lh">
                       <a href="user.php?act=order_detail&order_id=<?php echo $this->_var['item']['order_id']; ?>" class="c10 db"><?php echo $this->_var['item']['order_status']; ?></a>
                       <a href="user.php?act=order_detail&order_id=<?php echo $this->_var['item']['order_id']; ?>" class="c10 db">订单详情</a>
                    </td>
                    <td width="154" bgcolor="ffffff" align="center" class="b-b1 b-r1">
                       <?php echo $this->_var['item']['handler']; ?> <?php if ($this->_var['item']['shipping_status'] == 2): ?><?php if ($this->_var['item']['is_comment'] == '1'): ?><span style="color:red">已评价</a></span><?php else: ?><span><a href="user.php?act=order_comment&order_id=<?php echo $this->_var['item']['order_id']; ?>">待评价</a></span><?php endif; ?> <a href="javascript:if(confirm('真的确定申请退货吗？')){window.location.href='user.php?act=tuihuo&order_id=<?php echo $this->_var['item']['order_id']; ?>'}" style="text-decoration:none;color:#F00">申请退货</a><?php endif; ?>
                    </td>
                  </tr>
                  <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
               </table>
          <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>


       <?php echo $this->fetch('library/pages.lbi'); ?>
       
       <?php endif; ?>
      
      
      
      
<?php if ($this->_var['action'] == 'order_comment'): ?>




<script language="javascript">
function setImagePreview(a) {
var docObj=document.getElementById("pic"+a); 
var imgObjPreview=document.getElementById("preview"+a);
if(docObj.files &&docObj.files[0])
{
//火狐下，直接设img属性
//imgObjPreview.style.display = 'block';
imgObjPreview.style.width = '89px';
imgObjPreview.style.height = '89px'; 
//imgObjPreview.src = docObj.files[0].getAsDataURL();
 
//火狐7以上版本不能用上面的getAsDataURL()方式获取，需要一下方式
imgObjPreview.src = window.URL.createObjectURL(docObj.files[0]);
}
else
{
//IE下，使用滤镜
docObj.select();
var imgSrc = document.selection.createRange().text;
var localImagId = document.getElementById("localImag"+a);
//必须设置初始大小
localImagId.style.width = "89px";
localImagId.style.height = "89px";
//图片异常的捕捉，防止用户修改后缀来伪造图片
try{
localImagId.style.filter="progid:DXImageTransform.Microsoft.AlphaImageLoader(sizingMethod=scale)";
localImagId.filters.item("DXImageTransform.Microsoft.AlphaImageLoader").src = imgSrc;
}
catch(e)
{
alert("您上传的图片格式不正确，请重新选择!");
return false;
}
imgObjPreview.style.display = 'none';
document.selection.empty();
}
return true;
}


function check(){
	var textarea = document.getElementsByTagName('textarea');	
	for(var i =0;i < textarea.length;i++){
	if(textarea[i].value==""){
		alert("没有写评价的内容");
		return false;
	}	
	}
	}
</script>


<form name="formEdit" action="user.php" method="post" id="formEdit" >
<input type="hidden" name="order_id" value="<?php echo $this->_var['order_id']; ?>"/>

               <table width="100%" border="0" cellspacing="0" cellpadding="0"> 
<?php $_from = $this->_var['goods_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('k', 'goods');if (count($_from)):
    foreach ($_from AS $this->_var['k'] => $this->_var['goods']):
?>                              
                  <tr>
                    <td width="42" height="150" bgcolor="f9f9f9" class="b-b1 b-l1 b-t1">&nbsp;</td>
                    <td width="172" bgcolor="f9f9f9" class="b-b1 b-t1"><img src="<?php echo $this->_var['goods']['goods_thumb']; ?>" width="100"></td>
                    <td bgcolor="f9f9f9" class="b-b1 b-r1 b-t1" style="padding-top: 25px; padding-bottom: 30px;"><?php echo $this->_var['goods']['goods_name']; ?></td>
                  </tr>
                  <tr>
                    <td width="42" bgcolor="f9f9f9" class="b-b1 b-l1">&nbsp;</td>
                    <td width="172" bgcolor="f9f9f9" valign="top" class="b-b1" style="padding-top: 25px;"><span class="c29 fs">评价内容：</span></td>
                    <td bgcolor="f9f9f9" class="b-b1 b-r1" style="padding-top: 25px; padding-bottom: 30px;">
                      <textarea name="goods[<?php echo $this->_var['k']; ?>][content]" id="content_<?php echo $this->_var['k']; ?>"  class="fs c8 lh" cols="75" rows="3"></textarea>
                    </td>
                  </tr>
                  <tr>
                    <td width="42" height="114" bgcolor="f9f9f9" class="b-b1 b-l1">&nbsp;</td>
                    <td bgcolor="f9f9f9" class="b-b1 b-r1" colspan="2">
                         <a  href="javascript:;" style="position:relative" id="localImag1"><img id="preview1<?php echo $this->_var['k']; ?>" src="themes/default/images/t27.jpg" width="89" height="89" /><input type="file" style="width:89px; height:89px; position: absolute; top:-89px; left:0px;  filter:alpha(opacity:0); opacity:0;" name="pic1<?php echo $this->_var['k']; ?>" id="pic1<?php echo $this->_var['k']; ?>" onchange="javascript:setImagePreview(1<?php echo $this->_var['k']; ?>);" accept="image/*" ></a>
                         <a  href="javascript:;" style="position:relative" id="localImag2"><img id="preview2<?php echo $this->_var['k']; ?>" src="themes/default/images/t27.jpg" width="89" height="89" /><input type="file" style="width:89px; height:89px; position: absolute; top:-89px; left:0px;  filter:alpha(opacity:0); opacity:0;" name="pic2<?php echo $this->_var['k']; ?>" id="pic2<?php echo $this->_var['k']; ?>" onchange="javascript:setImagePreview(2<?php echo $this->_var['k']; ?>);" accept="image/*" ></a>
                         <a  href="javascript:;" style="position:relative" id="localImag3"><img id="preview3<?php echo $this->_var['k']; ?>" src="themes/default/images/t27.jpg" width="89" height="89" /><input type="file" style="width:89px; height:89px; position: absolute; top:-89px; left:0px;  filter:alpha(opacity:0); opacity:0;" name="pic3<?php echo $this->_var['k']; ?>" id="pic3<?php echo $this->_var['k']; ?>" onchange="javascript:setImagePreview(3<?php echo $this->_var['k']; ?>);" accept="image/*" ></a>
                         <a  href="javascript:;" style="position:relative" id="localImag4"><img id="preview4<?php echo $this->_var['k']; ?>" src="themes/default/images/t27.jpg" width="89" height="89" /><input type="file" style="width:89px; height:89px; position: absolute; top:-89px; left:0px;  filter:alpha(opacity:0); opacity:0;" name="pic4<?php echo $this->_var['k']; ?>" id="pic4<?php echo $this->_var['k']; ?>" onchange="javascript:setImagePreview(4<?php echo $this->_var['k']; ?>);" accept="image/*" ></a>
                    </td>
                  </tr>
                  <tr>
                    <td width="42">&nbsp;</td>
                    <td colspan="2">&nbsp;</td>
                  </tr>

<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                  <tr>
                    <td width="42" height="84">&nbsp;</td>
                    <td colspan="2">
                       <input name="act" type="hidden" value="save_comment" />
                       <input name="submit" type="submit" class="btn20" value="" onClick="return check();"  />
                    </td>
                  </tr>
               </table>
</form>
<?php endif; ?>
      
      
       
      <?php if ($this->_var['action'] == 'track_packages'): ?>
        <h5><span><?php echo $this->_var['lang']['label_track_packages']; ?></span></h5>
        <div class="blank"></div>
        <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#dddddd" id="order_table">
        <tr align="center">
          <td bgcolor="#ffffff"><?php echo $this->_var['lang']['order_number']; ?></td>
          <td bgcolor="#ffffff"><?php echo $this->_var['lang']['handle']; ?></td>
        </tr>
        <?php $_from = $this->_var['orders']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['item']):
?>
        <tr>
          <td align="center" bgcolor="#ffffff"><a href="user.php?act=order_detail&order_id=<?php echo $this->_var['item']['order_id']; ?>"><?php echo $this->_var['item']['order_sn']; ?></a></td>
          <td align="center" bgcolor="#ffffff"><?php echo $this->_var['item']['query_link']; ?></td>
        </tr>
        <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
      </table>
      <script>
      var query_status = '<?php echo $this->_var['lang']['query_status']; ?>';
      var ot = document.getElementById('order_table');
      for (var i = 1; i < ot.rows.length; i++)
      {
        var row = ot.rows[i];
        var cel = row.cells[1];
        cel.getElementsByTagName('a').item(0).innerHTML = query_status;
      }
      </script>
      <div class="blank5"></div>
      <?php echo $this->fetch('library/pages.lbi'); ?>
      <?php endif; ?>
    
     
      <?php if ($this->_var['action'] == order_detail): ?>
      
<style>
td,th{padding:10px;}
input{border: 1px solid #c9c9c9; padding:2px 10px;}
select{border: 1px solid #c9c9c9;}
</style>
      
         <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#dddddd">
        <tr>
          <td width="15%" align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['detail_order_sn']; ?>：</td>
          <td align="left" bgcolor="#ffffff"><?php echo $this->_var['order']['order_sn']; ?></td>
        </tr>
        <tr>
          <td align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['detail_order_status']; ?>：</td>
          <td align="left" bgcolor="#ffffff"><?php echo $this->_var['order']['order_status']; ?>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $this->_var['order']['confirm_time']; ?></td>
        </tr>
        <tr>
          <td align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['detail_pay_status']; ?>：</td>
          <td align="left" bgcolor="#ffffff" class="paybtn"><?php echo $this->_var['order']['pay_status']; ?>&nbsp;&nbsp;&nbsp;&nbsp;<?php if ($this->_var['order']['order_amount'] > 0): ?><?php echo $this->_var['order']['pay_online']; ?><?php endif; ?><?php echo $this->_var['order']['pay_time']; ?></td>
        </tr>
        <tr>
          <td align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['detail_shipping_status']; ?>：</td>
          <td align="left" bgcolor="#ffffff"><?php echo $this->_var['order']['shipping_status']; ?>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $this->_var['order']['shipping_time']; ?></td>
        </tr>
        <?php if ($this->_var['order']['invoice_no']): ?>
        <tr>
          <td align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['consignment']; ?>：</td>
          <td align="left" bgcolor="#ffffff"><b id="shipping_name"><?php echo $this->_var['order']['shipping_name']; ?></b> <b id="invoice_no"><?php echo strip_tags($this->_var['order']['invoice_no']); ?></b></td>
        </tr>
        <?php endif; ?>
	</table>
    <div class="clear"></div>

	<?php if ($this->_var['order']['invoice_no']): ?>
	<table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#dddddd">
	<tr>
		<td bgcolor="#ffffff"><div id="retData"></div></td>
	</tr>
	</table>
    <div class="clear"></div>
	<?php endif; ?>

	<?php if ($this->_var['order']['to_buyer']): ?>	
    <table>        
        <tr>
          <td align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['detail_to_buyer']; ?>：</td>
          <td align="left" bgcolor="#ffffff"><?php echo $this->_var['order']['to_buyer']; ?></td>
        </tr>        
    </table>
	<div class="clear"></div>
    <?php endif; ?>

         <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#dddddd">
          <tr>
            <th width="23%" align="center" bgcolor="#ffffff"><?php echo $this->_var['lang']['goods_name']; ?></th>
            <th width="29%" align="center" bgcolor="#ffffff"><?php echo $this->_var['lang']['goods_attr']; ?></th>
            <!--<th><?php echo $this->_var['lang']['market_price']; ?></th>-->
            <th width="26%" align="center" bgcolor="#ffffff"><?php echo $this->_var['lang']['goods_price']; ?><?php if ($this->_var['order']['extension_code'] == "group_buy"): ?><?php echo $this->_var['lang']['gb_deposit']; ?><?php endif; ?></th>
            <th width="9%" align="center" bgcolor="#ffffff"><?php echo $this->_var['lang']['number']; ?></th>
            <th width="20%" align="center" bgcolor="#ffffff"><?php echo $this->_var['lang']['subtotal']; ?></th>
          </tr>
          <?php $_from = $this->_var['goods_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'goods');if (count($_from)):
    foreach ($_from AS $this->_var['goods']):
?>
          <tr>
            <td bgcolor="#ffffff">
              <?php if ($this->_var['goods']['goods_id'] > 0 && $this->_var['goods']['extension_code'] != 'package_buy'): ?>
                <a href="goods.php?id=<?php echo $this->_var['goods']['goods_id']; ?>" target="_blank" class="f6"><?php echo $this->_var['goods']['goods_name']; ?></a>
                <?php if ($this->_var['goods']['parent_id'] > 0): ?>
                <span style="color:#FF0000">（<?php echo $this->_var['lang']['accessories']; ?>）</span>
                <?php elseif ($this->_var['goods']['is_gift']): ?>
                <span style="color:#FF0000">（<?php echo $this->_var['lang']['largess']; ?>）</span>
                <?php endif; ?>
              <?php elseif ($this->_var['goods']['goods_id'] > 0 && $this->_var['goods']['extension_code'] == 'package_buy'): ?>
                <a href="javascript:void(0)" onclick="setSuitShow(<?php echo $this->_var['goods']['goods_id']; ?>)" class="f6"><?php echo $this->_var['goods']['goods_name']; ?><span style="color:#FF0000;">（礼包）</span></a>
                <div id="suit_<?php echo $this->_var['goods']['goods_id']; ?>" style="display:none">
                    <?php $_from = $this->_var['goods']['package_goods_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'package_goods_list');if (count($_from)):
    foreach ($_from AS $this->_var['package_goods_list']):
?>
                      <a href="goods.php?id=<?php echo $this->_var['package_goods_list']['goods_id']; ?>" target="_blank" class="f6"><?php echo $this->_var['package_goods_list']['goods_name']; ?></a><br />
                    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                </div>
              <?php endif; ?>
              </td>
            <td align="left" bgcolor="#ffffff"><?php echo nl2br($this->_var['goods']['goods_attr']); ?></td>
            <!--<td align="right"><?php echo $this->_var['goods']['market_price']; ?></td>-->
            <td align="right" bgcolor="#ffffff"><?php echo $this->_var['goods']['goods_price']; ?></td>
            <td align="center" bgcolor="#ffffff"><?php echo $this->_var['goods']['goods_number']; ?></td>
            <td align="right" bgcolor="#ffffff"><?php echo $this->_var['goods']['subtotal']; ?></td>
          </tr>
          <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
          <tr>
            <td colspan="8" bgcolor="#ffffff" align="right">
            <?php echo $this->_var['lang']['shopping_money']; ?><?php if ($this->_var['order']['extension_code'] == "group_buy"): ?><?php echo $this->_var['lang']['gb_deposit']; ?><?php endif; ?>: <?php echo $this->_var['order']['formated_goods_amount']; ?>
            </td>
          </tr>
        </table>
        <div class="clear"></div>
         <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#dddddd">
          <tr>
            <td align="right" bgcolor="#ffffff">
                <?php echo $this->_var['lang']['goods_all_price']; ?><?php if ($this->_var['order']['extension_code'] == "group_buy"): ?><?php echo $this->_var['lang']['gb_deposit']; ?><?php endif; ?>: <?php echo $this->_var['order']['formated_goods_amount']; ?>
              <?php if ($this->_var['order']['discount'] > 0): ?>
              - <?php echo $this->_var['lang']['discount']; ?>: <?php echo $this->_var['order']['formated_discount']; ?>
              <?php endif; ?>
              <?php if ($this->_var['order']['tax'] > 0): ?>
              + <?php echo $this->_var['lang']['tax']; ?>: <?php echo $this->_var['order']['formated_tax']; ?>
              <?php endif; ?>
              <?php if ($this->_var['order']['shipping_fee'] > 0): ?>
              + <?php echo $this->_var['lang']['shipping_fee']; ?>: <?php echo $this->_var['order']['formated_shipping_fee']; ?>
              <?php endif; ?>
              <?php if ($this->_var['order']['insure_fee'] > 0): ?>
              + <?php echo $this->_var['lang']['insure_fee']; ?>: <?php echo $this->_var['order']['formated_insure_fee']; ?>
              <?php endif; ?>
              <?php if ($this->_var['order']['pay_fee'] > 0): ?>
              + <?php echo $this->_var['lang']['pay_fee']; ?>: <?php echo $this->_var['order']['formated_pay_fee']; ?>
              <?php endif; ?>
              <?php if ($this->_var['order']['pack_fee'] > 0): ?>
              + <?php echo $this->_var['lang']['pack_fee']; ?>: <?php echo $this->_var['order']['formated_pack_fee']; ?>
              <?php endif; ?>
              <?php if ($this->_var['order']['card_fee'] > 0): ?>
              + <?php echo $this->_var['lang']['card_fee']; ?>: <?php echo $this->_var['order']['formated_card_fee']; ?>
              <?php endif; ?>        </td>
          </tr>
          <tr>
            <td align="right" bgcolor="#ffffff">
              <?php if ($this->_var['order']['money_paid'] > 0): ?>
              - <?php echo $this->_var['lang']['order_money_paid']; ?>: <?php echo $this->_var['order']['formated_money_paid']; ?>
              <?php endif; ?>
              <?php if ($this->_var['order']['surplus'] > 0): ?>
              - <?php echo $this->_var['lang']['use_surplus']; ?>: <?php echo $this->_var['order']['formated_surplus']; ?>
              <?php endif; ?>
              <?php if ($this->_var['order']['integral_money'] > 0): ?>
              - <?php echo $this->_var['lang']['use_integral']; ?>: <?php echo $this->_var['order']['formated_integral_money']; ?>
              <?php endif; ?>
              <?php if ($this->_var['order']['bonus'] > 0): ?>
              - <?php echo $this->_var['lang']['use_bonus']; ?>: <?php echo $this->_var['order']['formated_bonus']; ?>
              <?php endif; ?>        </td>
          </tr>
          <tr>
            <td align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['order_amount']; ?>: <?php echo $this->_var['order']['formated_order_amount']; ?>
            <?php if ($this->_var['order']['extension_code'] == "group_buy"): ?><br />
            <?php echo $this->_var['lang']['notice_gb_order_amount']; ?><?php endif; ?></td>
          </tr>
            <?php if ($this->_var['allow_edit_surplus']): ?>
          <tr>
            <td align="right" bgcolor="#ffffff">
      <form action="user.php" method="post" name="formFee" id="formFee"><?php echo $this->_var['lang']['use_more_surplus']; ?>:
            <input name="surplus" type="text" size="8" value="0" style="border:1px solid #ccc;"/><?php echo $this->_var['max_surplus']; ?>
            <input type="submit" name="Submit" class="submit" value="<?php echo $this->_var['lang']['button_submit']; ?>" />
      <input type="hidden" name="act" value="act_edit_surplus" />
      <input type="hidden" name="order_id" value="<?php echo $_GET['order_id']; ?>" />
      </form></td>
          </tr>
    <?php endif; ?>
        </table>
         <div class="clear"></div>
         <?php if ($this->_var['order']['allow_update_address'] > 0): ?>
          <form action="user.php" method="post" name="formAddress" id="formAddress">
           <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#dddddd">
              <tr>
                <td width="15%" align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['consignee_name']; ?>： </td>
                <td align="left" bgcolor="#ffffff"><input name="consignee" type="text"  class="inputBg" value="<?php echo htmlspecialchars($this->_var['order']['consignee']); ?>" size="25">
                </td>
              </tr>
              <?php if ($this->_var['order']['exist_real_goods']): ?>
              
              <tr>
                <td align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['detailed_address']; ?>： </td>
                <td align="left" bgcolor="#ffffff"><input name="address" type="text" class="inputBg" value="<?php echo htmlspecialchars($this->_var['order']['address']); ?> " size="25" /></td>
              </tr>
              <?php endif; ?>
              <tr>
                <td align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['phone']; ?>：</td>
                <td align="left" bgcolor="#ffffff"><input name="tel" type="text" class="inputBg" value="<?php echo htmlspecialchars($this->_var['order']['tel']); ?>" size="25" /></td>
              </tr>
              <?php if ($this->_var['order']['exist_real_goods']): ?>
              
              <?php endif; ?>
              <tr>
                <td colspan="2" align="center" bgcolor="#ffffff"><input type="hidden" name="act" value="save_order_address" />
                  <input type="hidden" name="order_id" value="<?php echo $this->_var['order']['order_id']; ?>" />
                  <input type="submit" class="bnt_blue_2" value="<?php echo $this->_var['lang']['update_address']; ?>"  />
                </td>
              </tr>
            </table>
          </form>
          <?php else: ?>
          <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#dddddd">
            <tr>
              <td width="15%" align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['consignee_name']; ?>：</td>
              <td align="left" bgcolor="#ffffff"><?php echo $this->_var['order']['consignee']; ?></td>
            </tr>
            <?php if ($this->_var['order']['exist_real_goods']): ?>
            <tr>
              <td align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['detailed_address']; ?>：</td>
              <td align="left" bgcolor="#ffffff"><?php echo $this->_var['order']['address']; ?>
                <?php if ($this->_var['order']['zipcode']): ?>
                [<?php echo $this->_var['lang']['postalcode']; ?>: <?php echo $this->_var['order']['zipcode']; ?>]
                <?php endif; ?></td>
            </tr>
            <?php endif; ?>
            <tr>
              <td align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['phone']; ?>：</td>
              <td align="left" bgcolor="#ffffff"><?php echo $this->_var['order']['tel']; ?> </td>
            </tr>

          </table>
          <?php endif; ?>
        <div class="clear"></div>
        <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#dddddd">
                <tr>
                  <td bgcolor="#ffffff">
                  <?php echo $this->_var['lang']['select_payment']; ?>: <?php echo $this->_var['order']['pay_name']; ?>。<?php echo $this->_var['lang']['order_amount']; ?>: <strong><?php echo $this->_var['order']['formated_order_amount']; ?></strong><br />
                  <?php echo $this->_var['order']['pay_desc']; ?>
                  </td>
                </tr>
                  <tr>
                  <td bgcolor="#ffffff" align="right">
                  <?php if ($this->_var['payment_list']): ?>
              <form name="payment" method="post" action="user.php">
              <?php echo $this->_var['lang']['change_payment']; ?>:
              <select name="pay_id">
                <?php $_from = $this->_var['payment_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'payment');if (count($_from)):
    foreach ($_from AS $this->_var['payment']):
?>
                <option value="<?php echo $this->_var['payment']['pay_id']; ?>">
                <?php echo $this->_var['payment']['pay_name']; ?>(<?php echo $this->_var['lang']['pay_fee']; ?>:<?php echo $this->_var['payment']['format_pay_fee']; ?>)
                </option>
                <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
              </select>
              <input type="hidden" name="act" value="act_edit_payment" />
              <input type="hidden" name="order_id" value="<?php echo $this->_var['order']['order_id']; ?>" />
              <input type="submit" name="Submit" class="submit" value="<?php echo $this->_var['lang']['button_submit']; ?>" />
              </form>
              <?php endif; ?>
                  </td>
                </tr>
              </table>
        <div class="clear"></div>
        <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#dddddd">
          <?php if ($this->_var['order']['shipping_id'] > 0): ?>
          <tr>
            <td width="15%" align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['shipping']; ?>：</td>
            <td colspan="3" width="85%" align="left" bgcolor="#ffffff"><?php echo $this->_var['order']['shipping_name']; ?></td>
          </tr>
          <?php endif; ?>

          <tr>
            <td width="15%" align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['payment']; ?>：</td>
            <td colspan="3" align="left" bgcolor="#ffffff"><?php echo $this->_var['order']['pay_name']; ?></td>
          </tr>
          <?php if ($this->_var['order']['insure_fee'] > 0): ?>
          <?php endif; ?>
          <?php if ($this->_var['order']['pack_name']): ?>
          <tr>
            <td width="15%" align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['use_pack']; ?>：</td>
            <td colspan="3" align="left" bgcolor="#ffffff"><?php echo $this->_var['order']['pack_name']; ?></td>
          </tr>
          <?php endif; ?>
          <?php if ($this->_var['order']['card_name']): ?>
          <tr>
            <td width="15%" align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['use_card']; ?>：</td>
            <td colspan="3" align="left" bgcolor="#ffffff"><?php echo $this->_var['order']['card_name']; ?></td>
          </tr>
          <?php endif; ?>
          <?php if ($this->_var['order']['card_message']): ?>
          <tr>
            <td width="15%" align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['bless_note']; ?>：</td>
            <td colspan="3" align="left" bgcolor="#ffffff"><?php echo $this->_var['order']['card_message']; ?></td>
          </tr>
          <?php endif; ?>
          <?php if ($this->_var['order']['surplus'] > 0): ?>
          <?php endif; ?>
          <?php if ($this->_var['order']['integral'] > 0): ?>
          <tr>
            <td width="15%" align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['use_integral']; ?>：</td>
            <td colspan="3" align="left" bgcolor="#ffffff"><?php echo $this->_var['order']['integral']; ?></td>
          </tr>
          <?php endif; ?>
          <?php if ($this->_var['order']['bonus'] > 0): ?>
          <?php endif; ?>
          <?php if ($this->_var['order']['inv_payee'] && $this->_var['order']['inv_content']): ?>
          <tr>
            <td width="15%" align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['invoice_title']; ?>：</td>
            <td width="36%" align="left" bgcolor="#ffffff"><?php echo $this->_var['order']['inv_payee']; ?></td>
            <td width="19%" align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['invoice_content']; ?>：</td>
            <td width="25%" align="left" bgcolor="#ffffff"><?php echo $this->_var['order']['inv_content']; ?></td>
          </tr>
          <?php endif; ?>
          <?php if ($this->_var['order']['postscript']): ?>
          <tr>
            <td width="15%" align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['order_postscript']; ?>：</td>
            <td colspan="3" align="left" bgcolor="#ffffff"><?php echo $this->_var['order']['postscript']; ?></td>
          </tr>
          <?php endif; ?>
          <tr>
            <td width="15%" align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['booking_process']; ?>：</td>
            <td colspan="3" align="left" bgcolor="#ffffff"><?php echo $this->_var['order']['how_oos_name']; ?></td>
          </tr>
        </table>
      <?php endif; ?>
    
    

        <?php if ($this->_var['action'] == "account_raply"): ?>
<style>
td,th{padding:10px;}
</style>
        <form name="formSurplus" method="post" action="user.php" onSubmit="return submitSurplus()">
        <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#dddddd">
          <tr>
            <td width="15%" bgcolor="#ffffff"><?php echo $this->_var['lang']['repay_money']; ?>:</td>
            <td bgcolor="#ffffff" align="left"><input type="text" name="amount" value="<?php echo htmlspecialchars($this->_var['order']['amount']); ?>" class="inputBg"  style="border:1px solid #CCC" size="30" />
            </td>
          </tr>
          <tr>
            <td bgcolor="#ffffff"><?php echo $this->_var['lang']['process_notic']; ?>:</td>
            <td bgcolor="#ffffff" align="left"><textarea name="user_note" cols="55" rows="6" style="border:1px solid #ccc;"><?php echo htmlspecialchars($this->_var['order']['user_note']); ?></textarea></td>
          </tr>
          <tr>
            <td bgcolor="#ffffff" colspan="2" align="center">
            <input type="hidden" name="surplus_type" value="1" />
              <input type="hidden" name="act" value="act_account" />
              <input type="submit" name="submit"  class="btn19" value="" />
            </td>
          </tr>
        </table>
        </form>
        <?php endif; ?>
        <?php if ($this->_var['action'] == "account_deposit"): ?>
        <form name="formSurplus" method="post" action="user.php" onSubmit="return submitSurplus()">
            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="tab6 b-t1" style="margin-top: 0;">
                  <tr>
                    <td height="72" width="145" align="center" bgcolor="eeeeee" class="b-b1 b-l1"><b class="c21">余&emsp;&emsp;额：</b></td>
                    <td bgcolor="eeeeee" class="b-b1 b-r1"><b class="c14 c17"><?php echo $this->_var['surplus_amount']; ?></b></td>
                  </tr>
                  <tr>
                    <td height="72" width="145" align="center" bgcolor="eeeeee" class="b-b1 b-l1"><b class="c21">充&emsp;&emsp;值：</b></td>
                    <td bgcolor="eeeeee" class="b-b1 b-r1"><input type="text" name="amount"  class="inputBg" style="border:1px solid #CCC" value="<?php echo htmlspecialchars($this->_var['order']['amount']); ?>" size="30" /></td>
                  </tr>
               </table>
               <div class="clear"></div>
            <table width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="#dddddd"  class="table">
              <tr align="center">
              <td bgcolor="#ffffff"  colspan="3" align="left"><?php echo $this->_var['lang']['payment']; ?>:</td>
            </tr>
            <tr align="center">
              <td bgcolor="#ffffff"><?php echo $this->_var['lang']['pay_name']; ?></td>
              <td bgcolor="#ffffff" width="60%"><?php echo $this->_var['lang']['pay_desc']; ?></td>
              <td bgcolor="#ffffff" width="17%"><?php echo $this->_var['lang']['pay_fee']; ?></td>
            </tr>
            <?php $_from = $this->_var['payment']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'list');if (count($_from)):
    foreach ($_from AS $this->_var['list']):
?>
            <tr>
              <td bgcolor="#ffffff" align="left">
              <input type="radio" name="payment_id" value="<?php echo $this->_var['list']['pay_id']; ?>" /><?php echo $this->_var['list']['pay_name']; ?></td>
              <td bgcolor="#ffffff" align="left"><?php echo $this->_var['list']['pay_desc']; ?></td>
              <td bgcolor="#ffffff" align="center"><?php echo $this->_var['list']['pay_fee']; ?></td>
            </tr>
            <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
            <tr>
        <td bgcolor="#ffffff" colspan="3"  align="center">
        <input type="hidden" name="surplus_type" value="0" />
          <input type="hidden" name="rec_id" value="<?php echo $this->_var['order']['id']; ?>" />
          <input type="hidden" name="act" value="act_account" />
          <input type="submit" class="btn19" name="submit" value="" />
        </td>
      </tr>
          </table>
        </form>
        <?php endif; ?>
        <?php if ($this->_var['action'] == "act_account"): ?>
        <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#dddddd" class="table">
          <tr>
            <td width="25%" align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['surplus_amount']; ?></td>
            <td width="80%" bgcolor="#ffffff"><?php echo $this->_var['amount']; ?></td>
          </tr>
          <tr>
            <td align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['payment_name']; ?></td>
            <td bgcolor="#ffffff"><?php echo $this->_var['payment']['pay_name']; ?></td>
          </tr>
          <tr>
            <td align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['payment_fee']; ?></td>
            <td bgcolor="#ffffff"><?php echo $this->_var['pay_fee']; ?></td>
          </tr>
          <tr>
            <td align="right" valign="middle" bgcolor="#ffffff"><?php echo $this->_var['lang']['payment_desc']; ?></td>
            <td bgcolor="#ffffff"><?php echo $this->_var['payment']['pay_desc']; ?></td>
          </tr>
          <tr>
            <td colspan="2" align="center" bgcolor="#ffffff" class="paybtn"><?php echo $this->_var['payment']['pay_button']; ?></td>
          </tr>
        </table>
        <?php endif; ?>
       <?php if ($this->_var['action'] == "account_detail"): ?>
        <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#dddddd">
          <tr align="center">
            <td bgcolor="#ffffff"><?php echo $this->_var['lang']['process_time']; ?></td>
            <td bgcolor="#ffffff"><?php echo $this->_var['lang']['surplus_pro_type']; ?></td>
            <td bgcolor="#ffffff"><?php echo $this->_var['lang']['money']; ?></td>
            <td bgcolor="#ffffff"><?php echo $this->_var['lang']['change_desc']; ?></td>
          </tr>
          <?php $_from = $this->_var['account_log']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['item']):
?>
          <tr>
            <td align="center" bgcolor="#ffffff"><?php echo $this->_var['item']['change_time']; ?></td>
            <td align="center" bgcolor="#ffffff"><?php echo $this->_var['item']['type']; ?></td>
            <td align="right" bgcolor="#ffffff"><?php echo $this->_var['item']['amount']; ?></td>
            <td bgcolor="#ffffff" title="<?php echo $this->_var['item']['change_desc']; ?>">&nbsp;&nbsp;<?php echo $this->_var['item']['short_change_desc']; ?></td>
          </tr>
          <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
          <tr>
            <td colspan="4" align="center" bgcolor="#ffffff"><div align="right"><?php echo $this->_var['lang']['current_surplus']; ?><?php echo $this->_var['surplus_amount']; ?></div></td>
          </tr>
        </table>
        <?php echo $this->fetch('library/pages.lbi'); ?>
        <?php endif; ?>
        <?php if ($this->_var['action'] == "account_log"): ?>
        <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#dddddd">
          <tr align="center">
            <td bgcolor="#ffffff"><?php echo $this->_var['lang']['process_time']; ?></td>
            <td bgcolor="#ffffff"><?php echo $this->_var['lang']['surplus_pro_type']; ?></td>
            <td bgcolor="#ffffff"><?php echo $this->_var['lang']['money']; ?></td>
            <td bgcolor="#ffffff"><?php echo $this->_var['lang']['process_notic']; ?></td>
            <td bgcolor="#ffffff"><?php echo $this->_var['lang']['admin_notic']; ?></td>
            <td bgcolor="#ffffff"><?php echo $this->_var['lang']['is_paid']; ?></td>
            <td bgcolor="#ffffff"><?php echo $this->_var['lang']['handle']; ?></td>
          </tr>
          <?php $_from = $this->_var['account_log']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['item']):
?>
          <tr>
            <td align="center" bgcolor="#ffffff"><?php echo $this->_var['item']['add_time']; ?></td>
            <td align="left" bgcolor="#ffffff"><?php echo $this->_var['item']['type']; ?></td>
            <td align="right" bgcolor="#ffffff"><?php echo $this->_var['item']['amount']; ?></td>
            <td align="left" bgcolor="#ffffff"><?php echo $this->_var['item']['short_user_note']; ?></td>
            <td align="left" bgcolor="#ffffff"><?php echo $this->_var['item']['short_admin_note']; ?></td>
            <td align="center" bgcolor="#ffffff"><?php echo $this->_var['item']['pay_status']; ?></td>
            <td align="right" bgcolor="#ffffff"><?php echo $this->_var['item']['handle']; ?>
              <?php if (( $this->_var['item']['is_paid'] == 0 && $this->_var['item']['process_type'] == 1 ) || $this->_var['item']['handle']): ?>
              <a href="user.php?act=cancel&id=<?php echo $this->_var['item']['id']; ?>" onclick="if (!confirm('<?php echo $this->_var['lang']['confirm_remove_account']; ?>')) return false;"><?php echo $this->_var['lang']['is_cancel']; ?></a>
              <?php endif; ?>
                            </td>
          </tr>
          <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
          <tr>
            <td colspan="7" align="right" bgcolor="#ffffff"><?php echo $this->_var['lang']['current_surplus']; ?><?php echo $this->_var['surplus_amount']; ?></td>
          </tr>
        </table>
        <?php echo $this->fetch('library/pages.lbi'); ?>
      <?php endif; ?>
      
      
      <?php if ($this->_var['action'] == 'address_list'): ?>
         
            <?php echo $this->smarty_insert_scripts(array('files'=>'utils.js,transport.js,region.js,shopping_flow.js')); ?>
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
            <?php $_from = $this->_var['consignee_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('sn', 'consignee');$this->_foreach['cn'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['cn']['total'] > 0):
    foreach ($_from AS $this->_var['sn'] => $this->_var['consignee']):
        $this->_foreach['cn']['iteration']++;
?>
            
            
            <?php if (($this->_foreach['cn']['iteration'] - 1) != 0): ?>
            <?php if (($this->_foreach['cn']['iteration'] - 1) == 1): ?> 
          <div class="clear"></div>
          <?php endif; ?>
               <table width="100%" border="0" cellspacing="0" cellpadding="0" class="b-b1 b-t1 b-l1 b-r1 fs1 m-b">
                  <tr>
                    <td height="46" width="209" bgcolor="eeeeee">&emsp;&ensp;<?php if ($this->_var['consignee']['address_ids'] == 1): ?><span class="c31 c32">已默认地址</span><?php else: ?><a href="user.php?act=act_moren_address&id=<?php echo $this->_var['consignee']['address_id']; ?>" class="c31">设为默认地址</a><?php endif; ?></td>
                    <td width="115" bgcolor="eeeeee"><b class="user2"><?php echo htmlspecialchars($this->_var['consignee']['consignee']); ?></b></td>
                    <td width="163" bgcolor="eeeeee"><span class="c33 tel2"><?php echo htmlspecialchars($this->_var['consignee']['tel']); ?><?php echo htmlspecialchars($this->_var['consignee']['mobile']); ?></span></td>
                    <td width="430" bgcolor="eeeeee"><span class="local2 c33"><?php $_from = $this->_var['province_list'][$this->_var['sn']]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'province');if (count($_from)):
    foreach ($_from AS $this->_var['province']):
?>
                        <?php if ($this->_var['consignee']['province'] == $this->_var['province']['region_id']): ?><?php echo $this->_var['province']['region_name']; ?><?php endif; ?>
						<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
						<?php $_from = $this->_var['city_list'][$this->_var['sn']]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'city');if (count($_from)):
    foreach ($_from AS $this->_var['city']):
?>
						<?php if ($this->_var['consignee']['city'] == $this->_var['city']['region_id']): ?><?php echo $this->_var['city']['region_name']; ?><?php endif; ?>
						<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
						<?php $_from = $this->_var['district_list'][$this->_var['sn']]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'district');if (count($_from)):
    foreach ($_from AS $this->_var['district']):
?>
						<?php if ($this->_var['consignee']['district'] == $this->_var['district']['region_id']): ?><?php echo $this->_var['district']['region_name']; ?><?php endif; ?>
						<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?><?php echo htmlspecialchars($this->_var['consignee']['address']); ?></span></td>
                    <td width="81" bgcolor="eeeeee" align="center"><a href="user.php?act=address_list&id=<?php echo $this->_var['consignee']['address_id']; ?>" class="btn29 b-r1"><img src="themes/default/images/index82.png" width="14" height="14" /></a><a href="javascript:void(0);" onclick="if (confirm('<?php echo $this->_var['lang']['confirm_drop_address']; ?>'))location.href='user.php?act=drop_consignee&id=<?php echo $this->_var['consignee']['address_id']; ?>'" class="btn29"><img src="themes/default/images/index83.png" width="15" height="16" /></a></td>
                  </tr>
               </table>  
              
              
              <?php else: ?>
            
            <form action="user.php" method="post" name="theForm" onsubmit="return checkConsignee(this)">
            
               <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td height="50">
                       收货人姓名：<input name="consignee" type="text" class="text12 fs" id="consignee" value="<?php echo htmlspecialchars($this->_var['consignee']['consignee']); ?>" />
                       手机号码：<input name="tel" type="text" class="text13 fs" id="tel" value="<?php echo htmlspecialchars($this->_var['consignee']['tel']); ?>" />
                    </td>
                  </tr>
                  <tr>
                    <td height="50">                      
                    &nbsp;&nbsp;&nbsp;收货地址：<select name="country" id="selCountries_<?php echo $this->_var['sn']; ?>" onchange="region.changed(this, 1, 'selProvinces_<?php echo $this->_var['sn']; ?>')" class="text12 text14 fs">
                      <option value="0"><?php echo $this->_var['lang']['please_select']; ?><?php echo $this->_var['name_of_region']['0']; ?></option>
                      <?php $_from = $this->_var['country_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'country');if (count($_from)):
    foreach ($_from AS $this->_var['country']):
?>
                      <option value="<?php echo $this->_var['country']['region_id']; ?>" <?php if ($this->_var['consignee']['country'] == $this->_var['country']['region_id']): ?>selected<?php endif; ?>><?php echo $this->_var['country']['region_name']; ?></option>
                      <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                    </select>
                    <select name="province" id="selProvinces_<?php echo $this->_var['sn']; ?>" onchange="region.changed(this, 2, 'selCities_<?php echo $this->_var['sn']; ?>')" class="text12 text14 fs">
                      <option value="0"><?php echo $this->_var['lang']['please_select']; ?><?php echo $this->_var['name_of_region']['1']; ?></option>
                      <?php $_from = $this->_var['province_list'][$this->_var['sn']]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'province');if (count($_from)):
    foreach ($_from AS $this->_var['province']):
?>
                      <option value="<?php echo $this->_var['province']['region_id']; ?>" <?php if ($this->_var['consignee']['province'] == $this->_var['province']['region_id']): ?>selected<?php endif; ?>><?php echo $this->_var['province']['region_name']; ?></option>
                      <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                    </select>
                    <select name="city" id="selCities_<?php echo $this->_var['sn']; ?>" onchange="region.changed(this, 3, 'selDistricts_<?php echo $this->_var['sn']; ?>')" class="text12 text14 fs">
                      <option value="0"><?php echo $this->_var['lang']['please_select']; ?><?php echo $this->_var['name_of_region']['2']; ?></option>
                      <?php $_from = $this->_var['city_list'][$this->_var['sn']]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'city');if (count($_from)):
    foreach ($_from AS $this->_var['city']):
?>
                      <option value="<?php echo $this->_var['city']['region_id']; ?>" <?php if ($this->_var['consignee']['city'] == $this->_var['city']['region_id']): ?>selected<?php endif; ?>><?php echo $this->_var['city']['region_name']; ?></option>
                      <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                    </select>
                    <select name="district" id="selDistricts_<?php echo $this->_var['sn']; ?>" <?php if (! $this->_var['district_list'][$this->_var['sn']]): ?>style="display:none"<?php endif; ?> class="text12 text14 fs">
                      <option value="0"><?php echo $this->_var['lang']['please_select']; ?><?php echo $this->_var['name_of_region']['3']; ?></option>
                      <?php $_from = $this->_var['district_list'][$this->_var['sn']]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'district');if (count($_from)):
    foreach ($_from AS $this->_var['district']):
?>
                      <option value="<?php echo $this->_var['district']['region_id']; ?>" <?php if ($this->_var['consignee']['district'] == $this->_var['district']['region_id']): ?>selected<?php endif; ?>><?php echo $this->_var['district']['region_name']; ?></option>
                      <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                    </select>  
                    </td>
                  </tr>
                  <tr>
                    <td height="50">
                       &nbsp;&nbsp;&nbsp;详细地址：<input name="address" type="text" class="text15 fs" id="address" value="<?php echo htmlspecialchars($this->_var['consignee']['address']); ?>" />
                    </td>
                  </tr>
               </table>
               <div class="clear"></div>
               
               
               
                    
                    <?php if ($this->_var['consignee']['consignee'] && $this->_var['consignee']['email']): ?>
                    <input type="submit" name="submit" class="btn12bg" value="<?php echo $this->_var['lang']['confirm_edit']; ?>" />
                    <input name="button" type="button" class="btn12bg" onclick="if (confirm('<?php echo $this->_var['lang']['confirm_drop_address']; ?>'))location.href='user.php?act=drop_consignee&id=<?php echo $this->_var['consignee']['address_id']; ?>'" value="<?php echo $this->_var['lang']['drop']; ?>" />
                    <?php else: ?>
                    <input type="submit" name="submit" class="btn12bg" value="新增地址"/>
                    <?php endif; ?>
                    <input type="hidden" name="act" value="act_edit_address" />
                    <input name="address_id" type="hidden" value="<?php echo $this->_var['consignee']['address_id']; ?>" />
                    
                    
            </form>
            <div class="blank"></div>
            <?php endif; ?>
            <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
      <?php endif; ?>
    
      
       <?php if ($this->_var['action'] == 'transform_points'): ?>
       <h5><span><?php echo $this->_var['lang']['transform_points']; ?></span></h5>
             <div class="blank"></div>
       <?php if ($this->_var['exchange_type'] == 'ucenter'): ?>
        <form action="user.php" method="post" name="transForm" onsubmit="return calcredit();">
       <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#dddddd">
                <tr>
                    <th width="120" bgcolor="#FFFFFF" align="right" valign="top"><?php echo $this->_var['lang']['cur_points']; ?>:</th>
                    <td bgcolor="#FFFFFF">
                    <label for="pay_points"><?php echo $this->_var['lang']['exchange_points']['1']; ?>:</label><input type="text" size="15" id="pay_points" name="pay_points" value="<?php echo $this->_var['shop_points']['pay_points']; ?>" style="border:0;border-bottom:1px solid #DADADA;" readonly="readonly" /><br />
                    <div class="blank"></div>
                    <label for="rank_points"><?php echo $this->_var['lang']['exchange_points']['0']; ?>:</label><input type="text" size="15" id="rank_points" name="rank_points" value="<?php echo $this->_var['shop_points']['rank_points']; ?>" style="border:0;border-bottom:1px solid #DADADA;" readonly="readonly" />
                    </td>
                    </tr>
          <tr><td bgcolor="#FFFFFF">&nbsp;</td>
          <td bgcolor="#FFFFFF">&nbsp;</td>
          </tr>
          <tr>
            <th align="right" bgcolor="#FFFFFF"><label for="amount"><?php echo $this->_var['lang']['exchange_amount']; ?>:</label></th>
            <td bgcolor="#FFFFFF"><input size="15" name="amount" id="amount" value="0" onkeyup="calcredit();" type="text" />
                <select name="fromcredits" id="fromcredits" onchange="calcredit();">
                  <?php echo $this->html_options(array('options'=>$this->_var['lang']['exchange_points'],'selected'=>$this->_var['selected_org'])); ?>
                </select>
            </td>
          </tr>
          <tr>
            <th align="right" bgcolor="#FFFFFF"><label for="desamount"><?php echo $this->_var['lang']['exchange_desamount']; ?>:</label></th>
            <td bgcolor="#FFFFFF"><input type="text" name="desamount" id="desamount" disabled="disabled" value="0" size="15" />
              <select name="tocredits" id="tocredits" onchange="calcredit();">
                <?php echo $this->html_options(array('options'=>$this->_var['to_credits_options'],'selected'=>$this->_var['selected_dst'])); ?>
              </select>
            </td>
          </tr>
          <tr>
            <th align="right" bgcolor="#FFFFFF"><?php echo $this->_var['lang']['exchange_ratio']; ?>:</th>
            <td bgcolor="#FFFFFF">1 <span id="orgcreditunit"><?php echo $this->_var['orgcreditunit']; ?></span> <span id="orgcredittitle"><?php echo $this->_var['orgcredittitle']; ?></span> <?php echo $this->_var['lang']['exchange_action']; ?> <span id="descreditamount"><?php echo $this->_var['descreditamount']; ?></span> <span id="descreditunit"><?php echo $this->_var['descreditunit']; ?></span> <span id="descredittitle"><?php echo $this->_var['descredittitle']; ?></span></td>
          </tr>
          <tr><td bgcolor="#FFFFFF">&nbsp;</td>
          <td bgcolor="#FFFFFF"><input type="hidden" name="act" value="act_transform_ucenter_points" /><input type="submit" name="transfrom" value="<?php echo $this->_var['lang']['transform']; ?>" /></td></tr>
  </table>
        </form>
       <script type="text/javascript">
        <?php $_from = $this->_var['lang']['exchange_js']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'lang_js');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['lang_js']):
?>
        var <?php echo $this->_var['key']; ?> = '<?php echo $this->_var['lang_js']; ?>';
        <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>

        var out_exchange_allow = new Array();
        <?php $_from = $this->_var['out_exchange_allow']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'ratio');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['ratio']):
?>
        out_exchange_allow['<?php echo $this->_var['key']; ?>'] = '<?php echo $this->_var['ratio']; ?>';
        <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>

        function calcredit()
        {
            var frm = document.forms['transForm'];
            var src_credit = frm.fromcredits.value;
            var dest_credit = frm.tocredits.value;
            var in_credit = frm.amount.value;
            var org_title = frm.fromcredits[frm.fromcredits.selectedIndex].innerHTML;
            var dst_title = frm.tocredits[frm.tocredits.selectedIndex].innerHTML;
            var radio = 0;
            var shop_points = ['rank_points', 'pay_points'];
            if (parseFloat(in_credit) > parseFloat(document.getElementById(shop_points[src_credit]).value))
            {
                alert(balance.replace('{%s}', org_title));
                frm.amount.value = frm.desamount.value = 0;
                return false;
            }
            if (typeof(out_exchange_allow[dest_credit+'|'+src_credit]) == 'string')
            {
                radio = (1 / parseFloat(out_exchange_allow[dest_credit+'|'+src_credit])).toFixed(2);
            }
            document.getElementById('orgcredittitle').innerHTML = org_title;
            document.getElementById('descreditamount').innerHTML = radio;
            document.getElementById('descredittitle').innerHTML = dst_title;
            if (in_credit > 0)
            {
                if (typeof(out_exchange_allow[dest_credit+'|'+src_credit]) == 'string')
                {
                    frm.desamount.value = Math.floor(parseFloat(in_credit) / parseFloat(out_exchange_allow[dest_credit+'|'+src_credit]));
                    frm.transfrom.disabled = false;
                    return true;
                }
                else
                {
                    frm.desamount.value = deny;
                    frm.transfrom.disabled = true;
                    return false;
                }
            }
            else
            {
                return false;
            }
        }
       </script>
       <?php else: ?>
        <b><?php echo $this->_var['lang']['cur_points']; ?>:</b>
        <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#dddddd">
          <tr>
            <td width="30%" valign="top" bgcolor="#FFFFFF"><table border="0">
              <?php $_from = $this->_var['bbs_points']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'points');if (count($_from)):
    foreach ($_from AS $this->_var['points']):
?>
              <tr>
                <th><?php echo $this->_var['points']['title']; ?>:</th>
                <td width="120" style="border-bottom:1px solid #DADADA;"><?php echo $this->_var['points']['value']; ?></td>
              </tr>
              <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
            </table></td>
            <td width="50%" valign="top" bgcolor="#FFFFFF"><table>
                    <tr>
                <th><?php echo $this->_var['lang']['pay_points']; ?>:</th>
                <td width="120" style="border-bottom:1px solid #DADADA;"><?php echo $this->_var['shop_points']['pay_points']; ?></td>
                    </tr>
              <tr>
                <th><?php echo $this->_var['lang']['rank_points']; ?>:</th>
                <td width="120" style="border-bottom:1px solid #DADADA;"><?php echo $this->_var['shop_points']['rank_points']; ?></td>
              </tr>
            </table></td>
          </tr>
        </table>
        <br />
        <b><?php echo $this->_var['lang']['rule_list']; ?>:</b>
        <ul class="point clearfix">
          <?php $_from = $this->_var['rule_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'rule');if (count($_from)):
    foreach ($_from AS $this->_var['rule']):
?>
          <li><font class="f1">·</font>"<?php echo $this->_var['rule']['from']; ?>" <?php echo $this->_var['lang']['transform']; ?> "<?php echo $this->_var['rule']['to']; ?>" <?php echo $this->_var['lang']['rate_is']; ?> <?php echo $this->_var['rule']['rate']; ?>
          <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
        </ul>

        <form action="user.php" method="post" name="theForm">
        <table width="100%" border="1" align="center" cellpadding="5" cellspacing="0" style="border-collapse:collapse;border:1px solid #DADADA;">
          <tr style="background:#F1F1F1;">
            <th><?php echo $this->_var['lang']['rule']; ?></th>
            <th><?php echo $this->_var['lang']['transform_num']; ?></th>
            <th><?php echo $this->_var['lang']['transform_result']; ?></th>
          </tr>
          <tr>
            <td>
              <select name="rule_index" onchange="changeRule()">
                <?php $_from = $this->_var['rule_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'rule');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['rule']):
?>
                <option value="<?php echo $this->_var['key']; ?>"><?php echo $this->_var['rule']['from']; ?>-><?php echo $this->_var['rule']['to']; ?></option>
                <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
              </select>
          </td>
          <td>
            <input type="text" name="num" value="0" onkeyup="calPoints()"/>
          </td>
          <td><span id="ECS_RESULT">0</span></td>
          </tr>
          <tr>
            <td colspan="3" align="center"><input type="hidden" name="act" value="act_transform_points"  /><input type="submit" value="<?php echo $this->_var['lang']['transform']; ?>" /></td>
          </tr>
        </table>
        </form>
       <script type="text/javascript">
          //<![CDATA[
            var rule_list = new Object();
            var invalid_input = '<?php echo $this->_var['lang']['invalid_input']; ?>';
            <?php $_from = $this->_var['rule_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'rule');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['rule']):
?>
            rule_list['<?php echo $this->_var['key']; ?>'] = '<?php echo $this->_var['rule']['rate']; ?>';
            <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
            function calPoints()
            {
              var frm = document.forms['theForm'];
              var rule_index = frm.elements['rule_index'].value;
              var num = parseInt(frm.elements['num'].value);
              var rate = rule_list[rule_index];

              if (isNaN(num) || num < 0 || num != frm.elements['num'].value)
              {
                document.getElementById('ECS_RESULT').innerHTML = invalid_input;
                rerutn;
              }
              var arr = rate.split(':');
              var from = parseInt(arr[0]);
              var to = parseInt(arr[1]);

              if (from <=0 || to <=0)
              {
                from = 1;
                to = 0;
              }
              document.getElementById('ECS_RESULT').innerHTML = parseInt(num * to / from);
            }

            function changeRule()
            {
              document.forms['theForm'].elements['num'].value = 0;
              document.getElementById('ECS_RESULT').innerHTML = 0;
            }
          //]]>
       </script>
       <?php endif; ?>
        <?php endif; ?>
        




      </div>
     </div>
    </div>
  </div>
  
</div>
<div class="blank"></div>
<?php echo $this->fetch('library/page_footer.lbi'); ?>
<script language="javascript">
	document.getElementById("retData").innerHTML="<center>正在查询物流信息，请稍后...</center>";
	var expressid = document.getElementById("shipping_name").innerHTML;
	var expressno = document.getElementById("invoice_no").innerHTML;
	Ajax.call('plugins/kuaidi100/express.php?com='+ expressid+'&nu=' + expressno,'showtest=showtest', function(data){document.getElementById("retData").innerHTML=data;}, 'GET', 'TEXT');
</script>
</body>
<script type="text/javascript">
<?php $_from = $this->_var['lang']['clips_js']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['item']):
?>
var <?php echo $this->_var['key']; ?> = "<?php echo $this->_var['item']; ?>";
<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
</script>
</html>
