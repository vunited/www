<?php echo $this->fetch('pageheader.htm'); ?>
<link href="styles/nms_style.css" rel="stylesheet" type="text/css" />
<div class="tab-div">
  <div id="tabbody-div" class="tbbg" >
    <form enctype="multipart/form-data" action="shops.php?act=getbatchco" method="post" name="theForm" >
      <table width="90%" id="general-table" >
        <div class="shuoming"> 
		  1、商品ID是淘宝商品链接里id=123456789的一串数字<br />
		  2、可输入多个商品id号进行采集，以半角逗号或者回车分隔（如：18736939637,15646098607,24298040344）<br />
          3、可输入多个商品的链接，回车分隔或连续输入都可以<br />
			（如：https://item.taobao.com/item.htm?id=19474502166 https://item.taobao.com/item.htm?id=35499459595）<br />
          </div>
        <tr>
          <th width="150"><div>
            批量商品ID：</th>
          <td><textarea name="content" cols="80" rows="4" wrap="VIRTUAL" onclick="select();"></textarea>
            <span   style="color:#FF0000">&nbsp;<br />
            （输入多个ID，用逗号或回车隔开，或多个商品链接）</span> </td>
        </tr>
        <tr>
          <th>采集评论：</th>
          <td><input name="checkbox" type="checkbox" value="1" <?php if ($this->_var['user_setting']['ratetag']): ?> checked="checked" <?php endif; ?> />
            <span>&nbsp;(评论为10~50间的随机数)</span> </td>
        </tr>
        <tr>
          <th>放到产品分类：</th>
          <td><select name="cat_id">
              <option value="0">产品分类</option>
              
              
              <?php echo $this->_var['cat_list']; ?>
            
            
            </select>
            <span>&nbsp;(产品分类，默认为第一个类别)</span> </td>
        </tr>
		<?php if ($this->_var['is_sup'] == 'supplier'): ?>
		<tr>
          <th>放到店内分类：</th>
          <td><select name="seller_cat_id">
              <option value="0">店内分类</option>
              <?php echo $this->_var['seller_cat_list']; ?>
            
            </select>
            <span>&nbsp;(入驻商店内分类，默认为第一个类别，必选)</span> </td>
        </tr>
		<?php endif; ?>
        <tr>
          <th>放到属性类型：</th>
          <td><select name="goods_type_id">
              
					    <?php $_from = $this->_var['goods_type_arr']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'goods_type');if (count($_from)):
    foreach ($_from AS $this->_var['goods_type']):
?>
						
              <option value="<?php echo $this->_var['goods_type']['cat_id']; ?>" <?php if ($this->_var['goods_type_id'] == $this->_var['goods_type']['cat_id']): ?> selected="selected"<?php endif; ?>><?php echo $this->_var['goods_type']['cat_name']; ?></option>
              
					    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>

					
            </select>
            <span>&nbsp;(选择商品属性的类型，自动采集商品属性放入此类型中，默认类型：采集属性)</span> </td>
        </tr>
		<?php if ($this->_var['supplier_list'] && $this->_var['is_sup'] != 'supplier'): ?>
		<tr>
          <th>分配入驻商：</th>
          <td>
		  <select name="supplier_id" id="supplier_id" onchange="changed_sup()">
			<option value="">请选择入驻商</option>
			<?php $_from = $this->_var['supplier_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'sl');$this->_foreach['sln'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['sln']['total'] > 0):
    foreach ($_from AS $this->_var['sl']):
        $this->_foreach['sln']['iteration']++;
?>
			  <option value="<?php echo $this->_var['sl']['supplier_id']; ?>"><?php echo $this->_var['sl']['supplier_name']; ?></option>
			<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
		  </select>
		  <select name="sup_cat_id" id="sup_cat_id">
              <?php echo $this->_var['cat_list_sup']; ?>
            </select>
            <span>&nbsp;(入驻商店内分类，默认为第一个类别)</span> </td>
        </tr>
		<?php endif; ?>
		<?php if ($this->_var['priv_ru'] == 1): ?>
		<tr>
          <th>商家品牌：</th>
          <td>
            <input style="display:none" name="search_brand" type="button" id="search_brand" value=" 搜索 " class="button" onclick="searchBrand()">
            <select name="mbt_brand_id" id="mbt_brand_id" onchange="hideBrandDiv()" >
              <?php echo $this->html_options(array('options'=>$this->_var['mbt_brand_id_list'],'selected'=>$this->_var['user_setting']['mbt_brand_id'])); ?>
            </select>
          </td>
        </tr>
		<?php endif; ?>
        <tr class="act">
          <th>&nbsp;</th>
          <td>&nbsp;</td>
        </tr>
        <tr class="act">
          <th>&nbsp;</th>
          <td><div id="caij_btns" style="width:100%;"> <a class="caiji" href="javascript:colltaobao();" >立即采集</a> </div></td>
        </tr>
      </table>
    </form>
  </div>
</div>
<script type="text/javascript">
function colltaobao()
{
 	document.getElementById('caij_btns').innerHTML = '正在采集：<img src="https://img.alicdn.com/imgextra/i1/619666972/TB2PCZjjVXXXXXxXpXXXXXXXXXX-619666972.gif" />';
	var targetForm = document.forms[ "theForm" ];
	targetForm.submit();
}
function changed_sup()
{
	supplier_id=document.forms['theForm'].elements['supplier_id'].value;
	if(supplier_id=='')
	{
		alert('请选择入驻商！');
		return false;
	}
	Ajax.call('shops.php?is_ajax=1&act=changed_sup', "supplier_id="+supplier_id, changed_supResponse, "GET", "JSON");
}
function changed_supResponse(result)
{
	  document.forms[ "theForm" ].elements['sup_cat_id'].innerHTML=result.content.cat_list_sup
}
</script>
<?php echo $this->fetch('pagefooter.htm'); ?> 