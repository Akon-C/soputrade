/*jmsajax*/
(function($){$.jmsajax=function(options){};dateparse=function(data){try{return msJSON.parse(data,function(key,value){var a;if(typeof value==="string"){if(value.indexOf("Date")>=0){a=/^\/Date\(([0-9]+)\)\/$/.exec(value);if(a){return new Date(parseInt(a[1],10));}}}
return value;});}
catch(e){return null;}}
msJSON=function(){function f(n){return n<10?'0'+n:n;}
var cx=/[\u0000\u00ad\u0600-\u0604\u070f\u17b4\u17b5\u200c-\u200f\u2028-\u202f\u2060-\u206f\ufeff\ufff0-\uffff]/g,escapeable=/[\\\"\x00-\x1f\x7f-\x9f\u00ad\u0600-\u0604\u070f\u17b4\u17b5\u200c-\u200f\u2028-\u202f\u2060-\u206f\ufeff\ufff0-\uffff]/g,gap,indent,meta={'\b':'\\b','\t':'\\t','\n':'\\n','\f':'\\f','\r':'\\r','"':'\\"','\\':'\\\\'},rep;function quote(string){escapeable.lastIndex=0;return escapeable.test(string)?'"'+string.replace(escapeable,function(a){var c=meta[a];if(typeof c==='string'){return c;}
return'\\u'+('0000'+(+(a.charCodeAt(0))).toString(16)).slice(-4);})+'"':'"'+string+'"';}
function str(key,holder){var i,k,v,length,mind=gap,partial,value=holder[key];if(value&&typeof value==='object'&&typeof value.toJSON==='function'){value=value.toJSON(key);}
if(typeof rep==='function'){value=rep.call(holder,key,value);}
switch(typeof value){case'string':return quote(value);case'number':return isFinite(value)?String(value):'null';case'boolean':case'null':return String(value);case'object':if(!value){return'null';}
if(value.toUTCString){return '"\\/Date('+(value.getTime())+')\\/"';}
gap+=indent;partial=[];if(typeof value.length==='number'&&!(value.propertyIsEnumerable('length'))){length=value.length;for(i=0;i<length;i+=1){partial[i]=str(i,value)||'null';}
v=partial.length===0?'[]':gap?'[\n'+gap+
partial.join(',\n'+gap)+'\n'+
mind+']':'['+partial.join(',')+']';gap=mind;return v;}
if(rep&&typeof rep==='object'){length=rep.length;for(i=0;i<length;i+=1){k=rep[i];if(typeof k==='string'){v=str(k,value,rep);if(v){partial.push(quote(k)+(gap?': ':':')+v);}}}}else{for(k in value){if(Object.hasOwnProperty.call(value,k)){v=str(k,value,rep);if(v){partial.push(quote(k)+(gap?': ':':')+v);}}}}
v=partial.length===0?'{}':gap?'{\n'+gap+partial.join(',\n'+gap)+'\n'+
mind+'}':'{'+partial.join(',')+'}';gap=mind;return v;}}
return{stringify:function(value,replacer,space){var i;gap='';indent='';if(typeof space==='number'){for(i=0;i<space;i+=1){indent+=' ';}}else if(typeof space==='string'){indent=space;}
rep=replacer;if(replacer&&typeof replacer!=='function'&&(typeof replacer!=='object'||typeof replacer.length!=='number')){throw new Error('JSON.stringify');}
return str('',{'':value});},parse:function(text,reviver){var j;function walk(holder,key){var k,v,value=holder[key];if(value&&typeof value==='object'){for(k in value){if(Object.hasOwnProperty.call(value,k)){v=walk(value,k);if(v!==undefined){value[k]=v;}else{delete value[k];}}}}
return reviver.call(holder,key,value);}
cx.lastIndex=0;if(cx.test(text)){text=text.replace(cx,function(a){return'\\u'+('0000'+(+(a.charCodeAt(0))).toString(16)).slice(-4);});}
if(/^[\],:{}\s]*$/.test(text.replace(/\\(?:["\\\/bfnrt]|u[0-9a-fA-F]{4})/g,'@').replace(/"[^"\\\n\r]*"|true|false|null|-?\d+(?:\.\d*)?(?:[eE][+\-]?\d+)?/g,']').replace(/(?:^|:|,)(?:\s*\[)+/g,''))){j=eval('('+text+')');return typeof reviver==='function'?walk({'':j},''):j;}
throw new SyntaxError('JSON.parse');}};}();})(jQuery);
/*trimpath*/
var TrimPath;(function(){
if(TrimPath==null)
TrimPath=new Object();
if(TrimPath.evalEx==null)
TrimPath.evalEx=function(src){return eval(src);};
var UNDEFINED;
if(Array.prototype.pop==null)
Array.prototype.pop=function(){
if(this.length===0){return UNDEFINED;}
return this[--this.length];};
if(Array.prototype.push==null)
Array.prototype.push=function(){
for(var i=0;i<arguments.length;++i){this[this.length]=arguments[i];}
return this.length;};
TrimPath.parseTemplate=function(tmplContent,optTmplName,optEtc){
if(optEtc==null)
optEtc=TrimPath.parseTemplate_etc;
var funcSrc=parse(tmplContent,optTmplName,optEtc);
var func=TrimPath.evalEx(funcSrc,optTmplName,1);
if(func!=null)
return new optEtc.Template(optTmplName,tmplContent,funcSrc,func,optEtc);
return null;}
try{
String.prototype.process=function(context,optFlags){
var template=TrimPath.parseTemplate(this,null);
if(template!=null)
return template.process(context,optFlags);
return this;}}catch(e){}
TrimPath.parseTemplate_etc={};
TrimPath.parseTemplate_etc.statementTag="forelse|for|if|elseif|else|var|macro";
TrimPath.parseTemplate_etc.statementDef={
"if":{delta:1,prefix:"if (",suffix:") {",paramMin:1},
"else":{delta:0,prefix:"} else {"},
"elseif":{delta:0,prefix:"} else if (",suffix:") {",paramDefault:"true"},
"/if":{delta:-1,prefix:"}"},
"for":{delta:1,paramMin:3,
prefixFunc:function(stmtParts,state,tmplName,etc){
if(stmtParts[2]!="in")
throw new etc.ParseError(tmplName,state.line,"bad for loop statement: "+stmtParts.join(' '));
var iterVar=stmtParts[1];
var listVar="__LIST__"+iterVar;
return["var ",listVar," = ",stmtParts[3],";",
"var __LENGTH_STACK__;",
"if (typeof(__LENGTH_STACK__) == 'undefined' || !__LENGTH_STACK__.length) __LENGTH_STACK__ = new Array();",
"__LENGTH_STACK__[__LENGTH_STACK__.length] = 0;",
"if ((",listVar,") != null) { ",
"var ",iterVar,"_ct = 0;",
"for (var ",iterVar,"_index in ",listVar,") { ",
iterVar,"_ct++;",
"if (typeof(",listVar,"[",iterVar,"_index]) == 'function') {continue;}",
"__LENGTH_STACK__[__LENGTH_STACK__.length - 1]++;",
"var ",iterVar," = ",listVar,"[",iterVar,"_index];"].join("");}},
"forelse":{delta:0,prefix:"} } if (__LENGTH_STACK__[__LENGTH_STACK__.length - 1] == 0) { if (",suffix:") {",paramDefault:"true"},
"/for":{delta:-1,prefix:"} }; delete __LENGTH_STACK__[__LENGTH_STACK__.length - 1];"},
"var":{delta:0,prefix:"var ",suffix:";"},
"macro":{delta:1,
prefixFunc:function(stmtParts,state,tmplName,etc){
var macroName=stmtParts[1].split('(')[0];
return["var ",macroName," = function",
stmtParts.slice(1).join(' ').substring(macroName.length),
"{ var _OUT_arr = []; var _OUT = { write: function(m) { if (m) _OUT_arr.push(m); } }; "].join('');}},
"/macro":{delta:-1,prefix:" return _OUT_arr.join(''); };"}}
TrimPath.parseTemplate_etc.modifierDef={
"eat":function(v){return "";},
"escape":function(s){return String(s).replace(/&/g,"&amp;").replace(/</g,"&lt;").replace(/>/g,"&gt;");},
"capitalize":function(s){return String(s).toUpperCase();},
"default":function(s,d){return s!=null?s:d;}}
TrimPath.parseTemplate_etc.modifierDef.h=TrimPath.parseTemplate_etc.modifierDef.escape;
TrimPath.parseTemplate_etc.Template=function(tmplName,tmplContent,funcSrc,func,etc){
this.process=function(context,flags){
if(context==null)
context={};
if(context._MODIFIERS==null)
context._MODIFIERS={};
if(context.defined==null)
context.defined=function(str){return(context[str]!=undefined);};
for(var k in etc.modifierDef){
if(context._MODIFIERS[k]==null)
context._MODIFIERS[k]=etc.modifierDef[k];}
if(flags==null)
flags={};
var resultArr=[];
var resultOut={write:function(m){resultArr.push(m);}};
try{
func(resultOut,context,flags);}catch(e){
if(flags.throwExceptions==true)
throw e;
var result=new String(resultArr.join("")+"[ERROR: "+e.toString()+(e.message?'; '+e.message:'')+"]");
result["exception"]=e;
return result;}
return resultArr.join("");}
this.name=tmplName;
this.source=tmplContent;
this.sourceFunc=funcSrc;
this.toString=function(){return "TrimPath.Template ["+tmplName+"]";}}
TrimPath.parseTemplate_etc.ParseError=function(name,line,message){
this.name=name;
this.line=line;
this.message=message;}
TrimPath.parseTemplate_etc.ParseError.prototype.toString=function(){
return("TrimPath template ParseError in "+this.name+": line "+this.line+", "+this.message);}
var parse=function(body,tmplName,etc){
body=cleanWhiteSpace(body);
var funcText=["var TrimPath_Template_TEMP = function(_OUT, _CONTEXT, _FLAGS) { with (_CONTEXT) {"];
var state={stack:[],line:1};
var endStmtPrev=-1;
while(endStmtPrev+1<body.length){
var begStmt=endStmtPrev;
begStmt=body.indexOf("{",begStmt+1);
while(begStmt>=0){
var endStmt=body.indexOf('}',begStmt+1);
var stmt=body.substring(begStmt,endStmt);
var blockrx=stmt.match(/^\{(cdata|minify|eval)/);
if(blockrx){
var blockType=blockrx[1];
var blockMarkerBeg=begStmt+blockType.length+1;
var blockMarkerEnd=body.indexOf('}',blockMarkerBeg);
if(blockMarkerEnd>=0){
var blockMarker;
if(blockMarkerEnd-blockMarkerBeg<=0){
blockMarker="{/"+blockType+"}";}else{
blockMarker=body.substring(blockMarkerBeg+1,blockMarkerEnd);}
var blockEnd=body.indexOf(blockMarker,blockMarkerEnd+1);
if(blockEnd>=0){
emitSectionText(body.substring(endStmtPrev+1,begStmt),funcText);
var blockText=body.substring(blockMarkerEnd+1,blockEnd);
if(blockType=='cdata'){
emitText(blockText,funcText);}else if(blockType=='minify'){
emitText(scrubWhiteSpace(blockText),funcText);}else if(blockType=='eval'){
if(blockText!=null&&blockText.length>0)
funcText.push('_OUT.write( (function() { '+blockText+' })() );');}
begStmt=endStmtPrev=blockEnd+blockMarker.length-1;}}}else if(body.charAt(begStmt-1)!='$'&&
body.charAt(begStmt-1)!='\\'){
var offset=(body.charAt(begStmt+1)=='/'?2:1);
if(body.substring(begStmt+offset,begStmt+10+offset).search(TrimPath.parseTemplate_etc.statementTag)==0)
break;}
begStmt=body.indexOf("{",begStmt+1);}
if(begStmt<0)
break;
var endStmt=body.indexOf("}",begStmt+1);
if(endStmt<0)
break;
emitSectionText(body.substring(endStmtPrev+1,begStmt),funcText);
emitStatement(body.substring(begStmt,endStmt+1),state,funcText,tmplName,etc);
endStmtPrev=endStmt;}
emitSectionText(body.substring(endStmtPrev+1),funcText);
if(state.stack.length!=0)
throw new etc.ParseError(tmplName,state.line,"unclosed, unmatched statement(s): "+state.stack.join(","));
funcText.push("}}; TrimPath_Template_TEMP");
return funcText.join("");}
var emitStatement=function(stmtStr,state,funcText,tmplName,etc){
var parts=stmtStr.slice(1,-1).split(' ');
var stmt=etc.statementDef[parts[0]];
if(stmt==null){
emitSectionText(stmtStr,funcText);
return;}
if(stmt.delta<0){
if(state.stack.length<=0)
throw new etc.ParseError(tmplName,state.line,"close tag does not match any previous statement: "+stmtStr);
state.stack.pop();}
if(stmt.delta>0)
state.stack.push(stmtStr);
if(stmt.paramMin!=null&&
stmt.paramMin>=parts.length)
throw new etc.ParseError(tmplName,state.line,"statement needs more parameters: "+stmtStr);
if(stmt.prefixFunc!=null)
funcText.push(stmt.prefixFunc(parts,state,tmplName,etc));
else
funcText.push(stmt.prefix);
if(stmt.suffix!=null){
if(parts.length<=1){
if(stmt.paramDefault!=null)
funcText.push(stmt.paramDefault);}else{
for(var i=1;i<parts.length;i++){
if(i>1)
funcText.push(' ');
funcText.push(parts[i]);}}
funcText.push(stmt.suffix);}}
var emitSectionText=function(text,funcText){
if(text.length<=0)
return;
var nlPrefix=0;
var nlSuffix=text.length-1;
while(nlPrefix<text.length&&(text.charAt(nlPrefix)=='\n'))
nlPrefix++;
while(nlSuffix>=0&&(text.charAt(nlSuffix)==' '||text.charAt(nlSuffix)=='\t'))
nlSuffix--;
if(nlSuffix<nlPrefix)
nlSuffix=nlPrefix;
if(nlPrefix>0){
funcText.push('if (_FLAGS.keepWhitespace == true) _OUT.write("');
var s=text.substring(0,nlPrefix).replace('\n','\\n');
if(s.charAt(s.length-1)=='\n')
s=s.substring(0,s.length-1);
funcText.push(s);
funcText.push('");');}
var lines=text.substring(nlPrefix,nlSuffix+1).split('\n');
for(var i=0;i<lines.length;i++){
emitSectionTextLine(lines[i],funcText);
if(i<lines.length-1)
funcText.push('_OUT.write("\\n");\n');}
if(nlSuffix+1<text.length){
funcText.push('if (_FLAGS.keepWhitespace == true) _OUT.write("');
var s=text.substring(nlSuffix+1).replace('\n','\\n');
if(s.charAt(s.length-1)=='\n')
s=s.substring(0,s.length-1);
funcText.push(s);
funcText.push('");');}}
var emitSectionTextLine=function(line,funcText){
var endMarkPrev='}';
var endExprPrev=-1;
while(endExprPrev+endMarkPrev.length<line.length){
var begMark="${",endMark="}";
var begExpr=line.indexOf(begMark,endExprPrev+endMarkPrev.length);
if(begExpr<0)
break;
if(line.charAt(begExpr+2)=='%'){
begMark="${%";
endMark="%}";}
var endExpr=line.indexOf(endMark,begExpr+begMark.length);
if(endExpr<0)
break;
emitText(line.substring(endExprPrev+endMarkPrev.length,begExpr),funcText);
var exprArr=line.substring(begExpr+begMark.length,endExpr).replace(/\|\|/g,"#@@#").split('|');
for(var k in exprArr){
if(exprArr[k].replace)
exprArr[k]=exprArr[k].replace(/#@@#/g,'||');}
funcText.push('_OUT.write(');
emitExpression(exprArr,exprArr.length-1,funcText);
funcText.push(');');
endExprPrev=endExpr;
endMarkPrev=endMark;}
emitText(line.substring(endExprPrev+endMarkPrev.length),funcText);}
var emitText=function(text,funcText){
if(text==null||
text.length<=0)
return;
text=text.replace(/\\/g,'\\\\');
text=text.replace(/\n/g,'\\n');
text=text.replace(/"/g,'\\"');
funcText.push('_OUT.write("');
funcText.push(text);
funcText.push('");');}
var emitExpression=function(exprArr,index,funcText){
var expr=exprArr[index];
if(index<=0){
funcText.push(expr);
return;}
var parts=expr.split(':');
funcText.push('_MODIFIERS["');
funcText.push(parts[0]);
funcText.push('"](');
emitExpression(exprArr,index-1,funcText);
if(parts.length>1){
funcText.push(',');
funcText.push(parts[1]);}
funcText.push(')');}
var cleanWhiteSpace=function(result){
result=result.replace(/\t/g,"    ");
result=result.replace(/\r\n/g,"\n");
result=result.replace(/\r/g,"\n");
result=result.replace(/^(\s*\S*(\s+\S+)*)\s*$/,'$1');
return result;}
var scrubWhiteSpace=function(result){
result=result.replace(/^\s+/g,"");
result=result.replace(/\s+$/g,"");
result=result.replace(/\s+/g," ");
result=result.replace(/^(\s*\S*(\s+\S+)*)\s*$/,'$1');
return result;}
TrimPath.parseDOMTemplate=function(elementId,optDocument,optEtc){
if(optDocument==null)
optDocument=document;
var element=optDocument.getElementById(elementId);
var content=element.value;
if(content==null)
content=element.innerHTML;
content=content.replace(/&lt;/g,"<").replace(/&gt;/g,">");
return TrimPath.parseTemplate(content,elementId,optEtc);}
TrimPath.processDOMTemplate=function(elementId,context,optFlags,optDocument,optEtc){
return TrimPath.parseDOMTemplate(elementId,optDocument,optEtc).process(context,optFlags);}})();
/*pagination*/
jQuery.fn.pagination=function(maxentries,opts){
opts=jQuery.extend({
items_per_page:10,
num_display_entries:10,
current_page:0,
num_edge_entries:0,
link_to:"#",
prev_text:"Prev",
next_text:"Next",
ellipse_text:"...",
prev_show_always:true,
next_show_always:true,
callback:function(){return false;}},opts||{});
return this.each(function(){
function numPages(){
return Math.ceil(maxentries/opts.items_per_page);}
function getInterval(){
var ne_half=Math.ceil(opts.num_display_entries/2);
var np=numPages();
var upper_limit=np-opts.num_display_entries;
var start=current_page>ne_half?Math.max(Math.min(current_page-ne_half,upper_limit),0):0;
var end=current_page>ne_half?Math.min(current_page+ne_half,np):Math.min(opts.num_display_entries,np);
return[start,end];}
function pageSelected(page_id,evt){
current_page=page_id;
drawLinks();
var continuePropagation=opts.callback(page_id,panel);
if(!continuePropagation){
if(evt.stopPropagation){
evt.stopPropagation();}
else{
evt.cancelBubble=true;}}
return continuePropagation;}
function drawLinks(){
panel.empty();
var interval=getInterval();
var np=numPages();
if(np==1){
$(".Pagination").css({display:"none"});}
var getClickHandler=function(page_id){
return function(evt){return pageSelected(page_id,evt);}}
var appendItem=function(page_id,appendopts){
page_id=page_id<0?0:(page_id<np?page_id:np-1);
appendopts=jQuery.extend({text:page_id+1,classes:""},appendopts||{});
if(page_id==current_page){
var lnk=$("<a href='javascript:void(0)' class='current'>"+(appendopts.text)+"</a>");}
else{
var lnk=$("<a>"+(appendopts.text)+"</a>")
.bind("click",getClickHandler(page_id))
.attr('href',opts.link_to.replace(/__id__/,page_id));}
if(appendopts.classes){lnk.addClass(appendopts.classes);}
panel.append(lnk);}
if(opts.prev_text&&(current_page>0||opts.prev_show_always)){
appendItem(current_page-1,{text:opts.prev_text,classes:"prev"});}
if(interval[0]>0&&opts.num_edge_entries>0){
var end=Math.min(opts.num_edge_entries,interval[0]);
for(var i=0;i<end;i++){
appendItem(i);}
if(opts.num_edge_entries<interval[0]&&opts.ellipse_text){
jQuery("<span>"+opts.ellipse_text+"</span>").appendTo(panel);}}
for(var i=interval[0];i<interval[1];i++){
appendItem(i);}
if(interval[1]<np&&opts.num_edge_entries>0){
if(np-opts.num_edge_entries>interval[1]&&opts.ellipse_text){
jQuery("<span>"+opts.ellipse_text+"</span>").appendTo(panel);}
var begin=Math.max(np-opts.num_edge_entries,interval[1]);
for(var i=begin;i<np;i++){
appendItem(i);}}
if(opts.next_text&&(current_page<np-1||opts.next_show_always)){
appendItem(current_page+1,{text:opts.next_text,classes:"next"});}}
var current_page=opts.current_page;
maxentries=(!maxentries||maxentries<0)?1:maxentries;
opts.items_per_page=(!opts.items_per_page||opts.items_per_page<0)?1:opts.items_per_page;
var panel=jQuery(this);
this.selectPage=function(page_id){pageSelected(page_id);}
this.prevPage=function(){
if(current_page>0){
pageSelected(current_page-1);
return true;}
else{
return false;}}
this.nextPage=function(){
if(current_page<numPages()-1){
pageSelected(current_page+1);
return true;}
else{
return false;}}
drawLinks();});};
/*jdMarquee*/
(function($){$.fn.jdMarquee=function(option,callback){if(typeof option=="function"){callback=option;option={};};var s=$.extend({deriction:"up",speed:10,auto:false,width:null,height:null,step:1,control:false,_front:null,_back:null,_stop:null,_continue:null,wrapstyle:"",stay:5000,delay:20,dom:"div>ul>li".split(">"),mainTimer:null,subTimer:null,tag:false,convert:false,btn:null,disabled:"disabled",pos:{ojbect:null,clone:null}},option||{});var object=this.find(s.dom[1]);var subObject=this.find(s.dom[2]);var clone;if(s.deriction=="up"||s.deriction=="down"){var height=object.eq(0).outerHeight();var step=s.step*subObject.eq(0).outerHeight();object.css({width:s.width+"px",overflow:"hidden"});};if(s.deriction=="left"||s.deriction=="right"){var width=subObject.length*subObject.eq(0).outerWidth();object.css({width:width+"px",overflow:"hidden"});var step=s.step*subObject.eq(0).outerWidth();};var init=function(){var wrap="<div style='position:relative;overflow:hidden;z-index:1;width:"+s.width+"px;height:"+s.height+"px;"+s.wrapstyle+"'></div>";object.css({position:"absolute",left:0,top:0}).wrap(wrap);s.pos.object=0;clone=object.clone();object.after(clone);switch(s.deriction){default:case "up":object.css({marginLeft:0,marginTop:0});clone.css({marginLeft:0,marginTop:height+"px"});s.pos.clone=height;break;case "down":object.css({marginLeft:0,marginTop:0});clone.css({marginLeft:0,marginTop:-height+"px"});s.pos.clone=-height;break;case "left":object.css({marginTop:0,marginLeft:0});clone.css({marginTop:0,marginLeft:width+"px"});s.pos.clone=width;break;case "right":object.css({marginTop:0,marginLeft:0});clone.css({marginTop:0,marginLeft:-width+"px"});s.pos.clone=-width;break;};if(s.auto){initMainTimer();object.hover(function(){clear(s.mainTimer);},function(){initMainTimer();});clone.hover(function(){clear(s.mainTimer);},function(){initMainTimer();});};if(callback){callback();};if(s.control){initControls();}};var initMainTimer=function(delay){clear(s.mainTimer);s.stay=delay?delay:s.stay;s.mainTimer=setInterval(function(){initSubTimer()},s.stay);};var initSubTimer=function(){clear(s.subTimer);s.subTimer=setInterval(function(){roll()},s.delay);};var clear=function(timer){if(timer!=null){clearInterval(timer);}};var disControl=function(A){if(A){$(s._front).unbind("click");$(s._back).unbind("click");$(s._stop).unbind("click");$(s._continue).unbind("click");}else{initControls();}};var initControls=function(){if(s._front!=null){$(s._front).click(function(){$(s._front).addClass(s.disabled);disControl(true);clear(s.mainTimer);s.convert=true;s.btn="front";if(!s.auto){s.tag=true;};convert();});};if(s._back!=null){$(s._back).click(function(){$(s._back).addClass(s.disabled);disControl(true);clear(s.mainTimer);s.convert=true;s.btn="back";if(!s.auto){s.tag=true;};convert();});};if(s._stop!=null){$(s._stop).click(function(){clear(s.mainTimer);});};if(s._continue!=null){$(s._continue).click(function(){initMainTimer();});}};var convert=function(){if(s.tag&&s.convert){s.convert=false;if(s.btn=="front"){if(s.deriction=="down"){s.deriction="up";};if(s.deriction=="right"){s.deriction="left";}};if(s.btn=="back"){if(s.deriction=="up"){s.deriction="down";};if(s.deriction=="left"){s.deriction="right";}};if(s.auto){initMainTimer();}else{initMainTimer(4*s.delay);}}};var setPos=function(y1,y2,x){if(x){clear(s.subTimer);s.pos.object=y1;s.pos.clone=y2;s.tag=true;}else{s.tag=false;};if(s.tag){if(s.convert){convert();}else{if(!s.auto){clear(s.mainTimer);}}};if(s.deriction=="up"||s.deriction=="down"){object.css({marginTop:y1+"px"});clone.css({marginTop:y2+"px"});};if(s.deriction=="left"||s.deriction=="right"){object.css({marginLeft:y1+"px"});clone.css({marginLeft:y2+"px"});}};var roll=function(){var y_object=(s.deriction=="up"||s.deriction=="down")?parseInt(object.get(0).style.marginTop):parseInt(object.get(0).style.marginLeft);var y_clone=(s.deriction=="up"||s.deriction=="down")?parseInt(clone.get(0).style.marginTop):parseInt(clone.get(0).style.marginLeft);var y_add=Math.max(Math.abs(y_object-s.pos.object),Math.abs(y_clone-s.pos.clone));var y_ceil=Math.ceil((step-y_add)/s.speed);switch(s.deriction){case "up":if(y_add==step){setPos(y_object,y_clone,true);$(s._front).removeClass(s.disabled);disControl(false);}else{if(y_object<=-height){y_object=y_clone+height;s.pos.object=y_object;};if(y_clone<=-height){y_clone=y_object+height;s.pos.clone=y_clone;};setPos((y_object-y_ceil),(y_clone-y_ceil));};break;case "down":if(y_add==step){setPos(y_object,y_clone,true);$(s._back).removeClass(s.disabled);disControl(false);}else{if(y_object>=height){y_object=y_clone-height;s.pos.object=y_object;};if(y_clone>=height){y_clone=y_object-height;s.pos.clone=y_clone;};setPos((y_object+y_ceil),(y_clone+y_ceil));};break;case "left":if(y_add==step){setPos(y_object,y_clone,true);$(s._front).removeClass(s.disabled);disControl(false);}else{if(y_object<=-width){y_object=y_clone+width;s.pos.object=y_object;};if(y_clone<=-width){y_clone=y_object+width;s.pos.clone=y_clone;};setPos((y_object-y_ceil),(y_clone-y_ceil));};break;case "right":if(y_add==step){setPos(y_object,y_clone,true);$(s._back).removeClass(s.disabled);disControl(false);}else{if(y_object>=width){y_object=y_clone-width;s.pos.object=y_object;};if(y_clone>=width){y_clone=y_object-width;s.pos.clone=y_clone;};setPos((y_object+y_ceil),(y_clone+y_ceil));};break;}};if(s.deriction=="up"||s.deriction=="down"){if(height>=s.height&&height>=s.step){init();}};if(s.deriction=="left"||s.deriction=="right"){if(width>=s.width&&width>=s.step){init();}}}})(jQuery);