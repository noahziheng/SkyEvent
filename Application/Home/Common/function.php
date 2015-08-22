<?php
/**   
* PHP去掉特定的html标签 
* @param array $string   
* @param bool $str  
* @return string 
*/  
function _strip_tags($str,$tagsArr=array('p')) {
    foreach ($tagsArr as $tag) {  
        $p[]="/(<(?:\/".$tag."|".$tag.")[^>]*>)/i";  
    }  
    $str = preg_replace($p,"",$str);
    $return_str = str_replace("\n",'',$str);
    return $return_str;  
}