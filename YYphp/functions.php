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
   			return isset($config[$name])? $config[$name] : null;
   		}else{
   			return $config[$name] = $value;
   		}
   }

   function md5_s($var)
  {
      return md5(serialize($var));
  }

   /**
 * 根据配置文件的URL参数重新生成URL地址
 * @param String $pathinfo 访问url
 * @param array $args GET参数
 * <code>
 * $args = "nid=2&cid=1"
 * $args=array("nid"=>2,"cid"=>1)
 * </code>
 * @return string
 */
    function U($pathinfo, $args = array())
    {
      if (preg_match("/^https?:\/\//i", $pathinfo))
          return $pathinfo;
      //是否指定单入口
      $end = strpos($pathinfo, '.php');
      if ($end) {
          $web = __ROOT__ . '/' . substr($pathinfo, 0, $end + 4);
          $pathinfo = substr($pathinfo, $end + 4);
      } else {
          $web = __WEB__;
      }
      //参数$args为字符串时转数组
      if (is_string($args)) {
          parse_str($args, $args);
      }
      $parseUrl = parse_url(trim($pathinfo, '/'));
      $path = trim($parseUrl['path'], '/');
      //解析字符串的?后参数 并与$args合并
      if (isset($parseUrl['query'])) {
          parse_str($parseUrl['query'], $query);
          $args = array_merge($query, $args);
      }
      //组合出索引数组  将?后参数与$args传参
      $gets = array();
      if (is_array($args)) {
          foreach ($args as $n => $q) {
              array_push($gets, $n);
              array_push($gets, $q);
          }
      }
      $vars = explode("/", $path);
      //入口文件类型
      $urlType = C("URL_TYPE"); //1 pathinfo 2 get
      switch ($urlType) {
          case 1:
              $root = $web . '/'; //入口位置
              break;
          case 2:
              $root = $web . '?';
              break;
      }
      //是否定义应用组
      $set_app_group = false;
      if (defined("GROUP_PATH")) {
          $set_app_group = true;
      }
      //组合出__WEB__后内容
      $data = array();
      switch (count($vars)) {
          case 2: //应用
              if ($set_app_group) {
                  $data[] = C("VAR_APP");
                  $data[] = APP;
              }
              $data[] = C("VAR_CONTROL");
              $data[] = array_shift($vars);
              $data[] = C("VAR_METHOD");
              $data[] = array_shift($vars);
              break;
          case 1: //方法
              if ($set_app_group) {
                  $data[] = C("VAR_APP");
                  $data[] = APP;
              }
              $data[] = C("VAR_CONTROL");
              $data[] = CONTROL;
              $data[] = C("VAR_METHOD");
              $data[] = array_shift($vars);
              break;
          default: //应用组及其他情况
              $data[] = C("VAR_APP");
              $data[] = array_shift($vars);
              $data[] = C("VAR_CONTROL");
              $data[] = array_shift($vars);
              $data[] = C("VAR_METHOD");
              $data[] = array_shift($vars);
              if (is_array($vars)) {
                  foreach ($vars as $v) {
                      $data[] = $v;
                  }
              }
      }
      $varsAll = array_merge($data, $gets); //合并GET参数
      $url = '';
      switch ($urlType) {
          case 1:
              foreach ($varsAll as $value) {
                  $url .= C('PATHINFO_Dli') . $value;
              }
              $url = str_replace(array("/" . C("VAR_APP") . "/", "/" . C("VAR_CONTROL") . "/", "/" . C("VAR_METHOD") . "/"), "/", $url);
              $url = substr($url, 1);
              break;
          case 2:
              foreach ($varsAll as $k => $value) {
                  if ($k % 2) {
                      $url .= '=' . $value;
                  } else {
                      $url .= '&' . $value;
                  }
              }
              $url = substr($url, 1);
              break;
      }
      $pathinfo_html = $urlType === 1 ? '.' . trim(C("PATHINFO_HTML"), '.') : ''; //伪表态后缀如.html
      return $root . Route::toUrl($url) . $pathinfo_html . C("PATHINFO_HTML");
    }

    /**
     * 类库导入
     * @param null $class 类名
     * @param null $base 目录
     * @param string $ext 扩展名
     * @return bool
     */
    function import($class = null, $base = null, $ext = ".class.php")
    {
        $class = str_replace(".", "/", $class);
        if (is_null($base)) {
            halt('请输入类所处位置');
        }
        $base = rtrim($base, '/') . '/';
        $file = $base . $class . $ext;
        if (!class_exists($class, false)) {
            return require($file);
        }
        return true;
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
