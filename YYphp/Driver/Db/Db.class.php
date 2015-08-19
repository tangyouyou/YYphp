<?php
class Db{
	public $table;//操作的表
	public $error;
	public $opt=array(
		'where'=>'',
		'group'=>'',
		'having'=>'',
		'limit'=>'',
		'order'=>''
	);

	//添加数据
	public function insert($data){
		$field = array_keys($data);
		$value = array_values($data);
		$value = "'".implode("','", $value)."'";
		$sql = "INSERT INTO ".$this->table.'('.implode(',',$field).') VALUES('.$value.') ';
		return $this->exe($sql);
	}

	//where条件
	public function where($where){
		$this->opt['where'] = " WHERE ".$where;
	}


	//查询
	public function select(){
		$sql = "SELECT * FROM ".$this->table.$this->opt['where'].$this->opt['group'].$this->opt['having'].$this->opt['order'].$this->opt['limit'];
		return $this->query($sql);
	}

	//limt
	public function limit($limit){
		$this->opt['limit'] = " LIMIT ".$limit;
	}

	//更新
	public function update($data){
		$sql = "UPDATE ".$this->table.' SET ';
		foreach ($data as $field=>$value) {
			$sql .= $field."='".$value."',";
		}
		$sql = substr($sql, 0,-1).$this->opt['where'];
		return $this->exe($sql);
	}

	//删除
	public function delete(){
		$sql = "DELETE FROM ".$this->table.$this->opt['where'];
		return $this->exe($sql);
	}

}
