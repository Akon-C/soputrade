<?php
/**
  * @author nanze
  * @link 
  * @todo 
  * @copyright 811046@qq.com
  * @version 1.0
  * @lastupdate 2010-12-2
*/ 
class Products_askModel extends Model{
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
		if(isset($map['isdown'])){
			unset($map['isdown']);
		}
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
		if(!empty($_SESSION['map']) && 'Search'==MODULE_NAME){
			$map=$_SESSION['map'];
		}
		$count= $this->where($map)->count();
		
		$pages=array(
		'totalRows'=>0,//总记录
		'totalPages'=>0,//总页数
		'startRow'=>0,//开始行
		'endRow'=>1,//结束行
		'list'=>null,//当前数据
		"page"=>null//表示字符串
		);
		if($count>0) {
			import("ORG.Util.Page");
			//创建分页数量

			$p   = new Page($count,10);

			//分页查询数据
			$voList = $this->where($map)->order("`".$order."` ". $sort)->limit($p->firstRow .','.$p->listRows)->findAll();
			//分页显示
			$page = $p->show();
			$pages['list']=$voList;
			$pages['page']=$page;
		}
		$view->assign($pages);
	}
}
?>