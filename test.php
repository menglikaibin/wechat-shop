<?php

$data = array('a'=>'foo', 'b'=>'bar 2');
$a = http_build_query($data);

echo "http://www.aaa.com/index.php?" . $a;



