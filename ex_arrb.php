<?php
// $input = array(
//     'item1'  => 'object1',
//     'item2'  => 'object2',
//     'item-n' => 'object-n'
// );

 
// $output = implode(', ', array_map(
//     function ($v, $k) {
//         if(is_array($v)){
//             return $k.'[]='.implode('&'.$k.'[]=', $v);
//         }else{
//             return $k.'='.$v;
//         }
//     }, 
//     $input, 
//     array_keys($input)
// )); 

// echo $output;
 
  $a=array("item1"=>"object1", "item2"=>"object2");
  echo http_build_query($a,'',', ');

?>