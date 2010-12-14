<?php
/**
  * @author nanze
  * @link 
  * @todo 
  * @copyright 811046@qq.com
  * @version 1.0
  * @lastupdate 2010-11-23
*/ 
class ArticleModel extends Model{
	protected $_validate=array(

	array('article_title','require','文章标题必须填写!'),
	array('article_title','','文章标题已经存在!',0,'unique',1),

	);
}

?>