<?php
/**
 * @author nanze
 * @link 
 * @todo 
 * @copyright 811046@qq.com
 * @version 1.0
 * @lastupdate 2010-11-15
 */
class AdminCommAction extends Action {
	var $dao,$sort;
	protected static $Model=null;	//数据Model
	function _initialize() {
		$this->roletree = get_roletree_arr ();
		$this->nodetree = get_nodetree_arr ();
		$this->catetree = get_catetree_arr ();
		$this->brandtree = get_brand_tree ();
		self::$Model = D ( "Type_cate" );
		$this->type_id = self::$Model->where ( "status=1" )->order ( "id" )->findall ();
		self::$Model=D("Countries");
		$this->countries=self::$Model->getlist();
		if (in_array(MODULE_NAME,array('Brand','Cate','Node','Products','Role','Setting','User','Ad','Currencies','Members','Orders'))){
			$this->dao = D ( MODULE_NAME );
		}
		
		$this->userName = Session::get ( 'loginUserName' );
		//echo APP_NAME;
		// 用户权限检查
		if (C ( 'USER_AUTH_ON' ) && ! in_array ( MODULE_NAME, explode ( ',', C ( 'NOT_AUTH_MODULE' ) ) )) {
			import ( '@.ORG.RBAC' );
			if (! RBAC::AccessDecision ()) {
				
				//检查认证识别号
				if (! $_SESSION [C ( 'USER_AUTH_KEY' )]) {
					//跳转到认证网关
					redirect ( PHP_FILE . C ( 'USER_AUTH_GATEWAY' ) );
				}
				// 没有权限 抛出错误
				if (C ( 'RBAC_ERROR_PAGE' )) {
					// 定义权限错误页面
					redirect ( C ( 'RBAC_ERROR_PAGE' ) );
				} else {
					if (C ( 'GUEST_AUTH_ON' )) {
						$this->assign ( 'jumpUrl', PHP_FILE . C ( 'USER_AUTH_GATEWAY' ) );
					}
					// 提示错误信息
					$this->error ( L ( '_VALID_ACCESS_' ) );
				}
			}
		}
	}
	function upload() {
		
		import ( "ORG.Net.UploadFile" );
		$upload = new UploadFile ();
		//检查客户端上传文件参数设置
		if (isset ( $_POST ['_uploadFileSize'] ) && is_numeric ( $_POST ['_uploadFileSize'] )) {
			//设置上传文件大小
			$upload->maxSize = $_POST ['_uploadFileSize'];
		} else {
			$upload->maxSize = C ( 'FILE_UPLOAD_MAXSIZE' );
		}
		if (! empty ( $_POST ['_uploadFileType'] )) {
			//设置上传文件类型
			$upload->allowExts = explode ( ',', strtolower ( $_POST ['_uploadFileType'] ) );
		} else {
			$upload->allowExts = explode ( ',', C ( 'FILE_UPLOAD_ALLOWEXTS' ) );
		}
		
		if (! empty ( $_POST ['_uploadSavePath'] )) {
			//设置附件上传目录
			$upload->savePath = $_POST ['_uploadSavePath'];
		} else {
			$upload->savePath = "./Public/Uploads/" . MODULE_NAME . "/";
		}
		if (isset ( $_POST ['_uploadSaveRule'] )) {
			//设置附件命名规则
			$upload->saveRule = $_POST ['_uploadSaveRule'];
		} else {
			$upload->saveRule = 'uniqid';
		}
		if (MODULE_NAME == 'Products') {
			//创建目录
			$upload->savePath = $upload->savePath . toDate ( time (), 'Ymd' ) . "/";
			if (! file_exists ( "$upload->savePath" )) {
				mk_dir ( $upload->savePath );
			}
			//设置需要生成缩略图，仅对图像文件有效
			$upload->thumb = true;
			//设置需要生成缩略图的文件后缀
			//$upload->thumbSuffix = "_thumb";
			//设置缩略图最大宽度
			$upload->thumbMaxWidth = GetSettValue ( 'ImgThumbW' );
			//设置缩略图最大高度
			$upload->thumbMaxHeight = GetSettValue ( 'ImgThumbH' );
		}
		$upload->uploadReplace = true;
		if (! $upload->upload ()) {
			$error = $upload->getErrorMsg ();
			$this->ajaxReturn ( '', $error, 0 );
		} else {
			$uploadSuccess = true;
			$uploadList = $upload->getUploadFileInfo ();
			foreach ( $uploadList as $key => $file ) {
				$savename [] = $upload->savePath . $file ['savename'];
			}
			$this->ajaxReturn ( $savename, '上传成功！', 1 );
		}
	
	}
	function _list($map = null) {
		if (!$this->sort){
			$this->sort="sort";
		}
		$count = $this->dao->where ( $map )->count ();
		import ( 'ORG.Util.Page' );
		$page = new Page ( $count, 20 );
		foreach ( $map as $key => $val ) {
			$page->parameter .= "key=" . urlencode ( $val ) . "&";
		}
		$list = $this->dao->where ( $map )->order ( $this->sort )->limit ( $page->firstRow . ',' . $page->listRows )->findall ();
		$show = $page->show ();
		$this->list = $list;
		$this->show = $show;
	}
	function Delete() {
		$map ['id'] = $_GET ['id'];		
		$this->dao->where ( $map )->delete ();
		$this->success ( "删除成功！" );
	}
	public function edit() {
		$map ['id'] = $_GET ['id'];
		$list = $this->dao->where ( $map )->find ();
		if ($list) {
			$this->list = $list;
			
			$this->display ();
		} else {
			$this->error ( '没有数据！' );
		}
	
	}
	public function Update() {
		if (isset ( $_POST ['pid'] )) {
			if ($_POST ['id'] == $_POST ['pid']) {
				$this->error ( "无法更新数据!" );
			}
		}
		if ($this->dao->create ()) {
			$list = $this->dao->save ();
			if ($list !== false) {
				$this->success ( '数据更新成功！' );
				cleanCache ();
			} else {
				$this->error ( "没有更新任何数据!" );
			}
		} else {
			$this->error ( $this->dao->getError () );
		}
	}
	public function add() {
		$this->display ();
	}
	public function Insert() {
		if ($this->dao->create ()) {
			$id = $this->dao->add ();
			$this->success ( '添加成功！' );
		} else {
			$this->error ( $this->dao->getError () );
		}
	}
	
	public function admenage(){
		$this->display();
	}
}

?>