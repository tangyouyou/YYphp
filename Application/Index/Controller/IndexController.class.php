<?php
//测试控制器
class IndexController extends Controller{
	//默认访问动作
	public function index(){
		$this->display('index.html');
	}

}