<?php
 
/*$curl_handle=curl_init();
curl_setopt($curl_handle,CURLOPT_URL,'http://api.recman.no/v1.php?key=170802052520k704a4ea1b924837dc639307650e27e34354317558&scope=job_post&fields=name,title,logo,place,num_positions,deadline&type=json');
curl_setopt($curl_handle,CURLOPT_CONNECTTIMEOUT,2); //waktu timeout ketika server tidak aktif
curl_exec($curl_handle);
curl_close($curl_handle);
echo json_decode($curl_handle);

*/
 

$url = 'http://api.recman.no/v1.php?key=170802052520k704a4ea1b924837dc639307650e27e34354317558&scope=job_post&fields=name,title,logo,place,num_positions,deadline&type=json';

$cURL = curl_init();

curl_setopt($cURL, CURLOPT_URL, $url);
curl_setopt($cURL, CURLOPT_HTTPGET, true);

curl_setopt($cURL, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json',
    'Accept: application/json'
));

$result = curl_exec($cURL);

curl_close($cURL);



var_dump($result);

 
 
?>