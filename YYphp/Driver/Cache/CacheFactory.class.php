<?php
if(!defined('YY_PATH')){
	exit('NO allowed');
}

//缓存驱动工厂
final class CacheFactory{

	public static $cacheFactory = null;//驱动实例
	protected $cacheList = array();

	//构造函数
	private function __construct()
    {

    }

	public static function factory($options)
    {
        $options = is_array($options) ? $options : array();
        //只实例化一个对象
        if (is_null(self::$cacheFactory)) {
            self::$cacheFactory = new cacheFactory();
        }
        $driver = isset($options['driver']) ? $options['driver'] : C("CACHE_TYPE");
        //静态缓存实例名称
        $driverName = md5_s($options);
        //对象实例存在
        if (isset(self::$cacheFactory->cacheList[$driverName])) {
            return self::$cacheFactory->cacheList[$driverName];
        }
        $class = 'Cache' . ucwords(strtolower($driver)); //缓存驱动
        $classFile = YY_PATH . 'Cache/' . $class . '.class.php'; //加载驱动类库文件
        if (!require_array($classFile)) {
            halt("缓存类型指定错误，不存在缓存驱动文件:" . $classFile);
        }
        $cacheObj = new $class($options);
        self::$cacheFactory->cacheList[$driverName] = $cacheObj;
        return self::$cacheFactory->cacheList[$driverName];
    }
}