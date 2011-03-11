<?php
/**
  * @author nanze
  * @link 
  * @todo 
  * @copyright 811046@qq.com
  * @version 1.0
  * @lastupdate 2010-11-17
*/ 
$array=array(
'DO_OK'=>"Operation is successful",
);
$alipay	=	require LANG_PATH.C('DEFAULT_LANG').'/alipay.php';
$array= array_merge($alipay,$array);
$member=require LANG_PATH.C('DEFAULT_LANG').'/member.php';
$array= array_merge($member,$array);
$cart=require LANG_PATH.C('DEFAULT_LANG').'/cart.php';
$array= array_merge($cart,$array);
return $array;
?>