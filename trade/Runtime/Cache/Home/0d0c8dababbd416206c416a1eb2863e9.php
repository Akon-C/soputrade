<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" media="screen,projection" type="text/css" href="../Public/css/css.css" /> 
<?php echo Meta($pagetitle,$pagekeywords,$pagedesc,$list);?>
<script type="text/javascript" src="../Public/Js/jquery.js"></script> 
</head>

<body>
<!--bof header--> 
<div class="in_top">
  <div class="left">
     <ul>
       <li class="up"><a href="<?php echo GetSettValue('siteurl');?>"><img src="../Public/images/logo.jpg" width="188" height="44" alt="<?php echo GetSettValue('sitename');?>"/></a> China Wholesale</li>
       <li class="cent">
         <a class="addthis_button" href="http://www.addthis.com/bookmark.php?v=250&amp;username=xyxxshs"><img src="http://s7.addthis.com/static/btn/v2/lg-bookmark-en.gif" width="125" height="16" alt="Bookmark and Share" style="border:0;margin-top:2px"/></a><script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#username=xyxxshs"></script>
       </li>
       <li class="down"><img src="../Public/images/topbg.gif"  alt="China Wholesale"/></li>
     </ul>
  </div>
  <div class="right">
    <dl>
      <dt class="up">
      <?php if(($mid)  >  "0"): ?><a alt="" href="<?php echo U('Member/index');?>">My Account</a><a alt="Log in" href="<?php echo U('Member-Index/LogOut');?>">Log Out
      <?php else: ?>
      <a alt="Log in" href="<?php echo U('Member-Public/Login');?>">Log in</a><a alt="Join Now" href="<?php echo U('Member-Public/Join');?>">Join Now</a><?php endif; ?>
      <a alt="" href="<?php echo U('Help');?>">Support Center</a><a  href="<?php echo U('Home-Cart/disp');?>" title="my cart"><img src="../Public/images/shopping-Cart.jpg" width="98" height="12" style="margin-top:5px"alt=""/></a>
      <p><img src="../Public/images/topline.jpg" style="margin-top:11px" title=""/></p>
      </dt>
      <dt class="down">
       <ul>
         <li class="u1"><a  href="<?php echo U('Cart/list');?>" title="my cart"><img src="../Public/images/checkout.jpg" title=""/></a></li>
         <li class="u2">Currencies:</li>
		 <li class="u3">
         <form name="form1" id="form1" action="<?php echo U('Index/Currencies');?>" method="post">
         <select name="Currencies" onchange="document.form1.submit();">
         <option value="">Please select...</option>
         <?php if(is_array($currencies)): $i = 0; $__LIST__ = $currencies;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): ++$i;$mod = ($i % 2 )?><option value="<?php echo ($vo["symbol"]); ?>"><?php echo ($vo["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
         </select>
         </form>
         </li>
       </ul>
      </dt>
    </dl>
  </div>
</div>
<div class="in_nav">
  <ul>
    <li class="left"><a alt="Home" href="__ROOT__">Home</a></li>
    <li class="cent">
<a href="/products/" title="Product">Product</a>
 
<a href="/Payment/" title="Payment">Payment</a>
 
<a href="/Shipping-Delivery/" title="Shipping">Shipping</a>
 
<a href="/privacy-and-policy/" title="Privacy Notice">Privacy Notice</a>
 
<a href="/Wholesale/" title="Wholesale">Wholesale</a>
 
<a href="/mc/" title="My Account">My Account</a>
</li>
    <li class="right"><img src="../Public/images/navright.gif" title=""/></li>
  </ul>
</div>
<div class="in_ser">
    <div class="left"><img title="" style="float:left" src="../Public/images/srchcor.jpg">
      <ul> <form name="form2" method="post" action="search/index.asp">
        <li class="u1">Search:</li> 
        <li class="u2"><input type="text" name="keyword" size="10" maxlength="40" class="search"></li>  
        <li class="u3">
			<select name="sort_id" id="sort_id" style="width:220px">
		      <option value="0" SELECTED>All Categories</option>
			  
			  <option  value="1">Women's Clothing</option>
			  
			  <option  value="10">Women's Footwear</option>
			  
			  <option  value="12">Men's Wear</option>
			  
			  <option  value="13">Handbags & bags</option>
			  
			  <option  value="14">Hats & Belts</option>
			  
			  <option  value="15">Sunglasses</option>
			  
			  <option  value="16">Jerseys</option>
			  
			  <option  value="17">Sports Shoes</option>
			  
			  <option  value="18">Casual Shoes</option>
			  
			  <option  value="19">Children's Wear</option>
			  
			  <option  value="20">Hair Care Shop</option>
			  
			  <option  value="21">Fashion Accessories</option>
			  
			  <option  value="23">Electronics Products</option>
			  
			</select></li>
            <li class="u4"><input type="image" src="../Public/images/go.jpg" class="quickbutton" border="0" alt="Product Search" title="Quick Find"></li>
            </form>
      </ul>
    
    </div>
    <div class="right"><img title="" style="float:right" src="../Public/images/srchcor1.jpg">
      <ul class="chat" id=nav_chat_sales>
  <li class="nm"><span><A  style="color:#990000" class=red title=William onclick=show_chat_div(this); 
  href="javascript:void(0);">Linda</A></span> is Online to help you</li>
  <li class="cline" id=chat_div style="DISPLAY: none">
  <dl>
  
  <dd><IMG id="chat_div_close_img" title="close" onclick="close_chat_div()" height="13" alt="close" src="../Public/images/close.gif" width=13 border=0></dd></dl>
</li>
</ul>
    </div>
</div>
<div class="in_s"><?php echo GetSettValue('hottitle');?></div>
<!--eof header-->
<div class="ind_con">
<div class="left">
 
 
<dl>
<dt class="cht">Categories</dt>
<dd class="cata">
 
<div class="in1_l_in">
	  <ol>
      <?php if(is_array($catetree)): $i = 0; $__LIST__ = $catetree;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): ++$i;$mod = ($i % 2 )?><ul>          
		  <?php if(($vo['subcount'])  ==  "0"): ?><li class="titleout"><div class="tt"><a href="<?php echo U(tourlstr($vo['name']).'@',array('cid'=>$vo['id']));?>" title="<?php echo ($vo["name"]); ?>"><?php echo ($vo["name"]); ?></a></div>
          </li><?php endif; ?>
          <?php if(($vo['subcount'])  >  "0"): ?><li class="titleout" onMouseOver="document.all.Layer<?php echo ($vo["id"]); ?>.style.visibility='';this.className='titleover'" onMouseOut="document.all.Layer<?php echo ($vo["id"]); ?>.style.visibility='hidden';this.className='titleout'"><div class="tt"><a href="<?php echo U(tourlstr($vo['name']).'@',array('cid'=>$vo['id']));?>" title="<?php echo ($vo["name"]); ?>"><?php echo ($vo["name"]); ?></a></div>
		  <div class="l_li" id="Layer<?php echo ($vo["id"]); ?>" style="visibility:hidden;">
		  <ul>
		    <?php if(is_array($vo['sub'])): $i = 0; $__LIST__ = $vo['sub'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$subvo): ++$i;$mod = ($i % 2 )?><li><a href="<?php echo U(tourlstr($subvo['name']).'@',array('cid'=>$subvo['id']));?>" title="T Shirts"><?php echo ($subvo["name"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
			
		  </ul>
		  </div>
          </li><?php endif; ?>
		  
		</ul><?php endforeach; endif; else: echo "" ;endif; ?>
		
		
	  </ol>
	</div> 
</dd>
</dl>
<div class="bestpro">
<ol>Top Ten Views</ol>
<ul class="l_class">
	    <?php if(is_array($toptenviews)): $i = 0; $__LIST__ = $toptenviews;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): ++$i;$mod = ($i % 2 )?><li>
          <dl>
            <dt class="left"><img src="__ROOT__/<?php echo ($vo["smallimage"]); ?>" alt="<?php echo ($vo["name"]); ?>"></dt><dd class="right"><a href="<?php echo U(tourlstr($vo['name']).'@',array('pid'=>$vo['id']));?>" target="_blank" title="<?php echo ($vo["name"]); ?>"><?php echo ($vo["name"]); ?></a></dd>
          </dl>
       </li><?php endforeach; endif; else: echo "" ;endif; ?>
		
	  </ul>
</div>

<div class="inc">
<ul>
<li class="f"><a href="http://translate.google.com/?hl=fr&langpair=en%7Cfr#">Français</a></li>
<li class="i"><a href="http://translate.google.com/?hl=it&langpair=en%7Cit#">Italiano</a></li>
<li class="n"><a href="http://translate.google.com/?hl=nl&langpair=en%7Cnl#">Nederlands</a></li>
<li class="e"><a href="http://translate.google.com/?hl=es&langpair=en%7Ces#">Español</a></li>
<li class="d"><a href="http://translate.google.com/?hl=da&langpair=en%7Cda#">Dansk</a></li>
<li class="de"><a href="http://translate.google.com/?hl=de&langpair=en%7Cde#">Deutsch</a></li>
</ul>
</div>
 
</div>
<div class="right">
 <div class="pcata">
  <div class="pcata_l">
   <ol class="pic">
	  <SCRIPT  src="../Public/Js/flash.js" type=text/javascript></SCRIPT>
	  <div id=flashFCI><a href="#" title="jerseysmaker" target="_blank"><IMG src="/upfile/10/201082423343331813.jpg" alt="jerseysmaker"></a></div>
	  <SCRIPT type=text/javascript>
	  var s1 = new SWFObject("../Public/flash/flash.swf", "mymovie1", "534", "180", "5", "#ffffff");
	  s1.addParam("wmode", "transparent");
	  s1.addParam("AllowscriptAccess", "sameDomain");
	  s1.addVariable("bigSrc", "<?php echo ($flashpic); ?>");
	  s1.addVariable("smallSrc", "|images/06.jpg|||");
	  s1.addVariable("href", "<?php echo ($flashlink); ?>");
	  s1.addVariable("txt", "<?php echo ($flashremark); ?>");
	  s1.addVariable("width", "534");
	  s1.addVariable("height", "180");
	  s1.write("flashFCI");
	  </SCRIPT>
	  </ol>
      
<div class="procata">
<ol>Featured Categories</ol>
<ul>
	<li>    
        <?php if(is_array($catetree)): $i = 0; $__LIST__ = $catetree;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): ++$i;$mod = ($i % 2 )?><?php if(($vo['ishot'])  ==  "1"): ?><dl>
		  <dt><a href="<?php echo U(tourlstr($vo['name']).'@',array('cid'=>$vo['id']));?>" title="<?php echo ($vo["name"]); ?>"><img src="__ROOT__/<?php echo ($vo["imgurl"]); ?>" alt="<?php echo ($vo["name"]); ?>"></a></dt>
		  <dd class="title"><a href="<?php echo U(tourlstr($vo['name']).'@',array('cid'=>$vo['id']));?>" title="<?php echo ($vo["name"]); ?>"><?php echo ($vo["name"]); ?></a></dd>
		<dd class="cash">	
              <?php if(is_array($vo['sub'])): $i = 0; $__LIST__ = array_slice($vo['sub'],0,5);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$subvo): ++$i;$mod = ($i % 2 )?><h3><a href="<?php echo U(tourlstr($subvo['name']).'@',array('cid'=>$subvo['id']));?>" title="<?php echo ($subvo["name"]); ?>"><?php echo ($subvo["name"]); ?></a></h3><?php endforeach; endif; else: echo "" ;endif; ?>
<a href='<?php echo U(tourlstr($subvo['name']).'@',array('cid'=>$subvo['id']));?>' title='More wholesale products'><h4>More wholesale products &gt;&gt;</h4></a>
</dd>
</dl><?php endif; ?><?php endforeach; endif; else: echo "" ;endif; ?>
		</li>
	  </ul>
</div>
 
</div> 
 <div class="pcata_r">
   <ul class="pic">
	  <?php if(is_array($leftpic)): $i = 0; $__LIST__ = $leftpic;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): ++$i;$mod = ($i % 2 )?><li><a href="<?php echo ($vo["link"]); ?>" target="_blank"><img src="__ROOT__/<?php echo ($vo["img_url"]); ?>"  /></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
		
		 </ul>
  </div>
</div>
<script> 
function INFShow(id)
{
for (var i = 0;i < 3;i++)
{
var INFV = document.getElementById("INFV" + i);
var INFC = document.getElementById("INFC" + i);
if (i == id)
{
INFV.className = 'I_over';
INFC.style.display = "";
}
else
{
INFV.className = '';
INFC.style.display = "none";
}
}
}
</script>
<div class="INF_TJ">
<ul class="uhead"><li class="best"><h2 onClick="INFShow('0')" id="INFV0" class="I_over">Featured Products</h2></li><li class="ship"><h2 onClick="INFShow('1')" id="INFV1"><ol>Hot Products</ol></h2></li><li><h2 onClick="INFShow('2')" id="INFV2">New Products</h2></li></ul>
<div class="prov" id="INFC0">
<ul>
	    <li>
        <?php if(is_array($FeaturedPorducts)): $i = 0; $__LIST__ = $FeaturedPorducts;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): ++$i;$mod = ($i % 2 )?><dl>
		  <dt><a href="<?php echo U(tourlstr($vo['name']).'@',array('pid'=>$vo['id']));?>" target="_blank" title="<?php echo ($vo["name"]); ?>"><img src="__ROOT__/<?php echo ($vo["smallimage"]); ?>" alt="<?php echo ($vo["name"]); ?>"></a></dt>
		  <dd><a href="<?php echo U(tourlstr($vo['name']).'@',array('pid'=>$vo['id']));?>" target="_blank" title="<?php echo ($vo["name"]); ?>"><?php echo ($vo["name"]); ?></a></dd><dd class="price"><?php echo getprice($vo['price'],$vo['pricespe']);?></dd>
		</dl><?php endforeach; endif; else: echo "" ;endif; ?>
		</li>
	  </ul>
</div>
<div class="prov" id="INFC1" style="display:none;">
<ul>
	    <li>
		<?php if(is_array($HotPorducts)): $i = 0; $__LIST__ = $HotPorducts;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): ++$i;$mod = ($i % 2 )?><dl>
		  <dt><a href="<?php echo U(tourlstr($vo['name']).'@',array('pid'=>$vo['id']));?>" target="_blank" title="<?php echo ($vo["name"]); ?>"><img src="__ROOT__/<?php echo ($vo["smallimage"]); ?>" alt="<?php echo ($vo["name"]); ?>"></a></dt>
		  <dd><a href="<?php echo U(tourlstr($vo['name']).'@',array('pid'=>$vo['id']));?>" target="_blank" title="<?php echo ($vo["name"]); ?>"><?php echo ($vo["name"]); ?></a></dd><dd class="price"><?php echo getprice($vo['price'],$vo['pricespe']);?></dd>
		</dl><?php endforeach; endif; else: echo "" ;endif; ?>
		</li>
	  </ul>
</div>
<div class="prov" id="INFC2" style="display:none;">
<ul>
	    <li>
		<?php if(is_array($NewPorducts)): $i = 0; $__LIST__ = $NewPorducts;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): ++$i;$mod = ($i % 2 )?><dl>
		  <dt><a href="<?php echo U(tourlstr($vo['name']).'@',array('pid'=>$vo['id']));?>" target="_blank" title="<?php echo ($vo["name"]); ?>"><img src="__ROOT__/<?php echo ($vo["smallimage"]); ?>" alt="<?php echo ($vo["name"]); ?>"></a></dt>
		  <dd><a href="<?php echo U(tourlstr($vo['name']).'@',array('pid'=>$vo['id']));?>" target="_blank" title="<?php echo ($vo["name"]); ?>"><?php echo ($vo["name"]); ?></a></dd><dd class="price"><?php echo getprice($vo['price'],$vo['pricespe']);?></dd>
		</dl><?php endforeach; endif; else: echo "" ;endif; ?>
		</li>
	  </ul>
</div>
</div>
 

</div>
</div>
<center>
 <div class="ind_link">
<div class="footerblock">
 
<dl>
<dt>Company Info</dt>
 
<dd><a href="/Shipment-Payment/" title="Shipment & Payment">Shipment & Payment</a></dd>
 
<dd><a href="Http://www.jerseysmaker.com/News/" title="News">News</a></dd>
 
<dd><a href="/about-us/" title="About US">About US</a></dd>
 
</dl>
      
<dl>
<dt>Customer Service</dt>
 
<dd><a href="/faqs/" title="F.A.Q.">F.A.Q.</a></dd>
 
<dd><a href="/Size-Guide/" title="Size Guide">Size Guide</a></dd>
 
<dd><a href="/Products Expected/" title="Products Expected">Products Expected</a></dd>
 
<dd><a href="/help/" title="Help">Help</a></dd>
 
<dd><a href="/contact-us/" title="Contact US">Contact US</a></dd>
 
</dl>
      
<dl>
<dt>Shipping & Returns</dt>
 
<dd><a href="/Shipping-Delivery/" title="Shipping & Delivery">Shipping & Delivery</a></dd>
 
<dd><a href="/Shipping-Return/" title="Shipping & Return">Shipping & Return</a></dd>
 
</dl>
      
<dl>
<dt>Security & Privacy</dt>
 
<dd><a href="/Payment/" title="Payment Methods">Payment Methods</a></dd>
 
<dd><a href="/notice/" title="Notice">Notice</a></dd>
 
<dd><a href="/privacy-and-policy/" title="Privacy & Policy">Privacy & Policy</a></dd>
 
</dl>
      
<dl>
<dt>Other Business</dt>
 
<dd><a href="/Wholesale/" title="Wholesale">Wholesale</a></dd>
 
<dd><a href="/Promotion-Details/" title="Promotion Details">Promotion Details</a></dd>
 
<dd><a href="/dropship/" title="Dropship">Dropship</a></dd>
 
<dd><a href="/deals/" title="Deals">Deals</a></dd>
 
<dd><a href="/ChristmasGifts/" title="Christmas">Christmas</a></dd>
 
</dl>
      
</div> 
 
<ol class="piclink">
<a href="http://www.visa.com" title="Visa" target="_blank"><img src="../Public/images/visa.gif" alt="Visa"></a>
<a href="http://www.MasterCard.com" title="MasterCard" target="_blank"><img src="../Public/images/mastercard.gif" alt="MasterCard"></a>
<a href="http://www.discovercard.com/" title="Discover" target="_blank"><img src="../Public/images/discover.gif" alt="link5"></a>
<a href="http://www.mcafee.com" title="mcafrr" target="_blank"><img src="../Public/images/mcafrr.gif" alt="mcafrr"></a>
<a href="http://www.verisign.com/" title="link8" target="_blank"><img src="../Public/images/verisign.jpg" alt="verisign"></a>
<a href="http://www.paypal.com" title="paypal" target="_blank"><img src="../Public/images/paypal.jpg" alt="paypal"></a>
</ol>
 <ol class="textlink">
No link
</ol>
<ol class="infolink">
<a href="/contact-Us/" title="Contact Us">Contact Us</a><a href="/wholesale/" title="Wholesale">Wholesale</a><a href="/payment/" title="Payment">Payment</a><a href="/Shipping-Returns/" title="Shipping & Returns">Shipping & Returns</a><a href="/dropship/" title="Dropship">Dropship</a><a href="/ChristmasGifts/" title="ChristmasGifts">ChristmasGifts</a><a href="/Help/" title="Help">Help</a><a href="/Sitemap/" title="Sitemap">Sitemap</a>
</ol>
</div>
<div class="ind_bot">Copyright &copy; 2009~2012 <a href="<?php echo GetSettValue('siteurl');?>" title="<?php echo GetSettValue('siteurl');?>"><?php echo GetSettValue('sitename');?></a> All right reserved.</div>
</center>
 
</body>
</html>