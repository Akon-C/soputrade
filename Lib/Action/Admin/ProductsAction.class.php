<?php
/**
 * @author nanze
 * @link 
 * @todo 
 * @copyright 811046@qq.com
 * @version 1.0
 * @lastupdate 2010-11-18
 */
class ProductsAction extends AdminCommAction {
	function productslist() {
		if ($_GET['name']){
			$name=auto_charset($_GET['name'],'gbk','utf-8');
			$map ['name'] = array ('like', '%' . $name . '%' );
			$map['id']=$name;
			$map['_logic']='or';
		}
		switch ($_GET ['cateid']){
			case 'isnew':
				$map['isnew']=1;
				break;
			case 'ishot':
				$map['ishot']=1;
				break;
			case 'isrec':
				$map['isrec']=1;
				break;
			case 'isprice':
				$map['isprice']=1;
				break;
			default:
				if(!empty($_GET ['cateid'])){
					$map ['cateid'] = $_GET ['cateid'];
					$this->cateid=$_GET['cateid'];
				}
		}

		$this->sort='id desc';
		$this->_list ($map);
		$this->display ();
	}
	function doSortUpdate(){
		$j=0;
		foreach($_POST['sort'] as $k=>$v){
			if($_POST['sort'][$k]!=''){
				if($this->dao->where(array('id'=>$k))->data(array('sort'=>$v))->save()){
					$j++;
				}
			}
		}
		$this->success('共修改了'.$j.'个类别排序!');
	}
	function move() {
		if(!empty($_REQUEST['id'])){
			$map['id']=array('in',$_REQUEST['id']);
			$data['cateid']=$_REQUEST['cateid'];
			if($count=$this->dao->where($map)->count()){
				$this->dao->where($map)->data($data)->save();

			}
			$this->success('成功移动了'.$count.'个产品!');
		}
		$this->error('请选择要转移的产品!');
	}
	function Delete() {
		if($_REQUEST['id']){

			$map ['id'] = array('in',$_REQUEST ['id']);
			$list = $this->dao->where ( $map )->findall ();
			if ($list) {
				parent::$Model = M ( "Products_gallery" );
				foreach ($list as $k=>$v){
					$v['bigimage']=auto_charset($v['bigimage'],'utf-8','gbk');
					$v['smallimage']=auto_charset($v['smallimage'],'utf-8','gbk');


					if(file_exists($v['bigimage'])){
						unlink($v['bigimage']);
					}
					if(file_exists($v['smallimage'])){
						unlink($v['smallimage']);
					}
					//删除产品相册
					$glist=parent::$Model->where(array("pid"=>$v['id']))->findAll();
					foreach ($glist as $g){
						$g['img_url']=auto_charset($g['img_url'],'utf-8','gbk');
						$g['thumb_url']=auto_charset($g['thumb_url'],'utf-8','gbk');
						if(file_exists($g['img_url'])){
							unlink($g['img_url']);
						}
						if(file_exists($g['thumb_url'])){
							unlink($g['thumb_url']);
						}
					}

					parent::$Model->where(array("pid"=>$v['id']))->delete();
					//删除关联产品连接
					parent::$Model=D("Products_related");
					parent::$Model->where(array("products_id"=>$v['id']))->delete();

				}
				$this->dao->where ( $map )->delete ();
			}

			$this->success ( "删除成功！" );
		}
		$this->error ( "删除失败！" );
	}
	function Insert() {

		for($i = 0; $i < count ( $_POST ['imgurl'] ); $i ++) {
			//判断是否为封面
			if (!empty($_POST ['imgurl'] [$i]) && $_POST ['timestamp'] [$i] == $_POST ['isIndex']) {
				//echo "It is Index! ";
				$_POST ['bigimage'] = $_POST ['imgurl'] [$i];
				$_POST ['smallimage'] = get_thumb_name ( $_POST ['imgurl'] [$i] );
			}
		}
		if(empty($_POST ['bigimage'])){
			for($i = 0; $i < count ( $_POST ['imgurl'] ); $i ++) {
				//取第一张做封面
				if(!empty($_POST ['imgurl'] [$i])){
					$_POST ['bigimage'] = $_POST ['imgurl'] [$i];
					$_POST ['smallimage'] = get_thumb_name ( $_POST ['imgurl'] [$i] );
				}
			}
		}


		if ($this->dao->create ()) {
			$id = $this->dao->add ();
			//插入相册开始
			$model = M ( "Products_gallery" );
			for($i = 0; $i < count ( $_POST ['imgurl'] ); $i ++) {
				if (! empty ( $_POST ['imgurl'][$i] ))
				{
					$data ['pid'] = $id;
					$data ['img_url'] = $_POST ['imgurl'] [$i];
					$data ['thumb_url'] = get_thumb_name ( $_POST ['imgurl'] [$i] );
					$data ['img_desc'] = $_POST ['img_desc'] [$i];
					empty($data['img_desc'])?$data['img_desc']=$_POST ['name']:'';
					$data ['sort'] = $_POST ['sort'] [$i]; //sort
					empty($data['sort'])?$data['sort']=$i:'';
					$model->add ( $data );
				}
			}
			//插入相册结束
			$this->success ( '添加成功！' );
		} else {
			$this->error ( $this->dao->getError () );
		}
	}

	public function edit() {
		$map ['id'] = $_GET ['id'];
		/**
		 * 关联产品
		 */
		parent::$Model=D("Products_related");
		$this->related=parent::$Model->field('a.id,b.name,b.smallimage')->table(C('DB_PREFIX').products_related." a")->join(C('DB_PREFIX').'products b on a.related_products_id = b.id')->where(array('a.products_id'=>$map['id']))->findall();
		unset($_SESSION['products_id']);

		$list = $this->dao->where ( $map )->find ();
		if ($list) {
			$this->list = $list;
			$model = M ( "Products_gallery" );
			$this->glist=$model->where("pid=".$_GET ['id'])->order("sort")->findAll();
			$this->display ();
		} else {
			$this->error ( '没有数据！' );
		}

	}
	/**
	 * 添加关联产品
	 *
	 */
	function addrelated() {
		if ($_GET['name']){
			$map ['name'] = array ('like', '%' . $_GET ['name'] . '%' );
		}
		if ($_GET ['cateid']) {
			$map ['cateid'] = $_GET ['cateid'];
		}

		$_SESSION['products_id']=$_SESSION['products_id']?$_SESSION['products_id']:$_GET['id'];//传参
		$this->id=$_SESSION['products_id'];
		/**
		 * 排除
		 */

		parent::$Model=D('Products_related');
		$neq_products_id=array_map('reset',parent::$Model->field('related_products_id')->where(array('products_id'=>$_SESSION['products_id']))->findall());

		$neq_products_id[]=$_SESSION['products_id'];
		$map['id']=array('not in',$neq_products_id);

		$this->_list ($map);
		$list=$this->get('list');

		parent::$Model=D('Products_gallery');
		foreach ($list as $k=>$v){
			$list[$k]['thumb_url']=__ROOT__."/".parent::$Model->where(array('pid'=>$v['id']))->getField('thumb_url');
		}
		$this->list=$list;
		$this->display ();
	}
	function doAddRelated(){
		parent::$Model=D('Products_related');
		$products_id=$_SESSION['products_id'];
		$ids=explode(",",$_REQUEST['id']);
		if(in_array($products_id,$ids)){
			$this->error('产品不能和自己关联!');
		}
		$j=0;
		foreach ($ids as $id){
			if(!parent::$Model->where(array('products_id'=>$products_id,'related_products_id'=>$id))->count()){
				$j++;
				parent::$Model->data(array('products_id'=>$products_id,'related_products_id'=>$id))->add();

			}
		}
		$this->success('增加了'.$j.'个关联产品!');
	}
	function doAddRelatedByCate(){
		parent::$Model=D('Products');
		$Products_list=parent::$Model->field('id')->where(array('cateid'=>$_POST['cateid']))->findall();
		$ids=array_map('reset',$Products_list);
		$products_id=$_SESSION['products_id'];
		parent::$Model=D('Products_related');
		$j=0;
		foreach ($ids as $id){
			if(($products_id!=$id) && !parent::$Model->where(array('products_id'=>$products_id,'related_products_id'=>$id))->count()){
				$j++;
				parent::$Model->data(array('products_id'=>$products_id,'related_products_id'=>$id))->add();

			}
		}
		$this->success('增加了'.$j.'个关联产品!');
	}
	function doDelRelated(){
		parent::$Model=D('Products_related');
		if($_REQUEST['id']){
			$map['id']=array('in',$_REQUEST['id']);
			$j=parent::$Model->where($map)->delete();
			$this->success('删除了'.$j.'个关联产品!');
		}
		$this->error('删除失败!');
	}
	public function Update(){

		for($i = 0; $i < count ( $_POST ['imgurl'] ); $i ++) {
			//判断是否为封面
			if (!empty($_POST ['imgurl'] [$i]) && $_POST ['timestamp'] [$i] == $_POST ['isIndex']) {
				//echo "It is Index! ";
				$_POST ['bigimage'] = $_POST ['imgurl'] [$i];
				$_POST ['smallimage'] = get_thumb_name ( $_POST ['imgurl'] [$i] );
			}

		}
		if(empty($_POST ['bigimage'])){
			for($i = 0; $i < count ( $_POST ['imgurl'] ); $i ++) {
				//取第一张做封面
				if(!empty($_POST ['imgurl'] [$i])){
					$_POST ['bigimage'] = $_POST ['imgurl'] [$i];
					$_POST ['smallimage'] = get_thumb_name ( $_POST ['imgurl'] [$i] );
				}
			}
		}

		if ($this->dao->create ()) {
			$list = $this->dao->save ();
			if ($list !== false) {
				$model = D( "Products_gallery" );
				$model->where("pid=".$_POST ['id'])->delete();
				//更新相册开始
				for($i = 0; $i < count ( $_POST ['imgurl'] ); $i ++) {
					if (! empty ( $_POST ['imgurl'][$i] )) {
						$data ['pid'] = $_POST ['id'];
						$data ['img_url'] = $_POST ['imgurl'] [$i];
						$data ['thumb_url'] = get_thumb_name ( $_POST ['imgurl'] [$i] );
						$data ['img_desc'] = $_POST ['img_desc'] [$i];
						$data ['sort'] = $_POST ['sort'] [$i]; //sort
						empty($data['img_desc'])?$data['img_desc']=$_POST ['name']:'';
						empty($data['sort'])?$data['sort']=$i:'';
						$model->add ( $data );
					}
				}
				//更新相册结束
				$this->success ( '数据更新成功！' );
			} else {
				$this->error ( "没有更新任何数据!" );
			}
		} else {
			$this->error ( $this->dao->getError () );
		}

	}

	public function easyupload(){
		//echo ACTION_NAME;
		if($this->isPost()){

			self::$Model=D("Cate");
			$typeid=self::$Model->field("type_id")->where(array('id'=>$_POST['cateid']))->getField('type_id');

			self::$Model=D("Type_attr");
			$attr=self::$Model->where(array('type_id'=>$typeid,'status'=>1))->order("sort desc")->findall();
			self::$Model=D("Products_attr");
			for ($row=0;$row<count($attr);$row++){
				$map1['attr_id']=$attr[$row]['id'];
				$attr[$row]['attrs']=self::$Model->where($map1)->group('attr_value')->findall();
				$attr[$row]['values']=explode(chr(13),$attr[$row]['values']);
				foreach ($attr[$row]['values'] as $k=>$v){
					$attr[$row]['values'][$k]=str_replace("\n","",$v);
				}
			}
			$this->attr=$attr;
			$this->cateid=$_POST['cateid'];
		}
		$this->display();
	}
	public function doEasyUpload(){
		if(!$_POST['cateid']){
			$this->error('请选择产品分类!');
		}
		//dump($_POST);
		$j=0;
		for($i=0;$i<count($_POST['imgurl']);$i++){
			if (! empty ( $_POST ['imgurl'][$i] )) {
				$j++;
				/*$data['name']=$_POST['name']."0".$j;
				$data['serial']=$_POST['serial'];
				$data['price']=$_POST['price'];
				$data['pricespe']=$_POST['pricespe'];
				$data['cateid']=$_POST['cateid'];
				$data['size']=$_POST['size'];
				$data['isnew']=$_POST['isnew'];
				$data['ishot']=$_POST['ishot'];
				$data['isrec']=$_POST['isrec'];
				$data['isprice']=$_POST['isprice'];
				$data['remark']=$_POST['remark'];
				$data['pagetitle']=$_POST['pagetitle'];
				$data['pagekey']=$_POST['pagekey'];
				$data['pagedec']=$_POST['pagedec'];*/
				if ($_POST ['name']) {
					$_POST ['tmp_name'] = $_POST ['name'];
					$_POST ['name'] = $_POST ['name'] . "0" . $j;
				}
				else{
					$fileinfo=pathinfo($_POST['imgname'][$i]);
					//dump($fileinfo);
					$_POST['name']=$fileinfo['filename'];
				}
				$_POST ['bigimage'] = $_POST ['imgurl'] [$i];
				$_POST ['smallimage'] = get_thumb_name ( $_POST ['imgurl'] [$i] );
				if ($this->dao->create()) {
					$id = $this->dao->add ();

					/**
				 * 插入属性bof
				 */
					self::$Model=D("Products_attr");
					foreach ($_POST ['attr_id'] as $key => $attr_id ) {

						foreach ( $_POST ['attr_value_' . $attr_id] as $key => $attr_value ) {
							if (!empty($attr_value))
							{
								//增加产品属性表
								$data ['products_id'] = $id;
								$data ['attr_id'] = $attr_id;
								$data ['attr_value'] = str_replace ( "\n", "", $attr_value );
								if (self::$Model->create ( $data )) {
									self::$Model->add ( $data );

								} else {
									$this->error ( self::$Model->geterror () );
								}
							}
						}
					}
					/**
				 * 属性eof
				 */

					$_POST ['name']=$_POST['tmp_name'];
					//开始插入相册
					$_POST ['pid'] = $id;
					$_POST ['img_url'] = $_POST ['imgurl'] [$i];
					$_POST ['thumb_url'] = get_thumb_name ( $_POST ['imgurl'] [$i] );
					$model = D( "Products_gallery" );
					if ($model->create ()) {
						$model->add ();
					} else {
						$this->error ( $this->dao->getError () );
					}
				}
				else {
					$this->error ( $this->dao->getError () );
				}

			}

		}
		$this->success("本次操作共上传".$j."个新产品！");
	}
	function attrdel(){
		$id=$_REQUEST["id"];
		self::$Model=D("Products_attr");
		self::$Model->where("id=".$id)->delete();
		echo json_encode($id);
		
	}
	function attrsave(){
		self::$Model=D("Products_attr");
		$id=$_REQUEST["id"];
		$data["attr_id"]=$_REQUEST["attr_id"];
		$data["attr_value"]=$_REQUEST["attr_value"];
		$data["products_id"]=$_REQUEST["products_id"];
		
		if (empty($data["attr_value"])){
			$r["status"]=0;
			echo json_encode($r);die;
		}
		if (empty($_REQUEST["attr_price"])){
			$data["attr_price"]=0;
		}
		else{
			$data["attr_price"]=$_REQUEST["attr_price"];
		}
		if ($id==0){
			$r["id"]=self::$Model->add($data);
			//echo self::$Model->getlastsql();
			$r["status"]=1;
			
			echo json_encode($r);die;
		}
		else{
			self::$Model->where("id=".$id)->save($data);
			$r["status"]=1;
			$r["id"]=$id;			
			echo json_encode($r);die;
		}
		
	}
	function attredit(){
		is_null($_REQUEST['id']) && $this->error('没有数据');
		if (is_array($_REQUEST['id'])){
			$map['id']=array("in",implode(",",$_REQUEST['id']));
			$this->pid=implode(",",$_REQUEST['id']);
		}
		else{
			$map['id']=$_REQUEST['id'];
			$this->pid=$_REQUEST['id'];
		}
		$cate=$this->dao->field("cateid")->where($map)->group("cateid")->findall();
		if (count($cate)>1){
			$this->error("请选择同一类别下的产品进行属性编辑！");
		}

		self::$Model=D("Cate");
		$typeid=self::$Model->field("type_id")->where("id=".$cate[0]['cateid'])->select();

		self::$Model=D("Type_attr");
		$attr=self::$Model->where("type_id=".$typeid[0]['type_id']." and status=1")->order("sort desc")->findall();
		self::$Model=D("Products_attr");
		for ($row=0;$row<count($attr);$row++){
			$map1['products_id']=$map['id'];
			$map1['attr_id']=$attr[$row]['id'];
			$attr[$row]['attrs']=self::$Model->where($map1)->findall();
			$attr[$row]['values']=explode(chr(13),$attr[$row]['values']);
			foreach ($attr[$row]['values'] as $k=>$v){
				$attr[$row]['values'][$k]=str_replace("\n","",$v);
			}
		}
		//dump($attr);
		$this->attr=$attr;
		$this->display();
	}
	function attrUpdate(){

		$products_id=explode(",",$_POST['products_id']);
		//先删除原来的属性
		self::$Model=D("Products_attr");
		$map['products_id']=array("in",$_POST['products_id']);
		self::$Model->where($map)->delete();
		//echo self::$Model->getlastsql();
		foreach ($products_id as $key=>$pid){
			foreach ( $_POST ['attr_id'] as $key => $attr_id ) {
				foreach ( $_POST ['attr_value_' . $attr_id] as $key => $attr_value ) {
					if (!empty($attr_value))
					{
						$data ['products_id'] = $pid;
						$data ['attr_id'] = $attr_id;
						$data ['attr_value'] = str_replace ( "\n", "", $attr_value );
						if (self::$Model->create ( $data )) {
							self::$Model->add ( $data );
							//echo self::$Model->getlastsql()."<br>";

						} else {
							$this->error ( self::$Model->geterror () );
						}
						//echo $pid . "-" . $attr_id . "-" . $attr_value . "<br>";
					}
				}
			}
		}
		$this->jumpUrl=U('Products/productslist');
		$this->success("操作成功！");
	}
	/**
	 * 批量修改产品属性
	 */
	function batchedit(){
		if($this->isPost()){

			self::$Model=D("Cate");
			$typeid=self::$Model->field("type_id")->where(array('id'=>$_POST['cateid']))->getField('type_id');

			self::$Model=D("Type_attr");
			$attr=self::$Model->where(array('type_id'=>$typeid,'status'=>1))->order("sort desc")->findall();
			self::$Model=D("Products_attr");
			for ($row=0;$row<count($attr);$row++){
				$map1['attr_id']=$attr[$row]['id'];
				$attr[$row]['attrs']=self::$Model->where($map1)->group('attr_value')->findall();
				$attr[$row]['values']=explode(chr(13),$attr[$row]['values']);
				foreach ($attr[$row]['values'] as $k=>$v){
					$attr[$row]['values'][$k]=str_replace("\n","",$v);
				}

			}
			$this->attr=$attr;
			$this->cateid=$_POST['cateid'];
		}
		$this->display();
	}
	function doBatchUpdate(){
		if($arr=$this->dao->create()){
			if(!$this->dao->cateid){
				$this->error('请选择修改类别!');
			}
			$cateModel=D("Cate");
			//更改所有子类别
			$cateid_list=$cateModel->getChildren($this->dao->cateid,$this->dao->cateid);
			$map['cateid']=array('in',implode(",",$cateid_list));
			//如果有产品则修改
			$count=$this->dao->where($map)->count();
			if($count){
				$data=array();
				foreach ($arr as $key=>$value){
					if($arr[$key] != ''){
						$data[$key]=$value;
					}
				}


				$this->dao->where($map)->data($data)->save();
				$str="修改了".$count."个产品";

				//产品id列表
				$products_list=$this->dao->where($map)->field('id')->findall();
				$products_id=array_map("reset",$products_list);
				//修改属性
				//先删除原来的属性
				self::$Model=D("Products_attr");
				unset($map);
				unset($data);
				$map['products_id']=array("in",$products_id);
				self::$Model->where($map)->delete();

				foreach ($products_id as $key=>$pid){
					foreach ($_POST ['attr_id'] as $key => $attr_id ) {

						foreach ( $_POST ['attr_value_' . $attr_id] as $key => $attr_value ) {
							if (!empty($attr_value))
							{
								//增加产品属性表
								$data ['products_id'] = $pid;
								$data ['attr_id'] = $attr_id;
								$data ['attr_value'] = str_replace ( "\n", "", $attr_value );
								if (self::$Model->create ( $data )) {
									self::$Model->add ( $data );

								} else {
									$this->error ( self::$Model->geterror () );
								}
							}
						}
					}
				}
				$this->success("修改成功!\n".$str);
			}else{
				$this->error('修改失败,该类别下没有产品!');
			}
		}else{
			$this->error($this->dao->getError());
		}


	}

	function SetStatus(){
		if($_REQUEST['id']){
			$type=$_REQUEST['type'];
			$id=$_REQUEST['id'];
			$time=time();
			$status=$this->dao->where(array('id'=>$id))->getField($type);
			if($status==1){
				$status=0;
				$data['imgurl']=__ROOT__.'/Tpl/default/Public/images/mod_0.gif';
			}else{
				$status=1;
				$data['imgurl']=__ROOT__.'/Tpl/default/Public/images/mod_1.gif';
			}
			$map['id']=$id;
			$data[$type]=$status;
			$this->dao->where($map)->data($data)->save();
			$this->ajaxReturn($data,'保存成功',1);
		}
	}
	function SetStatus2(){
		if($_REQUEST['id']){
			$type=$_REQUEST['type'];
			$id=$_REQUEST['id'];
			$time=time();
			$count=$this->dao->where(array('id'=>array('in',$id)))->count();
			$list=$this->dao->where(array('id'=>array('in',$id)))->findall();
			foreach ($list as $v){
				if($_REQUEST['reverse']==1){
					$this->dao->query("update __TABLE__ set `$type`=if(`$type`=1,0,1),`dateline`=\"$time\" where id={$v['id']};");
				}else{
					$this->dao->query("update __TABLE__ set `$type`=1,`dateline`=\"$time\" where id={$v['id']};");
				}
			}
			$this->success('成功设置'.$count.'个产品!');
		}
		$this->error('请选择产品');
	}

}
?>