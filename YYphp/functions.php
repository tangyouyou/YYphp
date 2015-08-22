<?php
   //打印函数
   function p ($arg){
   	  echo "<pre>" .print_r($arg,true)."</pre>";
   }
   //实例化模型驱动
   function M($table){
      return new Model($table);
   }
   //实例化扩展模型驱动
   function D($model){
      $model = $model."Model";
      return new $model();
   }
   //配置项处理
   function C($name=null,$value=null){
   		static $config = array();
   		if(is_null($name)){
   			return $config;
   		}else if(is_array($name)){
   			return $config = array_merge($config,$name);
   		}else if(is_null($value)){
   			return isset($config[$name])?$config[$name]:null;
   		}else{
   			return $config[$name] = $value;
   		}
   }
   //路由函数
   function U(){
      
   }

   /**
    * 设置和获取统计数据
    * 使用方法:
    * <code>
    * N('db',1); // 记录数据库操作次数
    * N('read',1); // 记录读取次数
    * echo N('db'); // 获取当前页面数据库的所有操作次数
    * echo N('read'); // 获取当前页面读取次数
    * </code> 
    * @param string $key 标识位置
    * @param integer $step 步进值
    * @return mixed
    */
   function N($key, $step=0,$save=false) {
       static $_num    = array();
       if (!isset($_num[$key])) {
           $_num[$key] = (false !== $save)? S('N_'.$key) :  0;
       }
       if (empty($step))
           return $_num[$key];
       else
           $_num[$key] = $_num[$key] + (int) $step;
       if(false !== $save){ // 保存结果
           S('N_'.$key,$_num[$key],$save);
       }
   }

   //中断脚本执行
   function halt($msg){
      header("Context-type:text/html;charset=utf-8");
      echo $msg;
      exit;
   }

   //类文件自动加载
   function __autoload($class){
      if(substr($class, -10) == 'Controller'){
         require_array(
            array(
              CONTROLLER_PATH.$class.'.class.php',
              YY_PATH.$class.'.class.php'
            )
         );
      }else if(substr($class, -5) == 'Model'){
         require_array(
            array(
              MODEL_PATH.$class.'.class.php',
              YY_PATH.$class.'.class.php'
            )
         );
      }elseif (substr($class, 0,2) == 'Db') {
         require_array(
            array(
              YY_PATH.'Driver/Db/'.$class.'.class.php'
            )
         );
      }elseif(substr($class, -5) == 'Cache'){
         require_array(
            array(
               YY_PATH.'Core/'.$class.'.class.php'
            )
         );
      }
   }

   //以数组形式加载文件
   function require_array($files){
      foreach ($files as $v) {
         is_file($v) && require $v;
      }
   }

   //获取客户端IP
   function get_client_ip(){
     $ip = $_SERVER["REMOTE_ADDR"];
     return  $ip;
   }
