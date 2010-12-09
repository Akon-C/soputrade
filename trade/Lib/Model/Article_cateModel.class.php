<?php
/**
  * @author nanze
  * @link 
  * @todo 
  * @copyright 811046@qq.com
  * @version 1.0
  * @lastupdate 2010-11-23
*/ 
class Article_cateModel extends Model{
	
	
	/**
	 * 生成类别
	 *
	 */

	public function cate_option($article_cateid=0,$i=0,$selected=null)
	{
		
		$cate = $this->where(array('article_parent_cateid'=>$article_cateid))->order('article_cateid asc')->findall();
		if(false == $cate) return null;
		
		$option='';
		if($i==0){
			$option.="<option value=''>-请选择-</option>";
		}else{
			$str='|';
			$str.=str_repeat('-',$i*2);
		}
		foreach ($cate as $v){
			if(!is_null($selected) && $selected==$v['article_cateid']){
				$option.="<option value='{$v['article_cateid']}' selected='selected'>".$str.$v['article_catename']."</option>";
			}else{
				$option.="<option value='{$v['article_cateid']}'>".$str.$v['article_catename']."</option>";
			}
			$option.=$this->cate_option($v['article_cateid'],$i+1);
		}
		return $option;
	}
}

?>