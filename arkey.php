 <?php
// $array = array(
// "name" => "John",
// "surname" => "Doe",
// "email" => "nowhere@nowhere.com"
// );

// function bastard($array){
// 	$comma = '' ;
// 	$output = '' ;
// 	foreach( $array as $key=>$data ) {
// 	$output .= $comma . $key . ':' . $data;
// 	$comma = ',';
// 	return $output;
// 	}
// }


// echo bastard($array);
 
 $fruits = array('123'=>'apple','124'=>'bannana','125'=>'orange');
 echo implode(", ", array_keys($fruits));


?>