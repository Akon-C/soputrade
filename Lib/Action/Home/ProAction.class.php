<?php
/**
 * 查找
 *
 */
class ProAction extends CommAction {
	public function _empty(){
		$_REQUEST[ACTION_NAME]=1;
		$this->index();
	}
	public function index(){	
		self::$Model=D("Products");
		$map=array();
		switch (true){
			case isset($_REQUEST['new']):
				$map['isnew']=1;
				$this->disp_text="New";
				break;
			case isset($_REQUEST['hot']):
				$map['ishot']=1;
				$this->disp_text="HotSell";
				break;
			case isset($_REQUEST['rec']):
				$map['isrec']=1;
				
				$this->disp_text="Featured";
				break;
			case isset($_REQUEST['price']):
				$map['isprice']=1;
				$this->disp_text="Specials";
				break;
			case isset($_REQUEST['brand']):
				$map['brandid']=$_REQUEST['id'];
				$this->disp_text="Brand"; 
				break;
			default:
				$this->disp_text="All";
		}
		if(isset($_REQUEST['limit_name'])){
			$map['name']=array('like',$_REQUEST['limit_name']."%");
		}
		$map['isuser']=0;
		if($_REQUEST['order']){
			$order=$_REQUEST['order'];
		}else{
			$order='id';
		}
		if($_REQUEST['sort']=='asc'){
			$sort=true;
		}else{
			$sort=false;
		}
		$this->sort=$sort;
		$this->order=$order;
		self::$Model->_list($this->view,$map,$order,$sort);
		$this->display('index');
	} 
	public function ask(){
		self::$Model = D("Products_ask");
		if (false === self::$Model ->create()){
			$this->error(self::$Model ->getError());
		}else{
			self::$Model ->ip=get_client_ip();
			self::$Model ->dateline=time();
			if(self::$Model ->add()){
				
			}else{
				$this->error('Failure to submit your question!');
			}
		}
		$this->success('Your question has been submitted!');
	}
	
}


?>