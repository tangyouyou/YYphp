<?php
require_once(YY_PATH."Smarty/Smarty.class.php"); 
class Controller extends Smarty{

	public function __construct(){
		//子类如果存在auto方法，自动运行
        if (method_exists($this, "__init")) {
            $this->__init();
        }
		//模板目录
		$this->template_dir =  VIEW_PATH.CONTROLLER;
		//编译目录
		$this->compile_dir = VIEW_PATH.CONTROLLER.'/Compile';
		is_dir($this->compile_dir) or mkdir($this->compile_dir,0755,true);
		//修改左定界符
		$this->left_delimiter = '{yy:';
		//$this->rigth_delimiter = '-->';
	}

	// public function display(){
	// 	require VIEW_PATH.CONTROLLER.'/'.ACTION.'.html';
	// }



	//操作成功时提示信息
	public function success($action,$message,$time=3){
		$url = "?m=".MODULE.'&c='.CONTROLLER.'&a='.$action;
		require YY_PATH.'Tpl/success.html';
		exit;
	}

	//操作失败时提示信息
	public function error($action,$message,$time=3){
		$url = "?m=".MODULE.'&c='.CONTROLLER.'&a='.$action;
		require YY_PATH.'Tpl/error.html';
		exit;
	}

	//是否为ajax提交数据
	public function isAjax(){
		if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER["HTTP_X_REQUESTED_WITH"]) =="xmlhttprequest"){
			return true;
		}else{
			return false;
		}
	}

	//为post数据提交过滤、加密处理
	public function _post($data,$fun = null){
		$data = $_POST[$data];
		if(is_null($fun)){
			$data = htmlspecialchars($data);
		}
		$data = $fun($data);
		return $data;
	}

	//为get数据提交过滤、加密处
	public function _get($data,$fun = null){
		$data = $_GET[$data];
		if(is_null($fun)){
			$data = htmlspecialchars($data);
		}
		$data = $fun($data);
		return $data;
	}
}
