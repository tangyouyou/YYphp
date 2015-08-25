<?php
if (!defined("YY_PATH"))
exit('No allowed');

//session的驱动工厂
final class SessionFactory{

	public static $sessionFactory = null; //静态工厂实例
	protected $driver = array(); //驱动

	/**
	*返回工厂实例
	*/
	public static function factory(){
		//只实例一个对象
		if(is_null(self::$sessionFactory)){
			self::$sessionFactory = new SessionFactory();
		}
		$driver = ucfirst(strtolower(C('SESSION_ENGINE')));
		if(isset(self::$sessionFactory->driver[$driver])){
			return self::$sessionFactory->driver[$driver];
		}
		self::$sessionFactory->getDriver($driver);
        return self::$sessionFactory->driver[$driver];
	}

	/*
	获得数据库驱动接口
	*/
	private function getDriver($driver){
		$class = 'Session'.ucfirst($driver);
		$this->driver[$driver] = new $class;
	}

	

}