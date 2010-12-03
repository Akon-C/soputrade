<?php
/**
 * @author nanze
 * @link 
 * @todo 
 * @copyright 811046@qq.com
 * @version 1.0
 * @lastupdate 2010-11-24
 */
class EmptyAction extends CommAction {
	function _empty() {
		$pathinfo = explode ( "-", $_SERVER ['PATH_INFO'] );
		$count = count ( $pathinfo );
		for($i = 0; $i < $count; $i ++) {
			if ($pathinfo [$i] == 'cid') {
				$_GET ['cid'] = $pathinfo [$i + 1];
			}
			if ($pathinfo [$i] == 'pid') {
				$_GET ['pid'] = $pathinfo [$i + 1];
			}
			if ($pathinfo [$i] == 'p') {
				$_GET ['p'] = $pathinfo [$i + 1];
			}
		}
		if (isset ( $_GET ['pid'] ) && ! empty ( $_GET ['pid'] )) {
			$this->good ( intval ( $_GET ['pid'] ) );
			//echo "goods";
		} elseif (isset ( $_GET ['cid'] ) && ! empty ( $_GET ['cid'] )) {
			$this->cate ( intval ( $_GET ['cid'] ) );
			//echo "cate";
		} else {
			$this->redirect ( 'Index/index' );
		}
		return;
	}
	function good($pid) {
		$dao = D ( "Products" );
		
		$list = $dao->where ( "id=" . $pid )->find ();
		if ($list) {
			$dao->viewcounts ( $pid );
			$this->list = $list;
			//获取产品属性
			$attrlist=$dao->get_attrs($list['cateid'],$pid);
			$this->attrlist=$attrlist;
			$this->attrcount=count($attrlist[0]['attrs']);
			//相册
			$dao = D ( "Products_gallery" );
			$this->gallerys = $dao->where ( "pid=" . $pid )->order ( "sort desc" )->findAll ();
			$this->catep = get_catep_arr ( $list ['cateid'] );
			$classModel=D("Cate");
			$classid=$list ['cateid'];
			//尺码
			$this->sizes = explode ( ",", $list ['size'] );
			$this->sizes_count = count ( explode ( ",", $list ['size'] ) );
			//SEO相关
			if (! empty ( $list ['pagekey'] )) {
				$this->assign ( 'pagekeywords', $list ['name'] . ',' . $list ['pagekey'] );
			} else {
				$this->assign ( 'pagekeywords', $classModel->getKeywords ( $classid ) );
			}
			
			if (! empty ( $list ['pagedec'] )) {
				$this->assign ( 'pagedesc', $list ['name'] . ',' . $list ['pagedec'] );
			} else {
				$this->assign ( 'pagedesc', $classModel->getDescription ( $classid ) );
			}
			if (! empty ( $list ['pagetitle'] )) {
				$this->assign ( 'pagetitle', $list ['name'] . ',' . $list ['pagetitle'] );
			} else {
				$this->assign ( 'pagetitle', $list ['name'] . ',' . $classModel->getPageTitle ( $classid ) );
			}
			$this->display ( 'disp', 'Empty' );
		} else {
			$this->redirect ( 'Index/index' );
		}
	
	}
	function cate($cid) {
		$this->catep = get_catep_arr ( $cid );
		//获取下级分类
		$dao = D ( "Cate" );
		
		$this->assign('pagekeywords',$dao->getKeywords($cid));//关键字
		$this->assign('pagedesc',$dao->getDescription($cid));//描述
		$this->assign('pagetitle',$dao->getPageTitle($cid));//标题
		$strFid_class = 'Fid_class' . $cid;
		if (S ( $strFid_class ) == '') {
			$classChildren = $dao->getChildren ( $cid );
			$classChildren [count ( $classChildren )] = $cid;
			S ( $strFid_class, implode ( ",", $classChildren ) ); //取得所有子类
		}
		
		$this->catec = $dao->where ( "pid=" . $cid )->order ( "sort desc" )->findAll ();
		$dao = D ( "Products" );
		$dao->_list ( $this->view, array ('cateid' => array ('in', S ( $strFid_class ) ) ), 'sort', false );
		$this->cateinfo = get_cate_info ( $cid );
		$this->display ( 'cate', 'Empty' );
	}
}
?>