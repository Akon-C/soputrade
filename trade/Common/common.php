<?php
/**
  * @author nanze
  * @link 
  * @todo 
  * @copyright 811046@qq.com
  * @version 1.0
  * @lastupdate 2010-11-15
*/ 
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
	}elseif(!empty($list[0]['product_name'])){
		$Meta.="<title>";
		$Meta.=!empty($list[0]['product_name'])?$list[0]['product_name']:'';
		$Meta.=!empty($list[1]['product_name'])?",".$list[1]['product_name']:'';
		$Meta.=!empty($list[2]['product_name'])?",".$list[2]['product_name']:'';
		$Meta.=!empty($list[3]['product_name'])?",".$list[3]['product_name']:'';
		$Meta.=!empty($list[4]['product_name'])?",".$list[4]['product_name']:'';
		$Meta.=" - $sitename</title>\n";
	}else{
		$Meta.="<title>$sitename</title>\n";
	}
	//关键词
	$Meta.='<meta name="keywords" content="';
	if(!empty($pagekeywords)){
		$Meta.=$pagekeywords;
	}elseif(!empty($list[0]['product_name'])){
		$Meta.=!empty($list[0]['product_name'])?$list[0]['product_name']:'';
		$Meta.=!empty($list[1]['product_name'])?",".$list[1]['product_name']:'';
		$Meta.=!empty($list[2]['product_name'])?",".$list[2]['product_name']:'';
		$Meta.=!empty($list[3]['product_name'])?",".$list[3]['product_name']:'';
		$Meta.=!empty($list[4]['product_name'])?",".$list[4]['product_name']:'';
	}else{
		$Meta.=GetSettValue('keywords')." - ".$sitename;
	}
	$Meta.=" - $sitename\" />\n";

	//描述
	$Meta.='<meta name="description" content="';
	if(!empty($pagedesc)){
		$Meta.=$pagedesc." - ".$sitename;
	}elseif(!empty($list[0]['product_name'])){
		$Meta.=!empty($list[0]['product_name'])?$list[0]['product_name']:'';
		$Meta.=!empty($list[1]['product_name'])?",".$list[1]['product_name']:'';
		$Meta.=!empty($list[2]['product_name'])?",".$list[2]['product_name']:'';
		$Meta.=!empty($list[3]['product_name'])?",".$list[3]['product_name']:'';
		$Meta.=!empty($list[4]['product_name'])?",".$list[4]['product_name']:'';
	}else{
		$Meta.=GetSettValue('description')." - ".$sitename;
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
			$count++;
		}		
	}
	return $data;	
}

//获取分类树
function get_catetree_arr() {
	if (S ( 'S_CATETREE' ) == "") {
		$classDAO = D( "cate" );
		$result = $classDAO->order ( 'sort desc' )->findall ();
		$arr = parse ( $result );
		S('S_CATETREE',$arr);
	}
	
	return S ( 'S_CATETREE' );
}
//获取节点树
function get_nodetree_arr() {
	$classDAO = D( "node" );
	$result = $classDAO->order ( 'sort' )->findall ();
	
	
	$arr = parse ( $result );
	return $arr;
}
//获取权限角色树

//class_tree


function get_roletree_arr() {
	$classDAO = D( "role" );
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
function GetSettValue($valuename){
	if (S('S_'.$valuename)==""){
		$setting=D('setting');
		$map=array();
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
		$setting	=	D('setting');
		$map['valuename']=$valuename;
		$info=$setting->where($map)->find();
		if ($info) {
			$date['valuetxt']=$valuetxt;
			$setting->where($map)->data($date)->save();
		}
		else {
			$d	=	D('setting');
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
	$dao=D("brand");
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
function getprice($price,$spe){
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
		return $_SESSION ['currency'] ['code'] . ($spe * $_SESSION ['currency'] ['rate']);
	} else {
		$price *= $_SESSION ['currency'] ['rate'];
		$spe *= $_SESSION ['currency'] ['rate'];
		return  '<Span style="color:red;text-decoration: line-through;">'.$_SESSION ['currency'] ['code'] . $price . '</Span>&nbsp;&nbsp;&nbsp;<Span style="color:red;">' . $_SESSION ['currency'] ['code'] . $spe . '</span><BR>Save:' . number_format ( (($price - $spe) / $price * 100), 2 ) . '% off';
	}
	
}
function getprice_str($price){
	return $_SESSION ['currency'] ['code'] . ($price * $_SESSION ['currency'] ['rate']);
}

/**
 * 替换冲突url名
 *
 * @param String $name
 * @return String 过滤后
 */
//返回类别导航条
function tourlstr($name){
	return str_replace(array('*','&','#','（','）',';',' '),'_',$name);
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

function sendmail($sendTo,$subject,$body){
	
	$body = eregi_replace ( "[\]", '', $body );	
	$headers = "MIME-Version: 1.0\r\n";
	$headers .= "Content-type: text/html; charset=utf-8\r\n";
	if (GetSettValue ( "sendemailtype" ) == "phpmail") {
		foreach ( $sendTo as $key => $val ) {
			mail ( $val, $subject, $body, $headers );
		}	
	}
	if (GetSettValue ( "sendemailtype" ) == "smtp") {
		import ( "@.ORG.phpmailer" );
		$mail = new PHPMailer();
		$mail->IsSMTP ();
		$mail->SMTPDebug = true;
		$mail->SMTPAuth = true;
		if (GetSettValue ( "smtpisssl" ) == "1") {
			$mail->SMTPSecure = "ssl";
		}
		$mail->Host = GetSettValue ( 'smtphost' );
		$mail->Port =GetSettValue( 'smtpport' );
		$mail->Username = GetSettValue ( 'smtpusername' );
		$mail->Password = GetSettValue ( 'smtppassword' ); // GMAIL password
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

?>