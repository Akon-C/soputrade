<?php
/**
 * @author nanze
 * @link 
 * @todo 
 * @copyright 811046@qq.com
 * @version 1.0
 * @lastupdate 2010-11-16
 */
class SitemapAction extends AdminCommAction {
	function index(){
		$dao=D('Products');
		$count=$dao->count();
		$this->assign('count', $count);
	
		if(file_exists("../sitemap.xml")){
			$this->assign('mtime',date('Y-m-d H:i:s',filemtime("../sitemap.xml")));
		}
		if($this->isPost()){
			$this->create();
		}else{
			$this->display();
		}
	}
	function create(){
		$app=C('URL_MODEL')==2?'':"/index.php";
		$unit=5000;
		//类别页面
		$num=$_GET['num']?$_GET['num']:0;
		Vendor('Google.Sitemap');
		$sitemap=new google_sitemap();
		if($num==0){
			//写入头部
			$fh = fopen('../sitemap.xml', 'w');
			fwrite($fh, $sitemap->header);
			fclose($fh);
			$dao=D('Cate');
			$data=$dao->order('pid asc')->findall();
			foreach($data as $k => $v){
				$cats[]=array("loc" => "http://".$_SERVER['HTTP_HOST']."$app/".tourlstr($v['name'])."-cid-".$v['id'].".html",
				"changefreq" => "weekly",
				"priority"	=> 0.8,);
			}
			$cats[]=array("loc" => "http://".$_SERVER['HTTP_HOST']."$app/Products-index.html","changefreq" => "weekly","priority"	=> 0.8,);
		}
		//产品页面
		$dao	=	D('Products');
		$data=$dao->order('id desc')->limit("$num,$unit")->findall();
		if(!$data){
			//写入底部
			$fh = fopen('../sitemap.xml', 'a');
			fwrite($fh, $sitemap->footer);
			fclose($fh);
			$sitemap="http://".$_SERVER['HTTP_HOST'].'/sitemap.xml';
			$pingurl="http://www.google.com/webmasters/sitemaps/ping?sitemap=".urlencode($sitemap);
			//通知google更新
			$ch=curl_init();
			curl_setopt($ch,CURLOPT_URL,$pingurl);
			curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
			curl_exec($ch);
			$this->assign('jumpUrl',U("Sitemap/index"));
			$this->success('生成Google SiteMap成功！');
		}
		foreach($data as $k => $v){
			$cats[]=array("loc" => "http://".$_SERVER['HTTP_HOST']."$app/".tourlstr($v['name'])."-pid-".$v['id'].".html",
			"changefreq" => "weekly",
			"priority"	=> 0.8,);
		}

		for ( $i=0,$count=count($cats); $i < $count; $i++ )
		{
			$value = $cats[ $i ];
			$site_map_item =& new google_sitemap_item(
			$value[ 'loc' ]
			, ""
			, $value[ 'changefreq' ]
			, $value[ 'priority' ]
			);
			$sitemap->add_item( $site_map_item );
		}
		header( "Content-type: application/xml; charset=\"".$sitemap->charset . "\"", true );
		header( 'Pragma: no-cache' );
		$sitemap->build('../sitemap.xml');
		$more=$num+$unit;
		$this->assign('jumpUrl',U("Sitemap/create?num=$more"));
		$this->success("正在生成产品从".$num."到".$more);
	}
}
?>