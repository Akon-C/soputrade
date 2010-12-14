<?php
/**
 * @author nanze
 * @link 
 * @todo 
 * @copyright 811046@qq.com
 * @version 1.0
 * @lastupdate 2010-11-18
 */
class CateAction extends AdminCommAction {

	function catelist(){
		cleanCache ();
		$this->display();
	}
	function doSortUpdate(){
		parent::$Model=D('Cate');
		$j=0;
		foreach($_POST['sort'] as $k=>$v){
			if($_POST['sort'][$k]!=''){
				if(parent::$Model->where(array('id'=>$k))->data(array('sort'=>$v))->save()){
					$j++;
				}
			}
		}
		$this->success('共修改了'.$j.'个类别排序!');
	}
	function Delete() {
		$map ['pid'] = $_GET ['id'];
		$i = $this->dao->where ( $map )->find ();
		if (! $i) {
			$map1['id']= $_GET ['id'];
			$img=$this->dao->where ( $map1 )->getField('imgurl');
			$img=auto_charset($img,'utf-8','gbk');
			if(file_exists($img)){
				unlink($img);
			}
			$this->dao->where ( $map1 )->delete ();
			$this->success ( "删除成功！" );
			cleanCache ();
		}
		else{
			$this->error('无法删除，还有下级分类！');
		}

	}
	function delProducts(){
		$id=intval($_REQUEST['id']);
		if($id){
			//获得所有子类
			parent::$Model=D('Cate');
			$cate_ids=implode(',',parent::$Model->getChildren($id,$id));
			if($cate_ids){
				//获得所有产品
				parent::$Model=D('Products');
				$map['cateid']=array('in',$cate_ids);
				$list=parent::$Model->where($map)->findall();
				$count=parent::$Model->where($map)->count();
				$j=$k=0;
				if($list){
					parent::$Model=D('Products_gallery');
					foreach ($list as $v) {
						$v['bigimage']=auto_charset($v['bigimage'],'utf-8','gbk');
						$v['smallimage']=auto_charset($v['smallimage'],'utf-8','gbk');
						if(file_exists($v['bigimage'])){
							$j++;
							unlink($v['bigimage']);
						}
						if(file_exists($v['smallimage'])){
							unlink($v['smallimage']);
						}
						//删除相关图片
						$g=parent::$Model->where(array('pid'=>$v['id']))->find();
						$g['img_url']=auto_charset($v['img_url'],'utf-8','gbk');
						$g['thumb_url']=auto_charset($v['thumb_url'],'utf-8','gbk');
						if(file_exists($v['img_url'])){
							$k++;
							unlink($v['img_url']);
						}
						if(file_exists($v['thumb_url'])){
							unlink($v['thumb_url']);
						}
						
					}
					//删除相关产品
					parent::$Model=D('Products');
					parent::$Model->where($map)->delete();
					$this->success('共删除了'.$count."个产品,其中删除了".$j."个产品图片,".$k."个相关图片!");
				}
			}
		}
		$this->error('没有数据!');
	}
	
	public function ishot(){
		$map['id']=intval($_REQUEST['id']);
		$ishot=$this->dao->where($map)->getField('ishot');
		if($ishot==1){
			$ishot=0;
			$data['imgurl']=__ROOT__.'/Tpl/default/Public/images/mod_0.gif';
		}else{
			$ishot=1;
			$data['imgurl']=__ROOT__.'/Tpl/default/Public/images/mod_1.gif';
		}
		$this->dao->where($map)->data(array('ishot'=>$ishot))->save();
		$this->ajaxReturn($data,'保存成功',1);

	}

}
?>