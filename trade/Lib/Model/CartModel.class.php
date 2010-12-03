<?php
/**
 * @author nanze
 * @link 
 * @todo 
 * @copyright 811046@qq.com
 * @version 1.0
 * @lastupdate 2010-11-25
 */
class CartModel extends Model {
	// 查验物品
	public function check_item($sessionID, $pid,$model) {
		$list = $this->where ( "session_id='" . $sessionID . "' and pid=" . $pid." and model='".$model."'" )->find ();
		if (! $list) {
			return 0;
		} else {
			//返回产品数量
			return count($list);
		}
	}
	//添加购物车
	public function add_item($sessionID, $pid, $count,$model) {
		$qty = $this->check_item ( $sessionID, $pid,$model );
		
		if ($qty) {
			$data ['count'] = array ('exp', 'count+' . $count );
			$data['dateline']=time();
			$this->where ( "session_id='" . $sessionID . "' and pid=" . $pid." and model='".$model."'" )->save ( $data );
		} else {
			$data['pid']=$pid;
			$data['session_id']=$sessionID;
			$data['count']=$count;
			$data['model']=$model;
			$data['dateline']=time();
			$this->add($data);
		}
	
	}
	// 删除购物车中的内容
	public function delete_item($sessionID, $id){
		$this->where ( "session_id='" . $sessionID . "' and id=" . $id)->delete();
	}
	//修改物品数量
	public function modify_quantity($sessionID, $id,$count,$model){
		$data['count']=$count;
		$data['model']=$model;
		$data['dateline']=time();
		$this->where ( "session_id='" . $sessionID . "' and id=" . $id )->save($data);
	}
	//获取产品种类数
	public function get_item_count($sessionID){
		return $this->where ( "session_id='" . $sessionID."'"  )->count();
	}
	//清空购物车
	public function clear_cart($sessionID){
		$this->where ( "session_id='" . $sessionID."'"  )->delete();
	}
	//获取总价格
	public function cart_total($sessionID){
		$total=0;
		$dao=D("Products");
		$list=$this->where( "session_id='" . $sessionID."'")->findAll();
		for ($row=0;$row<count($list);$row++){
			$data=$dao->getpriceInfo($list[$row]['pid'],$list[$row]['count']);
			$total=$total+$data['total'];
		}
		return $total;
	}
	//获取购物车明细
	public function display_contents($sessionID){
		$list = $this->where (  "session_id='" . $sessionID."'")->findAll ();
		if (!$list){
			return null;
		}
		$dao = D ( "Products" );
		for($row = 0; $row < count ( $list ); $row ++) {
			$data = $dao->getpriceInfo ( $list [$row] ['pid'], $list [$row] ['count'] );
			$list[$row]['price']=$data['price'];
			//$list[$row]['pid']=$data['id'];
			$list[$row]['name']=$data['name'];
			$list[$row]['bigimage']=$data['bigimage'];
			$list[$row]['smallimage']=$data['smallimage'];
			$list[$row]['model']= unserialize($list[$row]['model']) ;
			//$list[$row]['model']= $list['model'] ;
			$list[$row]['pricespe']=$data['pricespe'];
			$list[$row]['count']=$data['count'];
			$list[$row]['discount']=$data['discount'];
			$list[$row]['price_total']=$data['price_total'];
			$list[$row]['pricespe_total']=$data['pricespe_total'];
			$list[$row]['total']=$data['total'];
		}
		
		return $list;
	}
}
?>