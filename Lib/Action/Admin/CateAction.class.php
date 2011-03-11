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
		if($this->isPost()){
			$this->key=$_POST['key'];
			$this->type=$_POST['type'];
			switch (true){
				case $_POST['type']=='id':
					$catetree=$this->dao->where(array('id'=>$_POST['key']))->findall();
					$this->assign('catetree',$catetree);
					break;
				case $_POST['type']=='name':
					$catetree=$this->dao->where(array('name'=>array('like','%'.$_POST['key'].'%')))->findall();
					$this->assign('catetree',$catetree);
					break;
				case $_POST['type']=='ishot':
					if(empty($_POST['key'])){
						$catetree=$this->dao->where(array('ishot'=>1))->findall();
					}else{
						$map['_string']="`ishot`='1' and (`name` like '%".$_POST['key']."%' or `id`='".$_POST['key']."')";
						$catetree=$this->dao->where($map)->findall();
					}
					$this->assign('catetree',$catetree);
					break;
				case $_POST['type']=='nothot':
					if(empty($_POST['key'])){
						$catetree=$this->dao->where(array('ishot'=>0))->findall();
					}else{
						$map['_string']="`ishot`='0' and (`name` like '%".$_POST['key']."%' or `id`='".$_POST['key']."')";
						$catetree=$this->dao->where($map)->findall();
					}
					$this->assign('catetree',$catetree);
					break;
			}

		}
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
	function delall(){
		if($_REQUEST['id']){
			foreach (array($_REQUEST['id']) as $id){

				if($id){
					$cate_ids=implode(',',$this->dao->getChildren($id,$id));

					$map['id']=array('in',$cate_ids);
					$imgurl=$this->dao->field('imgurl')->where($map)->findall();

					foreach ($imgurl as $img){
						$img=auto_charset($img,'utf-8','gbk');
						if(file_exists($img)){
							unlink($img);
						}
					}
					$this->dao->where ( $map )->delete ();
					cleanCache ();
					$this->ajaxReturn($cate_ids,'删除成功',1);
				}

			}

		}
		$this->error('删除失败，该类别不存在！');

	}
	function moveall(){
		if($_POST['id']){
			$cateid=intval($_POST['cateid']);
			if(!is_null($cateid)){
				foreach (array($_POST['id']) as $id){
					if($id && ($id != $cateid)){
						$map['id']=$id;
						$data['pid']=$cateid;
						$this->dao->where ( $map )->data($data)->save();
						$count=$this->dao->where ( $map )->count();
						cleanCache ();
						$this->ajaxReturn($id,'移动成功了'.$count.'个类别!',1);
					}

				}
			}else{
				$this->error('移动失败，请输入类别ID！');
			}

		}
		$this->error('移动失败，该类别不存在！');

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
				$j=$k=$l=0;
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
						//删除产品相册
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
						parent::$Model->where(array('pid'=>$v['id']))->delete();

						//删除关联产品数据
						parent::$Model=D("Products_related");
						parent::$Model->where(array("products_id"=>$v['id']))->delete();
						$l++;

					}
					//最后删除产品
					parent::$Model=D('Products');
					parent::$Model->where($map)->delete();
					$this->success('共删除了'.$count."个产品,其中删除了".$j."个产品图片,".$k."个相关图片,".$l."个关联!");
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