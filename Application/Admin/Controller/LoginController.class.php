<?php

	class LoginController extends Controller{

		public function index(){
			$this->display();
		}

		public function login(){
			$data = array();
			$data['username'] = $_POST['account'];
			$data['password'] = $_POST['pwd'];
			if(D('user')->insert($data)){
				$this->success('index','插入成功');
			}else{
				$this->error('index','插入失败');
			}
			$this->display();
		}
	}