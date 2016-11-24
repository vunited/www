<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="Keywords" content="<?php echo $this->_var['keywords']; ?>" />
<meta name="Description" content="<?php echo $this->_var['description']; ?>" />

<title><?php echo $this->_var['page_title']; ?></title>



<link rel="shortcut icon" href="favicon.ico" />
<link rel="icon" href="animated_favicon.gif" type="image/gif" />
<link rel="alternate" type="application/rss+xml" title="RSS|<?php echo $this->_var['page_title']; ?>" href="<?php echo $this->_var['feed_url']; ?>" />
<link rel="stylesheet" href="css/zyit.css" />
<link rel="stylesheet" href="css/style.css" />
<link rel="stylesheet" href="css/js.css" />
<link rel="stylesheet" href="fonts/font-awesome.min.css">
<link href="themes/default/css/zyit.css" rel="stylesheet" type="text/css"  charset="utf-8"> 
</head>
<body>
<script language="javascript">
	function form_order(order){
		listform.sort.value = order;
		listform.order.value = "<?php if ($this->_var['pager']['search']['order'] == 'DESC'): ?>ASC<?php else: ?>DESC<?php endif; ?>";
		listform.submit();
	}
	</script>
<?php echo $this->fetch('library/page_header.lbi'); ?>


    <script type="text/javascript">  


function $(o){ //获取对象
 if(typeof(o) == "string")
 return document.getElementById(o);
 return o;
}


function check(theForm){
		if(theForm.name.value == ""){
			alert("姓名不可为空!"); 
			return false;
		}
		if(theForm.tel.value == ""){
			alert("联系电话不可为空!");
			return false;
		}		
		theform.submit();
	}

  </script>


    
   
      <div class="content">
         <div class="container">
            <div class="local">您的当前位置 > <a href="index.php">首页</a> > <span>本地导购</span></div>
            <div class="title5"><span class="p6">店铺详细</span></div>
         </div>
         <div class="clear"></div><div class="clear"></div>
         
            <div class="container">
               
                <div class="content-l" style="background:#CCC">
                   <iframe height="100%" src="show.html#center=<?php echo $this->_var['brand']['position']; ?>&zoom=14&width=593&height=432&markers=<?php echo $this->_var['brand']['position']; ?>&markerStyles=l,A" frameborder="0" width="100%"></iframe>
                </div>
              
              
                <div class="content-r">
                   <div class="title6"><?php echo $this->_var['brand']['suppliers_name']; ?></div>
                   <div class="contact">
                      <p>店铺地址：<?php echo $this->_var['brand']['address']; ?></p>
                      <p>咨询电话：<?php echo $this->_var['brand']['tel']; ?></p>
                   </div>
                   <div class="arc">
                      <b>店铺详情</b>
                      <?php echo $this->_var['brand']['suppliers_desc']; ?>
                   </div>
                </div>
               
              <div class="clear"></div><div class="clear"></div><div class="clear"></div>
                 <div class="title7"><span>线下体验</span></div>  
            </div>
			
         
      </div>
         
         <form onSubmit="javascript:return check(formUser);" action="xx.php?act=add" method="post" name="formUser">
            <div class="container">
               <div class="clear"></div><div class="clear"></div>
                  <table width="705" border="0" cellspacing="0" cellpadding="0" class="form1">
                    <tr>
                      <td width="90" height="60"><b>姓&emsp;&emsp;名</b>：</td>
                      <td width="615"><input type="text" name="name" id="name" class="text1"/></td>
                    </tr>
                    <tr>
                      <td width="90" height="60"><b>性&emsp;&emsp;别</b>：</td>
                      <td width="615"><input name="sex" type="radio" value="1"  checked="checked"/>&ensp;先生&emsp;&emsp;<input name="sex" type="radio" value="2"/>&ensp;女士</td>
                    </tr>
                    <tr>
                      <td width="90" height="60"><b>联系电话</b>：</td>
                      <td width="615"><input type="text" name="tel" id="tel" class="text1"/></td>
                    </tr>
                    <tr>
                      <td width="90" height="60"><b>到店时间</b>：</td>
                      <td width="615">
                         <select name="fw_time1" class="text2" id="fw_time1"><option value="2016">2016</option></select>年
                         <select name="fw_time2" class="text3" id="fw_time2">
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
                  <option value="5">5</option>
                  <option value="6">6</option>
                  <option value="7">7</option>
                  <option value="8">8</option>
                  <option value="9">9</option>
                  <option value="10">10</option>
                  <option value="11">11</option>
                  <option value="12">12</option></select>月
                         <select name="fw_time3" class="text4" id="fw_time3">
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
                  <option value="5">5</option>
                  <option value="6">6</option>
                  <option value="7">7</option>
                  <option value="8">8</option>
                  <option value="9">9</option>
                  <option value="10">10</option>
                  <option value="11">11</option>
                  <option value="12">12</option>
                  <option value="13">13</option>
                  <option value="14">14</option>
                  <option value="15">15</option>
                  <option value="16">16</option>
                  <option value="17">17</option>
                  <option value="18">18</option>
                  <option value="19">19</option>
                  <option value="20">20</option>
                  <option value="21">21</option>
                  <option value="22">22</option>
                  <option value="23">23</option>
                  <option value="24">24</option>
                  <option value="25">25</option>
                  <option value="26">26</option>
                  <option value="27">27</option>
                  <option value="28">28</option>
                  <option value="29">29</option>
                  <option value="30">30</option>
                  <option value="31">31</option></select>日
                         <select name="fw_time4" class="text5" id="fw_time4">
                  <option value="08:00">08:00</option>
                  <option value="09:00">09:00</option>
                  <option value="10:00">10:00</option>
                  <option value="11:00">11:00</option>
                  <option value="12:00">12:00</option>
                  <option value="13:00">13:00</option>
                  <option value="14:00">14:00</option>
                  <option value="15:00">15:00</option>
                  <option value="16:00">16:00</option></select>
                         <select name="fw_time5" class="text6" id="fw_time5">
                  <option value="09:00">09:00</option>
                  <option value="10:00">10:00</option>
                  <option value="11:00">11:00</option>
                  <option value="12:00">12:00</option>
                  <option value="13:00">13:00</option>
                  <option value="14:00">14:00</option>
                  <option value="15:00">15:00</option>
                  <option value="16:00">16:00</option>
                  <option value="17:00">17:00</option></select>
                      </td>
                    </tr>
                    <tr>
                      <td width="90" height="90"></td>
                      <td width="615" valign="bottom"><input type="submit" class="btn4" value="" /><input name="store" type="hidden" id="store" value="<?php echo $this->_var['store']; ?>"></td>
                    </tr>
                  </table>
               <div class="clear"></div><div class="clear"></div>
            </div>
         </form>
         
   


<?php echo $this->fetch('library/page_footer.lbi'); ?>

</body>
</html>