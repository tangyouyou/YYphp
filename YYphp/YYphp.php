<?php

//框架入口
final class yyPHP{
    //运行框架
	static public function run(){
		  //定义常用的常量
		  self::setConst();
          //加载核心文件
		  self::loadFile();
		  //创建应用目录
		  self::createDir();
		  //运行项目
		  Application::run();
		  
	}

	//创建常用目录
	static public function createDir(){
		if(is_dir(APP_PATH)) return;
		$model = explode(',',MODULE_LIST);
		foreach ($model as $v) {
			$dirs = array(
				APP_PATH,
				APP_PATH.$v.'/'.'Controller',
				APP_PATH.$v.'/'.'Config',
				APP_PATH.$v.'/'.'Model',
				APP_PATH.$v.'/'.'Lib',
				APP_PATH.$v.'/'.'View',
		    );
		    foreach ($dirs as $m) {
		    	is_dir($m) or mkdir($m,0755,true);
		    }
		    //复制默认控制器
		    copy(YY_PATH .'Tpl/IndexController.class.php',APP_PATH.$v.'/'.'Controller/IndexController.class.php');
		    //复制默认视图文件
		    is_dir(APP_PATH.$v.'/View/Index') or mkdir(APP_PATH.$v.'/View/Index');
		    copy(YY_PATH.'Tpl/View.html',APP_PATH.$v.'/View/Index/index.html');

		    
		}
	}

	//定义常量
	static private function setConst(){
      define('YY_PATH',dirname(__FILE__).'/');
	}

	//加载文件
	static public function loadFile(){
		 $files = array(YY_PATH .'functions.php',YY_PATH . 'Application.class.php');
		 foreach ($files as $v) {
            is_file($v) and require($v);
         }
	}
}

//运行框架
yyPHP::run();