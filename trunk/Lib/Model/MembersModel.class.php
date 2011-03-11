<?php
/**
 * @author nanze
 * @link 
 * @todo 
 * @copyright 811046@qq.com
 * @version 1.0
 * @lastupdate 2010-11-26
 */
class MembersModel extends Model {
	protected $_validate = array (
	array ('firstname', 'require', 'Firstname is required!' ),
	 array ('lastname', 'require', 'Lastname is required!' ),

     array('email','email','Incorrect email format!',0),	 
	 //array ("email", "chkemail", "Incorrect email format!", 0, "callback" ),
	array ('repassword', 'password', 'Confirm password error!', self::EXISTS_VAILIDATE, 'confirm' ),
	array ('password', 'chkpwd', 'Incorrect password format!', self::EXISTS_VAILIDATE, 'callback' ),
	array ('email', 'uniqueEmail', 'The email have been registered!', self::EXISTS_VAILIDATE, 'callback',1 ) );
	protected $_auto=array(
	array('password','md5',1,'function'),
	array('createdate','time',1,'function'),
	array('lastlogindate','time',1,'function'),
	array('lastloginip','get_client_ip',1,'function'),
	);
	protected function chkpwd() {
		$password = $_REQUEST ['password'];
		if (strlen ( $password ) >= 6) {
			return true;
		} else {
			return false;
		}
	}
	protected function chkemail() {
		if (!eregi('^[a-z0-9]+([._\-]*[a-z0-9])*@([a-z0-9]+[-a-z0-9]*[a-z0-9]+.){2,63}[a-z0-9]+$', $_REQUEST ['email'] )) {
			return true;
		} else {
			return false;
		}
	
	}
	protected function uniqueEmail(){
		$list=$this->where("email='".$_REQUEST ['email'] ."'")->find();
		if ($list){
			return false;
		}
		else{
			return true;
		}
	}

	
}
?>