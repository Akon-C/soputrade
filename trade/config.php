<?php 
return array(
	'DB_TYPE'=>'mysql',
	'DB_HOST'=>'localhost',
	'DB_NAME'=>'sop',
	'DB_USER'=>'root',
	'DB_PWD'=>'123456',
	'DB_PORT'=>'3306',
	'DB_PREFIX'=>'sopu_',
	//'TMPL_CACHE_ON'=>false,// 默认开启模板编译缓存 false 的话每次都重新编译模板
	'FILE_UPLOAD_MAXSIZE'=>1024000000,
	'FILE_UPLOAD_ALLOWEXTS'=>'jpg,gif,png,bmp',
    'DEFAULT_CURRENCIES_SYMBOL'=>'USD',//默认货币标识
	//'DB_FIELDS_CACHE' =>true,// 缓存数据表字段信息
);
?>