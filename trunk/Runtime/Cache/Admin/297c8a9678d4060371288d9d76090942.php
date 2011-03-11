<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta http-equiv="content-language" content="en" />
	<meta name="robots" content="noindex,nofollow" />
	<link rel="stylesheet" media="screen,projection" type="text/css" href="../Public/css/reset.css" /> <!-- RESET -->
	<link rel="stylesheet" media="screen,projection" type="text/css" href="../Public/css/main.css" /> <!-- MAIN STYLE SHEET -->
	<link rel="stylesheet" media="screen,projection" type="text/css" href="../Public/css/2col.css" title="2col" /> <!-- DEFAULT: 2 COLUMNS -->
	<link rel="alternate stylesheet" media="screen,projection" type="text/css" href="../Public/css/1col.css" title="1col" /> <!-- ALTERNATE: 1 COLUMN -->
	<!--[if lte IE 6]><link rel="stylesheet" media="screen,projection" type="text/css" href="../Public/css/main-ie6.css" /><![endif]--> <!-- MSIE6 -->
	<link rel="stylesheet" media="screen,projection" type="text/css" href="../Public/css/style.css" /> <!-- GRAPHIC THEME -->
	<link rel="stylesheet" media="screen,projection" type="text/css" href="../Public/css/mystyle.css" /> <!-- WRITE YOUR CSS CODE HERE -->
	<link rel="stylesheet"  type="text/css" href="../Public/css/nyroModal.css" /> 
    <!---->
    <script type="text/javascript" src="../Public/Js/My97DatePicker/WdatePicker.js"></script>  
	<script type="text/javascript" src="../Public/Js/jquery.js"></script>    
	<script type="text/javascript" src="../Public/Js/switcher.js"></script>
	<script type="text/javascript" src="../Public/Js/toggle.js"></script>
	<script type="text/javascript" src="../Public/Js/ui.core.js"></script>
	<script type="text/javascript" src="../Public/Js/ui.tabs.js"></script>
	<script type="text/javascript" src="../Public/Js/ui.selectable.js"></script>
    <script type="text/javascript" src="../Public/Js/ajaxfileupload.js"></script>
    <script type="text/javascript" src="../Public/Js/jquery.imagePreview.js"></script>
    <script type="text/javascript" src="../Public/Js/jquery.nyroModal-1.6.2.min.js"></script>
    <script type="text/javascript" src="../Public/Js/jquery.cookie.js"></script>
    
    
	<script type="text/javascript">
	$(document).ready(function(){
		$(".tabs > ul").tabs();
		$("#listform tbody").selectable();
	});
	</script>
	<title><?php echo C('SYSTEM_NAME');?><?php echo C('SYSTEM_VAR');?></title>
</head>

<body>
<div id="main">

	<!-- Tray -->
	<div id="tray" class="box">

		<p class="f-left box">

			<!-- Switcher -->
			<span class="f-left" id="switcher">
				<a href="#" rel="1col" class="styleswitch ico-col1" title="Display one column"><img src="../Public/design/switcher-1col.gif" alt="1 Column" /></a>
				<a href="#" rel="2col" class="styleswitch ico-col2" title="Display two columns"><img src="../Public/design/switcher-2col.gif" alt="2 Columns" /></a>
			</span>

			项目名称: <strong><?php echo C('SYSTEM_NAME');?></strong>

		</p>

		<p class="f-right">User: <strong><a href="#"><?php echo ($userName); ?></a></strong> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <strong><a href="<?php echo U('Index/loginOut');?>" id="logout">Log out</a></strong></p>

	</div> <!--  /tray -->

	<hr class="noscreen" />

	<!-- Menu -->
	<div id="menu" class="box">

		<ul class="box f-right">
			<li><a href="__APP__" target="_blank"><span><strong>网站首页 &raquo;</strong></span></a></li>
		</ul>

		<ul class="box">
			<li id="menu-active"><a href="<?php echo U('Admin-Index/index');?>"><span>首页</span></a></li> <!-- Active -->
			<li><a href="<?php echo U('Orders/orderslist');?>"><span>订单管理</span></a></li>
			<li><a href="<?php echo U('Members/memberslist');?>"><span>会员管理</span></a></li>
			<li><a href="<?php echo U('Cate/catelist');?>"><span>类别管理</span></a></li>
			<li><a href="<?php echo U('Products/productslist');?>"><span>产品管理</span></a></li>
			<li><a href="<?php echo U('Article/articlelist');?>"><span>文章管理</span></a></li>
            <li><a href="<?php echo U('Setting/Cache');?>"><span>更新缓存</span></a></li>
		</ul>

	</div> <!-- /header -->



	<hr class="noscreen" />

	<!-- Columns -->
	<div id="cols" class="box">

		<!-- Aside (Left Column) -->
		<div id="aside" class="box">

			<div class="padding box">

				<!-- Logo (Max. width = 200px) -->
				<p id="logo"><a href="http://www.0594trade.com" target="_blank"><img src="../Public/tmp/logo.gif" alt="Our logo" title="Visit Site" /></a></p>

				<!-- Search -->
				<form action="<?php echo U('Products/productslist');?>" method="get">
					<fieldset>
						<legend>产品搜索 <a style="text-decoration:none;" href="http://www.0594trade.com/anfu/" target="_blank">安福货源导航</a></legend>

						<p><input type="text" size="17" name="name" class="input-text" />&nbsp;<input type="submit" value="OK" class="input-submit-02" /><br />
                        <select name="cateid" class="input-text" >
                        <option value="">请选择...</option>
                         <option value="isnew">最新产品</option>
                        <option value="ishot">热卖产品</option>
                        <option value="isrec">推荐产品</option>
                        <option value="isprice">特价产品</option>
                        <?php if(is_array($catetree)): $i = 0; $__LIST__ = $catetree;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): ++$i;$mod = ($i % 2 )?><option value="<?php echo ($vo['id']); ?>"><?php echo class_str_insert($vo['deep'],"&nbsp;&nbsp;&nbsp;");?><?php echo ($vo["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                        </select>
                        <br />
						

					</fieldset>
				</form>

				<!-- Create a new project -->
				<p id="btn-create" class="box"><a href="<?php echo U('Products/add');?>"><span>添加产品</span></a></p>

			</div> <!-- /padding -->

			<ul class="box">
				
                <li id="submenu-active"><a href="javascript:void(0);">系统设置</a> <!-- Active -->
					<ul>
						<li><a href="<?php echo U('Setting/base');?>">基本设置</a></li>
						<li><a href="<?php echo U('Setting/payment');?>">支付设置</a></li>
                        <li><a href="<?php echo U('Currencies/currencieslist');?>">货币设置</a></li>
                        <li><a href="<?php echo U('Setting/mail');?>">邮件设置</a></li>
                        <li><a href="<?php echo U('Setting/Money');?>">费用设置</a></li>
                        <li><a href="<?php echo U('Ad/adlist');?>">广告管理</a></li>
                        <li><a href="<?php echo U('Sitemap/index');?>">网站地图</a></li>
                        <li><a href="<?php echo U('Webcall/index');?>">客服管理</a></li>
                        <li><a href="<?php echo U('Ipblock/index');?>">区域封锁</a></li>
                        <li><a href="<?php echo U('Setting/ShippingAddress');?>">发货地址</a></li>
                        <li><a href="<?php echo U('Sqlbackup/index');?>">数据库备份</a></li>
					</ul>
				</li>
                <li id="submenu-active"><a href="javascript:void(0);">分类管理</a> <!-- Active -->
					<ul>
						<li><a href="<?php echo U('Cate/add');?>">添加分类</a></li>
						<li><a href="<?php echo U('Cate/catelist');?>">分类列表</a></li>
                        <li><a href="<?php echo U('Brand/brandlist');?>">品牌管理</a></li>
					</ul>
				</li>
                <li id="submenu-active"><a href="javascript:void(0);">产品管理</a> <!-- Active -->
					<ul>
						<li><a href="<?php echo U('Products/add');?>">添加产品</a></li>
                        <li><a href="<?php echo U('Products/productslist');?>">产品列表</a></li>
						<li><a href="<?php echo U('Type/catelist');?>">产品类型</a></li>
						<li><a href="<?php echo U('Products/batchedit');?>">批量修改</a></li>
                        <li><a href="<?php echo U('Products/easyupload');?>">批量上传</a></li>
                        <li><a href="<?php echo U('Ftpbatch/index');?>">批量处理</a></li>
                        <li><a href="<?php echo U('Products_ask/index');?>">产品问答</a></li>
					</ul>
				</li>
                <li id="submenu-active"><a href="javascript:void(0);">会员/订单管理</a> <!-- Active -->
					<ul>
					    <li><a href="<?php echo U('Members/groupslist');?>">会员等级</a></li>
						<li><a href="<?php echo U('Members/memberslist');?>">会员列表</a></li>
						<li><a href="<?php echo U('Members/points');?>">会员积分</a></li>
                        <li><a href="<?php echo U('Orders/orderslist');?>">订单列表</a></li>
					</ul>
				
                <li id="submenu-active"><a href="javascript:void(0);">文章/下载管理</a> <!-- Active -->
					<ul>
						<li><a href="<?php echo U('Article/add');?>">新增文章</a></li>
						<li><a href="<?php echo U('Article/articlelist');?>">文章列表</a></li>
                        <li><a href="<?php echo U('Article_cate/catelist');?>">文章类别</a></li>
						<li><a href="<?php echo U('Down/downlist');?>">下载列表</a></li>
                        <li><a href="<?php echo U('Down_cate/catelist');?>">下载类别</a></li>
					</ul>
				</li>
				<li id="submenu-active"><a href="javascript:void(0);">权限维护</a> <!-- Active -->
					<ul>
						<li><a href="<?php echo U('Role/roleList');?>">角色管理</a></li>
						<li><a href="<?php echo U('Node/nodelist');?>">节点管理</a></li>
                        <li><a href="<?php echo U('User/userlist');?>">后台用户</a></li>
					</ul>
				</li>
		
				
			</ul>

		</div> <!-- /aside -->

		<hr class="noscreen" />
		
		
<script type="text/javascript">
var submenu_active=$.cookie('submenu_active') || 0;
$('#aside ul.box>li>ul').each(function(i){
	if(i!=submenu_active){
		$(this).hide();
	}
});
$('#aside ul.box>li>ul>li>a').each(function(){
	if($(this).attr('href')==$.cookie('submenu_active_a')){
		$(this).css({'font-weight':'bold'});
	}
});
$('#aside ul.box>li>ul>li>a').click(function(){
	$.cookie('submenu_active_a',$(this).attr('href'));
});
$('#aside ul.box>li>a').click(function(){
	$.cookie('submenu_active',$(this).parent().index());
	$(this).parent().children('ul').toggle('fast').parent().siblings().children('ul').slideUp('fast');
});
</script>

<script language="javascript">
function ajaxFileUpload(fileToUpload,timestamp)
{
	
	$("#loading")
	.ajaxStart(function(){
		$(this).show();
	})
	.ajaxComplete(function(){
		$(this).hide();
	});

	$.ajaxFileUpload
	(
		{
			url:"<?php echo U('Products/upload');?>",
			secureuri:false,
			fileElementId:fileToUpload,
			dataType: 'json',
			success: function (data, status)
			{
				
				if (status==1){
					$("#msg").text(data.info);
					
				}
				else{
					$("#msg").text(data.info);
					$("#fileToUpload_look_"+timestamp).attr("href","."+data.data['savename']);
					$("#fileToUpload_look_"+timestamp).show();
					$("#fileToUpload_look_"+timestamp).preview();
					$("#fileToUpload_url_"+timestamp).val(data.data['savename']);
					//var jsonObj = eval("("+data+")");						
					/*$("#imgurlbox").attr("src",".././Public/Uploads/Products/"+data.data); 
					$("#imgurlbox").show();
					$("#imgurl").val(data.data);*/
				}


			},
			error: function (data, status, e)
			{
				alert(e);
			}
		}
	)		
	return false;

}
$(document).ready (
				   function(){
					   
					  
					   $("#img_add").click(
							   function(){
								   var timestamp = Date.parse(new Date());
								   var str="<p class='t-left'><input type='hidden'  name='timestamp[]' value='"+timestamp+"' /><input type='hidden' id='fileToUpload_url_"+timestamp+"' name='imgurl[]' value='' />描述：<input type='text' size='20' name='img_desc[]' class='input-text' />&nbsp排序：<input type='text' size='5' name='sort[]' class='input-text' />&nbsp图片：<input type='file' id='fileToUpload_"+timestamp+"' name='fileToUpload[]' class='input-text' /><input type='radio' name='isIndex'  class='input-text' value='"+timestamp+"'>封面&nbsp;&nbsp;<input class='input-submit' id='upload'  type='button' name='upload' value='上传' onClick=\"return ajaxFileUpload('fileToUpload_"+timestamp+"','"+timestamp+"');\" />&nbsp;<a id='fileToUpload_look_"+timestamp+"' href='javascript:void(0);' style='display:none;'  target='_blank'><img ' src='../Public/images/look.jpg' width='15' height='15' ></a></p>";
								   //alert(str);
								   $("#img_html").html($("#img_html").html()+str);
								   
							   }
							   );
				   }
				   );
</script>
<!-- Content (Right Column) -->
		<div id="content" class="box">

			<h1>添加新产品</h1>
            <p class="msg info">提示：<label id="msg"></label><span id="loading" style="display:none;"><img   src="../Public/images/loading.gif" style="height:20px;">上传中...</span></p>
            	
            <p id="btn-create" class="box">
              <a href="<?php echo U('Products/productslist');?>">产品列表</a>
            </p>
            <!-- Tabs -->
			<div class="tabs box">
				<ul>
					<li><a href="#tab01"><span>通用信息</span></a></li>
					<li><a href="#tab02"><span>详细描述</span></a></li>
					<li><a href="#tab03"><span>商品相册</span></a></li>
                    <li><a href="#tab04"><span>SEO信息</span></a></li>
				</ul>
			</div> <!-- /tabs -->
            <div id="tab01">
            <form action="<?php echo U('Products/Insert');?>" name="myform" method="post" enctype="multipart/form-data">
            <table class="nostyle">
                    <tr>
						<td style="width:120px;">产品名称(必填):</td>
						<td><input type="text" size="40" name="name" class="input-text" value="" /></td>
					</tr>
                    <tr>
						<td style="width:120px;">编号:</td>
						<td><input type="text" size="40" name="serial" class="input-text" value="" /></td>
					</tr>
                    <tr>
						<td style="width:120px;">价格:</td>
						<td><input type="text" size="40" name="price" class="input-text" value="" /></td>
					</tr>
                    <tr>
						<td style="width:120px;">特价:</td>
						<td><input type="text" size="40" name="pricespe" class="input-text" value="" /></td>
					</tr>
                    <tr>
						<td style="width:120px;">赠送积分:</td>
						<td><input type="text" size="40" name="points" class="input-text" value="0" /></td>
					</tr>
                    <tr>
						<td style="width:120px;">产品分类(必填):</td>
						<td>
                        <select name="cateid" class="input-text" >
                        <option value="0">最上级...</option>
                        <?php if(is_array($catetree)): $i = 0; $__LIST__ = $catetree;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): ++$i;$mod = ($i % 2 )?><option value="<?php echo ($vo['id']); ?>"><?php echo class_str_insert($vo['deep'],"&nbsp;&nbsp;&nbsp;");?><?php echo ($vo["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                        </select>
                        </td>
					</tr>
                     <tr>
						<td style="width:120px;">品牌:</td>
						<td>
                        <select name="brandid" class="input-text" >
                        <option value="0">最上级...</option>
                        <?php if(is_array($brandtree)): $i = 0; $__LIST__ = $brandtree;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): ++$i;$mod = ($i % 2 )?><option value="<?php echo ($vo['id']); ?>"><?php echo ($vo["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                        </select>
                        </td>
					</tr>
                  <!--  <tr>
						<td style="width:120px;">尺码:</td>
						<td><input type="text" size="40" name="size" class="input-text" value="" />"以","号分隔</td>
					</tr>-->
                    
                    <tr>
						<td style="width:120px;">最新产品:</td>
						<td><input type="radio" value="1"  name="isnew" class="input-text"  />是<input type="radio" value="0"  name="isnew" class="input-text"  checked/>否</td>
					</tr>
                    <tr>
						<td style="width:120px;">热卖产品:</td>
						<td><input type="radio" value="1"  name="ishot" class="input-text"  />是<input type="radio" value="0"  name="ishot" class="input-text"  checked/>否</td>
					</tr>
                    <tr>
						<td style="width:120px;">推荐产品:</td>
						<td><input type="radio" value="1"  name="isrec" class="input-text"  />是<input type="radio" value="0"  name="isrec" class="input-text"  checked/>否</td>
					</tr>
                    <tr>
						<td style="width:120px;">特价产品:</td>
						<td><input type="radio" value="1"  name="isprice" class="input-text"  />是<input type="radio" value="0"  name="isprice" class="input-text"  checked/>否</td>
					</tr>
                    <tr>
						<td style="width:120px;">排序:</td>
						<td><input type="text" size="20" name="sort" class="input-text" value="" /></td>
					</tr>
                    
            </table>
            </div>
            <div id="tab02">
            <!-- 编辑器调用开始 --><script type="text/javascript" src="__ROOT__/Public/Js/FCKeditor/fckeditor.js"></script><textarea id="remark" name="remark" ></textarea><script type="text/javascript"> var remark = new FCKeditor( "remark","100%","400x" ) ; remark.BasePath = "__ROOT__/Public/Js/FCKeditor/" ; remark.ReplaceTextarea() ;function resetEditor(){setContents("remark",document.getElementById("remark").value)}; function saveEditor(){document.getElementById("remark").value = getContents("remark");} function InsertHTML(html){ var oEditor = FCKeditorAPI.GetInstance("remark") ;if (oEditor.EditMode == FCK_EDITMODE_WYSIWYG ){oEditor.InsertHtml(html) ;}else	alert( "FCK必须处于WYSIWYG模式!" ) ;}</script> <!-- 编辑器调用结束 -->
            </div>
            <div id="tab03">
            <table class="nostyle">
           
            <tr><td>
            <p class="t-left">
            <input type="hidden"  name="timestamp[]" value="0" />
            <input type="hidden" id="fileToUpload_url_0" name="imgurl[]" value="" />
            描述：<input type="text" size="20" name="img_desc[]" class="input-text" />
            排序：<input type="text" size="5" name="sort[]" class="input-text" />
            图片：<input type="file" id="fileToUpload" name="fileToUpload[]" class="input-text" /><input type="radio" name="isIndex" checked class="input-text" value="0">
            封面 
             <input class="input-submit" id="upload"  type="button" name="upload" value="上传" onClick="return ajaxFileUpload('fileToUpload','0');" />
             &nbsp;<a id="img_add" href="javascript:void(0);" title="../Public/images/look.jpg"><img src="../Public/images/add.jpg" width="15" height="15"></a>
             <a id='fileToUpload_look_0' href='javascript:void(0);' target="_blank" style='display:none;'><img  src='../Public/images/look.jpg' width='15' height='15' ></a></p>
            <label id="img_html">
            </label>
           </td></tr>
           <tr><td>
           
           </td></tr>
           </table>
            </div>
            <div id="tab04">
            <table class="nostyle">
            <tr>
                <td style="width:120px;">标题(SEO):</td>
                <td><input type="text" size="60" name="pagetitle" class="input-text" value="" /></td>
            </tr>
            <tr>
                <td style="width:120px;">关键字(SEO):</td>
                <td><textarea name="pagekey" cols="60" rows="10" class="input-text"></textarea></td>
            </tr>
            <tr>
                <td style="width:120px;">描述(SEO):</td>
                <td><textarea name="pagedec" cols="60" rows="10" class="input-text"></textarea></td>
            </tr>
            
            </table>
            </div>
            <p class="t-right"><input type="submit" class="input-submit" value="添加" /></p>
            </form>
		</div> <!-- /content -->
	</div> <!-- /cols -->
	<hr class="noscreen" />

	<!-- Footer -->
	<div id="footer" class="box">

		<p class="f-left">&copy; 2010 外贸易 All Rights Reserved &reg;<a href="http://www.soupw.net/" target="_blank">搜莆网络</a> 客服QQ:<a href="tencent://Message/?Menu=YES&Uin=800038618&websiteName=搜莆网络 " target="_blank">800038618</a> <a href="www.0594trade.com" target="_blank">技术论坛</a></p>

	</div> <!-- /footer -->

</div> <!-- /main -->
</body>
</html>