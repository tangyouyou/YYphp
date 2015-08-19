<?php
defined("YY_PATH") or die();
return array(
	"VAR_MODULE" => 'm',//GET参数模块变量
	"VAR_CONTROLLER" =>'c',//GET参数控制器变量
	"VAR_ACTION" => 'a',//GET方法控制器变量
	"DEFAULT_MODULE" => "Index",//默认执行模块
	"DEFAULT_CONTROLLER" => "Index",//默认执行的控制器
	"DEFAULT_ACTION"=>"Index", //默认执行的动作
	//数据库连接
	'DB_HOST'=>'127.0.0.1',
	'DB_ENGINE'=>'mysql',//mysql pdo mysqli
	'DB_USER'=>'root',
	'DB_PASS'=>'',
	'DB_DATABASE'=>'youyou',
	'DB_CHARSET'=>'UTF8'//设置字符集
);