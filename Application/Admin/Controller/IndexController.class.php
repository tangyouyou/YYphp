<?php
//测试控制器
class IndexController extends Controller{
	//默认访问动作
	public function index(){
		//显示视图
		$this->display();
	}

	public function reg(){
		$this->display();
	}


}