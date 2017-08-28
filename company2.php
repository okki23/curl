
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

//visitAddress postAddress  invoiceAddress
//var_dump($companylist['data']);
//exit();
$no  = 950;
foreach ($companylist['data'] as $key => $value) {

if(isset($value['visitAddress']) && isset($value['postAddress']) && isset($value['invoiceAddress']) ){
/*

if($value['visitAddress'] == $value['postAddress']){
 echo '1';
 echo '<br>';
 echo '<hr>';
}else if($value['visitAddress'] == $value['invoiceAddress']){
 echo '2';
 echo '<br>';
 echo '<hr>';
}else if($value['postAddress'] == $value['invoiceAddress']){
 echo '3';
 echo '<br>';
 echo '<hr>';
}else{
 echo '4';
 echo '<br>';
 echo '<hr>';
}

*/
 if($value['visitAddress'] == $value['postAddress']){
	 
 echo "insert into address (AddressID,Address,City,ZipCode,State,Country,Address2,IsVisitAddress,IsDeliveryAddress,IsInvoiceAddress) values
 ('".$no."','".$value['visitAddress']['address1']."','".$value['visitAddress']['city']."','".$value['visitAddress']['postalCode']."','".$value['visitAddress']['city']."','".$value['visitAddress']['country']."','".$value['visitAddress']['address2']."','1','1','');";
 echo "insert into companyaddressstruct (AddressID,CompanyID) values
 ('".$no."','".$value['companyId']."');";
 
 
}else if($value['visitAddress'] == $value['invoiceAddress']){
	
 echo "insert into address (AddressID,Address,City,ZipCode,State,Country,Address2,IsVisitAddress,IsDeliveryAddress,IsInvoiceAddress) values
 ('".$no."','".$value['visitAddress']['address1']."','".$value['visitAddress']['city']."','".$value['visitAddress']['postalCode']."','".$value['visitAddress']['city']."','".$value['visitAddress']['country']."','".$value['visitAddress']['address2']."','1','','1');";
  echo "insert into companyaddressstruct (AddressID,CompanyID) values
 ('".$no."','".$value['companyId']."');";
 
 
}else if($value['postAddress'] == $value['invoiceAddress']){

 echo "insert into address (AddressID,Address,City,ZipCode,State,Country,Address2,IsVisitAddress,IsDeliveryAddress,IsInvoiceAddress) values
 ('".$no."','".$value['visitAddress']['address1']."','".$value['visitAddress']['city']."','".$value['visitAddress']['postalCode']."','".$value['visitAddress']['city']."','".$value['visitAddress']['country']."','".$value['visitAddress']['address2']."','','1','1');";
  echo "insert into companyaddressstruct (AddressID,CompanyID) values
 ('".$no."','".$value['companyId']."');";
 
 
}else{
echo "insert into address (AddressID,Address,City,ZipCode,State,Country,Address2,IsVisitAddress,IsDeliveryAddress,IsInvoiceAddress) values
 ('".$no."','".$value['visitAddress']['address1']."','".$value['visitAddress']['city']."','".$value['visitAddress']['postalCode']."','".$value['visitAddress']['city']."','".$value['visitAddress']['country']."','".$value['visitAddress']['address2']."','1','1','1');";
 echo "insert into companyaddressstruct (AddressID,CompanyID) values
 ('".$no."','".$value['companyId']."');";
 
 
}
$no++;

 //echo '<br>';
 //echo "insert into address (Address,City,ZipCode,State,Country,Address2,IsVisitAddress,IsDeliveryAddress,IsInvoiceAddress) values
 //('".$value['visitAddress']['address1']."','".$value['visitAddress']['city']."','".$value['visitAddress']['postalCode']."','".$value['visitAddress']['city']."','".$value['visitAddress']['country']."','".$value['visitAddress']['address2']."','1','1','1');";
 //echo '<hr>';
 //
 // echo "<br>";
 // echo "insert into temp_company_post_address (id,company_id,address1,address2,postalCode,city,country) values
 // (null,'".$value['companyId']."','".$value['postAddress']['address1']."','".$value['postAddress']['address2']."','".$value['postAddress']['postalCode']."','".$value['postAddress']['city']."','".$value['postAddress']['country']."');";
 // echo '<hr>';
 //
 // echo "<br>";
 // echo "insert into temp_company_invoice_address (id,company_id,address1,address2,postalCode,city,country) values
 // (null,'".$value['companyId']."','".$value['invoiceAddress']['address1']."','".$value['invoiceAddress']['address2']."','".$value['invoiceAddress']['postalCode']."','".$value['invoiceAddress']['city']."','".$value['invoiceAddress']['country']."');";
 // echo '<hr>';

}else{

}


}






?>
