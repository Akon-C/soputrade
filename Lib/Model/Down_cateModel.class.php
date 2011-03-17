<?php
/**
  * @author nanze
  * @link 
  * @todo 
  * @copyright 811046@qq.com
  * @version 1.0
  * @lastupdate 2010-11-23
*/ 
class Down_cateModel extends Model{
	protected $_validate=array(

	array('catename','require','类别名称必须填写!'),
	array('catename','','类别名称已经存在!',0,'unique',1),

	);
	
	/**
	 * 生成类别
	 *
	 */

	public function cate_option($cateid=0,$i=0,$selected=null)
	{
		
		$cate = $this->where(array('parent_cateid'=>$cateid))->order('cateid asc')->findall();
		if(false == $cate) return null;
		
		$option='';
		if($i==0){
			$option.="<option value=''>-请选择-</option>";
		}else{
			$str='|';
			$str.=str_repeat('-',$i*2);
		}
		foreach ($cate as $v){
			if(!is_null($selected) && $selected==$v['cateid']){
				$option.="<option value='{$v['cateid']}' selected='selected'>".$str.$v['catename']."</option>";
			}else{
				$option.="<option value='{$v['cateid']}'>".$str.$v['catename']."</option>";
			}
			$option.=$this->cate_option($v['cateid'],$i+1);
		}
		return $option;
	}
}

?>