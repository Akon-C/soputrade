<?php
/**
  * @author nanze
  * @link 
  * @todo 文章管理
  * @copyright 811046@qq.com
  * @version 1.0
  * @lastupdate 2010-11-18
*/ 
class ArticleAction extends AdminCommAction{
	public function __construct(){
		parent::__construct();
		$this->jumpUrl=U('Article/articlelist');
	}
	public function articlelist(){
		$this->sort='article_cateid desc';
		$this->_list();
		$list=$this->get('list');
		$article_cate_model=D('Article_cate');
		foreach ($list as $k=>$v){
			$list[$k]['article_caetname']=$article_cate_model->where(array('article_cateid'=>$v['article_cateid']))->getField('article_catename');
		}
		$this->assign('list',$list);
		$this->display();
	}
	public function add(){
		$this->cateoption=D('Article_cate')->cate_option();
		$this->display();
	}
	public function edit(){
		
		$list=$this->dao->where(array('article_id'=>$_REQUEST['article_id']))->find();
		if($list['article_cateid']){
			$this->cateoption=D('Article_cate')->cate_option(0,0,$list['article_cateid']);
		}else{
			$this->cateoption=D('Article_cate')->cate_option();
		}
		$this->list=$list;
		$this->display();
	}
	public function status(){
		$map['article_id']=intval($_REQUEST['article_id']);
		$status=$this->dao->where($map)->getField('status');
		$this->dao->where($map)->data(array('status'=>($status==1?0:1)))->save();


	}
	public function insert(){
		if($this->isPost()){
			
			if(false !== $this->dao->create()){
				if(false !== $this->dao->add()){
					$this->success('新增文章成功!');
				}else{
					$this->error('新增文章失败!');
				}
			}else{
				$this->error($this->dao->getError());
			}
		}

	}
	public function update(){
		if($this->isPost()){
			if(false !== $this->dao->create()){
				if(false !== $this->dao->save()){
					$this->success('修改文章成功!');
				}else{
					$this->error('修改文章失败!');
				}
			}else{
				$this->error($this->dao->getError());
			}
		}

	}
	public function delete() {
		$map ['article_id'] = array('in',$_REQUEST ['article_id']);
		if($list=$this->dao->where ($map)->findall()){
			if(false !== $this->dao->where ($map)->delete()){
				/**
				 * 删除相关图片
				 */
				foreach ($list as $value) {
					$img=iconv('utf-8','gbk',$value['imgurl']);
					if(file_exists($img)){
						unlink($img);
					}
				}
				$this->success("删除成功!");
			}else{
				$this->error('删除失败!');
			}
		}else{
			$this->error('请选择删除项!');
		}

	}
}
?>