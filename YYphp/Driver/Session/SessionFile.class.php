<?php

if (!defined("YY_PATH"))
    exit('No allowed');

/*
SESSION文件驱动
*/
class SessionFile extends SessionAbstract{

	//初始
	public function run(){
		if (C("SESSION_SAVE_PATH")) {
            session_save_path(C("SESSION_SAVE_PATH"));
        }
        session_name(C("SESSION_NAME"));
        session_set_save_handler(
            array(&$this, "open"),
            array(&$this, "close"),
            array(&$this, "read"),
            array(&$this, "write"),
            array(&$this, "destroy"),
            array(&$this, "gc")
        );
	}

	public function open(){
		return true;
	}

	public function read(){
		$session = session_save_path() . '/yysess_' . $sid;
        if (!is_file($session)) {
            return false;
        }
        return file_get_contents($session);
	}

	public function write(){
		$session = session_save_path() . '/yysess_' . $sid;
        return file_put_contents($session, $data) ? true : false;
	}

	//卸载
    public function destroy($sid){
        $session = session_save_path() . '/yysess_' . $sid;
        if (is_file($session)) {
            unlink($session);
        }
    }

    //垃圾回收
    public function gc()
    {
        $path = session_save_path();
        foreach (glob($path . "/*") as $file) {
            if (strpos($file, "yysess_") === false) continue;
            if (filemtime($file) + C("SESSION_LIFETIME") < time()) {
                unlink($file);
            }
        }
        return true;
    }

    //关闭
    public function close()
    {
        //关闭SESSION
        if (mt_rand(1, C("SESSION_GC_DIVISOR")) == 1) {
            $this->gc();
        }
        return true;
    }

}