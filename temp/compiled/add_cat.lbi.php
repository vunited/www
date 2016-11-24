<div id="shopbox" class="shopbox fixed-middle" style="top:300px;opacity:0;display:none;">
<div class="shopboxcon">
<div id="shoploading" style="display: none;">
<img alt="loading" src="themes/default/images/loading.gif">
</div>
<div>
<h2>
<a class="track close" name="item-close-cart" href="javascript:;" onclick="catbox_hidden('shopbox')">
<img src="themes/default/images/dpbox_06.gif">
<span>关闭</span>
</a>
</h2>
<div class="spboxcontent">
<div class="shopboxdetail">
<div class="spboxleft">
<img src="themes/default/images/DPshopcarIco.gif">
</div>
<div class="spboxright">
<span class="spboxtitle">该商品已成功放入购物车</span>
<span class="blank5"></span>
<p style="font-size:14px">您的购物车中有<span id="ECS_CARTINFO_flow"><?php 
$k = array (
  'name' => 'cart_info',
);
echo $this->_echash . $k['name'] . '|' . serialize($k) . $this->_echash;
?></span>件商品</p>

<span class="blank5"></span>
<p class="spbbtndiv">
<a class="jxgwbtn track" href="javascript:;" onclick="catbox_hidden('shopbox')">&lt;&lt;继续购物</a>
<a class="track" target="_parent" href="flow.php">
<img class="qujiesuan" style="float:right; margin-top:6px" src="themes/default/images/btn-gocart.gif">
</a>
</p>
</div>
<span class="blank15"></span>
</div>
</div>
</div>
</div>
<span class="blank0"> </span>

</div>
  <script language="javascript">

  //******POWERBY 老杨 QQ:359199843******//
function addToCart_choose(goodsId, parentId)
{
  var goods        = new Object();
  var spec_arr     = new Array();
  var fittings_arr = new Array();
  var number       = 1;
  var formBuy      = document.forms['ECS_FORMBUY'];
  var quick		   = 0;

  // 检查是否有商品规格 
  if (formBuy)
  {
    spec_arr = getSelectedAttributes(formBuy);

    if (formBuy.elements['number'])
    {
      number = formBuy.elements['number'].value;
    }
    else{
	    number = $("#quantity").html();

	    
    }
	quick = 1;
  }

  goods.quick    = quick;
  goods.spec     = spec_arr;
  goods.goods_id = goodsId;
  goods.number   = number;
  goods.parent   = (typeof(parentId) == "undefined") ? 0 : parseInt(parentId);

 Ajax.call('flow.php?step=add_to_cart', 'goods=' + goods.toJSONString(), addToCartResponse_choose, 'POST', 'JSON');//官方原模板
 // Ajax.call('flow.php?step=add_to_cart', 'goods=' + objToJSONString(goods), addToCartResponse_choose, 'POST', 'JSON');//有的改了模板机制的！
}
//******POWERBY 老杨 QQ:359199843******//
/* *
 * 处理添加商品到购物车的反馈信息
 */
function addToCartResponse_choose(result)
{
  if (result.error > 0)
  {
    // 如果需要缺货登记，跳转
    if (result.error == 2)
    {
      if (confirm(result.message))
      {
        location.href = 'user.php?act=add_booking&id=' + result.goods_id + '&spec=' + result.product_spec;
      }
    }
    // 没选规格，弹出属性选择框
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
    var cartInfo = document.getElementById('ECS_CARTINFO');
	var cartInfo_flow = document.getElementById('ECS_CARTINFO_flow');
	var cartInfo_flows = document.getElementById('ECS_CARTINFO_flows');
    var cart_url = 'flow.php?step=cart';
    if (cartInfo)
    {
      cartInfo.innerHTML = result.content;
    }
    if (cartInfo_flow)
    {
      cartInfo_flow.innerHTML = result.content;
	  cartInfo_flows.innerHTML = result.content;
    }
    catbox_show('shopbox');
  }
}

function catbox_show(elfm)
{
	var cart_timecount=0;
	var cat_box = document.getElementById(elfm);
	cat_box.style.display='block';
	var aaaa = setInterval(function(){
	cart_timecount=cart_timecount+0.05;
	cat_box.style.opacity=cart_timecount;
	if(cart_timecount>=1)clearInterval(aaaa);
	},10)
}
function catbox_hidden(elfm)
{
	var cart_timecount=1;
	var cat_box = document.getElementById(elfm);
	
	var bbb = setInterval(function(){
	cart_timecount=cart_timecount-0.05;
	cat_box.style.opacity=cart_timecount;
	if(cart_timecount<=0){clearInterval(bbb);
	cat_box.style.display='none';}
	},10)
}
  </script>