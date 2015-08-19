<?php

   //驱动工厂
   class DbFactory{
       static private $_driver = array();
         //不允许外部实例化
   	   private function __construct(){

   	   }

   	   //获得连接驱动
   	   static public function getDriver(){
   	   	  $database = C('DB_DATABASE');
          if(isset(self::$_driver[$database])){
              return self::$_driver[$database];
          }else{
              $engine = 'Db'.C('DB_ENGINE');
              $db = new $engine;
              $db->connect();
              return self::$_driver[$database] = $db;                 
          }
   	   }
   }