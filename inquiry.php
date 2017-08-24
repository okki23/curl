<?php
//header('Content-Type: application/json');
include "konek.php";

/*$key = "170802052520k704a4ea1b924837dc639307650e27e34354317558";
$scope = "company";
$operation = "select";
$data = array("key"=>$key,"scope"=>$scope,"operation"=>$operation,"data"=>array("page"=>2,"fields"=>array("name","countryRegNumber","email","invoiceaAddress"))
	);


$jsondata = json_encode($data);


$data_string = json_encode($jsondata);*/
/*
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

//execute post
$result = curl_exec($ch);

//close connection
curl_close($ch);

$www = json_decode($result, true);

print_r($www);*/






$data = array("key" => "170802052520k704a4ea1b924837dc639307650e27e34354317558",
              "scope" => "inquiry",
              "operation" => "insert",
              "data" => array("page" => 1, "fields" => ["settings"]));
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

var_dump($companylist);
exit();

?>
