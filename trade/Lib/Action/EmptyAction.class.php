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
	
		$pathinfo = str_replace('.html','',ltrim($_SERVER ['PATH_INFO'],'/' ));
		
		switch (true){
			case strpos($pathinfo,'-pid-'):
				$page=explode("-pid-",$pathinfo);
				
				$_GET['pid']=$pid=intval($page[1]);
				$p=explode("-p-",$page[1]);
				if($p){
					$_GET['p']=intval($p[1]);
				}
				
				$this->good($pid);
				break;
			case strpos($pathinfo,'-cid-'):
				$page=explode("-cid-",$pathinfo);
				$_GET['cid']=$cid=intval($page[1]);
				$p=explode("-p-",$page[1]);
				if($p){
					$_GET['p']=intval($p[1]);
				}
				$this->cate($cid);
				break;
			case strpos($pathinfo,'-aid-'):
				$page=explode("-aid-",$pathinfo);
				$_GET['aid']=$aid=intval($page[1]);
				$p=explode("-p-",$page[1]);
				if($p){
					$_GET['p']=intval($p[1]);
				}
				$this->cate($aid);
				break;
			case substr($pathinfo,-1)=='/':
				$_GET['title']=$title=trim($pathinfo,'/');
				$this->article($title);
			default:
				parent::_empty();
				return;

		}

		return;
	}
	function good($pid) {
		$dao = D ( "Products" );

		$list = $dao->where ( "id=" . $pid )->find ();
		if ($list) {
			$dao->viewcounts ( $pid );
			$this->list = $list;
			//上一产品，下一产品
			$prev=$dao->where(array("id"=>array("lt",$pid)))->order('id desc')->find();
			$next=$dao->where(array("id"=>array("gt",$pid)))->order('id asc')->find();
			if($prev){
				$this->prev=build_url($prev,'pro_url');
			}
			if($next){
				$this->next=build_url($next,'pro_url');
			}
			//获取产品属性
			$attrlist=$dao->get_attrs($list['cateid'],$pid);
			$this->attrlist=$attrlist;
			$this->attrcount=count($attrlist[0]['attrs']);
			//获取同类产品
			$this->smaeclass=$dao->where(array('cateid'=>$list['cateid']))->limit(12)->findall();
			//获取关联产品
			$dao=D('Products_related');
			$this->related=$dao->field('b.*')->table(C('DB_PREFIX').'products_related a')->join(C('DB_PREFIX').'products b on a.related_products_id=b.id')->where(array('a.products_id'=>$pid))->limit(12)->findall();
			if(!$this->get('related')){
				$this->related=$this->smaeclass;
			}

			//欢迎词
			$dao= D('Ad');
			$this->welcome = $dao->where(array('remark'=>'产品内页欢迎词'))->getField('content');
			//获取产品
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
			$this->display ( 'Home:disp' );
		} else {
			$this->redirect ( 'Index/index' );
		}

	}
	function cate($cid) {
		$this->catep = get_catep_arr ( $cid );//导航
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

		$this->catec = $dao->where ( "pid=" . $cid )->order ( "sort desc" )->findAll ();//下级分类
		$dao = D ( "Products" );
		$dao->_list ( $this->view, array ('cateid' => array ('in', S ( $strFid_class ) ) ), 'sort', false );
		$this->cateinfo = get_cate_info ( $cid );
		$this->display ( 'Home:cate' );
	}
	function article($aid){
		parent::$Model=D('Article');
		if(!is_numeric($aid)){
			$title=auto_charset($aid,'utf-8','gbk');

			$aid=parent::$Model->where(array('article_title'=>$title))->getField('article_id');

		}
		if(!$aid){
			parent::_empty();
		}
		$article_cache=md5('article_'.$aid);
		if(S($article_cache)==''){
			$list=parent::$Model->find($aid);
			S($article_cache,$list);
		}
		$list= S($article_cache);

		$this->assign($list);
		$this->display ('Home:article');
	}
}
?>