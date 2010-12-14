<?php
/**
 * @author nanze
 * @link 
 * @todo 
 * @copyright 811046@qq.com
 * @version 1.0
 * @lastupdate 2010-11-23
 */
class ProductsModel extends Model {
	

	
	protected $_validate = array (
	array ('name', 'checknamelen', 'Products name too long!', self::EXISTS_VAILIDATE, 'callback' ),
	array('name','require','产品名称必须填写!'),
	array('name','','产品名称已经存在!',0,'unique',1),
	);
	protected function checknamelen(){
		if (strlen($_REQUEST['name'])>=60){
			return false;
		}
		else{
			return true;
		}
	}
	/**
	 * 分页
	 *
	 * @param Model $model
	 * @param Array $map
	 * @param String $sortBy
	 * @param Boolean $asc
	 */
	public function _list($view,$map,$sortBy='',$asc=true)
	{
		//排序字段 默认为主键名
		if(isset($_REQUEST['order'])) {
			$order = $_REQUEST['order'];
		}else {
			$order = !empty($sortBy)? $sortBy: $model->getPk();
		}
		//排序方式默认按照倒序排列
		//接受 sost参数 0 表示倒序 非0都 表示正序
		if(isset($_REQUEST['sort'])) {
			$sort = $_REQUEST['sort']?'asc':'desc';
		}else {
			$sort = $asc?'asc':'desc';
		}
		//取得满足条件的记录数
		$map=(isset($_COOKIE['map']) && $_COOKIE['map']['module']==MODULE_NAME)?$_COOKIE['map']:$map;

		$count= $this->where($map)->count();

		if($count>0) {
			import("ORG.Util.Page");
			//创建分页数量

			$p          = new Page($count,20);
			//分页查询数据
			$voList = $this->where($map)->order("`".$order."` ". $sort)->limit($p->firstRow .','.$p->listRows)->findAll();
			//分页显示
			$page      = $p->show();
			$view->assign('list',       $voList);
			$view->assign("page",       $page);
		}
		return null ;
	}

	public function viewcounts($pid){
		$data['viewcount']=array('exp',"viewcount+1");
		$this->where('id='.$pid)->save($data);
	}

	public function get_attrs($cateid,$pid){
		$dao=D("Cate");
		$typeid=$dao->field("type_id")->where("id=".$cateid)->select();
		$dao=D("Type_attr");
		$attr = $dao->where ( "type_id=" . $typeid [0] ['type_id'] . " and status=1" )->order ( "sort desc" )->findall ();
		$dao = D ( "Products_attr" );
		for($row = 0; $row < count ( $attr ); $row ++) {
			$map1 ['products_id'] = $pid;
			$map1 ['attr_id'] = $attr [$row] ['id'];
			$attr [$row] ['attrs'] = $dao->where ( $map1 )->findall ();
			$attr [$row] ['values'] = explode ( chr ( 13 ), $attr [$row] ['values'] );
			$attr [$row] ['values_count'] = count($attr [$row] ['attrs']);
		}
		return $attr;
	}
	//获取产品价格明细
	public function getpriceInfo($pid,$count){
		$list=$this->where("id=".$pid)->find();
		if (!$list){
			return null;
		}
		else{
			$discount=0;
			$list['price']=(float)$list['price'];
			$list['pricespe']=(float)$list['pricespe'];
			$list['count']=$count;
			$list['discount']=$discount;
			$list['price_total']=$list['price']*$count;
			$list['pricespe_total']=$list['pricespe']*$count;
			if ($list['price_total']<=$list['pricespe_total']){
				$list['total']=$list['price_total'];
			}
			else{
				$list['total']=$list['pricespe_total'];
			}
			if ($discount>0){
				$list['total']=$list['total']*$discount;
			}
			return $list;			
		}
	}
}
?>