<?php

class LoginController extends Controller{
	public function index(){
		$this->display('index.html');
	}

	public function login(){
		if(IS_POST){
			$data = array();
			$data['username'] = $_POST['account'];
			$data['password'] = $_POST['pwd'];
			if(D('user')->insert($data)){
				$this->success('index','插入成功');
			}else{
				$this->error('index','插入失败');
			}
		}else{
			halt('页面不存在');
		}
	}

	public function reg(){
		$this->display('reg.html');
	}

	
	/*
	验证码
	*/
	public function verify(){
		//require YY_PATH.'Core/Code.class.php';
		import('Code',YY_PATH.'Core');
		$code = new Code();
		$code->show();
	}

	/*
	验证登录
	*/
	public function checkReg(){
		if(!IS_POST){
			halt('页面不存在');
		}

	}

	
}