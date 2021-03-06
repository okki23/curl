<?php
//header('Content-Type: application/json');
include "konek.php";

$data = array("key" => "170802052520k704a4ea1b924837dc639307650e27e34354317558",
              "scope" => "company",
              "operation" => "select",
              "data" => array("page" => 5,"fields" => 
			  ["name","countryRegNumber","companyNumber","email",
			  "web","phone","invoiceEmail","newsletter","linkedin",
			  "facebook","skype","countryId","branchCategoryId","note",
			  "creditTime","connectDepartment","connectUser","directions",
			  "visitAddress","postAddress","deliveryAddress","invoiceAddress"
			  ,"file","attribute"]));
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

$companylist = json_decode($result, true);///

//var_dump($companylist);
//exit();

foreach ($companylist['data'] as $key => $value) {
  
  echo "insert into company (CompanyID,CompanyName,CompanyNumber,OrgNumber,Email,WWW,ClassificationID,ExternalID,Phone,LinkedIn,Facebook)
  values
  (null,'$value[name]','$value[companyNumber]','$value[countryRegNumber]','$value[email]','$value[web]','$value[branchCategoryId]','$value[companyId]','$value[phone]','$value[linkedin]','$value[facebook]');";
	/* 
	echo "insert into companystruct (ParentCompanyID,ChildCompanyID,Active) values ('0','$value[companyId]','1');";
  */
  }
exit();
 
foreach ($companylist['data'] as $key => $value) {
  echo "insert into company (CompanyID,CompanyName,CompanyNumber,OrgNumber,Email,WWW,ClassificationID,Phone,LinkedIn,Facebook)
  values
  ('$value[companyId]','$value[name]','$value[companyNumber]','$value[countryRegNumber]','$value[email]','$value[web]','$value[branchCategoryId]','$value[phone]','$value[linkedin]','$value[facebook]');";

/*
 mysqli_query($connect,"insert into temp_company (companyId,name,countryRegNumber,companyNumber,email,web,phone,invoiceEmail,newsletter,linkedin,facebook,skype,countryId,branchCategoryId,creditTime)
     values
    ('$value[companyId]','$value[name]','$value[countryRegNumber]','$value[companyNumber]','$value[email]','$value[web]','$value[phone]','$value[invoiceEmail]','$value[newsletter]','$value[linkedin]','$value[facebook]','$value[skype]','$value[countryId]','$value[branchCategoryId]','$value[creditTime]')");

*/
 // echo "<br>";
 // echo "insert into company (CompanyID,CompanyName,CompanyNumber,OrgNumber,Email,WWW,Phone,LinkedIn,Facebook)
 //     values
 //    ('$value[companyId]','$value[name]','$value[companyNumber]','$value[countryRegNumber]','$value[email]','$value[web]','$value[phone]','$value[linkedin]','$value[facebook]');";
 mysqli_query($connect,"insert into company (CompanyID,CompanyName,CompanyNumber,OrgNumber,Email,WWW,Phone,LinkedIn,Facebook)
    values
   ('$value[companyId]','$value[name]','$value[companyNumber]','$value[countryRegNumber]','$value[email]','$value[web]','$value[phone]','$value[linkedin]','$value[facebook]')");
 // echo "<br>";
 // echo "insert into companystruct (ChildCompanyID)
 //     values
 //    ('$value[companyId]');";

//mysqli_query($connect,"insert into companystruct (ChildCompanyID) values ('$value[companyId]')");

/* echo "insert into temp_company (companyId,name,countryRegNumber,companyNumber,email,web,phone,invoiceEmail,newsletter,linkedin,facebook,skype,countryId,branchCategoryId,creditTime)
     values
    ('$value[companyId]','$value[name]','$value[countryRegNumber]','$value[companyNumber]','$value[email]','$value[web]','$value[phone]','$value[invoiceEmail]','$value[newsletter]','$value[linkedin]','$value[facebook]','$value[skype]','$value[countryId]','$value[branchCategoryId]','$value[creditTime]');";*/


  if(isset($value['visitAddress'])){
    //echo $value['visitAddress']['address1'];
    // echo "<br>";
    // echo "insert into temp_company_visit_address (id,company_id,address1,address2,postalCode,city,country) values
    // (null,'".$value['companyId']."','".$value['visitAddress']['address1']."','".$value['visitAddress']['address2']."','".$value['visitAddress']['postalCode']."','".$value['visitAddress']['city']."','".$value['visitAddress']['country']."');";
    mysqli_query($connect,"insert into temp_company_visit_address (id,company_id,address1,address2,postalCode,city,country) values
    (null,'".$value['companyId']."','".$value['visitAddress']['address1']."','".$value['visitAddress']['address2']."','".$value['visitAddress']['postalCode']."','".$value['visitAddress']['city']."','".$value['visitAddress']['country']."')");

  }


  if(isset($value['postAddress'])){
    //echo $value['postAddress']['address1'];
  //  echo "<br>";
  //  echo "insert into temp_company_post_address (id,company_id,address1,address2,postalCode,city,country) values
  //   (null,'".$value['companyId']."','".$value['visitAddress']['address1']."','".$value['visitAddress']['address2']."','".$value['visitAddress']['postalCode']."','".$value['visitAddress']['city']."','".$value['visitAddress']['country']."');";
   mysqli_query($connect,"insert into temp_company_post_address (id,company_id,address1,address2,postalCode,city,country) values
   (null,'".$value['companyId']."','".$value['visitAddress']['address1']."','".$value['visitAddress']['address2']."','".$value['visitAddress']['postalCode']."','".$value['visitAddress']['city']."','".$value['visitAddress']['country']."')");

  }


  if(isset($value['deliveryAddress'])){
    //echo $value['postAddress']['address1'];
    // echo "<br>";
    // echo "insert into temp_company_delivery_address (id,company_id,address1,address2,postalCode,city,country) values
    // (null,'".$value['companyId']."','".$value['visitAddress']['address1']."','".$value['visitAddress']['address2']."','".$value['visitAddress']['postalCode']."','".$value['visitAddress']['city']."','".$value['visitAddress']['country']."');";
    mysqli_query($connect,"insert into temp_company_delivery_address (id,company_id,address1,address2,postalCode,city,country) values
    (null,'".$value['companyId']."','".$value['visitAddress']['address1']."','".$value['visitAddress']['address2']."','".$value['visitAddress']['postalCode']."','".$value['visitAddress']['city']."','".$value['visitAddress']['country']."')");

  }

  if(isset($value['invoiceAddress'])){
    //echo $value['postAddress']['address1'];
  //   echo "<br>";
  //   echo "insert into temp_company_invoice_address (id,company_id,address1,address2,postalCode,city,country) values
  //  (null,'".$value['companyId']."','".$value['visitAddress']['address1']."','".$value['visitAddress']['address2']."','".$value['visitAddress']['postalCode']."','".$value['visitAddress']['city']."','".$value['visitAddress']['country']."');";
    mysqli_query($connect,"insert into temp_company_invoice_address (id,company_id,address1,address2,postalCode,city,country) values
    (null,'".$value['companyId']."','".$value['visitAddress']['address1']."','".$value['visitAddress']['address2']."','".$value['visitAddress']['postalCode']."','".$value['visitAddress']['city']."','".$value['visitAddress']['country']."')");

  }


  if(isset($value['file'])){
    //echo $value['postAddress']['address1'];
  //   echo "insert into temp_company_file ('id','company_id','extension','created','base64') values
  //  (null,'".$value['companyId']."','".$value['file']['extension']."','".$value['file']['created']."','".$value['file']['base64']."');";
    mysqli_query($connect,"insert into temp_company_file ('id','company_id','extension','created','base64') values
    (null,'".$value['companyId']."','".$value['file']['extension']."','".$value['file']['created']."','".$value['file']['base64']."')");

  }


  if(isset($value['attribute'])){
    //echo $value['postAddress']['address1'];
  //   echo "<br>";
  //   echo "insert into temp_company_attribute ('id','company_id','text','boolean','rating','checkboxlds','dropdownld') values
  //  (null,'".$value['companyId']."','".$value['attribute']['text']."','".$value['attribute']['boolean']."','".$value['attribute']['rating']."','".$value['attribute']['checkboxlds']."','".$value['attribute']['dropdownld']."');";
     mysqli_query($connect,"insert into temp_company_attribute ('id','company_id','text','boolean','rating','checkboxlds','dropdownld') values
    (null,'".$value['companyId']."','".$value['attribute']['text']."','".$value['attribute']['boolean']."','".$value['attribute']['rating']."','".$value['attribute']['checkboxlds']."','".$value['attribute']['dropdownld']."')");

  }



  }



?>
