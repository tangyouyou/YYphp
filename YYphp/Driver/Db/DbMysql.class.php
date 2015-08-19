<?php
	//mysql扩展驱动
	class DbMysql extends Db{

		public function connect(){
			$link = @mysql_connect(C('DB_HOST'),C('DB_USER'),C('DB_PASS'));
			//设置字符集
			mysql_query("SET NAMES ".C('DB_CHARSET'));
			//选择数据库
			mysql_select_db(C('DB_DATABASE'));
			if(!$link){
				halt('连接数据库失败....');
			}
		}

		//没有结果集的查询
		public function exe($sql){
			mysql_query($sql);
			return mysql_insert_id()? mysql_insert_id():mysql_affected_rows();
		}

		//有结果集的查询
		public function query($sql){
			$result = mysql_query($sql);
			if($result){
				$rows = array();
				while($row = mysql_fetch_assoc($result)){
					$rows[] = $row;
				}
				return $rows;
			}else{
				$this->error = mysql_error();
				return false;
			}
		}

	}