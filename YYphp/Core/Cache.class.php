<?php
//缓存类的设计
defined("YY_PATH") or die();
class Cache{

	//操作句柄
	protected $handler;

	//操作连接
	protected $options = array();

	//连接缓存
	public function connect($type='',$options=array()){
		if(empty($type)){
			$type = C('DATA_CACHE_TYPE');
			$type = strtolower(trim($type));
			$class = 'Cache'.ucwords($type);
			if(class_exists($class)){
				$cache = new $class($options);
			}else{
				halt('该类不存在');
			}
			return $cache;
		}	
	}

	public function __get($name) {
        return $this->get($name);
    }

    public function __set($name,$value) {
        return $this->set($name,$value);
    }

    public function __unset($name) {
        $this->rm($name);
    }

    public function setOptions($name,$value) {
        $this->options[$name]   =   $value;
    }

    public function getOptions($name) {
        return $this->options[$name];
    }

    
}