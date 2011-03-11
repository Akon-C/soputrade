<?php
/**
  * @author nanze
  * @link 
  * @todo FTP批量
  * @copyright 811046@qq.com
  * @version 1.0
  * @lastupdate 2010-11-18
*/ 

class FtpbatchAction extends AdminCommAction {
	public $products_image_path;
	public $products_temp_path;
	function _initialize()
	{
		parent::_initialize();
		import("ORG.Io.Dir");
		import("ORG.Util.Image");
		set_time_limit(0);
		$this->products_image_path="./Public/Uploads/Products";
		$this->products_temp_path="./Public/Uploads/Temp";
	}

	public function index() {
		/**
		 * 追加路径
		 */
		$realpath="./".auto_charset($_POST['f'],'utf-8','gbk');
		if(!empty( $_POST['f']) && substr_count(realpath($realpath),realpath($this->products_temp_path))>0){
			$dir	= $_REQUEST['f'];	//追加路径
		}else {
			$dir	= $this->products_temp_path;	//根目录
		}
		$fileName	= array();
		/**
		 * 列出文件
		 * 
					$file=auto_charset($file,'gbk','utf-8');
		 */
		$dir=auto_charset($dir,'utf-8','gbk');
		if (is_dir( $dir)) {

			if ($dh = opendir( $dir)) {
				while (($file = readdir($dh)) !== false) {
					$file=auto_charset($file,'gbk','utf-8');
					if($file != "." && $file !=".."){
						if(is_dir(auto_charset("$dir/$file",'utf-8','gbk'))){
							$enterPath=substr( "$dir/$file",2);	//去除..
							$fileName[$i]['href']	= "<a href=\"javascript:e('$enterPath');\" >$file</a>";
						}else{
							$fileName[$i]['href']	= $file;
						}
						$fileName[$i]['file']		= $file;
						$i++;
					}
				}
				closedir($dh);
			}
		}
		$dir=auto_charset($dir,'gbk','utf-8');
		$this->assign('path',str_replace("./","", $dir));		//当前路径
		$this->assign('dir',str_replace("./","", $dir));	//模板显示文件路径
		$this->assign('fileName', $fileName);	//当前目录文件
		$this->assign('uplevel', realpath($dir)==realpath($this->products_temp_path)?$this->products_temp_path:dirname($dir));	//上一级目录
		$this->display();
		return;
	}
	/**
	 * 删除选择的文件或文件夹
	 *
	 * @param string $directory  文件或目录
	 */
	function deletefile($directory){
		$directory	= $_POST['checkbox'];		//获取数据
		$path		= "./".$_POST['path'];
		for($i=0;$i<count($directory);$i++){
			$Temp_path="$path/${directory[$i]}";	//临时路径
			$Temp_path=auto_charset($Temp_path,'utf-8','gbk');
			if (is_dir($Temp_path) == true)		//如果是文件夹
			{
				$this->delDir($Temp_path);
			}else{
				unlink($Temp_path);		//删除文件
			}
		}
		closedir($handle);
		$this->success('删除成功');
	}
	/**
	 * 批量导入
	 *
	 */
	function moreuploadfile(){
		$this->assign("jumpUrl",$_SERVER["HTTP_REFERER"]);
		$this->display('Ftpbatch-success');
		$filename	= $_POST['checkbox'];	//处理多选文件
		$path		= "./".$_POST['path'];	//给路径加上..
		for($i=0;$i<count($filename);$i++){
			$filename[$i]=auto_charset($filename[$i],'utf-8','gbk');
			if(file_exists($path.'/'.$filename[$i]) ==true){
				$filename[$i]=auto_charset($filename[$i],'gbk','utf-8');
				$this->showjsmessage("正在打开文件夹$path/{$filename[$i]}");
				if(isset($_POST['importClass']) && $_POST['importClass']==1){
					$this->processdir($path.'/'.$filename[$i],$_POST['cateid']);
				}else{
					$this->processdir($path.'/'.$filename[$i]);
				}
			}
		}
		//删除空目录
		foreach ($filename as $v){
			$v=auto_charset($v,'utf-8','gbk');
			if(file_exists($path.'/'.$v) ==true){
				if(is_dir($path."/".$v)){
					$this->delDir($path."/".$v);	//删除文件夹下所有文件和自身
					$this->showjsmessage("正在移除文件夹$path/".auto_charset($v,'gbk','utf-8'));
				}else{
					unlink($path."/".$v);		//删除文件
					$this->showjsmessage("正在移除文件$path/".auto_charset($v,'gbk','utf-8'));
				}
			}
		}
		$this->showjsmessage("全部导入成功!");
		echo "</body></html>";
	}
	/**
	 * 处理文件夹
	 *
	 * @param 要处理的文件夹 $dir
	 * @param 上一级 $pid
	 */
	function processdir($dir,$pid=0){
		$dir=auto_charset($dir,'utf-8','gbk');
		if (is_dir($dir)) {
			$c=D('Cate');
			$data['name']=auto_charset(basename($dir),'gbk','utf-8');
			if(!$id=$c->where($data)->getField('id')){
				$data['pid']=$pid;
				$id=$c->data($data)->add();
			}
			if(isset($_POST['type_id']) && !empty($_POST['type_id'])){
				$c->where(array('id'=>$id))->data(array('type_id'=>$_POST['type_id']))->save();
			}
			if ($dh = opendir($dir)) {
				while (($file = readdir($dh)) !== false) {
					if($file != "." && $file !=".."){
						if(is_dir("$dir/$file")){
							$dir=auto_charset($dir,'gbk','utf-8');
							$this->processdir($dir.'/'.$file,$id);
						}else{
							$extend = pathinfo($file); 	//扩展名
							$extend = $extend["extension"];
							$p=D('Products');
							$pro=$p->create();
							//自动命名
							if(isset($_POST['autoReName']) && $_POST['autoReName']==1){
						
								$k=$p->where("cateid=$id")->count();
								if($k){
									$k++;
								}else{
									$k=1;
								}
								$autoname=$this->GetCateName($id)."-".$k;
								$pro['name']=$autoname;
							}else{
								$pro['name']=str_replace(".$extend",'',auto_charset(basename($file),'gbk','utf-8'));
							}
							if(empty($id) || !isset($id)){
								$pro['cateid']=$pid;
							}else{
								$pro['cateid']=$id;
							}

							$pro['bigimage']=$this->products_image_path .'/'.toDate ( time (), 'Ymd' ) . "/".$pro['name'].'.'.$extend;

							$new_path=dirname($pro['bigimage']).'/';
							if(!file_exists($new_path)){
								mkdir($new_path);
							}


							$new_name=$new_path.$pro['name'].".$extend";

							//处理中文
							$old_name=$dir."/".$file;
							$new_name=auto_charset($new_name,'utf-8','gbk');

							rename($old_name,$new_name);

							//原图,文件名,格式,宽,高,隔行扫描
							$thumbname = Image::thumb($new_name,dirname($new_name).'/thumb_'.basename($new_name),'',GetSettValue('ImgThumbW'),GetSettValue('ImgThumbH'),true,'');

							$pthumbname=pathinfo($thumbname);

							$pro['smallimage']=$new_path.auto_charset($pthumbname['filename'],'gbk','utf-8').".".$pthumbname['extension'];


							$pro['dateline']=time();
							$p->data($pro)->add();
							//提示
							$this->showjsmessage("正在导入".auto_charset($file,'gbk','utf-8'));
						}
					}
				}
			}
		}else{
			//单个文件处理
			$p=D('Products');
			$pro=$p->create();
			$file=$dir;
			$extend = pathinfo($file); 	//扩展名
			$extend = $extend["extension"];
			$pro['name']=str_replace(".$extend",'',basename($file));

			$id=$pid;
			$pro['cateid']=$id;
			$pro['bigimage']=$this->products_image_path .'/'.toDate ( time (), 'Ymd' ) . "/".$pro['name'].'.'.$extend;

			$new_path=dirname($pro['bigimage']).'/';
			if(!file_exists($new_path)){
				mkdir($new_path);
			}

			$new_name=$new_path.$pro['name'].".$extend";

			//处理中文
			$old_name=$file;
			$new_name=auto_charset($new_name,'utf-8','gbk');

			rename($old_name,$new_name);
			//原图,文件名,格式,宽,高,隔行扫描
			$thumbname = Image::thumb($new_name,dirname($new_name).'/thumb_'.basename($new_name),'',GetSettValue('ImgThumbW'),GetSettValue('ImgThumbH'),true,'');
			$pthumbname=pathinfo($thumbname);
			$pro['smallimage']=$new_path.auto_charset($pthumbname['filename'],'gbk','utf-8').".".$pthumbname['extension'];
			$pro['dateline']=time();
			$p->data($pro)->add();
			//提示
			$this->showjsmessage("正在导入".$file);
		}
	}
	/**
	 * 判断文件夹是否为空
	 *
	 * @param string $directory
	 * @return boolean
	 */
	function isEmpty($directory)
	{
		$handle = opendir($directory);
		while (($file = readdir($handle)) !== false)
		{
			if ($file != "." && $file != "..")
			{
				closedir($handle);
				return false;
			}
		}
		closedir($handle);
		return true;
	}
	/**
	 * 删除文件夹和文件
	 *
	 * @param 目录名 $directory
	 * @param 是否删除子目录 $subdir
	 */
	function delDir($directory,$subdir=true)
	{
		if (is_dir($directory) == false)
		{
			//exit("The Directory Is Not Exist!");
			return false;
		}
		$handle = opendir($directory);
		while (($file = readdir($handle)) !== false)
		{
			if ($file != "." && $file != "..")
			{
				is_dir("$directory/$file")?
				$this->delDir("$directory/$file"):
				unlink("$directory/$file");
			}
		}
		if (readdir($handle) == false)
		{
			closedir($handle);
			rmdir("$directory");
		}
	}
	//获取类别名称
	function GetCateName($id){
		$Cate=D("Cate");
		$map['id']=$id;
		$name=$Cate->where($map)->getField('name');
		return $name;
	}
	function showjsmessage($message) {
		echo "<script type=\"text/javascript\">showmessage(\"".addslashes($message)."\");</script>\r\n";
		flush();
		ob_flush();
	}
}
?>