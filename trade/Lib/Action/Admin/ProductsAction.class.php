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
			$map ['name'] = array ('like', '%' . $_GET ['name'] . '%' );
		}
		if ($_GET ['cateid']) {
			$map ['cateid'] = $_GET ['cateid'];
		}
		$this->_list ($map);
		$this->display ();
	}
	function Insert() {
		//dump($_POST['imgurl']);
		//echo $_POST['isIndex'];
		for($i = 0; $i < count ( $_POST ['imgurl'] ); $i ++) {
			//判断是否为封面
			if ($_POST ['timestamp'] [$i] == $_POST ['isIndex']) {
				//echo "It is Index! ";
				$_POST ['bigimage'] = $_POST ['imgurl'] [$i];
				$_POST ['smallimage'] = get_thumb_name ( $_POST ['imgurl'] [$i] );
			}
		}
		if ($this->dao->create ()) {
			$id = $this->dao->add ();
			//插入相册开始
			for($i = 0; $i < count ( $_POST ['imgurl'] ); $i ++) {
				if (! empty ( $_POST ['imgurl'][$i] )) {
					$data ['pid'] = $id;
					$data ['img_url'] = $_POST ['imgurl'] [$i];
					$data ['thumb_url'] = get_thumb_name ( $_POST ['imgurl'] [$i] );
					$data ['img_desc'] = $_POST ['img_desc'] [$i];
					$data ['sort'] = $_POST ['sort'] [$i]; //sort
					$model = M ( "products_gallery" );
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
		$list = $this->dao->where ( $map )->find ();
		if ($list) {
			$this->list = $list;
			$model = M ( "products_gallery" );
			$this->glist=$model->where("pid=".$_GET ['id'])->order("sort")->findAll();
			$this->display ();
		} else {
			$this->error ( '没有数据！' );
		}
	
	}
	public function Update(){
	for($i = 0; $i < count ( $_POST ['imgurl'] ); $i ++) {
			//判断是否为封面
			if ($_POST ['timestamp'] [$i] == $_POST ['isIndex']) {
				//echo "It is Index! ";
				$_POST ['bigimage'] = $_POST ['imgurl'] [$i];
				$_POST ['smallimage'] = get_thumb_name ( $_POST ['imgurl'] [$i] );
			}
			if ($this->dao->create ()) {
				$list = $this->dao->save ();
				if ($list !== false) {
					$model = D( "products_gallery" );
					$model->where("pid=".$_POST ['id'])->delete();
					//更新相册开始
					for($i = 0; $i < count ( $_POST ['imgurl'] ); $i ++) {
						if (! empty ( $_POST ['imgurl'][$i] )) {
							$data ['pid'] = $_POST ['id'];
							$data ['img_url'] = $_POST ['imgurl'] [$i];
							$data ['thumb_url'] = get_thumb_name ( $_POST ['imgurl'] [$i] );
							$data ['img_desc'] = $_POST ['img_desc'] [$i];
							$data ['sort'] = $_POST ['sort'] [$i]; //sort							
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
	}

	public function easyupload(){
		//echo ACTION_NAME;
		$this->display();
	}
	public function doEasyUpload(){
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
					dump($fileinfo);
					$_POST['name']=$fileinfo['filename'];
				}				
				$_POST ['bigimage'] = $_POST ['imgurl'] [$i];
				$_POST ['smallimage'] = get_thumb_name ( $_POST ['imgurl'] [$i] );
				if ($this->dao->create()) {
					$id = $this->dao->add ();
					$_POST ['name']=$_POST['tmp_name'];
					//开始插入相册
					$_POST ['pid'] = $id;
					$_POST ['img_url'] = $_POST ['imgurl'] [$i];
					$_POST ['thumb_url'] = get_thumb_name ( $_POST ['imgurl'] [$i] );
					$model = D( "products_gallery" );
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
		//$this->success("本次操作共上传".$j."个新产品！");
	}
	function attredit(){
		//dump($_REQUEST['id']);
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
}
?>