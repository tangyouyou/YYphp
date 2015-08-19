<?php
//变量调节器开发

function smarty_modifier_colorchange($string,$color){
   return '<font color="'. $color . '">'.$string .'</font>';
}

?>