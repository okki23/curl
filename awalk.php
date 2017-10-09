<?php
	$a = array("item1"=>"object1", "item2"=>"object2","item-n"=>"object-n");
    $r=array();
    array_walk($a, create_function('$b, $c', 'global $r; $r[]="$c=$b";'));
    echo implode(', ', $r);
?>