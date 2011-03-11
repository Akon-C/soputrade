<?php
/**
  * @author nanze
  * @link 
  * @todo 文章类别管理
  * @copyright 811046@qq.com
  * @version 1.0
  * @lastupdate 2010-11-18
*/ 
class Article_cateAction extends AdminCommAction{
	public function __construct(){
		parent::__construct();
		$this->jumpUrl=U('Article_cate/catelist');
	}
	public function catelist(){
		
		$this->sort='article_parent_cateid desc';
		$this->_list();
		$list=$this->get('list');
		foreach ($list as $k=>$v){
			$list[$k]['article_parent_caetname']=$this->dao->where(array('article_cateid'=>$v['article_parent_cateid']))->getField('article_catename');
		}
		$this->assign('list',$list);
		$this->display();
	}
	public function add(){

		$this->cateoption=$this->dao->cate_option();
		$this->display();
	}
	public function edit(){
		$list=$this->dao->where(array('article_cateid'=>$_REQUEST['article_cateid']))->find();
		$this->list=$list;
		if($list['article_parent_cateid']){
			$this->cateoption=$this->dao->cate_option(0,0,$list['article_cateid']);
		}else{
			$this->cateoption=$this->dao->cate_option();
		}
		$this->display();
	}
	public function status(){
		$map['article_cateid']=intval($_REQUEST['article_cateid']);
		$status=$this->dao->where($map)->getField('status');
		if($status==1){
			$status=0;
			$data['imgurl']=__ROOT__.'/Tpl/default/Public/images/mod_0.gif';
		}else{
			$status=1;
			$data['imgurl']=__ROOT__.'/Tpl/default/Public/images/mod_1.gif';
		}
		$this->dao->where($map)->data(array('status'=>$status))->save();
		$this->ajaxReturn($data,'保存成功',1);

	}
	public function insert(){
		if($this->isPost()){
			if(false !== $this->dao->create()){
				if(false !== $this->dao->add()){
					$this->success('新增类别成功!');
				}else{
					$this->error('新增类别失败!');
				}
			}else{
				$this->error($this->dao->getError());
			}
		}

	}
	public function update(){
		if($this->isPost()){
			if(false !== $this->dao->create()){
				if($this->dao->article_cateid==$this->dao->article_parent_cateid){
					$this->error('上级类别不能为自已!');
				}
				$children=$this->dao->field('article_cateid')->where(array('article_parent_cateid'=>$this->dao->article_cateid))->findall();
				$children=array_map('reset',$children);
				
				if(in_array($this->dao->article_parent_cateid,$children)){
					$this->error('上级类别不能为自已子类!');
				}
				if(false !== $this->dao->save()){
					$this->success('修改类别成功!');
				}else{
					$this->error('修改类别失败!');
				}
			}else{
				$this->error($this->dao->getError());
			}
		}

	}
	public function delete() {
		$map ['article_cateid'] = array('in',$_REQUEST ['article_cateid']);
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