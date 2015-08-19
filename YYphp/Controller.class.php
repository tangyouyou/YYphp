<?php
require_once(YY_PATH."Smarty/Smarty.class.php"); 
//spl_autoload_register("__autoload");
class Controller extends Smarty{

	// public function __construct(){
	// 	echo "1";
	// }



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
