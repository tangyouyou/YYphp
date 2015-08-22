<?php
require_once(YY_PATH."Smarty/Smarty.class.php"); 
class Controller{

	public function __construct(){
		
	}

	public function display(){
		require VIEW_PATH.CONTROLLER.'/'.ACTION.'.html';
	}



	//操作成功时提示信息
	public function success($action,$message){
		$url = "?m=".MODULE.'&c='.CONTROLLER.'&a='.$action;
		require YY_PATH.'Tpl/success.html';
		exit;
	}

	//操作失败时提示信息
	public function error($action,$message){
		$url = "?m=".MODULE.'&c='.CONTROLLER.'&a='.$action;
		require YY_PATH.'Tpl/error.html';
		exit;
	}

	//是否为post提交数据
	public function isPost(){
		if(empty($_POST)){
			return false;
		}else{
			return true;
		}
	}

	//是否为get提交数据
	public function isGet(){
		if(empty($_GET)){
			return false;
		}else{
			return true;
		}
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
	public function _post($data,$fun){
		$data = $_POST[$data];
		$data = $fun($data);
		return $data;
	}

	//为get数据提交过滤、加密处理
	public function _get($data,$fun){
		$data = $_GET[$data];
		$data = $fun($data);
		return $data;
	}
}
