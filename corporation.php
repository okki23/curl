<?php


$data = array("key" => "170802052520k704a4ea1b924837dc639307650e27e34354317558",
              "scope" => "corporation",
              "operation" => "select",
              "data" => array("page" => 1, "fields" => ["name","phone","email","logo","footer_logo","about","webpage","facebook","linkedin","twitter","rm_page"]));
$data_string = json_encode($data);
$ch = curl_init('https://api.recman.no/v1.php');
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
$corp = json_decode($result, true);

var_dump($corp);
exit();
 
 

 
?>