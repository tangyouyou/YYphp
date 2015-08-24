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
	'DB_CHARSET'=>'UTF8',//设置字符集
	//缓存文件类型
	'DATA_CACHE_TYPE'=>'file',//file,memcache,redis

	/* 日志设置 */
    'LOG_RECORD'            => false,   // 默认不记录日志
    'LOG_TYPE'              => 3, // 日志记录类型 0 系统 1 邮件 3 文件 4 SAPI 默认为文件方式
    'LOG_DEST'              => '', // 日志记录目标
    'LOG_EXTRA'             => '', // 日志记录额外信息
    'LOG_LEVEL'             => 'EMERG,ALERT,CRIT,ERR',// 允许记录的日志级别
    'LOG_FILE_SIZE'         => 2097152,	// 日志文件大小限制
    'LOG_EXCEPTION_RECORD'  => false,    // 是否记录异常信息日志

    /* 数据缓存设置 */
    'DATA_CACHE_TIME'       => 0,      // 数据缓存有效期 0表示永久缓存
    'DATA_CACHE_COMPRESS'   => false,   // 数据缓存是否压缩缓存
    'DATA_CACHE_CHECK'      => false,   // 数据缓存是否校验缓存
    'DATA_CACHE_PREFIX'     => '',     // 缓存前缀
    'DATA_CACHE_TYPE'       => 'File',  // 数据缓存类型,支持:File|Db|Apc|Memcache|Shmop|Sqlite|Xcache|Apachenote|Eaccelerator
    'DATA_CACHE_PATH'       => '',// 缓存路径设置 (仅对File方式缓存有效)
    'DATA_CACHE_SUBDIR'     => false,    // 使用子目录缓存 (自动根据缓存标识的哈希创建子目录)
    'DATA_PATH_LEVEL'       => 1,        // 子目录缓存级别

    /********************************验证码********************************/
    "CODE_FONT"                     => YY_PATH . "Data/Font/font.ttf",       //字体
    "CODE_STR"                      => "123456789abcdefghijklmnpqrstuvwsyz", //验证码种子
    "CODE_WIDTH"                    => 150,         //宽度
    "CODE_HEIGHT"                   => 45,          //高度
    "CODE_BG_COLOR"                 => "#ffffff",   //背景颜色
    "CODE_LEN"                      => 4,           //文字数量
    "CODE_FONT_SIZE"                => 22,          //字体大小
    "CODE_FONT_COLOR"               => "",          //字体颜色

     
);