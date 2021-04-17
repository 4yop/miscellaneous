<?php
//819. 最常见的单词
function mostCommonWord($paragraph, $banned) {
    $paragraph = strtolower($paragraph);
    $regex = "/\/|\～|\，|\。|\！|\？|\“|\”|\【|\】|\『|\』|\：|\；|\《|\》|\’|\‘|\ |\·|\~|\!|\@|\#|\\$|\%|\^|\&|\*|\(|\)|\_|\+|\{|\}|\:|\<|\>|\?|\[|\]|\,|\.|\/|\;|\'|\`|\-|\=|\\\|\|/";
    $paragraph = preg_replace($regex," ",$paragraph);
    $arr = array_filter(explode(' ',$paragraph));
    $count = array_count_values($arr);
    arsort($count);
    foreach($count as $k=>$v){
        if(!in_array($k,$banned) ){
            return $k;
        }
    }
    return '';
}

$paragraph = "Bob. hIt, baLl";
$banned = ["bob", "hit"];


$res = mostCommonWord($paragraph,$banned);
print_r($res);