<?php
/**
  * @author nanze
  * @link 
  * @todo 
  * @copyright 811046@qq.com
  * @version 1.0
  * @lastupdate 2010-11-15
*/ 
function product_history(){
	if(isset($_SESSION['product_history'])){
		$proModel=D("Products");
		$info=$proModel->where(array('id'=>array('in',$_SESSION['product_history'])))->findall();
		return $info;
	}
	return '';
}
 
function format_size($size) {
     $sizes = array(" Bytes", " KB", " MB", " GB", " TB", " PB", " EB", " ZB", " YB");
     if ($size == 0) { return('n/a'); } else {
     return (round($size/pow(1024, ($i = floor(log($size, 1024)))), $i > 1 ? 2 : 0) . $sizes[$i]); }
}

function products_ask($str){
	switch ($str){
		case 'Ask':
			return '询问';
		case 'Buy':
			return '购物';
		case 'Other':
			return '其它';
		default:
			return $str;
	}
}
function orderstatus_convert($status,$lang='en'){
	if($lang=='en'){
		switch ($status){
			case '等待中':
				return 'Pending';
			case '处理中':
				return 'Processing';
			case '已关闭':
				return 'Close';
			case '已发货':
				return 'Delivered';
			default:
				return $status;
		}
	}else{
		switch ($status){
			case 'Pending':
				return '等待中';
			case 'Processing':
				return '处理中';
			case 'Close':
				return '已关闭';
			case 'Delivered':
				return '已发货';
			default:
				return $status;
		}
	}
}
function build_url($vo,$type){
	switch ($type){
		case 'pro_url':
			return U(tourlstr($vo['name']).'@',array('pid'=>$vo['id']));
		case 'pid':
			return U(tourlstr($vo['name']).'@',array('pid'=>$vo['pid']));
		case 'pro_name':
			return $vo['name'];
		case 'pro_smallimage':
			return __ROOT__.'/'.$vo['smallimage'];
		case 'pro_bigimage':
			return __ROOT__.'/'.$vo['bigimage'];
		case 'altimg':
			if(GetSettValue('isBigimg')==0){
				return '';
			}
			return __ROOT__.'/'.$vo['bigimage'];
		case 'pro_price':
			return getprice($vo['price'],$vo['pricespe']);//特价表示
			//return $vo['price'];
		case 'pro_pricespe':
			return $vo['pricespe'];
		case 'cate_url':
			return U(tourlstr($vo['name']).'@',array('cid'=>$vo['id']));
		case 'cate_name':
			return $vo['name'];
		case 'cate_img':
			return __ROOT__.'/'.$vo['imgurl'];
		case 'g_bigimage':
			return __ROOT__.'/'.$vo['img_url'];
		case 'g_smallimage':
			return __ROOT__.'/'.$vo['thumb_url'];
		case 'hotmail'://msn
		return "msnim:chat?contact=".GetSettValue($vo);
		case 'yahoo'://yahoo
		return "ymsgr:sendIM?".GetSettValue($vo);
		case 'email'://email
		return "mailto:".GetSettValue($vo);
		case 'skype'://skype
		return "callto://".GetSettValue($vo);
		case 'qq'://qq
		return "tencent://Message/?Menu=YES&Uin=".GetSettValue($vo)."&websiteName=im.qq.com";
		case 'gtalk'://gtalk
		return "gtalk:chat?jid=".GetSettValue($vo)."&from_jid=";
	}

}
//调用购物车购买数量
function itemCount(){
	return D( "Cart" )->get_item_count ( Session::get ( 'sessionID' ) );
}
function cart_total(){
	return D( "Cart" )->cart_total ( Session::get ( 'sessionID' ) );
}
function toDate($time, $format = 'Y-m-d H:i:s') {
	if (empty ( $time )) {
		return '';
	}
	$format = str_replace ( '#', ':', $format );
	return date ($format, $time );
}

/**
	 +----------------------------------------------------------
 * 获取缩略图名称
	 +----------------------------------------------------------
 * @param string $filename 原图名称
	 +----------------------------------------------------------
 * @return string
	 +----------------------------------------------------------
 */
function get_thumb_name($filename){
	$file_part=pathinfo($filename);
	return $file_part['dirname']."/thumb_".$file_part['basename'];
}
function get_client_ip() {
	if (getenv ( "HTTP_CLIENT_IP" ) && strcasecmp ( getenv ( "HTTP_CLIENT_IP" ), "unknown" ))
	$ip = getenv ( "HTTP_CLIENT_IP" );
	else if (getenv ( "HTTP_X_FORWARDED_FOR" ) && strcasecmp ( getenv ( "HTTP_X_FORWARDED_FOR" ), "unknown" ))
	$ip = getenv ( "HTTP_X_FORWARDED_FOR" );
	else if (getenv ( "REMOTE_ADDR" ) && strcasecmp ( getenv ( "REMOTE_ADDR" ), "unknown" ))
	$ip = getenv ( "REMOTE_ADDR" );
	else if (isset ( $_SERVER ['REMOTE_ADDR'] ) && $_SERVER ['REMOTE_ADDR'] && strcasecmp ( $_SERVER ['REMOTE_ADDR'], "unknown" ))
	$ip = $_SERVER ['REMOTE_ADDR'];
	else
	$ip = "unknown";
	return ($ip);
}
function get_sn(){
	return toDate(time(),'YmdHis');
}
function getOrderSN(){
	$dao=D('Orders');
	$OrderNo	= $dao->query("show table status where name='__TABLE__'");
	return "PP".sprintf("%04d",$OrderNo[0]['Auto_increment']);
}
/**
 * 输出Meta内容
 *
 * @param String $pagetitle 标题
 * @param String $pagekeywords 关键词
 * @param String $pagedesc 描述
 * @param String $list 相关信息
 */
function Meta($pagetitle='',$pagekeywords='',$pagedesc='',$list=''){
	$sitename=GetSettValue('sitename');
	$Meta="";
	//标题
	if(!empty($pagetitle)){
		$Meta.="<title>$pagetitle - $sitename</title>\n";
	}elseif(!empty($list[0]['name'])){
		$Meta.="<title>";
		$Meta.=!empty($list[0]['name'])?$list[0]['name']:'';
		$Meta.=!empty($list[1]['name'])?",".$list[1]['name']:'';
		$Meta.=!empty($list[2]['name'])?",".$list[2]['name']:'';
		$Meta.=!empty($list[3]['name'])?",".$list[3]['name']:'';
		$Meta.=!empty($list[4]['name'])?",".$list[4]['name']:'';
		$Meta.=" - $sitename</title>\n";
	}else{
		$Meta.="<title>$sitename</title>\n";
	}
	//关键词
	$Meta.='<meta name="keywords" content="';
	if(!empty($pagekeywords)){
		$Meta.=$pagekeywords;
	}elseif(!empty($list[0]['name'])){
		$Meta.=!empty($list[0]['name'])?$list[0]['name']:'';
		$Meta.=!empty($list[1]['name'])?",".$list[1]['name']:'';
		$Meta.=!empty($list[2]['name'])?",".$list[2]['name']:'';
		$Meta.=!empty($list[3]['name'])?",".$list[3]['name']:'';
		$Meta.=!empty($list[4]['name'])?",".$list[4]['name']:'';
	}else{
		$Meta.=GetSettValue('keywords');
	}
	$Meta.=" - $sitename\" />\n";

	//描述
	$Meta.='<meta name="description" content="';
	if(!empty($pagedesc)){
		$Meta.=$pagedesc;
	}elseif(!empty($list[0]['name'])){
		$Meta.=!empty($list[0]['name'])?$list[0]['name']:'';
		$Meta.=!empty($list[1]['name'])?",".$list[1]['name']:'';
		$Meta.=!empty($list[2]['name'])?",".$list[2]['name']:'';
		$Meta.=!empty($list[3]['name'])?",".$list[3]['name']:'';
		$Meta.=!empty($list[4]['name'])?",".$list[4]['name']:'';
	}else{
		$Meta.=GetSettValue('description');
	}
	$Meta.=" - $sitename\" />\n";

	$Meta.="<meta name=\"generator\" content=\"www.0594trade.com\" />\n";
	$Meta.="<meta name=\"anthor\" contnet=\"811046@qq.com\" />\n";
	return $Meta;
}
/**
	 +----------------------------------------------------------
 * 产生随机字串，可用来自动生成密码
 * 默认长度6位 字母和数字混合 支持中文
	 +----------------------------------------------------------
 * @param string $len 长度
 * @param string $type 字串类型
 * 0 字母 1 数字 其它 混合
 * @param string $addChars 额外字符
	 +----------------------------------------------------------
 * @return string
	 +----------------------------------------------------------
 */
function rand_string($len = 6, $type = '', $addChars = '') {
	$str = '';
	switch ($type) {
		case 0 :
			$chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz' . $addChars;
			break;
		case 1 :
			$chars = str_repeat ( '0123456789', 3 );
			break;
		case 2 :
			$chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ' . $addChars;
			break;
		case 3 :
			$chars = 'abcdefghijklmnopqrstuvwxyz' . $addChars;
			break;
		default :
			// 默认去掉了容易混淆的字符oOLl和数字01，要添加请使用addChars参数
			$chars = 'ABCDEFGHIJKMNPQRSTUVWXYZabcdefghijkmnpqrstuvwxyz23456789' . $addChars;
			break;
	}
	if ($len > 10) { //位数过长重复字符串一定次数
		$chars = $type == 1 ? str_repeat ( $chars, $len ) : str_repeat ( $chars, 5 );
	}
	if ($type != 4) {
		$chars = str_shuffle ( $chars );
		$str = substr ( $chars, 0, $len );
	} else {
		// 中文随机字
		for($i = 0; $i < $len; $i ++) {
			$str .= msubstr ( $chars, floor ( mt_rand ( 0, mb_strlen ( $chars, 'utf-8' ) - 1 ) ), 1 );
		}
	}
	return $str;
}
function pwdHash($password, $type = 'md5') {
	return hash ( $type, $password );
}
function getGroupName($id) {
	if ($id == 0) {
		return '无上级组';
	}
	$dao = D( "Role" );
	$list = $dao->find ( array ('id' => $id ) );

	$name = $list ['name'];
	return $name;
}
function getNodeName($id) {
	if ($id == 0) {
		return '无上级组';
	}
	$dao = D( "Node" );
	$list = $dao->find ( array ('id' => $id ) );

	$name = $list ['title'];
	return $name;
}

function getStatus($status, $imageShow = false) {
	switch ($status) {
		case 0 :
			$showText = '禁用';
			$showImg = '<IMG SRC="../Public/images/mod_0.gif" WIDTH="15" HEIGHT="15" BORDER="0" ALT="禁用">';
			break;
		case 2 :
			$showText = '待审';
			$showImg = '<IMG SRC="' . WEB_PUBLIC_PATH . '/Images/prected.gif" WIDTH="15" HEIGHT="15" BORDER="0" ALT="待审">';
			break;
		case - 1 :
			$showText = '删除';
			$showImg = '<IMG SRC="' . WEB_PUBLIC_PATH . '/Images/del.gif" WIDTH="15" HEIGHT="15" BORDER="0" ALT="删除">';
			break;
		case 1 :
			$showText = '正常';
			$showImg = '<IMG SRC="../Public/images/mod_1.gif" WIDTH="15" HEIGHT="15" BORDER="0" ALT="正常">';

	}
	return ($imageShow === true) ?  $showImg  : $showText;
}
//树的前字符操作
function class_str_insert($deep, $str) {
	$r = "";
	for($i = 0; $i < $deep; $i ++) {
		$r .= $str;
	}
	return $r;
}

//获取前台分类树
function get_indexcate_arr($pid=0){
	if (S ( 'S_INDEXCATETREE' ) == "") {
		S('S_INDEXCATETREE',get_subcate_arr());
	}
	return S ( 'S_INDEXCATETREE' );
}
function get_subcate_arr($pid=0){
	$data=array();
	$cate=get_catetree_arr();
	$count=0;
	for($i=0;$i<count($cate);$i++){
		if ($cate[$i]['pid']==$pid){
			$data[$count]=$cate[$i];
			$data[$count]['sub']=get_subcate_arr($cate[$i]['id']);
			$data[$count]['subcount']=count(get_subcate_arr($cate[$i]['id']));
			//$data[$count]['procount']=get_cate_pro_num($cate[$i]['id'],$cate[$i]['id']);
			$count++;
		}
	}
	return $data;
}

//获取分类树
function get_catetree_arr() {
	if (S ( 'S_CATETREE' ) == "") {
		$classDAO = D( "Cate" );
		$result = $classDAO->order ( 'sort desc' )->findall ();
		$arr = parse ( $result );
		S('S_CATETREE',$arr);
	}

	return S ( 'S_CATETREE' );
}
//获取节点树
function get_nodetree_arr() {
	$classDAO = D( "Node" );
	$result = $classDAO->order ( 'sort' )->findall ();


	$arr = parse ( $result );
	return $arr;
}
//获取权限角色树

//class_tree


function get_roletree_arr() {
	$classDAO = D( "Role" );
	$result = $classDAO->order ( 'sort' )->findall ();

	/*	foreach($result as $var){
	$arr[count($arr)]=$var;
	$arr=get_classtree_arr($var['cid'],$arr);
	}*/
	$arr = parse ( $result );
	return $arr;
}
function parse($tree_arr) {
	uasort ( $tree_arr, "parent_cmp" );
	$tree = array ();
	$index = array ();
	$deep = 0;
	foreach ( $tree_arr as $v ) {
		if ($v ['pid'] == 0) {
			$key = '0_' . $v ['sort'] . '_' . $v ['id'] . '_';
			$v ['deep'] = 0;
			$v ['key'] = $key;
			$tree [$key] = $v;
		} else {
			$key = $index [$v ['pid']] ['key'] . '_' . $v ['pid'] . '_' . $v ['sort'] . '_' . $v ['id'] . '_';
			$v ['deep'] = count ( explode ( '_', $key ) ) / 4 - 1;
			$v ['key'] = $key;
			$tree [$key] = $v;
		}
		$index [$v ['id']] = & $tree [$key];
	}
	usort ( $tree, 'kcmp' );
	return $tree;
}
function kcmp($a, $b) {
	$akl = strlen ( $a ['key'] );
	$bkl = strlen ( $b ['key'] );
	if ($akl < $bkl && substr ( $b ['key'], 0, $akl ) == $a ['key'])
	return - 1;
	elseif ($akl > $bkl && substr ( $a ['key'], 0, $bkl ) == $b ['key'])
	return 1;
	return strnatcmp ( $b ['key'], $a ['key'] );
}
function parent_cmp($a, $b) {
	if ($a ['pid'] == $b ['pid'])
	return 0;
	return $a ['pid'] > $b ['pid'] ? 1 : - 1;
}

/**
 * 返回存储的值
 *
 * @param String $valuename 名称
 * @return String 值
 */
function GetSettValue($valuename,$cache=true){
	if (S('S_'.$valuename)=="" || !$cache){
		$setting=D('Setting');
		$map['valuename']=$valuename;
		$settInfo=$setting->where($map)->find();
		if(false == $settInfo) {
			return  null;
		}
		else {
			S('S_'.$valuename,$settInfo['valuetxt']);
			return S('S_'.$valuename);
		}
	}
	else {
		return S('S_'.$valuename);
	}
}
/**
 * 快速保存一个值到数据库
 * @param String $valuename 名称
 * @param String $valuetxt 值
 */

function SetSettValue($valuename,$valuetxt=null){
	//echo $valuename."-".$valuetxt."<br>";
	if(is_null($valuetxt)){
		return true;
	}else{
		$setting	=	D('Setting');
		$map['valuename']=$valuename;
		$info=$setting->where($map)->find();
		if ($info) {
			$date['valuetxt']=$valuetxt;
			$setting->where($map)->data($date)->save();
		}
		else {
			$d	=	D('Setting');
			$data['valuename']=$valuename;
			$data['valuetxt']=$valuetxt;
			$d->add($data);

		}
		return true;
	}
}
function cleanCache() {
	import ( "ORG.Io.Dir" );
	if (file_exists ( './Runtime' )) {
		Dir::delDir ( './Runtime' );
	}
}
function get_brand_tree(){
	$dao=D("Brand");
	return $dao->where("status=1")->order("sort")->findAll();
}
//取得广告代码

function get_ad_arr($code) {
	if (S ( 'S_AD_' . $code ) == "") {
		$dao = D ( "Ad" );
		S ( 'S_AD_' . $code, $dao->where ( "code='" . $code."'" )->order ( "sort desc" )->findAll ()) ;
	}
	return S ( 'S_AD_' . $code );
}

//获取货币
function get_currencies_arr(){
	if (S ( 'S_CURRENCIES'  ) == ""){
		$dao = D ( "Currencies" );
		S ( 'S_CURRENCIES',$dao->order ( "sort desc" )->findAll ()  );

	}
	return S ( 'S_CURRENCIES'  );
}
/**
 * 获取价格
 *
 * @param Integer $price 价格
 * @param Integer $spe 特价
 */
function getprice($price,$spe,$discount=true){
	//如果没有选择汇率，读取系统默认汇率
	$currencies=get_currencies_arr();
	if (! isset ( $_SESSION ['currency'] )) {
		for($row = 0; $row < count ( $currencies ); $row ++) {
			if ($currencies [$row] ['symbol'] == C ( 'DEFAULT_CURRENCIES_SYMBOL' )) {
				$_SESSION ['currency'] = $currencies [$row];
			}
		}
	}
	if ( $spe >=$price) {
		//货币汇率
		$re= $_SESSION ['currency'] ['code'] . ($price * $_SESSION ['currency'] ['rate']);
		$r_price=$price;
	} else {
		$price *= $_SESSION ['currency'] ['rate'];
		$spe *= $_SESSION ['currency'] ['rate'];
		if($discount){
			$re=  '<Span style="color:red;text-decoration: line-through;">'.$_SESSION ['currency'] ['code'] . $price . '</Span>&nbsp;&nbsp;&nbsp;<Span style="color:red;">' . $_SESSION ['currency'] ['code'] . $spe . '</span><BR>Save:' . number_format ( (($price - $spe) / $price * 100), 2 ) . '% off';
		}else{
			$re= $_SESSION ['currency'] ['code'] . $spe;
		}
		$r_price=$spe;
	}
	$memberID = Session::get ( 'memberID' );
	//在价格里头显示vip价格
	if (!$memberID) {
		$memberID = 0;
	}
	$ginfo=get_members_group($memberID);
	if($ginfo){
		if($discount){
			return $re." ".$ginfo["name"].":".$_SESSION ['currency'] ['code'] .$r_price*$ginfo["discount"];
		}
		else{
			return $re;
		}
		
	}
	return $re;
		

}
function getprice_str($price){
	return "<strong style='color:red;font-weight: bold;'>".$_SESSION ['currency'] ['code'] . ($price * $_SESSION ['currency'] ['rate'])."</strong>";
}

/**
 * 替换冲突url名
 *
 * @param String $name
 * @return String 过滤后
 */
//返回类别导航条
/*function tourlstr($name){
return str_replace(array('*','&','#','（','）',';',' '),'_',$name);
}*/
function tourlstr($string){
	if (preg_match("/[\x{4e00}-\x{9fa5}]+/u", $string)) {
		return $string;
	}
	$depr=C('URL_PATHINFO_DEPR');
	$regex='/[^-a-zA-z0-9_ ]/';
	$string=preg_replace($regex,'',$string);
	$string=trim($string);
	$string=preg_replace('/[-_ ]+/','-',$string);
	$regex="/".
	$depr."(".C('VAR_GROUP').'|'.
	C('VAR_MODULE').'|'.
	C('VAR_ACTION').'|'.
	C('VAR_ROUTER').'|'.
	C('VAR_TEMPLATE').'|'.
	C('VAR_AJAX_SUBMIT').'|'.
	C('VAR_PATHINFO').")".$depr."/";
	$string=preg_replace($regex,"_$1_",$string);//中间
	$regex="/".
	$depr."(".C('VAR_GROUP').'|'.
	C('VAR_MODULE').'|'.
	C('VAR_ACTION').'|'.
	C('VAR_ROUTER').'|'.
	C('VAR_TEMPLATE').'|'.
	C('VAR_AJAX_SUBMIT').'|'.
	C('VAR_PATHINFO').")$/";
	$string=preg_replace($regex,"_$1",$string);//结尾
	return $string;
}
function get_cate_info($cid){
	$cate=get_catetree_arr();
	for ($row=0;$row<count($cate);$row++){
		if ($cate[$row]['id']==$cid) {
			return $cate[$row];
		}
	}
}

function get_catep_arr($cid) {
	$cate = get_cate_info ( $cid );
	$arr = explode ( "__", $cate ['key'] );
	//dump($arr);
	for ($row=0;$row<count($arr);$row++){
		$subarr = explode ( "_", $arr[$row] );
		//dump($subarr);
		$r [] = get_cate_info ( $subarr [2] );
	}
	return $r;
}
function get_country($id){
	$dao=D("Countries");
	$list=$dao->where("countries_id=".$id)->find();
	return $list['countries_name'];
}
function get_orders_status($id){
	$dao=D("Orders");
	$status=$dao->field("orders_status")->where("id=".$id)->find();
	return L("orders_status_".$status["orders_status"]);
}
function get_members_name($id){
	$dao=D("Members");
	$list=$dao->field("name")->where("id=".$id)->find();
	return $list['name'];
}
//获取属性的输入方式名称
function get_type_inputtype_name($type){
	switch ($type) {
		case "0": return "手工录入";break;
		case "1":return "从列表中选择";break;
	}

}
//发送邮件
function sendmail($sendTo,$subject,$body){

	$body = eregi_replace ( "[\]", '', $body );
	$headers = "MIME-Version: 1.0\r\n";
	$headers .= "Content-type: text/html; charset=utf-8\r\n";
	if (GetSettValue ( "sendemailtype" ) == "smtp") {
		foreach ( $sendTo as $key => $val ) {
			mail ( $val, $subject, $body, $headers );
		}
	}
	if (GetSettValue ( "sendemailtype" ) == "phpmail") {
		import ( "@.ORG.phpmailer" );
		$mail = new PHPMailer();
		$mail->IsSMTP ();
		$mail->SMTPDebug = false;
		$mail->SMTPAuth = true;
		if (GetSettValue ( "smtpisssl" ) == "1") {
			$mail->SMTPSecure = "ssl";
		}
		$mail->Host = GetSettValue ( 'smtphost' );
		$mail->Port =GetSettValue( 'smtpport' );
		$mail->Username = GetSettValue ( 'smtpusername' );
		$mail->Password = GetSettValue ( 'smtppassword' ); // GMAIL password
		if(empty($mail->Host) || empty($mail->Port) || empty($mail->Username) || empty($mail->Password)){
			return;
		}
		$mail->SetFrom ( GetSettValue ( 'mailfrom' ),GetSettValue ( 'siteurl' ));
		$mail->Subject = $subject;
		$mail->AltBody = "To view the message, please use an HTML compatible email viewer!";
		$mail->MsgHTML ( $body );
		foreach ( $sendTo as $key => $val ) {
			$mail->AddAddress($val);
		}
		$mail->Send();
	}

}
function get_orders_Fees($total){
	//四舍五入，保留 2 位
	//$cart_total = $dao->cart_total ( Session::get ( 'sessionID' ) );
	$r=array();
	$r["products_total"]=$total;
	switch (GetSettValue('no_shipping')){
		case 'qty':
			$dao = D ( "Cart" );
			$Count = $dao->get_item_totalcount ( Session::get ( 'sessionID' ) );
			$r['shippingmoney']=0;
			/*if ($Count<=GetSettValue("min_freeshippingqty")){

				$r['shippingmoney']=number_format(GetSettValue("shippingmoney"),2, '.', '');
			}
			else{
				$r['shippingmoney']=0;
			}*/
			break;
		case 'amount':
		default:
			$r['shippingmoney']=0;
			/*if ($total<=GetSettValue("min_freeshippingmoney")){
				$r['shippingmoney']=number_format(GetSettValue("shippingmoney"),2, '.', '');
			}
			else{
				$r['shippingmoney']=0;
			}*/
	}
	if ($total<=GetSettValue("min_insurance")){
		$r['insurance']=number_format($Count*GetSettValue("insurance"),2, '.', '');
	}
	else{
		$r['insurance']=0;
	}
	if ($total<=GetSettValue("min_freepaymoney")){
		$fee=$r['shippingmoney']+$r['insurance']+$total;
		$r['paymoney']=number_format((float)$fee*(float)GetSettValue("paymoney"),2, '.', '');
	}
	else{
		$r['paymoney']=0;
	}

	$r['total']=number_format($total+$r['shippingmoney']+$r['paymoney']+$r['insurance'],2, '.', '');
	return $r;
} 
//3.10更新

function get_members_points($uid){
	$dao=D("Members");
	$map["id"]=$uid;
	$list=$dao->where($map)->find();
	if ($list){
		return $list["points"];
	}
	else{
		return 0;
	}
}
function get_members_group($uid){
	$points=get_members_points($uid);
	$dao=D("Members_group");
	$map["minpoints"]=array("elt",$points);
	$map["maxpoints"]=array("egt",$points);
	$list=$dao->where($map)->find();
	if ($list){
		return $list;
	}
	else{
		return null;
	}	
	
}
/**
 * 赠送用户积分
 *
 * @param String $sn 订单编号
 * 
 */
function give_member_points($sn){
	$dao = D ( "Orders" );
	$list = $dao->where ( "sn=" . $sn )->find ();
	
	if ($list) {
		$orders_id = $list ["id"];
		$member_id=$list["member_id"];
		$dao = D ( "Orders_products" );
		$list=$dao->where("orders_id=".$orders_id)->findAll();
		if ($list){
			$dao=D("Members");
			for ($i=0;$i<count($list);$i++){				
				$dao->setInc("points","id=".$member_id,get_products_points($list[$i]["products_id"]));
				
			}
		}
	}
	
}
function get_products_points($pid){
	$dao=D("Products");
	$list=$dao->where("id=".$pid)->find();
	if ($list){
		return $list["points"];
	}
	else{
		return 0;
	}
}
//3.10更新
//3.17更新
function get_region_name($id){
	$dao = D ( "Region" );
	$list = $dao->where ( "id=" . $id )->find ();
	if ($list) {
		return $list ["name"];
	} else {
		return null;
	}
	
}
//获取运费
function get_shipping_fee($shippingid,$countyid,$stateid,$weight){
	$fee=array();
	$dao=D("Shipping_area");
	$list=$dao->where("shipping_id=".$shippingid)->findall();
	if ($list){
		for($i = 0; $i < count ( $list ); $i ++) {
			if (in_array ( $stateid, unserialize ( $list [$i] ["config"] ) )) {
				return shipping_fee($list[$i],$weight);
			}
			else{
				if (in_array ( $countyid, unserialize ( $list [$i] ["config"] ) )) {
					return shipping_fee($list[$i],$weight);
				}
				else{
					return 0;
				}
			}
		}
	}
	else{
		return 0;
	}
}
function shipping_fee($fee,$weight){
	if ($weight<=1){
		return $fee["base_fee"];
	}
	else{
		
		$r=$fee["base_fee"]+($weight-1)*$fee["step_fee"];
		if ($r<=$fee["free_money"]){
			return 0;
		}
		else{
			return $r;
		}
	}
	//return $fee["base_fee"];
}


?>