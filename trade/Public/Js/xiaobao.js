/*URL模式*/
if(location.href.indexOf('index.php') != -1){
	var URL_MODEL="/index.php";
}else{
	URL_MODEL='';
}
var xiaobao_ajax=true;//是否启用ajax
/*图片缩放*/
function cs_resize(obj, nw, nh){
	if (nw==0 || nh==0) return;
	var img = new Image();
	img.src = obj.src;
	var iw = img.width;
	var ih = img.height;
	if (iw==0 || ih==0) return;
	if (nw*ih/iw>=nh){
		obj.height = nh;
		obj.width = iw*nh/ih;
	}
	else{
		obj.width = nw;
		obj.height = ih*nw/iw;
	}
}
/*div向上滚动*/
function ScrollImgTop(){
	var speed=20;
	var scroll_begin = document.getElementById("scroll_begin");
	var scroll_end = document.getElementById("scroll_end");
	var scroll_div = document.getElementById("scroll_div");
	scroll_end.innerHTML=scroll_begin.innerHTML;
	var Marquee=function(){
		if(scroll_end.offsetTop-scroll_div.scrollTop<=0){
			scroll_div.scrollTop-=scroll_begin.offsetHeight;
		}else{
			scroll_div.scrollTop++;
		}
	};
	var MyMar=setInterval(Marquee,speed);
	scroll_div.onmouseover=function() {clearInterval(MyMar);}
	scroll_div.onmouseout=function() {MyMar=setInterval(Marquee,speed);}
}
/*div向左滚动*/
function ScrollImgLeft(){
	var speed=10;
	var scroll_begin =document.getElementById("scroll_begin");
	var scroll_end = document.getElementById("scroll_end");
	var scroll_div = document.getElementById("scroll_div");
	scroll_end.innerHTML=scroll_begin.innerHTML;
	var Marquee=function(){
		if(scroll_end.offsetTop-scroll_div.scrollTop<=0){
			scroll_div.scrollTop-=scroll_begin.offsetHeight;
		}else{
			scroll_div.scrollTop++;
		}
	};
	var MyMar=setInterval(Marquee,speed);
	scroll_div.onmouseover=function() {clearInterval(MyMar);}
	scroll_div.onmouseout=function() {MyMar=setInterval(Marquee,speed);}
}
/*折叠菜单*/
function ChangeStatus(o){
	if (o.parentNode){
		if (o.parentNode.className == "Opened")	{
			o.parentNode.className = "Closed";
		}else{
			o.parentNode.className = "Opened";
		}
	}
}
/*Cookie管理*/
function get_cookie(name)
{
	var cookieValue = "";
	var search = name + "=";
	if(document.cookie.length > 0)
	{
		offset = document.cookie.indexOf(search);
		if (offset != -1)
		{
			offset += search.length;
			end = document.cookie.indexOf(";", offset);
			if (end == -1)
			{
				end = document.cookie.length;
			}
			cookieValue = unescape(document.cookie.substring(offset, end));
		}
	}
	return cookieValue;
}

function set_cookie(cookieName,cookieValue,DayValue)
{
	var expire = "";
	var day_value=1;
	if(DayValue!=null)
	{
		day_value=DayValue;
	}
    expire = new Date((new Date()).getTime() + day_value * 86400000);
    expire = "; expires=" + expire.toGMTString();
	document.cookie = cookieName + "=" + escape(cookieValue) +";path=/"+ expire;
}

function del_cookie(cookieName)
{
	var expire = "";
    expire = new Date((new Date()).getTime() - 1 );
    expire = "; expires=" + expire.toGMTString();
	document.cookie = cookieName + "=" + escape("") +";path=/"+ expire;
}
/*折叠菜单,收起其它项*/
function MainStatus(o){
	//var tempColl = document.all.tags("li");
	var tempColl = document.getElementsByTagName("li");
	for(i=0; i<tempColl.length; i++)
	{
		if(tempColl[i].className=="Opened" && tempColl[i]!=o.parentNode){
			tempColl[i].className = "Closed";
		}
	}

	if (o.parentNode){
		if (o.parentNode.className == "Opened")
		{o.parentNode.className = "Closed";
		}
		else
		{
			o.parentNode.className = "Opened";
		}
	}
}
/*添加收藏夹*/
function addToFav(){
	if (document.all)
	{
		window.external.addFavorite(this.href,this.title);
	}
	else if (window.sidebar)
	{
		window.sidebar.addPanel(document.title,document.URL,'');
	}

}
/*订单查询*/
function goOrderQuery(f){
	if (f.orderno.value==''){
		alert('Input order number please!');
		document.f.orderno.focus();
		return false;
	}
}
/*产品搜索*/
function gosearch(){
	var key=document.search.key.value;
	var classid=document.search.classid.value;
	if(key=='Enter search keywords here' || key=='%' || key=='*'){
		alert('Please Enter search keywords here');
		document.search.focus();
		return false;
	}else{
		document.search.action=URL_MODEL+'/Searchpro-index-classid-'+classid+'-key-'+key;
		document.search.submit();
	}
}
/*飘动菜单*/
function showsort(s){
	s.style.backgroundColor="#ff926b";
	var obj=s.getElementsByTagName("ul")[0];
	if(!obj) return false;
	obj.style.display="block";
}
function hidesort(s){
	s.style.backgroundColor="";
	var obj=s.getElementsByTagName("ul");
	for (var i=0; i<obj.length; i++){
		obj[i].style.display="none";
	}
}
function inititem(s){
	var obj=s.getElementsByTagName("li");
	if(!obj) return false;
	for (var i=0; i<obj.length; i++){
		obj[i].onmouseover=function(){showsort(this);}
		obj[i].onmouseout=function(){hidesort(this);}
	}
}
function init(){
	var els = document.getElementById("sortlist").getElementsByTagName("li");
	for (var i=0; i<els.length; i++){
		inititem(els[i]);
	}
}
//启动
//init();
/*小图片转大图*/
function turnimg(objimg){
	var obj=document.getElementById("bigimg");
	var objbig=document.getElementById("bigimg").src;
	obj.src=objimg.src;
	objimg.src=objbig;
}
//相关插件
(function($){
		/**
		 * 图片大小缩放
		 * 用法:
		 * $("img.resize").resize({"imgWidth":150,"imgHeight":150});
		 * 样式名称,图片宽高
		 * center是否居中
		 */
	$.fn.resize=function(settings){
		var default_setting={
			imgWidth:160,
			imgHeight:120,
			center:false
		};
		settings = $.extend({},default_setting,settings);
		
        return this.each(function(i,n){
			var boxWidth=settings.imgWidth;
			var boxHeight=settings.imgHeight;
			var img=new Image();
			var imgWidth,imgHeight;
			img.src=this.src;
			imgWidth=img.width;
			imgHeight=img.height;
			if((boxWidth/boxHeight)>=(imgWidth/imgHeight)){
				//重新设置img的width和height
				$(this).width((boxHeight*imgWidth)/imgHeight);
				$(this).height(boxHeight);
				//让图片居中显示
				if(true===settings.center){
					var margin=(boxWidth-$(this).width())/2;
					$(this).css("margin-left",margin);
				}
			}else{
				//重新设置img的width和height
				$(this).width(boxWidth);
				$(this).height((boxWidth*imgHeight)/imgWidth);
				//让图片居中显示
				if(true===settings.center){
					var margin=(boxHeight-$(this).height())/2;
					$(this).css("margin-top",margin);
				}
			}
			if(true===settings.center){
				$(this).css({"display":"table-cell","vertical-align":"middle"});
			}
		});
				
	};
	

	$(function(){
		
	/*图片缩放*/
	$("img.resize").resize({"imgWidth":150,"imgHeight":150});
	

	/**
	 * 内页产品放大镜
	 * 用法<a class="jqzoom"><img src../></a>
	 * 给a加上class=jqzoom
	 */
	if ($('.jqzoom').length>0){
			$.getScript("/Public/Js/jqzoom/jqzoom.js",function(){
				$('head').append('<link href="/Public/Js/jqzoom/jqzoom.css" type="text/css" rel="stylesheet" />');
				$(".jqzoom").jqueryzoom();
			});
		
	}
	/**
	 * 内页产品灯箱
	 * 用法<a class="jqlightbox"><img src../></a>
	 * 给a加上class=jqlightbox
	 */
	if ($('.jqlightbox').length>0){
		$.getScript("/Public/Js/jqlightbox/jqlightbox-min.js",function(){
			$('head').append('<link href="/Public/Js/jqlightbox/jqlightbox.css" type="text/css" rel="stylesheet" />');
			$('.jqlightbox').lightBox();
		});
	}
	/**
	 * 装入购物车,会员,历史等动态数据
	 * 
	 * 
	 */
	//会员
	if ($('#Member').length>0){
		$('#Member').load(URL_MODEL+"/Javascript-Member");
	}
	//购物数量
	if ($('#Items').length>0){
		$('#Items').load(URL_MODEL+"/Javascript-Items");
	}
	//购物价格
	if ($('#Sum').length>0){
		$('#Sum').load(URL_MODEL+"/Javascript-Sum");
	}
	//品牌表单
	if ($('#Brand').length>0){
		$('#Brand').load(URL_MODEL+"/Javascript-Brand");
	}
	//汇率表单
	if ($('#Money').length>0){
		$('#Money').load(URL_MODEL+"/Javascript-Money");
	}
	//购物历史
	if ($('#Prohistory').length>0){
		$('#Prohistory').load(URL_MODEL+"/Javascript-Prohistory");
	}
	//登录状态
	if ($('#loginStatus').length>0){
		$('#loginStatus').load(URL_MODEL+"/Javascript-loginStatus");
	}
	/**
	 * 购物车客户资料验证
	 * 用法,表单必须id为cartnextform
	 */
	if($("#cartnextform").length>0){
		$.getScript("/Public/Js/validate/jqvalidate.js",function(){
			$("#cartnextform").validate();
		});
	}
	/**
	 * 会员注册验证
	 * 用法,表单必须id为checkRegisterform
	 */
	if($("#checkRegisterform").length>0){
		$.getScript("/Public/Js/validate/jqvalidate.js",function(){
			$("#checkRegisterform").validate();
		});
	}
	

	});
	
})(jQuery);
/*添加进购物车disp*/
function addToCart(){
	document.cartform.submit();
	return false;
}
/**
 * 购物车提交disp页
 * 用法:form名必须为cartform
 * xiaobao_ajax为false则关闭效果
 */
function saveToCart(){
	$.post(URL_MODEL+$('form[name=cartform]').attr('action'),$('form[name=cartform]').serialize()+'&ajax=1',function(data){
		//更新购物车状态
		if(data['counts'] != undefined){
		var exp=new RegExp('\\d+','g');
		var html=$('#cart').html().replace(exp,data['counts']);
		$('#cart').html(html);
		}
		
		$("#result").find('#AjaxResult').remove().end().append('<div id="AjaxResult"></div>').find('#AjaxResult').css({
			"background":"none repeat scroll 3px 40% #FFFFFF",
			"border":"1px solid gray",
			"color":"blue",
			"display":"none",
			/*"position":"relative",//浮动*/
			"font-family":"微软雅黑,Tahoma,Helvetica,sans",
			"font-weight":"bold",
			"letter-spacing":"2px",
			"padding":"5px 20px 5px 10px",
			"right":"5px",
			"top":"5px",
			"z-index":"1000"
		}).html(data['message']).hide().fadeIn(300).delay(5000).fadeOut(300,function(){
             $(this).remove();
        })
		//alert(data['message']);
		
	return false;
	},'json');
	return false;
}
/**
 * 保存购物车cartlist
 * 用法:form名必须为shopcart
 * xiaobao_ajax为false则关闭效果
 */
function checkcart(){
	//检查size
	var flag=true;
	$('form[name=shopcart] select').each(function(){
	if($(this).val()=='' || $(this).val()=='Please select size'){
		flag=false;
	};
	});
	if(false===flag){
		alert('Please select size!');
		return false;
	}
}
function savesubm(){
	if(checkcart()==false){
		return false;
	}
	//保存
	if(xiaobao_ajax){
		$.post(URL_MODEL+$('form[name=shopcart]').attr('action'),$('form[name=shopcart]').serialize()+'&ajax=1',function(data){
				alert(data['message']);
			return false;
		},'json');
		return false;
	}
	document.shopcart.action=URL_MODEL+"/Cart-UpdateCart";
	document.shopcart.submit();
	
}
/*提交购物车cartlist*/
function subm(){
	if(checkcart()==false){
		return false;
	}
	if(xiaobao_ajax){
		//提交并跳转
		$.post(URL_MODEL+$('form[name=shopcart]').attr('action'),$('form[name=shopcart]').serialize()+'&ajax=1',function(data){
			if(data['status']===0){
				alert(data['message']);
			}else{
				location.href=URL_MODEL+"/Cart-Next";
			}
			return false;
		},'json');
		return false;
	}
	document.shopcart.action=URL_MODEL+"/Cart-UpdateCart-next-next";
	document.shopcart.submit();
}
/*保存购物车cartlist结束*/

/*会员*/
function checkleft(theform){
	if(theform.memberid.value==''){
		alert("MemberId can not be empty!");
		theform.memberid.focus();
		return false;
	}
	if(theform.password.value.length<3)
	{
		alert("Password at least three characters!");
		theform.password.focus();
		return false;
	}
}
/*屏蔽非数字*/
function IsDigit()
{
	return ((event.keyCode >= 48) && (event.keyCode <= 57));
}

function Cart_next_check(theform){
	if(theform.r_name.value==''){
		alert("Name can not be empty!");
		theform.r_name.focus();
		return false;
	}
	if(theform.r_addr.value==''){
		alert("Shipping Address can not be empty!");
		theform.r_addr.focus();
		return false;
	}
	if(theform.r_tel.value==''){
		alert("Tel can not be empty!");
		theform.r_tel.focus();
		return false;
	}
	if(theform.r_postcode.value==''){
		alert("PostCode/Zip can not be empty!");
		theform.r_postcode.focus();
		return false;
	}
	var res=new RegExp("^[\\w.-]+@([0-9a-z][\\w-]+\\.)+[a-z]{2,3}$");
	if(!res.test(theform.r_eml.value)){
		theform.r_eml.focus();
		alert("Please input the correct email");
		return (false);
	}
	if(theform.country.value==''){
		alert("Country can not be empty!");
		theform.country.focus();
		return false;
	}
	if(theform.m_ocomment.value==''){
		alert("Note can not be empty!");
		theform.m_ocomment.focus();
		return false;
	}

}
/**
 * 计算运费
 * 在next页面
 * <select name="fashion" id="express">
 * {$Express}
 * </select>下面加上
 * <script type="text/javascript">
 * document.getElementById('express').onchange=total;
 * </script>
 */
function total(){
	var reg=new RegExp('([^0-9.])','gi');
	var price=(this.options[this.options.selectedIndex].text.replace(reg,''));
	if(price=='' || isNaN(price)) price=0;
	document.cart.shipping.value=price;
	var code=new RegExp('\\S{1}','i');
	code=code.exec(document.getElementById('total').innerHTML).toString();
	document.getElementById('total').innerHTML=code+(parseFloat(document.cart.m_oamount.value)+parseFloat(price));
	
}
/*会员*/
function checklogin(theform){
	if(theform.memberid.value==''){
		alert("MemberId can not be empty!");
		theform.memberid.focus();
		return false;
	}
	if(theform.password.value.length<6)
	{
		alert("Password at least six characters!");
		theform.password.focus();
		return false;
	}
}
/*刷新验证码*/
function fleshVerify(ele,url){
	var timenow = new Date().getTime();
	ele.src= URL_MODEL+url+"-"+timenow;
}
/*会员注册检查*/
function checkRegister(theform){
	if(theform.memberid.value==''){
		alert("MemberId can not be empty!");
		theform.memberid.focus();
		return false;
	}
	if(theform.password.value.length<6)
	{
		alert("Password at least six characters!");
		theform.password.focus();
		return false;
	}
	if(theform.password.value!=theform.repassword.value)
	{
		alert("Two different passwords!");
		theform.password.focus();
		return false;
	}
	var res=new RegExp("^[\\w.-]+@([0-9a-z][\\w-]+\\.)+[a-z]{2,3}$");
	if(!res.test(theform.email.value)){
		theform.email.focus();
		alert("Please input the correct email");
		return (false);
	}
}
/*订单验证*/
function checkorder(){
	var theform=document.order;
	if(theform.country.value==''){
		alert("Country can not be empty!");
		theform.country.focus();
		return false;
	}
	var res=new RegExp("^[\\w.-]+@([0-9a-z][\\w-]+\\.)+[a-z]{2,3}$");
	if(!res.test(theform.email.value)){
		theform.email.focus();
		alert("Please input the correct email");
		return (false);
	}
	theform.submit();
}
//jQuery.noConflict();

/**
 * 购物车相关
 * 如果有
 <div class="Numinput" style="float:left;width:80px;">Quantity:<input type="text" name="pno" value="1" size="3" /><span class="numadjust increase"></span><span class="numadjust decrease"></span></div>
* 或
 <div class="Numinput"><input name="pno[]" type="text" size="3" value="{$vo.pno}"/><span class="numadjust increase"></span><span class="numadjust decrease"></span></div>
 * 则启用效果
 * 
 */
(function($){
	
	$(function(){
		
		//disp,有向上向下按钮则启用
		if ($('form[name=cartform] span.increase').length>0 && $('form[name=cartform] span.decrease').length>0){
		$.fn.extend({
			  price:function(){
				//金额变动
				$("#price").text(function(){
					var reg=new RegExp('([^0-9.])','gi');
					//单价
					var price=parseFloat($('form[name=cartform] input:hidden[name=price]').val().replace(reg,''));
					//特价
					var spe=parseFloat($('form[name=cartform] input:hidden[name=spe]').val().replace(reg,''));
					//数量
					var pno=parseFloat($('form[name=cartform] input:text[name=pno]').val().replace(reg,''));
					if(pno<1){
						$('form[name=cartform] input:text[name=pno]').val(1);
						pno=1;
					}
					var code=new RegExp('\\S{1}','i');
					code=code.exec($('#price').text());
					if(price==0){
						price=spe;
					}else if(spe==0){
						spe=price;
					}
					if($('#price span').length>0){
					$('#price span').eq(0).text(code.toString()+pno*price);
					}
					if($('#price span').length>1){
					$('#price span').eq(1).text(code.toString()+pno*spe);
					}
				});
				}
		});
	   $('form[name=cartform] span.increase').click(function(){
		$('form[name=cartform] input:text[name=pno]').val(function(){
			return parseFloat(this.value)+1;
		}).price();
		}).mousedown(function(){
			$(this).addClass('active');
		}).mouseup(function(){
			$(this).removeClass('active');
		});
		//向下
		$('form[name=cartform] span.decrease').click(function(){
			$('form[name=cartform] input:text[name=pno]').val(function(){
				if(this.value<=1){
					return 1;
				}
				return parseFloat(this.value)-1;
			}).price();
		}).mousedown(function(){
			$(this).addClass('active');
		}).mouseup(function(){
			$(this).removeClass('active');
		});
		$('form[name=cartform] input:text[name=pno]').change(function(){$(this).price()});
	};
	//cartlist有向上向下按钮则启用
	if ($('form[name=shopcart] .increase').length>0 && $('form[name=shopcart] .decrease').length>0){
		$.fn.extend({
			  fun:function(i){
			  	var reg=new RegExp('([^0-9.])','gi');
			  	if(undefined != i){
				//单价
				var unit=parseFloat($('form[name=shopcart] td[name=unit]').eq(i).text().replace(reg,''));
				var pno=parseFloat($('form[name=shopcart] input:text[name^=pno]').eq(i).val());
				if(pno<1){
						$('form[name=shopcart] input:text[name^=pno]').eq(i).val(1);
						pno=1;
				}
				var code=new RegExp('\\S{1}','i');
				$('form[name=shopcart] td[name=total]').eq(i).text(function(){
					code=code.exec($(this).text()).toString();
					return code+(unit*pno);
				});
			  	}
				//总价
				var sumtotal=0;//总额
				var sumcounts=0;//产品种类数目
				//var sumpno=0;//购物总数量
				$('form[name=shopcart] td[name=total]').each(function(){
					 sumtotal+=parseFloat($(this).text().replace(reg,''));
					 sumcounts+=1;
				});
				$("#sumtotal").text(sumtotal);
				
				//购物总数量
				/*$('form[name=shopcart] input:text[name^=pno]').each(function(){
					 sumpno+=parseFloat($(this).val().replace(reg,''));
				});*/
				
				//显示购物车状态
				var exp=new RegExp('\\d+','g');
				var html=$('#cart').html().replace(exp,sumcounts);
				
				$('#cart').html(html);
				} 
		});
		$('form[name=shopcart] input:text[name^=pno]').each(function(i,n){
			$('form[name=shopcart] .increase').eq(i).click(function(){
				$('form[name=shopcart] input:text[name^=pno]').eq(i).val(function(){
					return parseFloat(this.value)+1;
				}).fun(i);
			}).mousedown(function(){
				$(this).addClass('active');
			}).mouseup(function(){
				$(this).removeClass('active');
			});
			$('form[name=shopcart] .decrease').eq(i).click(function(){
			$('form[name=shopcart] input:text[name^=pno]').eq(i).val(function(){
				if(this.value<=1){
					return 1;
				}
				return parseFloat(this.value)-1;
				}).fun(i);
				
			}).mousedown(function(){
				$(this).addClass('active');
			}).mouseup(function(){
				$(this).removeClass('active');
			});
			$(this).change(function(){
				$(this).fun(i);
			});
			
	});
	$('form[name=shopcart] td[name=del] > a').click(function(){
		$(this).parent().parent().remove().fun();
		$.post(URL_MODEL+$(this).attr('href'),'ajax=1');
		return false;
	});
	$('#clearcart').click(function(){		
		$('form[name=shopcart] td[name=del]').parent().remove().fun();
		$.post(URL_MODEL+$(this).attr('href'),'ajax=1');
		return false;
	});
	}
		
		
		
	});
})(jQuery);

