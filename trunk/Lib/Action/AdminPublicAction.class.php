<?php
/**
 * @author nanze
 * @link 
 * @todo 
 * @copyright 811046@qq.com
 * @version 1.0
 * @lastupdate 2010-11-15
 */
class AdminPublicAction extends Action {
	public function __construct(){
		C('TMPL_ACTION_ERROR','Public:success'); // 默认错误跳转对应的模板文件
		C('TMPL_ACTION_SUCCESS','Public:success'); // 默认成功跳转对应的模板文件
		parent::__construct();
	}
	public function adminlogin() {
		//echo Session::get(C('USER_AUTH_KEY'));
		if (! Session::get ( C ( 'USER_AUTH_KEY' ) )) {
			$this->display ();
		} else {
			$this->redirect ( 'Admin/Index' );
		}

	}
	public function verify() {
		import ( "ORG.Util.Image" );
		Image::buildImageVerify ();
	}
	public function doLogin() {
		$map ['account'] = $_POST ['account'];
		$map ['status'] = array ('gt', 0 );
		if ($_SESSION ['verify'] != md5 ( $_POST ['verify'] )) {
			$this->error ( "验证码错误！" );
		}
		import ( '@.ORG.RBAC' );
		$authInfo = RBAC::authenticate ( $map );
		if (! $authInfo) {
			$this->error ( '登录错误：可能这个账户已被禁用！' );
	}
	if ($authInfo ['password'] != md5 ( $_POST ['password'] )) {
		$this->error ( '登录失败：密码错误！' );
	}
	$model=D('User');
	$model->find($authInfo ['id']);
	$model->last_login_time=time();
	$model->last_login_ip=get_client_ip();
	$model->save();
	Session::set ( C ( 'USER_AUTH_KEY' ), $authInfo ['id'] );
	Session::set ( 'email', $authInfo ['email'] );
	Session::set ( 'loginUserName', !empty($authInfo ['nickname'])?$authInfo ['nickname']:$authInfo['account'] );
	Session::set ( 'login_count', $authInfo ['login_count'] );
	if($authInfo['isadministrator']==1){
		Session::set ( 'administrator', true );
	}
	RBAC::saveAccessList ();
	$this->success ( '登录成功！' );
}

}

?>