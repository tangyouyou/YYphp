<?php
class Application{
    //运行项目
	static public function run(){
		//设置编码级
		header("Context-type:text/html;charset=utf-8");
		define('IS_POST',!empty($_POST));
		define('IS_GET',!empty($_GET));
        //初始化配置项
		C(require YY_PATH.'config.php');
		//当前请求的模块
		$module = isset($_GET[C('VAR_MODULE')])?$_GET[C('VAR_MODULE')]:'Index'; 
		//当前请求的控制器
		$control = isset($_GET[C('VAR_CONTROLLER')])?$_GET[C('VAR_CONTROLLER')]:'Index';
		//当前请求的方法 	
		$action = isset($_GET[C('VAR_ACTION')])?$_GET[C('VAR_ACTION')]:'Index'; 
		$module = ucfirst($module);
		$control = ucfirst($control); //首字母大写
		define('MODULE',$module);//本次执行模块
		define('CONTROLLER', $control);//本次执行控制器
		define('ACTION',$action); //本次执行方法
		define('MODULE_PATH', APP_PATH .$module.'/'); //定义模块目录
		define('VIEW_PATH', MODULE_PATH.'View/');//定义视图目录
		define('CONTROLLER_PATH', MODULE_PATH.'Controller/');//定义控制器目录
		define('MODEL_PATH', MODULE_PATH.'Model/');//定义模型目录
		if(is_file(MODULE_PATH .'/Config/config.php')){
			C(require MODULE_PATH .'/Config/config.php');
		}
		if(!is_dir(MODULE_PATH)){
           halt('模块不存在');
		}
		$controlfile = CONTROLLER_PATH .$control.'Controller.class.php';
		if(!is_file($controlfile)){
		   halt('控制器不存在');
		}
		require $controlfile;
		$class = $control.'Controller';
		$obj = new $class;
		$obj->$action();		 
	}
}