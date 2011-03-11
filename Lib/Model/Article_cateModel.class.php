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
	protected $_validate=array(

	array('article_catename','require','类别名称必须填写!'),
	array('article_catename','','类别名称已经存在!',0,'unique',1),

	);
	public function get_article_by_cate($name,$limit){
		$article=$this->query("select * from ".C('DB_PREFIX')."article_cate a left join ".C('DB_PREFIX')."article b on a.article_cateid=b.article_cateid where a.article_catename='".$name."' order by b.article_id desc limit ".$limit);
		return $article;
	}
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