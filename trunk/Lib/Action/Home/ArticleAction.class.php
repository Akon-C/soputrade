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
			case isset($_REQUEST['News'])://新闻列表
				$this->disp_text="News";
				$model_cate=D('Article_cate');
				$pid=$model_cate->where(array('name'=>'新闻中心'))->getField("id");
				$map['pid']=$pid;
				$model->_list($this->view,$map,'id',false);
				
				$this->display ('Home:Article_list');
				break;
			case isset($_REQUEST['id'])://单独文章
				$list=$model->find(intval($_REQUEST['id']));
				$this->pagetitle=$list['title'];
				$this->pagekeywords=$list['keywords'];
				$this->pagedesc=$list['description'];
				$this->assign($list);
				$this->display ('Home:Article');
				break;
			case isset($_REQUEST['pid']):
				$map['pid']=intval($_REQUEST['pid']);
				$model->_list($this->view,$map,'id',false);
				$model=D('Article_cate');
				$cate=$model->where(array('id'=>intval($_REQUEST['pid'])))->find();
				$this->pagetitle=$cate['name'];
				$this->pagekeywords=$cate['keywords'];
				$this->pagedesc=$cate['description'];
				$this->disp_text=$cate['name'];
				$this->display ('Home:Article_list');
				break;
			default:
				$this->disp_text="Article";
				$model->_list($this->view,$map,'article_id',false);
				$this->display ('Home:Article_list');
		}


	}
}
?>