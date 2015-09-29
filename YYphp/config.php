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
    //默认函数过滤类型
    'FILTER_FUNCTION' =>'htmlspecialchars',
    
    /********************************URL设置********************************/
    "HTTPS"                         => FALSE,       //基于https协议
    "URL_REWRITE"                   => 1,           //url重写模式
    "URL_TYPE"                      => 1,           //类型 1:PATHINFO模式 2:普通模式 3:兼容模式
    "PATHINFO_DLI"                  => "/",         //PATHINFO分隔符
    "PATHINFO_VAR"                  => "q",         //兼容模式get变量
    "PATHINFO_HTML"                 => ".html",     //伪静态扩展名

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

     /********************************SESSION********************************/
    "SESSION_AUTO"                  => 1,           //自动开启SESSION
    "SESSION_NAME"                  => "hdsid",     //session_name
    "SESSION_ENGINE"                => "file",      //引擎:file,mysql,memcache
    "SESSION_SAVE_PATH"             => "",          //以文件处理时的位置
    "SESSION_LIFETIME"              => 1440,        //SESSION过期时间
    "SESSION_TABLE_NAME"            => "session",   //SESSION的表名
    "SESSION_GC_DIVISOR"            => 10,          //SESSION清理频率,数字越小清理越频繁
    "SESSION_MEMCACHE"              => array(       //Memcache配置,支持集群
                "host" => "127.0.0.1",  //主机
                "port" => 11211         //端口
    ),
    "SESSION_REDIS"                 => array(       //Redis配置,支持集群
        "host" => "127.0.0.1",          //主机
        "port" => 6379,                 //端口
        "password" => "",               //密码
        "Db" => 0,                      //数据库
    ),

    /********************************缓存控制********************************/
    "CACHE_TYPE"                    => "file",      //类型:file memcache redis
    "CACHE_MEMCACHE"                => array(       //多个服务器设置二维数组
        "host"      => "127.0.0.1",     //主机
        "port"      => 11211,           //端口
        "timeout"   => 1,               //超时时间(单位为秒)
        "weight"    => 1,               //权重
        "pconnect"  => 1,               //持久连接
    ),
    "CACHE_REDIS"                   => array( //多个服务器设置二维数组
        "host"      => "127.0.0.1",     //主机
        "port"      => 6379,            //端口
        "password"  => "",              //密码
        "timeout"   => 1,               //超时时间
        "Db"        => 0,               //数据库
        "pconnect"  => 0,               //持久连接
    ),
    "CACHE_TIME"                    => 3600,        //全局默认缓存时间 0为永久缓存
    "CACHE_SELECT_TIME"             => -1,          //SQL SELECT查询缓存时间 -1为不缓存 0为永久缓存
    "CACHE_SELECT_LENGTH"           => 30,          //缓存最大条数
    "CACHE_TPL_TIME"                => -1,           //模板缓存时间 -1为不缓存 0为永久缓存
     
);