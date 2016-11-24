<!-- $Id: goods_info.htm 17126 2010-04-23 10:30:26Z liuhui $ -->

<?php echo $this->fetch('pageheader.htm'); ?>
<link href="styles/nms_style.css" rel="stylesheet" type="text/css" />
<div class="tab-div">
  <div id="tabbody-div" class="tbbg" >
    <form enctype="multipart/form-data" action="shops.php?act=nms_tbk_api_colect" method="post" name="theForm" >
      <table width="90%" id="general-table" >
        <div class="shuoming"> 1、可输入要采集的商品关键词（如：女装）<br />
          2、可输入商品的链接（如：https://item.taobao.com/item.htm?id=19474502166）<br />
          3、如需指定特定条件的商品，可设置“卖家信用”等采集参数，输入采集商品的数量</div>
        <tr>
          <th width="150">采集关键词或商品链接：</th>
          <td><textarea style="display:none" name="keyword2" cols="80" rows="2" wrap="VIRTUAL"></textarea>
            <input type="text" value="<?php echo $this->_var['user_setting']['q']; ?>" class="textinput" name="keyword" onclick="select();" size="40">
            <span  style="color:#FF0000">(必填，关键字或商品链接。)</span> </td>
        </tr>
        <tr>
          <th>数据排序：</th>
          <td><select name="sort">
              <option value="" <?php if ($this->_var['user_setting']['sort'] == ''): ?> selected="selected" <?php endif; ?>>综合排序 </option>
              <option value="tk_rate_des" <?php if ($this->_var['user_setting']['sort'] == 'tk_rate_des'): ?> selected="selected" <?php endif; ?>>佣金比率从高到低 </option>
              <option value="tk_rate_asc" <?php if ($this->_var['user_setting']['sort'] == 'tk_rate_asc'): ?> selected="selected" <?php endif; ?>>佣金比率从低到高 </option>
              <option value="total_sales_des" <?php if ($this->_var['user_setting']['sort'] == 'total_sales_des'): ?> selected="selected" <?php endif; ?>>成交量从高到低 </option>
              <option value="total_sales_asc" <?php if ($this->_var['user_setting']['sort'] == 'total_sales_asc'): ?> selected="selected" <?php endif; ?>>成交量从低到高 </option>
              <option value="tk_total_commi_des" <?php if ($this->_var['user_setting']['sort'] == 'tk_total_commi_des'): ?> selected="selected" <?php endif; ?>>总支出佣金从高到低 </option>
              <option value="tk_total_commi_asc" <?php if ($this->_var['user_setting']['sort'] == 'tk_total_commi_asc'): ?> selected="selected" <?php endif; ?>>总支出佣金从低到高 </option>
              <option value="tk_total_sales_des" <?php if ($this->_var['user_setting']['sort'] == 'tk_total_sales_des'): ?> selected="selected" <?php endif; ?>>累计推广量从高到低 </option>
              <option value="tk_total_sales_asc" <?php if ($this->_var['user_setting']['sort'] == 'tk_total_sales_asc'): ?> selected="selected" <?php endif; ?>>累计推广量 </option>
            </select>
          </td>
        </tr>
        <tr style="display:none">
          <th>卖家信用：</th>
          <td><select name="start_credit" style="width:40">
              <option value=""  <?php if ($this->_var['user_setting']['start_credit'] == ''): ?> selected="selected" <?php endif; ?>>不限 </option>
              <option value="1heart" <?php if ($this->_var['user_setting']['start_credit'] == '1heart'): ?> selected="selected" <?php endif; ?>>一心 </option>
              <option value="2heart" <?php if ($this->_var['user_setting']['start_credit'] == '2heart'): ?> selected="selected" <?php endif; ?>>两心 </option>
              <option value="3heart" <?php if ($this->_var['user_setting']['start_credit'] == '3heart'): ?> selected="selected" <?php endif; ?>>三心 </option>
              <option value="4heart" <?php if ($this->_var['user_setting']['start_credit'] == '4heart'): ?> selected="selected" <?php endif; ?>>四心 </option>
              <option value="5heart" <?php if ($this->_var['user_setting']['start_credit'] == '5heart'): ?> selected="selected" <?php endif; ?>>五心 </option>
              <option value="1diamond" <?php if ($this->_var['user_setting']['start_credit'] == '1diamond'): ?> selected="selected" <?php endif; ?>>一钻 </option>
              <option value="2diamond" <?php if ($this->_var['user_setting']['start_credit'] == '2diamond'): ?> selected="selected" <?php endif; ?>>两钻 </option>
              <option value="3diamond" <?php if ($this->_var['user_setting']['start_credit'] == '3diamond'): ?> selected="selected" <?php endif; ?>>三钻 </option>
              <option value="4diamond" <?php if ($this->_var['user_setting']['start_credit'] == '4diamond'): ?> selected="selected" <?php endif; ?>>四钻 </option>
              <option value="5diamond" <?php if ($this->_var['user_setting']['start_credit'] == '5diamond'): ?> selected="selected" <?php endif; ?>>五钻 </option>
              <option value="1crown" <?php if ($this->_var['user_setting']['start_credit'] == '1crown'): ?> selected="selected" <?php endif; ?>>一冠 </option>
              <option value="2crown" <?php if ($this->_var['user_setting']['start_credit'] == '2crown'): ?> selected="selected" <?php endif; ?>>两冠 </option>
              <option value="3crown" <?php if ($this->_var['user_setting']['start_credit'] == '3crown'): ?> selected="selected" <?php endif; ?>>三冠 </option>
              <option value="4crown" <?php if ($this->_var['user_setting']['start_credit'] == '4crown'): ?> selected="selected" <?php endif; ?>>四冠 </option>
              <option value="5crown" <?php if ($this->_var['user_setting']['start_credit'] == '5crown'): ?> selected="selected" <?php endif; ?>>五冠 </option>
              <option value="1goldencrown" <?php if ($this->_var['user_setting']['start_credit'] == '1goldencrown'): ?> selected="selected" <?php endif; ?>>一皇冠 </option>
              <option value="2goldencrown" <?php if ($this->_var['user_setting']['start_credit'] == '2goldencrown'): ?> selected="selected" <?php endif; ?>>二皇冠 </option>
              <option value="3goldencrown" <?php if ($this->_var['user_setting']['start_credit'] == '3goldencrown'): ?> selected="selected" <?php endif; ?>>三皇冠 </option>
              <option value="4goldencrown" <?php if ($this->_var['user_setting']['start_credit'] == '4goldencrown'): ?> selected="selected" <?php endif; ?>>四皇冠 </option>
              <option value="5goldencrown" <?php if ($this->_var['user_setting']['start_credit'] == '5goldencrown'): ?> selected="selected" <?php endif; ?>>五皇冠 </option>
            </select>
            -
            <select name="end_credit" style="width:40">
              <option value=""  <?php if ($this->_var['user_setting']['end_credit'] == ''): ?> selected="selected" <?php endif; ?>>不限 </option>
              <option value="1heart" <?php if ($this->_var['user_setting']['end_credit'] == '1heart'): ?> selected="selected" <?php endif; ?>>一心 </option>
              <option value="2heart" <?php if ($this->_var['user_setting']['end_credit'] == '2heart'): ?> selected="selected" <?php endif; ?>>两心 </option>
              <option value="3heart" <?php if ($this->_var['user_setting']['end_credit'] == '3heart'): ?> selected="selected" <?php endif; ?>>三心 </option>
              <option value="4heart" <?php if ($this->_var['user_setting']['end_credit'] == '4heart'): ?> selected="selected" <?php endif; ?>>四心 </option>
              <option value="5heart" <?php if ($this->_var['user_setting']['end_credit'] == '5heart'): ?> selected="selected" <?php endif; ?>>五心 </option>
              <option value="1diamond" <?php if ($this->_var['user_setting']['end_credit'] == '1diamond'): ?> selected="selected" <?php endif; ?>>一钻 </option>
              <option value="2diamond" <?php if ($this->_var['user_setting']['end_credit'] == '2diamond'): ?> selected="selected" <?php endif; ?>>两钻 </option>
              <option value="3diamond" <?php if ($this->_var['user_setting']['end_credit'] == '3diamond'): ?> selected="selected" <?php endif; ?>>三钻 </option>
              <option value="4diamond" <?php if ($this->_var['user_setting']['end_credit'] == '4diamond'): ?> selected="selected" <?php endif; ?>>四钻 </option>
              <option value="5diamond" <?php if ($this->_var['user_setting']['end_credit'] == '5diamond'): ?> selected="selected" <?php endif; ?>>五钻 </option>
              <option value="1crown" <?php if ($this->_var['user_setting']['end_credit'] == '1crown'): ?> selected="selected" <?php endif; ?>>一冠 </option>
              <option value="2crown" <?php if ($this->_var['user_setting']['end_credit'] == '2crown'): ?> selected="selected" <?php endif; ?>>两冠 </option>
              <option value="3crown" <?php if ($this->_var['user_setting']['end_credit'] == '3crown'): ?> selected="selected" <?php endif; ?>>三冠 </option>
              <option value="4crown" <?php if ($this->_var['user_setting']['end_credit'] == '4crown'): ?> selected="selected" <?php endif; ?>>四冠 </option>
              <option value="5crown" <?php if ($this->_var['user_setting']['end_credit'] == '5crown'): ?> selected="selected" <?php endif; ?>>五冠 </option>
              <option value="1goldencrown" <?php if ($this->_var['user_setting']['end_credit'] == '1goldencrown'): ?> selected="selected" <?php endif; ?>>一皇冠 </option>
              <option value="2goldencrown" <?php if ($this->_var['user_setting']['end_credit'] == '2goldencrown'): ?> selected="selected" <?php endif; ?>>二皇冠 </option>
              <option value="3goldencrown" <?php if ($this->_var['user_setting']['end_credit'] == '3goldencrown'): ?> selected="selected" <?php endif; ?>>三皇冠 </option>
              <option value="4goldencrown" <?php if ($this->_var['user_setting']['end_credit'] == '4goldencrown'): ?> selected="selected" <?php endif; ?>>四皇冠 </option>
              <option value="5goldencrown" <?php if ($this->_var['user_setting']['end_credit'] == '5goldencrown'): ?> selected="selected" <?php endif; ?>>五皇冠 </option>
            </select>
          </td>
        </tr>
        <tr>
          <th>价格范围：</th>
          <td><input type="text" value="<?php echo $this->_var['user_setting']['start_price']; ?>" class="textinput" name="start_price" size="10">
            -
            <input type="text" value="<?php echo $this->_var['user_setting']['end_price']; ?>" class="textinput" name="end_price" size="10">
            (元) </td>
        </tr>
        <tr>
          <th>佣金比例：</th>
          <td><input type="text" id="apiParam_start_tk_rate" name="start_tk_rate" value="<?php echo $this->_var['user_setting']['start_tk_rate']; ?>" size="10" >
            -
            <input type="text" id="apiParam_end_tk_rate" name="end_tk_rate" value="<?php echo $this->_var['user_setting']['end_tk_rate']; ?>" size="10">
            (%)</td>
        </tr>
        <tr style="display:none">
          <th>30天累计推广量：</th>
          <td><input type="text" id="apiParam_start_total_sales" name="start_total_sales" value="<?php echo $this->_var['user_setting']['start_total_sales']; ?>" size="10">
            -
            <input type="text" id="apiParam_end_total_sales" name="end_total_sales" value="<?php echo $this->_var['user_setting']['end_total_sales']; ?>" size="10">
            (件) </td>
        </tr>
        <tr style="display:none">
          <th>商品总成交量：</th>
          <td><input type="text" id="apiParam_start_totalnum" name="start_totalnum" value="<?php echo $this->_var['user_setting']['start_totalnum']; ?>" size="10">
            -
            <input type="text" id="apiParam_end_totalnum" name="end_totalnum" value="<?php echo $this->_var['user_setting']['end_totalnum']; ?>" size="10">
            (件) </td>
        </tr>
         <tr>
          <th>采集数量：</th>
          <td><input type="text" value="<?php echo $this->_var['user_setting']['conum']; ?>" class="textinput" name="conum" size="4"></td>
        </tr>
       <tr>
          <th>采集评论：</th>
          <td><input name="checkbox" type="checkbox" value="1" <?php if ($this->_var['user_setting']['ratetag']): ?> checked="checked" <?php endif; ?> />
            <span>&nbsp;(评论为10~50间的随机数)</span> </td>
        </tr>
        <tr style="height:30px; display:none">
          <td align="right" >cid：
            </th>
          <td ><span class="l">
            <input type="text" id="apiParam_cid" name="cid" value="<?php echo $this->_var['user_setting']['cid']; ?>" size="10">
            </span><span class="point-blue">*</span><span class="l"><a href="javascript:void(0);" title="标准商品后台类目id。" class="explain">说明</a></span></td>
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
        <tr>
          <th>天猫商城：</th>
          <td><input name="is_tmall" type="checkbox" value="1" <?php if ($this->_var['user_setting']['is_tmall'] == 'true'): ?> checked="checked" <?php endif; ?>/><span>&nbsp;(只采集天猫商品)</span></td>
        </tr>
        <tr class="act">
          <th>&nbsp;</th>
          <td><input name="itemlist" type="checkbox" value="1" <?php if ($this->_var['user_setting']['itemlist']): ?> checked="checked" <?php endif; ?>/>
            <font color="#FF0000">选择性采集</font></td>
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