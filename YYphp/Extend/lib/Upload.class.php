<?php
/*********************/
/*                   */
/*  Version : 5.1.0  */
/*  Author  : 唐悠悠 */
/*  Time    : 150929 */
/*                   */
/*********************/

//上传处理类
class Upload{

	//上传类型
    public $ext = array();
    //上传文件大小
    public $size;
    //上传路径
    public $path;
    //错误信息
    public $error;
    //缩略图处理
    public $thumbOn;
    //缩略图参数
    public $thumb = array();
    //是否加水印
    public $waterMarkOn;
    //上传成功文件信息
    public $uploadedFile = array();

    /**
     * 构造函数
     * @param string $path        上传路径
     * @param array  $ext         上传文件后缀
     * @param array  $size        允许上传大小,如array('jpg'=>200000,'rar'=>'39999') 如果不设置系统会依据配置项C("UPLOAD_EXT_SIZE")值
     * @param [type] $waterMarkOn 上传文件是否添加水印
     * @param [type] $thumbOn     是否生成缩略图
     * @param array  $thumb       缩略图处理参数  只接收3个参数 1缩略图宽度 2缩略图高度  3缩略图生成规则
     */
    public function __construct($path = '', $ext = array(),$size = array(),$waterMarkOn = null,$thumbOn = null,$thumb = array()){
    	$path = empty($path) ? C('UPLOAD_PATH') : $path;
    	$this->path = preg_match('@/|\\\@', substr($path, -1)) ? $path : $path . '/';
    	$ext = empty($ext) ? array_keys(C("UPLOAD_EXT_SIZE")) : $ext;
    	foreach ($ext as $k => $v) {
    		$this->ext[] = strtoupper($v);
    	}
   		$this->size = $siez ? $size : C('UPLOAD_EXT_SIZE');
   		$this->waterMarkOn = is_null($waterMarkOn) ? C("WATER_ON") : $waterMarkOn;
        $this->thumbOn = is_null($thumbOn) ? C("UPLOAD_THUMB_ON") : $thumbOn;
        $this->thumb = $thumb;
    }

    /**
     * 将文件上传至服务器
     */
    public function upload(){

    }

    /**
     * 将上传文件整理为标准数组
     * @return [type] [description]
     */
    public function format(){
    	$files = $_FILES();
    	if(!isset($files)){
    		$this->error = L("upload_format_error");
    		return fasle;
    	}
    	$n = 0;
    	$info = array();
    	foreach ($files as $k => $v) {
    		if(is_array($v['name'])){
    			$count = count($v['name']);
    			for($i = 0; $i<$count; $i++){
    				foreach ($v as $m => $j) {
    					$info[$n][$m] = $j[$i];
    				}
    				$info[$n]['fieldname'] = $k; //字段名
                    $n++;
    			}
    		}else{
    			$info [$n] = $v;
                $info [$n] ['fieldname'] = $k; //字段名
                $n++;
    		}
    	}
    	return $info;
    }

    /**
     * 验证目录
     * @param  [type] $path [description]
     * @return [type]       [description]
     */
    private function checkDir($path){

    }

    /**
     * 验证文件
     * @return [type] [description]
     */
    private function checkFile($file){
    	if($file['error'] != 0){
    		$this->error = $file['error'];
    		return false;
    	}
    	
    }
}