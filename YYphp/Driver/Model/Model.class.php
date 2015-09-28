<?php
//模型基础类
   class Model{
   	private $db;//数据库连接驱动
      public $table;//操作的表名
      public function __construct($table=null){
          $this->db = DbFactory::getDriver();
          $this->db->table = $this->table ? $this->table : $table;
      }

      //插入数据
      public function insert($data){
          return $this->db->insert($data);  
      }

      //查询数据
      public function select(){
      	  return $this->db->select();
      }

      //where条件
      public function where($where){
      	  $this->db->where($where);
      	  return $this;
      }

      //limit
      public function limit($limit){
      	  $this->db->limit($limit);
      	  return $this;
      }

      //更新数据
      public function update($data){
      	  return $this->db->update($data);
      }

      //删除数据
      public function delete(){
      	  return $this->db->delete();
      }
   }