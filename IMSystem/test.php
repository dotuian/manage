<?php

$str = '综合高中';
var_dump(mb_strlen($str, 'UTF-8'));

$str = 'ABCD';
var_dump(mb_strlen($str,'UTF-8'));

$str = '综合高中ABCD';
var_dump(mb_strlen($str, 'UTF-8'));


$encode = mb_detect_encoding($string, array('ASCII', 'UTF-8', 'GB2312', 'GBK', 'BIG5')); 
echo $encode; // ASCII

