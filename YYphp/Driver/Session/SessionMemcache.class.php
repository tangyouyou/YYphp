<?php
if(!defined('YY_PATH')){
	exit('NO allowed');
}

/*
基于Memcache的session处理
*/
class SessionMemcache extends SessionAbstract{

	private $memcache; //memcache的连接对象

	public function __construct(){
		$config = C('SESSION_MEMCACHE');
		$this->memcache = new Memcache();
		$this->memcache->connect($config['host'],$config['port'],2,5);
	}

	public function open(){
		return true;
	}

	public function read($sid){
		$data = $this->memcache->get($sid);
		if(!isset($data['card'])) return false;
		return $data['card']===$this->card?$data['Data']:array();
	}

	public function write($sid, $data) {
        $m_data = array();
        $m_data['card'] = $this->card;
        $m_data['Data'] = $data;
        return $this->memcache->set($sid, $m_data);
    }

    public function destroy($sid) {
        return $this->memcache->delete($sid);
    }

    public function gc() {
        return true;
    }


}