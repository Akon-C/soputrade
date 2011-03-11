<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php echo Meta($pagetitle,$pagekeywords,$pagedesc,$list);?>

<Link href="../Public/images/reset.css" type="text/css" rel="stylesheet" />
<Link href="../Public/images/style.css" type="text/css" rel="stylesheet" />
<Link href="../Public/images/floatmenu.css" type="text/css" rel="stylesheet" />


<script type="text/javascript" src="../Public/Js/jquery.js"></script> 
<script type="text/javascript" src="../Public/Js/bigimg.js"></script> 
<script type="text/javascript" src="../Public/images/floatmenu.js"></script> 
</head>


<body>



  <div id="page">
    <div id="header">
      <div class="logo"><a href="__APP__"><img src="__ROOT__/<?php echo GetSettValue('sitelogo');?>" alt="" width="360" border="0" /></a></div>
      <div class="top">
        <div class="top_nav">
          <div class="top3"><a href="__APP__/Help/">Help</a></div>
          <div class="top2"><a href="<?php echo U('Member-Index/index');?>">User Center</a></div>
          <div class="top1"><a href="<?php echo U('Cart/disp');?>">Shopping Cart</a></div>
        </div>
        <div class="nav">
          <table width="590" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="485" align="right">
      <div class="nav1">
            <ul>
              <li><a href="__APP__" class="click" style="color:#FFFFFF">Home</a></li>
              <li><a href="__APP__/About-Us/">About Us</a></li>
              <li><a href="<?php echo U('Pro/index');?>">Products</a></li>
              <li><a href="__APP__/Contact-Us/">Contact Us</a></li>
              <li><a href="<?php echo U('Member-Index/index');?>">User Center</a></li>
            </ul>
          </div>
    </td>
    <td width="105" align="left">
      <div class="nav2">
            <a href="<?php echo build_url('hotmail','hotmail');?>"><img src="../Public/images/message.gif" alt="" border="0" /></a>
          </div>
    </td>
  </tr>
</table>
          
          
        </div>
      </div>
      <div class="search">
        <div class="search1">
          <div class="find">
           <form action="<?php echo U('Search/index');?>" method="POST">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="370" align="left">
      <input name="key" type="text" id="keyword" value="" />
    </td>
    <td width="185">
     <select name="cateid" id="category">
  <option value="">All Category</option>
    <?php if(is_array($catetree)): $i = 0; $__LIST__ = $catetree;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): ++$i;$mod = ($i % 2 )?><option value="<?php echo ($vo['id']); ?>"><?php echo class_str_insert($vo['deep'],"&nbsp;&nbsp;&nbsp;");?><?php echo ($vo["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
</select>
    </td>
    <td>
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="35">
    <input name="search" type="image" value="go" style="width:35px;" src="../Public/images/go1.gif" />
    </td>
    <td style="padding-left:5px;" align="left"><!--<a href="#">Advanced</a>--></td>
  </tr>
</table>
</form>
       
    </td>
  </tr>
</table>
          </div>
          <div class="cart">
            <a href="<?php echo U('Cart/disp');?>"><?php echo itemCount();?> products</a>
          </div>
        </div>
        <div class="search2">
          <strong>Hot search:</strong>
          <?php if(is_array($HotClass)): $i = 0; $__LIST__ = $HotClass;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): ++$i;$mod = ($i % 2 )?><?php if(($i)  >  "1"): ?>,<?php endif; ?>
          <a href="<?php echo build_url($vo,'cate_url');?>"><?php echo build_url($vo,'cate_name');?></a><?php endforeach; endif; else: echo "" ;endif; ?>
        </div>
      </div>
    </div>

 <div id="pagebody">
      <div class="col1">
        <div class="menu">
          <div class="menu_title">Browse by Category</div>
          <div class="menu_content">
           <ul class="sf-menu sf-vertical sf-js-enabled sf-shadow" >
  <?php if(is_array($catetree)): $i = 0; $__LIST__ = $catetree;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): ++$i;$mod = ($i % 2 )?><?php if(($vo['subcount'])  >  "0"): ?><li> <a href="<?php echo build_url($vo,'cate_url');?>"><?php echo build_url($vo,'cate_name');?></a>
        <ul style="display: none; visibility: hidden;">
          <?php if(is_array($vo['sub'])): $i = 0; $__LIST__ = $vo['sub'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$subvo): ++$i;$mod = ($i % 2 )?><?php if(($subvo['subcount'])  ==  "0"): ?><li> <a href="<?php echo build_url($subvo,'cate_url');?>"><?php echo build_url($subvo,'cate_name');?></a> </li><?php endif; ?>
            <?php if(($subvo['subcount'])  >  "0"): ?><li> <a href="<?php echo build_url($subvo,'cate_url');?>" class="sf-with-ul"><?php echo build_url($subvo,'cate_name');?></a>
                <ul style="display: none; visibility: hidden;">
                  <?php if(is_array($subvo['sub'])): $i = 0; $__LIST__ = $subvo['sub'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$subvo2): ++$i;$mod = ($i % 2 )?><li><a href="<?php echo build_url($subvo2,'cate_url');?>"><?php echo build_url($subvo2,'cate_name');?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
                </ul>
              </li><?php endif; ?><?php endforeach; endif; else: echo "" ;endif; ?>
        </ul>
      </li><?php endif; ?>
    <?php if(($vo['subcount'])  ==  "0"): ?><li> <a href="<?php echo build_url($vo,'cate_url');?>"><?php echo build_url($vo,'cate_name');?></a> </li><?php endif; ?><?php endforeach; endif; else: echo "" ;endif; ?>
</ul>

           <!-- <ul>
            <?php if(is_array($catetree)): $i = 0; $__LIST__ = $catetree;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): ++$i;$mod = ($i % 2 )?><li><a href="<?php echo build_url($vo,'cate_url');?>"><?php echo build_url($vo,'cate_name');?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
            </ul>-->
          </div>
        </div>
       <!-- <div class="menu1">
          <div class="menu1_title">Email Subscribe</div>
          <div class="menu1_content">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="30"><input name="" type="text" style="width:150px;" /></td>
  </tr>
  <tr>
    <td><input name="submit" type="image" src="../Public/images/submit.gif" /> &nbsp;<input name="cancel" type="image" src="../Public/images/cancel.gif" /></td>
  </tr>
</table> 
          </div>
          <div class="menu1_bottom"><img src="../Public/images/menu_bottom.gif" alt="" height="8" /></div>
        </div>-->
        <div class="menu1">
          <div class="menu1_title">Tags</div>
          <div class="menu1_content">
            <MARQUEE behavior= "scroll" align= "center" direction= "up" height="100" scrollamount= "2" scrolldelay= "70" onmouseover='this.stop()' onmouseout='this.start()'>
            <?php if(is_array($News)): $i = 0; $__LIST__ = $News;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): ++$i;$mod = ($i % 2 )?><a href="<?php echo U('Article/index',array('id'=>$vo['article_id']));?>"><?php echo ($vo["article_title"]); ?></a><br/><?php endforeach; endif; else: echo "" ;endif; ?>
            </MARQUEE>
          </div>
          <div class="menu1_bottom"><img src="../Public/images/menu_bottom.gif" alt="" height="8" /></div>
        </div>
        
         <div class="menu1">
          <div class="menu1_title">Broswer History</div>
          <div class="menu1_content">
           
            <?php if(is_array($product_history)): $i = 0; $__LIST__ = $product_history;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): ++$i;$mod = ($i % 2 )?><div class="list_pro0">
              <div class="list_pro_img"><a href="<?php echo build_url($vo,'pro_url');?>" altimg="<?php echo build_url($vo,'pro_bigimage');?>" title="<?php echo build_url($vo,'pro_name');?>"><a href="<?php echo build_url($vo,'pro_url');?>" altimg="<?php echo build_url($vo,'pro_bigimage');?>" title="<?php echo build_url($vo,'pro_name');?>"><img src="<?php echo build_url($vo,'pro_smallimage');?>" alt="<?php echo build_url($vo,'pro_name');?>" width="150" height="115" border="0" /></a></a></div>
              <div class="list_pro_name"><a href="<?php echo build_url($vo,'pro_url');?>"><?php echo build_url($vo,'pro_name');?></a></div>
              <div class="list_pro_pri">price:<?php echo build_url($vo,'pro_price');?></div>
              <div class="list_pro_button"><a href="<?php echo build_url($vo,'pro_url');?>"><img src="../Public/images/add-to-cart.gif" alt="" border="0" /></a></div>
            </div><?php endforeach; endif; else: echo "" ;endif; ?>
          </div>
          <div class="menu1_bottom"><img src="../Public/images/menu_bottom.gif" alt="" height="8" /></div>
        </div>
      </div>

       

<div class="col2">
  <div class="mainbody">
   <div class="barner">
          
        <!--默认参数字符串

0xffffff：文字颜色| 2：文字位置| 0xff6600：文字背景颜色| 60：文字背景透明度| 0xffffff：按键文字颜色| 0xff6600：按键默认颜色| 0x000033：按键当前颜色| 8：自动播放时间(秒)| 2：图片过渡效果| 1：是否显示按钮| _blank：打开新窗口

颜色都以0x开始16进制数字表示

文字颜色：题目文字的颜色
文字位置：0表示题目文字在顶端，1表示文字在底部，2表示文字在顶端
文字背景透明度：0-100值，0表示全部透明
按键文字颜色：按键数字颜色
按键默认颜色：按键默认的颜色
按键当前颜色：当前图片按键颜色
自动播放时间：单位是秒
图片过渡效果：0，表示亮度过渡，1表示透明度过渡，2表示模糊过渡，3表示运动模糊过渡
是否显示按钮：0，表示隐藏按键部分，更适合做广告挑轮换
打开窗口：_blank表示新窗口打开。_self表示在当前窗口打开
"0xffffff:文字颜色|1:文字位置|0x0066ff:文字背景颜色|60:文字背景透明度|0xffffff:按键文字颜色|0x0066ff:按键默认颜色|0x000033:按键当前颜色|8:自动播放时间(秒)|2:图片过渡效果|1:是否显示按钮|_blank:打开窗口";
-->
<div>
<script type="text/javascript">
var swf_width=523;
var swf_height=120;
var files="<?php echo ($flashpic); ?>";
var links='<?php echo ($flashlink); ?>';
var texts='<?php echo ($flashremark); ?>';
var bcastr_config='0xffffff|2|0x0066ff|60|0xffffff|0x0066ff|0x000033|8|2|0|_blank';

document.write('<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0" width="'+ swf_width +'" height="'+ swf_height +'">');
document.write('<param name="movie" value="../Public/images/bcastr3.swf"><param name="quality" value="high">');
document.write('<param name="menu" value="false"><param name=wmode value="opaque">');
document.write('<param name="FlashVars" value="bcastr_file='+files+'&bcastr_link='+links+'&bcastr_title='+texts+'&bcastr_config='+bcastr_config+'">');
document.write('<embed src="../Public/images/bcastr3.swf" wmode="opaque" FlashVars="bcastr_file='+files+'&bcastr_link='+links+'&bcastr_title='+texts+'&bcastr_config='+bcastr_config+'& menu="false" quality="high" width="'+ swf_width +'" height="'+ swf_height +'" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />');
document.write('</object>'); 
</script>
</div>
        </div>
        <div class="list">
          <div class="list_title">New Arrival Items</div>
          <div class="list_content">
          
          
          <?php if(is_array($NewPorducts)): $i = 0; $__LIST__ = $NewPorducts;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): ++$i;$mod = ($i % 2 )?><div class="pro">
              <div class="pro_img"><a href="<?php echo build_url($vo,'pro_url');?>" altimg="<?php echo build_url($vo,'pro_bigimage');?>" title="<?php echo build_url($vo,'pro_name');?>"><img src="<?php echo build_url($vo,'pro_smallimage');?>" alt="<?php echo build_url($vo,'pro_name');?>"  width="150" height="115" border="0" /></a></div>
              <div class="pro_name"><a href="<?php echo build_url($vo,'pro_url');?>"><?php echo build_url($vo,'pro_name');?></a></div>
              <div class="pro_pri"><span><?php echo build_url($vo,'pro_price');?></span></div>
              <div class="pro_cate">
                <a href="<?php echo U('Pro/new');?>">More Wholesale »</a>
              </div>
            </div><?php endforeach; endif; else: echo "" ;endif; ?>
            
            
            
          </div>
          <div class="list_bottom"><img src="../Public/images/list_bottom.gif" alt="" /></div>
        </div>
        <div class="list">
          <div class="list_title">Hot Sales Items</div>
          <div class="list_content">
            <?php if(is_array($HotPorducts)): $i = 0; $__LIST__ = $HotPorducts;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): ++$i;$mod = ($i % 2 )?><div class="pro">
              <div class="pro_img"><a href="<?php echo build_url($vo,'pro_url');?>" altimg="<?php echo build_url($vo,'pro_bigimage');?>" title="<?php echo build_url($vo,'pro_name');?>"><img src="<?php echo build_url($vo,'pro_smallimage');?>" alt="<?php echo build_url($vo,'pro_name');?>"  width="150" height="115" border="0" /></a></div>
              <div class="pro_name"><a href="<?php echo build_url($vo,'pro_url');?>"><?php echo build_url($vo,'pro_name');?></a></div>
              <div class="pro_pri"><span><?php echo build_url($vo,'pro_price');?></span></div>
              <div class="pro_cate">
                <a href="<?php echo U('Pro/hot');?>">More Wholesale »</a>
              </div>
            </div><?php endforeach; endif; else: echo "" ;endif; ?>
          </div>
          <div class="list_bottom"><img src="../Public/images/list_bottom.gif" alt="" /></div>
        </div> 
  </div>
  <script language="JavaScript" type="text/javascript">
	function check_memberlogin(){
		var string='';
		with(document.index_dologin){
			if(email.value==''){
				string+="email require!\r\n";
			}
			if(password.value==''){
				string+="password require!\r\n";
			}
		}
		if(string){
			alert(string);return false;
		}
	}
</script>


<div class="col3">
        <div class="login">
          <div class="login_title"><strong>Login</strong></div>
          <div class="login_content">
          <?php if(($mid)  >  "0"): ?>Welcome <?php echo ($member_Info['lastname']); ?> <?php echo ($member_Info['firstname']); ?>,<a alt="" href="<?php echo U('Member-Index/index');?>">My Account</a> <a href="<?php echo U('Member-Index/LogOut');?>">LogOut</a>
          
  <?php else: ?>
  <form method="POST" name="index_dologin" action="<?php echo U('Member-Public/doLogin');?>" >
       <table width="100%" border="0" align="left" cellpadding="0" cellspacing="2">
      <tr>
            <td align="right">User Name: </td>
            <td><input name="email" type="text"  size="10" style="width:100px; margin-left:5px;" /></td>
          </tr>
          <tr>
            <td align="right">Password: </td>
            <td>
            <input name="password" type="password" size="10" style="width:100px; margin-left:5px;" />            </td>
          </tr>
                    <tr>
            <td colspan="2" align="center">
            <input type="image" name="imageField2" src="../Public/images/signButton.gif" tabindex="4" onclick="return check_memberlogin();" />
            <a href="<?php echo U('Member-Public/Join');?>"><img src="../Public/images/JoinButton.gif" alt="Join Free" border="0" ></a> </td>
          </tr>
      </table>
  </form><?php endif; ?>
          </div>
          <div class="login_bottom"><img src="../Public/images/login_bottom.gif" alt="" /></div>
        </div>
        <div class="buyer">
          <strong>Buyer Guide</strong>
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td style="padding-left:5px;padding-top:5px;"><strong>Got a Question?</strong></td>
  </tr>
  <tr>
    <td style="padding-left:5px;"><a href="<?php echo build_url('hotmail','hotmail');?>"><img src="../Public/images/guidebottom.gif" alt="" border="0" /></a></td>
  </tr>
</table>
        </div>
        <div class="login">
          <div class="login_title"><strong>Top 10 Bestsellers</strong></div>
          <div class="login_content">
          <?php if(is_array($toptenviews)): $i = 0; $__LIST__ = $toptenviews;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): ++$i;$mod = ($i % 2 )?><div class="r_pro">
              <div class="r_pro_img"><a href="<?php echo build_url($vo,'pro_url');?>" altimg="<?php echo build_url($vo,'pro_bigimage');?>" title="<?php echo build_url($vo,'pro_name');?>"><img src="<?php echo build_url($vo,'pro_smallimage');?>" border="0" width="70" alt="<?php echo build_url($vo,'pro_name');?>" /></a></div>
              <div class="r_pro_name"><a href="<?php echo build_url($vo,'pro_url');?>"><?php echo build_url($vo,'pro_name');?></a></div>
              <div class="r_pro_pri">price:<?php echo build_url($vo,'pro_price');?></div>
            </div><?php endforeach; endif; else: echo "" ;endif; ?>
            
          </div>
          <div class="login_bottom"><img src="../Public/images/login_bottom.gif" alt="" /></div>
        </div>
      </div>


 <div class="col4">
        <div class="midd_list">
          <div class="midd_list_title">Special Offers</div>
          <div class="midd_list_content">
          <?php if(is_array($SpePorducts)): $i = 0; $__LIST__ = $SpePorducts;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): ++$i;$mod = ($i % 2 )?><div class="mpro">
              <div class="mpro_img"><a href="<?php echo build_url($vo,'pro_url');?>" altimg="<?php echo build_url($vo,'pro_bigimage');?>" title="<?php echo build_url($vo,'pro_name');?>"><img src="<?php echo build_url($vo,'pro_smallimage');?>" alt="<?php echo build_url($vo,'pro_name');?>" border="0" width="120" height="90" /></a></div>
              <div class="mpro_name"><a href="<?php echo build_url($vo,'pro_url');?>"><?php echo build_url($vo,'pro_name');?></a></div>
              <div class="mpro_pri"><?php echo build_url($vo,'pro_price');?></div>
            </div><?php endforeach; endif; else: echo "" ;endif; ?>
          </div>
          <div class="midd_list_bottom"><img src="../Public/images/middle_bottom.gif" alt="" /></div>
        </div>
      </div>      
      </div>




    </div>
      <div id="footer">
      <div class="page_search">
      
        <form action="<?php echo U('Search/index');?>" method="POST" name="bottom_search">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="60">
    <strong>Search</strong>
    </td>
    <td width="180" style="padding-right:10px;"> <select name="cateid" style="width:180px;">
  <option value="">All Category</option>
    <?php if(is_array($catetree)): $i = 0; $__LIST__ = $catetree;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): ++$i;$mod = ($i % 2 )?><option value="<?php echo ($vo['id']); ?>"><?php echo class_str_insert($vo['deep'],"&nbsp;&nbsp;&nbsp;");?><?php echo ($vo["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
</select>
</td>
    <td width="360" align="left" style="padding-right:10px;"><input name="key" type="text" value="" class="" style="width:360px; margin-left:10px;"/></td>
    <td><a href="#" onclick="bottom_search();"><img src="../Public/images/search_go.gif" alt="" border="0" /></a></td>
  </tr>
</table>
     </form>
      </div>
      <div class="footer_page">
        <div class="footer1"><img src="../Public/images/footer3.gif" alt="" /></div>
        <div class="footer2">
        <?php echo ($wholesale_text); ?> 
        </div>
        <div class="footer3"><img src="../Public/images/footer1.gif" alt="" /></div>
      </div>

  <div class="bottom_nav">
        <img src="../Public/images/ebay.gif" alt="" border="0" usemap="#Map" />
<map name="Map" id="Map"><area shape="rect" coords="2,7,41,30" href="#" /><area shape="rect" coords="47,6,85,31" href="#" /><area shape="rect" coords="93,7,130,30" href="#" /><area shape="rect" coords="138,7,176,30" href="#" /><area shape="rect" coords="186,7,260,29" href="#" /><area shape="rect" coords="264,3,319,34" href="#" /><area shape="rect" coords="328,7,410,29" href="#" /><area shape="rect" coords="417,7,438,29" href="#" /><area shape="rect" coords="446,8,514,31" href="#" /><area shape="rect" coords="520,5,581,34" href="#" /><area shape="rect" coords="587,7,637,31" href="#" /></map>
      </div>
      <div class="copyright"><?php echo ($Footer); ?><?php echo ($footcode); ?></div>
    </div>
  </div>
  
<?php if(GetSettValue('365webcall_status') == 1): ?><?php echo ($_365call); ?>
  <script type='text/javascript' src='http://p.365webcall.com/IMMeForPartner.aspx?email=<?php echo GetSettValue('365webcall_email');?>&accountid=<?php echo GetSettValue('365webcall_accountid');?>&LL=1'></script><?php endif; ?>
</body>
</html>