<?php
/**
 * @author nanze
 * @link 
 * @todo 
 * @copyright 811046@qq.com
 * @version 1.0
 * @lastupdate 2010-11-23
 */
class CateModel extends Model {
	protected $_validate=array(

	array('name','require','类别名必须填写!'),
	array('name','','类别名已经存在!',0,'unique',1),

	);
	/*protected $_auto = array (
	array('addtime','time',1,'function'),
	array('modify_time','time',1,'function'),
	);*/
	/**
	 * 取得该类别下的所有子类
	 */
	function getChildren($id) {
		static $children = array ();
		$data = $this->where ( array ('pid' => $id ) )->findall ();
		if (func_num_args () > 1) {
			$children [] = $id;
		}
		foreach ( $data as $k => $v ) {
			$children [] = $v ['id'];
			$this->getChildren ( $v ['id'] );
		}
		return $children;
	}
	
	function get_Children_Cate($id,$id) {
		$data = $this->where ( array ('pid' => $id ) )->findall ();

		$cateid='';
		if (func_num_args () > 1) {
			$cateid = $id;
		}
		foreach ( $data as $k => $v ) {
			if($v['pid']=$id){
				$cateid .= ','.$v['id'];
				$cateid .= $this->get_Children_Cate ($v ['id'] );
			}
		}
		return $cateid;
	}
	function get_cate_pro_num($id){
	$cate_id=$this->get_Children_Cate($id,$id);
	$pro=D("Products");
	$map['cateid']=array('in',$cate_id);
	return $pro->where($map)->count();
}
	/**
	 * 取得类别关键词
	 *
	 * @param Integer $cid
	 * @return String 关键词
	 */
	function getKeywords($cid) {
		$str_nav_class = md5 ( 'class_cid' . $cid );
		if (S ( $str_nav_class ) == '') {
			S ( $str_nav_class, $this->find ( $cid ) );
		} else {
			$list = S ( $str_nav_class );
		}
		if ($list) {
			if (empty ( $list ['pagekey'] )) {
				if ($list ['upid'] == 0) {
					$str .= ! empty ( $list ['name'] ) ? $list ['name'] : '';
					$str .= ! empty ( $list ['pagekey'] ) ? ',' . $list ['pagekey'] : '';
				} else {
					$str .= ! empty ( $list ['name'] ) ? $list ['name'] : '';
					$str .= "," . $this->getKeywords ( $list ['pid'] );
				}
			} else {
				$str .= ! empty ( $list ['name'] ) ? $list ['name'] : '';
				$str .= ! empty ( $list ['pagekey'] ) ? ',' . $list ['pagekey'] : '';
			}
		}
		return $str;
	}
	/**
	 * 取得类别描述
	 *
	 * @param Interger $cid
	 * @return String  描述
	 */
	function getDescription($cid) {
		$str_nav_class = md5 ( 'class_cid' . $cid );
		if (S ( $str_nav_class ) == '') {
			S ( $str_nav_class, $this->find ( $cid ) );
		} else {
			$list = S ( $str_nav_class );
		}
		if ($list) {
			if (empty ( $list ['pagedec'] )) {
				if ($list ['upid'] == 0) {
					$str .= ! empty ( $list ['name'] ) ? $list ['name'] : '';
					$str .= ! empty ( $list ['pagedec'] ) ? ',' . $list ['pagedec'] : '';
				} else {
					$str .= ! empty ( $list ['name'] ) ? $list ['name'] : '';
					$str .= "," . $this->getKeywords ( $list ['pid'] );
				}
			} else {
				$str .= ! empty ( $list ['name'] ) ? $list ['name'] : '';
				$str .= ! empty ( $list ['pagedec'] ) ? ',' . $list ['pagedec'] : '';
			}
		}
		return $str;
	}
	/**
	 * 取得类别title
	 *
	 * @param integer $cid
	 * @return String 标题
	 */
	function getPageTitle($cid) {
		$str_nav_class = md5 ( 'class_cid' . $cid );
		if (S ( $str_nav_class ) == '') {
			S ( $str_nav_class, $this->find ( $cid ) );
		} else {
			$list = S ( $str_nav_class );
		}
		if ($list) {
			if (empty ( $list ['pagetitle'] )) {
				if ($list ['upid'] == 0) {
					$str .= ! empty ( $list ['name'] ) ? $list ['name'] : '';
					$str .= ! empty ( $list ['pagetitle'] ) ? "-" . $list ['pagetitle'] : '';
				} else {
					$str .= ! empty ( $list ['name'] ) ? $list ['name'] : '';
					$str .= "-" . $this->getKeywords ( $list ['pid'] );
				}
			} else {
				$str .= ! empty ( $list ['name'] ) ? $list ['name'] : '';
				$str .= ! empty ( $list ['pagetitle'] ) ? '-' . $list ['pagetitle'] : '';
			}
		}
		return $str;
	}
}
?>