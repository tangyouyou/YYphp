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
      //域名
      $host = $_SERVER['HTTP_HOST'] ? $_SERVER['HTTP_HOST'] : $_SERVER['SERVER_NAME'];
      define("__HOST__","http://" . trim($host, '/'));
      //网站根-不含入口文件
      $documentRoot = str_ireplace($_SERVER['DOCUMENT_ROOT'], '', dirname($_SERVER['SCRIPT_FILENAME']));
      $root = empty($documentRoot) ? "" : '/' . trim(str_replace('\\', '/', $documentRoot), '/');
      define("__ROOT__", __HOST__ . $root);
      $url = isset($_SERVER['REDIRECT_URL']) ? rtrim(dirname($_SERVER['SCRIPT_NAME']), '/') : $_SERVER['SCRIPT_NAME'];
      //网站根-含入口文件
      define("__WEB__", __HOST__ . $url);
      //完整URL地址
      define("__URL__", __HOST__ . '/' . trim($_SERVER['REQUEST_URI'], '/')); 
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