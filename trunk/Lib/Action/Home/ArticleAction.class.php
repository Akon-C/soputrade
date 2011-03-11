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
		
		if(is_numeric(ACTION_NAME)){
			$_REQUEST['id']=ACTION_NAME;
		}elseif(strcasecmp('News',ACTION_NAME)==0){
			$_REQUEST['News']=1;
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
			case isset($_REQUEST['News']):
				$this->disp_text="News";
				$model_cate=D('Article_cate');
				$cateid=$model_cate->where(array('article_catename'=>'新闻中心'))->getField("article_cateid");
				$map['article_cateid']=$cateid;
				$model->_list($this->view,$map,'article_id',false);
				
				$this->display ('Home:Article_all');
				break;
			case isset($_REQUEST['id']):
				$list=$model->find(intval($_REQUEST['id']));
				$this->pagetitle=$list['article_title'];
				$this->pagekeywords=$list['keywords'];
				$this->pagedesc=$list['description'];
				$this->assign($list);
				$this->display ('Home:Article');
				break;
			case isset($_REQUEST['cateid']):
				$map['article_cateid']=intval($_GET['cateid']);
				$model->_list($this->view,$map,'article_id',false);
				$model=D('Article_cate');
				$cate=$model->where(array('article_cateid'=>intval($_GET['cateid'])))->find();
				$this->pagetitle=$cate['article_catename'];
				$this->pagekeywords=$cate['keywords'];
				$this->pagedesc=$cate['description'];
				$this->disp_text=$cate['article_catename'];
				$this->display ('Home:Article_all');
				break;
			default:
				$this->disp_text="Article";
				$model->_list($this->view,$map,'article_id',false);
				$this->display ('Home:Article_all');
		}


	}
}
?>