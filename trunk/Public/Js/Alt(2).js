var pltsPop=null;
var pltsoffsetX = 20;
var pltsoffsetY = 20;
var pltsPopbg="#ffffee";
var pltsPopfg="#111111";
var pltsTitle="";
document.write('<div id=pltsTipLayer style="display: none;position: absolute; z-index:10001"></div>');
function pltsinits()
{
    document.onmouseover   = plts;
    document.onmousemove = moveToMouseLoc;
}
function plts()
{  var o=event.srcElement;
    if(o.alt!=null && o.alt!=""){o.dypop=o.alt;o.alt=""};

    pltsPop=o.dypop;
    if(pltsPop!=null&&pltsPop!=""&&typeof(pltsPop)!="undefined")
    {
	pltsTipLayer.style.left=-1000;
	pltsTipLayer.style.display='';
	var Msg=pltsPop.replace(/\n/g,"<br>");
	Msg=Msg.replace(/\0x13/g,"<br>");
	var re=/\{(.[^\{]*)\}/ig;
	if(!re.test(Msg)) pltsTitle="<font color='ffffff'>Welcome to 0594.com</font>";
	else{
	  re=/\{(.[^\{]*)\}(.*)/ig;
  	  pltsTitle=Msg.replace(re,"$1")+"&nbsp;";
	  re=/\{(.[^\{]*)\}/ig;
	  Msg=Msg.replace(re,"");
	  Msg=Msg.replace("<br>","");}
	  var attr=(document.location.toString().toLowerCase().indexOf("list.asp")>0?"nowrap":"");
       	var content =
      	'<table style="FILTER:alpha(opacity=100) shadow(color=#bbbbbb,direction=150);" id=toolTipTalbe border=0><tr><td width="100%"><table class=selet_bg cellspacing="0" cellpadding="0" style="width:100%" style="font size:9pt;">'+
      	'<tr id=pltsPoptop><th height=12 valign=bottom class=header><p id=topleft align=left style="padding-left:10px;">↖'+pltsTitle+'</p><p id=topright align=right style="display:none">'+pltsTitle+'↗</font></th></tr>'+
      	'<tr><td "+attr+" class=f_one style="padding-left:6px;padding-right:6px;padding-top: 4px;padding-bottom:4px;line-height:135%">'+Msg+'</td></tr>'+
      	'<tr id=pltsPopbot style="display:none"><th height=12 valign=bottom class=header><p id=botleft align=left>↙'+pltsTitle+'</p><p id=botright align=right style="display:none">'+pltsTitle+'↘</font></th></tr>'+
      	'</table></td></tr></table>'+
      	"<iframe src='javascript:false' border=0 frameborder=0 scrolling=no style='position:absolute;visibility:inherit;top:0px; left:0px; width:100%; height:200px; overflow:hidden; z-index:-1;padding:0px;FILTER:alpha(opacity=0) shadow(color=#bbbbbb,direction=150);'></iframe>";
       	pltsTipLayer.innerHTML=content;
       	toolTipTalbe.style.width=Math.min(pltsTipLayer.clientWidth,document.body.clientWidth/2.2);
       	moveToMouseLoc();
       	return true;
       }
    else
    {
    	pltsTipLayer.innerHTML='';
      	pltsTipLayer.style.display='none';
       	return true;
    }
}

function moveToMouseLoc()
{
	if(pltsTipLayer.innerHTML=='')return true;
	var MouseX=event.x;
	var MouseY=event.y;
	var popHeight=pltsTipLayer.clientHeight;
	var popWidth=pltsTipLayer.clientWidth;
	if(MouseY+pltsoffsetY+popHeight>document.body.clientHeight)
	{
	  	popTopAdjust=-popHeight-pltsoffsetY*1.5;
	  	pltsPoptop.style.display="none";
	  	pltsPopbot.style.display="";
	}
	 else
	{
	   	popTopAdjust=0;
	  	pltsPoptop.style.display="";
	  	pltsPopbot.style.display="none";
	}
	if(MouseX+pltsoffsetX+popWidth>document.body.clientWidth)
	{
		popLeftAdjust=-popWidth-pltsoffsetX*2;
		topleft.style.display="none";
		botleft.style.display="none";
		topright.style.display="";
		botright.style.display="";
	}
	else
	{
		popLeftAdjust=0;
		topleft.style.display="";
		botleft.style.display="";
		topright.style.display="none";
		botright.style.display="none";
	}
	pltsTipLayer.style.left=MouseX+pltsoffsetX+document.body.scrollLeft+popLeftAdjust;
	pltsTipLayer.style.top=MouseY+pltsoffsetY+document.documentElement.scrollTop+popTopAdjust;
  	return true;
}
pltsinits();
