<?php
include "konek.php";
 
$data = array("key" => "170802052520k704a4ea1b924837dc639307650e27e34354317558",
              "scope" => "project",
              "operation" => "select",
              "data" => array("page" => 129, "fields" => ["companyId","projectId","departmentId","responsibleUserId","name","description","categoryId","statusId","percentCompleted","invoiceNotes","startDate","endDate","created","updated"]));
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

var_dump($companylist['data']);
exit(); 
foreach ($companylist['data'] as $key => $value) {
/*
ProjectID
Heading
Type
CommentCustomer
ValidFrom
ValidTo
Status
Priority
CompanyID
Active
ResponsiblePersonID
FinishedDate
RegisteredByPersonID
SalePersonID
Address
Zipcode
EnableZeroYearEnd
RequestID
City
CommentInternal
CreatedByPersonID
UpdatedByPersonID
CreatedDateTime
TS
ContactPersonID
PersonID
EnableHourListOnExtranet
RetailCompanyID
RetailKickbackPercent
isSupport
*/
   /* $qry = mysqli_query($connect,"select * from company where CompanyID = '$value[customerId]'")->fetch_object();
    var_dump($qry);*/
   echo "insert into temp_project (ProjectID,Heading,Status,ValidFrom,ValidTo,CompanyID,Active,ResponsiblePersonID,RetailCompanyID) values 
('".$value['projectId']."','".$value['name']."','registered','2017-08-30 00:00:00','9999-12-31 00:00:00','".$value['customerId']."','1','".$value['responsibleUserId']."','".$value['departmentId']."');";

// 	$sql = mysqli_query($connect,"insert into temp_project (ProjectID,Heading,Status,ValidFrom,ValidTo,CompanyID,Active,ResponsiblePersonID,RetailCompanyID) values 
// ('".$value['projectId']."','".$value['name']."','registered','2017-08-30 00:00:00','9999-12-31 00:00:00','".$value['customerId']."','1','".$value['responsibleUserId']."','".$value['departmentId']."')");
  
}

// if($sql){
// 	echo "inserted!";
// }else{
// 	echo mysqli_error($connect);
// }

 
?>