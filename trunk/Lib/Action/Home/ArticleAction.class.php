<?php
/**
 * @author nanze
 * @link 
 * @todo 
 * @copyright 811046@qq.com
 * @version 1.0
 * @lastupdate 2010-11-24
 */
class ArticleAction extends CommAction {
	public function _empty(){
		
		if(is_numeric(ACTION_NAME)){//单独文章
			$_REQUEST['id']=ACTION_NAME;
		}
		$this->index();
	}
	/**
	 * 文章新闻
	 *
	 */
	function index(){
		$model=D('Article');
		switch (true){
			case isset($_REQUEST['id'])://单独文章
				$list=$model->find(intval($_REQUEST['id']));
				if(!$list){
					parent::_empty();
					return;
				}
				$this->pagetitle=$list['title'];
				$this->pagekeywords=$list['keywords'];
				$this->pagedesc=$list['description'];
				$this->assign($list);
				$this->display ('Article');
				break;
			case isset($_REQUEST['pid'])://文章列表
				$map['pid']=intval($_REQUEST['pid']);
				$model->_list($this->view,$map,'id',false);
				$model=D('Article_cate');
				//seo
				$cate=$model->where(array('id'=>intval($_REQUEST['pid'])))->find();
				$this->pagetitle=$cate['name'];
				$this->pagekeywords=$cate['keywords'];
				$this->pagedesc=$cate['description'];
				$this->disp_text=$cate['name'];
				$this->display ('Article_list');
				break;
			default:
				parent::_empty();
				return;
			/*default:
				$this->disp_text="Article list";//所有列表
				$map['title']=array('neq','底部版权');
				$model->_list($this->view,$map,'id',false);
				$this->display ('Home:Article_list');*/
		}


	}
}
?>