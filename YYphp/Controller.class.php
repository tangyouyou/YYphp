<?php
require_once(YY_PATH."Smarty/Smarty.class.php"); 
class Controller extends Smarty{

	public function __construct(){
		// $this->template_dir = VIEW_PATH.CONTROLLER;
		// $this->compile_dir = VIEW_PATH.'/Compile';
		// is_dir($this->compile_dir) or mkdir($this->compile_dir,0755,true);
		// $this->display('index.html');
	}



	//操作成功时提示信息
	public function success($action,$message){
		$url = "?m=".MODULE.'&c='.CONTROLLER.'&a='.$action;
		require VIEW_PATH.CONTROLLER.'/Public/success.html';
		exit;
	}

	//操作失败时提示信息
	public function error(){

	}
}
