<?php
/*********************/
/*                   */
/*  Version : 1.0.0  */
/*  Author  : 唐悠悠 */
/*  Time    : 150928 */
/*                   */
/*********************/

//URL路由处理类
final class Route{

	static public function group(){
		if(C('URL_TYPE') == 2){//URL普通模式
			(isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : $_SERVER['QUERY_STRING']);
		}

	}

	//分析路由 && 清除伪静态后缀
	static private function parseRoute($query){
		$route = C('ROUTE');
		if(!$route or !is_array($route)) return $query;
		foreach ($route as $k => $v) {
			//正则路由
			if(preg_match("@^/.*/[isUx]*$@i",$k)){
				//如果匹配URL地址
				if(preg_match($k,$query)){
					//元子组替换
                    $v = str_replace('#', '\\', $v);
                    //匹配当前正则路由,url按正则替换
                    return preg_replace($k, $v, $query);
				}
				//下一个路由规则
                continue;
			}
			//非正则路由
            $search = array(
                '@(:year)@i',
                '@(:month)@i',
                '@(:day)@i',
                '@(:num)@i',
                '@(:any)@i',
                '@(:[a-z0-9]+\\\d)@i',
                '@(:[a-z0-9]+\\\w)@i',
                '@(:[a-z0-9]+)@i'
            );
            $replace = array(
                '\d{4}',
                '\d{1,2}',
                '\d{1,2}',
                '\d+',
                '.+',
                '\d+',
                '\w+',
                '([a-z0-9]+)'
            );
            //将:year等替换
            $base_preg = "@^" . preg_replace($search, $replace, $k) . "$@i";
            //不满足路由规则
            if (!preg_match($base_preg, $query)) {
                continue;
            }
            //满足路由，但不存在参数如:uid等
            if (!strstr($k, ":")) {
                return $v;
            }
            /**
             * user/:id=>user/1
             */
            $vars = "";
            preg_match('/[^:\sa-z0-9]/i', $k, $vars);
            //:id=>"index/index"
            if (isset($vars[0])) {
                //拆分路由获得:id
                $roles_ex = explode($vars[0], $k);
                //上例中拆分请求参数获得1
                $url_args = explode($vars[0], $query);
            } else {
                $roles_ex = array($k);
                $url_args = array($query);
            }
            //匹配路由规则
            $query = $v;
            foreach ($roles_ex as $m => $n) {
                if (!strstr($n, ":")) {
                    continue;
                }
                $_GET[str_replace(":", "", $n)] = $url_args[$m];
            }
            return $query;
		}
		return $query;
	}

	/**
     * 移除URL中的指定GET变量
     * 使用函数remove_url_param()调用
     * @param string $var 要移除的GET变量
     * @param null $url url地址
     * @return mixed|string 移除GET变量后的URL地址
     */
    static public function removeUrlParam($var, $url = null)
    {
        $pathinfo_dli = C("PATHINFO_DLI");
        if (!is_null($url)) {
            $url_format = strstr($url, "&") ? $url . '&' : $url . $pathinfo_dli;
            $url = str_replace($pathinfo_dli, "###", $url_format);
            $search = array(
                "/$var" . "###" . ".*?" . "###" . "/",
                "/$var=.*?&/i",
                "/\?&/",
                "/&&/"
            );
            $replace = array(
                "",
                "",
                "?",
                ""
            );
            $url_replace = preg_replace($search, $replace, $url);
            $url_rtrim = rtrim(rtrim($url_replace, "&"), "###");
            return str_replace("###", $pathinfo_dli, $url_rtrim);
        }
        $get = $_GET;
        unset($get[C("VAR_APP")]);
        unset($get[C("VAR_CONTROL")]);
        unset($get[C("VAR_METHOD")]);
        $url = '';
        $url_type = C("URL_TYPE");
        foreach ($get as $k => $v) {
            if ($k === $var)
                continue;
            if ($url_type == 1) {
                $url .= $pathinfo_dli . $k . $pathinfo_dli . $v;
            } else {
                $url .= "&" . $k . "=" . $v;
            }
        }
        $url_rtrim = trim(trim($url, $pathinfo_dli), '&');
        $url_str = empty($url_rtrim) ? "" : $pathinfo_dli . $url_rtrim;
        if ($url_type == 1) {
            return __METH__ . $url_str;
        } else {
            return __METH__ . "&" . trim($url_str, "&");
        }
    }
}

Route::group();