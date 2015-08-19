<?php
	//mysqli扩展驱动
	class DbMysqli extends Db{
		private $link;//连接

		public $table;//操作的表

		public function connect(){
			$this->link = new mysqli(C('DB_HOST'),C('DB_USER'),C('DB_PASS'),C('DB_DATABASE'));
			//设置字符集
			$this->link->query("SET NAMES ".C('DB_CHARSET'));
		}
		
		//没有结果集的查询
		public function exe($sql){
			$this->link->query($sql);
			return $this->link->insert_id;
		}

		//有结果集的查询
		public function query($sql){
			$result = $this->link->query($sql);
			if($result){
				$rows = array();
				while($row = $result->fetch_assoc()){
					$rows[] = $row;
				}
				return $rows;
			}else{
				return false;
			}
		}

	}