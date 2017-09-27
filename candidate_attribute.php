<?php
//header('Content-Type: application/json');
include "konek.php";

function string_from_array_assoc($nameArray){
$users = Array();
$output = '';
 
/* Add each user to the new array */
foreach ($nameArray as $key => $value) {
  $users[] = $key  . ' (' . $value . ')';
}
$output =  'The values are: '. implode(', ',$users);
return $output;
}

$data = array("key" => "170802052520k704a4ea1b924837dc639307650e27e34354317558",
              "scope" => "candidateAttribute",
              "operation" => "select",
              "data" => array("page" => 1, "fields" => ["all"]));
$data_string = json_encode($data);
$ch = curl_init('https://api.recman.no/post/');
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json',
    'Content-Length: ' . strlen($data_string))
);
curl_setopt($ch, CURLOPT_TIMEOUT, 5);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);

$result = curl_exec($ch);
curl_close($ch);

//echo "<pre>$result</pre>";
//print_r(json_decode($result, true));
$companylist = json_decode($result, true);

// var_dump($companylist['data']);
// exit();

foreach ($companylist['data'] as $key => $value) {
	echo "--<br>";
	echo $value['id']."   ". $value['name']."<br>";
	//var_dump($value);
	if(isset($value['checkbox_list'])){

		 
			 echo string_from_array_assoc($value['checkbox_list']);
		 

	}else{
		echo "nothing_checkbox_list<br>";
	}
	echo "-- <br>";
}
/* 
  $a=array("item1"=>"object1", "item2"=>"object2");
  echo http_build_query($a,'',', ');
*/

?>
