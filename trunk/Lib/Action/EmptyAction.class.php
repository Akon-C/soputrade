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
			case false!==strpos($pathinfo,'-pid-'):
				$page=explode("-pid-",$pathinfo);

				$_GET['pid']=$pid=intval($page[1]);
				$p=explode("-p-",$page[1]);
				if($p){
					$_GET['p']=intval($p[1]);
				}

				$this->good($pid);
				break;
			case false!==strpos($pathinfo,'-cid-'):
				$page=explode("-cid-",$pathinfo);
				$_GET['cid']=$cid=intval($page[1]);
				$p=explode("-p-",$page[1]);
				if($p){
					$_GET['p']=intval($p[1]);
				}
				$this->cate($cid);
				break;
			case false!==strpos($pathinfo,'-aid-'):
				$page=explode("-aid-",$pathinfo);
				$_GET['aid']=$aid=intval($page[1]);
				$p=explode("-p-",$page[1]);
				if($p){
					$_GET['p']=intval($p[1]);
				}
				$this->cate($aid);
				break;
			case 0==strcasecmp($pathinfo,'Sitemap'):
				$this->sitemap();
				break;
			case substr($pathinfo,-1)=='/':
				$_GET['title']=$title=trim($pathinfo,'/');
				$this->article($title);
				break;
			default:
				parent::_empty();
				return;

		}

		return;
	}
	function good($pid) {
		$dao = D ( "Products" );
		if(isset($_POST['id'])){
			$pid=intval($_POST['id']);
		}
		$list = $dao->where ( "id=" . $pid )->find ();
		if ($list) {
			$dao->viewcounts ( $pid );
			//添加用户最近浏览的产品
			if(!isset($_SESSION['product_history']) ) {
				$_SESSION['product_history']=$pid;
			} else {

				if(!$broswer_history_num=GetSettValue('broswer_history_num')){
					$broswer_history_num=6;
				}
				$history_array = explode(',',$_SESSION['product_history']);
				array_push($history_array,(int)$pid);
				$history_array = array_unique($history_array);
				if(count($history_array) > $broswer_history_num){
					array_shift($history_array);
				}
				$_SESSION['product_history']=implode(',',$history_array);
			}
			//ajax属性价格
			if(isset($_POST['attr_id'])){
				$products_attr_model=D("Products_attr");
				$map['id']=array('in',$_POST['attr_id']);
				$products_attr=$products_attr_model->where($map)->findall();
				$attrs=array();
				if($products_attr){
					$attrs['price']=0;
					foreach ($products_attr as $attr){
						$attrs['price']+=$attr['attr_price'];
					}
					if($attrs['price']){
						$attrs['product_price']=getprice_str(VipPrice($list['pricespe'])+$attrs['price']);
						$attrs['attr_price']='('.getprice_str(VipPrice($list['pricespe'])).($attrs['price']>0?'+':'').getprice_str($attrs['price']).')';
					}else{
						$attrs['product_price']=getprice_str($list['pricespe']);
						$attrs['attr_price']='';
					}
					die(json_encode($attrs));
				}
			}
			$this->list = $list;
			//获取Vip价格
			$this->vipPrice=VipPrice(get_real_price($list["price"],$list["pricespe"]));
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
			if(!$attrlist[0]['attrs']){
				$attrlist[0]['name']='size';
				$attrlist[0]['value']=array('nosize');
				$attrlist[0]['values_count']=1;
				$attrlist[0]['attrs']=array(0=>array('attr_value'=>'nosize'));
			}
			$this->attrlist=$attrlist;
			$this->attrcount=count($attrlist[0]['attrs']);


			if(!$realted_num=GetSettValue('realted_num')){
				$realted_num=6;
			}

			//获取同类产品
			$this->sameclass=$dao->where(array('cateid'=>$list['cateid']))->limit($realted_num)->findall();
			//类别产品数量
			$this->cate_count=$dao->where(array('cateid'=>$list['cateid']))->count();
			//产品位置
			$this->postion=reset($dao->field('count(*)+1 as postion')->where("id<'".$pid."' and cateid='".$list['cateid']."'")->order('id desc')->find());
			//获取关联产品
			$dao=D('Products_related');
			$this->related=$dao->field('b.*')->table(C('DB_PREFIX').'products_related a')->join(C('DB_PREFIX').'products b on a.related_products_id=b.id')->where(array('a.products_id'=>$pid))->limit($realted_num)->findall();
			if(!$this->get('related')){
				$this->related=$this->get('sameclass');
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
			//类别信息
			$cate=$classModel->where(array('id'=>$list['caetid']))->find();
			$classid=$list ['cateid'];
			$this->cateid=$classid;
			//尺码
			/*$this->sizes = explode ( ",", $list ['size'] );
			$this->sizes_count = count ( explode ( ",", $list ['size'] ) );*/
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
			$this->display("Home:disp");
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

		if($_REQUEST['order']){
			$order=$_REQUEST['order'];
		}else{
			$order='id';
		}
		if($_REQUEST['sort']=='asc'){
			$sort=true;
		}else{
			$sort=false;
		}
		$this->sort=$sort;
		$this->order=$order;
		$dao->_list ( $this->view, array ('cateid' => array ('in', S ( $strFid_class ) ) ), $order,$sort );
		$cateinfo = get_cate_info ( $cid );
		$this->cateinfo = $cateinfo;
		$this->pagetitle=$cateinfo['pagetitle'];
		$this->pagekeywords=$cateinfo['pagekey'];
		$this->pagedesc=$cateinfo['pagedec'];
		$this->cateid=$cid;
		$this->display("Home:cate");
	}
	function article($aid){
		parent::$Model=D('Article');
		$title=auto_charset($aid,'utf-8','gbk');
		$map['title']=$title;
		$aid=parent::$Model->where($map)->getField('id');
		//如果没有找到404
		if(!$aid){
			parent::_empty();
		}
		$article_cache=md5('article_'.$aid);
		if(S($article_cache)==''){
			$list=parent::$Model->find($aid);
			$list['title']=str_replace("-"," ",$list['title']);
			S($article_cache,$list);
		}
		$list= S($article_cache);
		$this->assign($list);
		//seo
		$this->pagetitle=$list['title'];
		$this->pagekeywords=$list['keywords'];
		$this->pagedesc=$list['description'];
		$this->display("Home:Article");
	}
	function sitemap(){
		$this->pagetitle='Sitemap';
		$this->pagekeywords='Sitemap';
		$this->pagedesc='Sitemap';
		$this->display("Home:sitemap");
	}
}
?>