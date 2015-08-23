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

function input_csv($handle) { 
    $out = array (); 
    $n = 0; 
    while ($data = fgetcsv($handle, 10000)) { 
        $num = count($data); 
        for ($i = 0; $i < $num; $i++) { 
            $out[$n][$i] = $data[$i]; 
        } 
        $n++; 
    } 
    return $out; 
} 

function export_csv($filename,$data) { 
    header("Content-type:text/csv"); 
    header("Content-Disposition:attachment;filename=".$filename); 
    header('Cache-Control:must-revalidate,post-check=0,pre-check=0'); 
    header('Expires:0'); 
    header('Pragma:public'); 
    echo $data; 
} 