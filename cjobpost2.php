<?php
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,'http://api.recman.no/v1.php?key=170802052520k704a4ea1b924837dc639307650e27e34354317558&scope=job_post&fields=name,title,logo,place,num_positions,deadline&type=json');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post));
$response = curl_exec($ch);
$result = json_decode($response);
var_dump($result);
/*
foreach($result as $key=>$value){
	echo $value->name;
}
*/
?>

