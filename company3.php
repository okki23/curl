
<?php
//header('Content-Type: application/json');
include "konek.php";

$data = array("key" => "170802052520k704a4ea1b924837dc639307650e27e34354317558",
              "scope" => "company",
              "operation" => "select",
              "data" => array("page" => 5, "fields" => ["name","countryRegNumber","companyNumber","email","web","phone","invoiceEmail","newsletter","linkedin","facebook","skype","countryId","branchCategoryId","note","creditTime","connectDepartment","connectUser","directions","visitAddress","postAddress","deliveryAddress","invoiceAddress","file","attribute"]));
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

$companylist = json_decode($result, true);
//var_dump($companylist);
//visitAddress postAddress  invoiceAddress
//var_dump($companylist['data']);
//exit();
// $no  = 950;
foreach ($companylist['data'] as $key => $value) {
  //echo $value['companyId'];
   // $qry = mysqli_query($connect,"select * from company where CompanyID = '$value[companyId]'")->fetch_object();
   //  var_dump($qry);

	echo "insert into project (ProjectID,Heading,Status,ValidFrom,ValidTo,CompanyID,Active) values 
(null,'".$value['name']."','registered','2017-08-28 00:00:00','9999-12-31 00:00:00','".$value['companyId']."','1');";


}
/*echo "insert into project (ProjectID,Heading,Status,ValidFrom,ValidTo,CompanyID,Active) values 
(null,'".$value['name']."','registered','2017-08-28 00:00:00','9999-12-31 00:00:00','".$value['companyId']."','1');";
}*/






?>
