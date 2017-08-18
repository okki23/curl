<?php
/*Field   Description     Required    Data type
corporationId   Corporation ID  Yes     int
firstName   First name  Yes     string
lastName    Last name   Yes     string
title   Title   No  string
email   Email   No  string
password    Password    No  string
languageId  Language ID

1= English

2= Swedish

3= Danish

4= Norwegian
    No  int
mobilePhone     Mobile phone number     No  string
homePhone   Home phone number   No  string
officePhone     Work phone number   No  string
workEmail   Work email  No  string
gender  Gender (male/female)    No  string
dob     Date of birth in format

dd.mm.yyyy
    No  string
departmentId    Department ID   No  string
description     Description     NO  string
notes   Notes   No  string
connectDepartment   Connect to department(ID)   No  int(array)
connectUser     Connected user/co-worker(ID)    No  int(array)
connectCompany  Connected company(ID)   No  int(array)
connectCompanyContact   Connected Company Contact(ID)   No  int(array)
rating  Star-rating (1-5)   no  int
facebook    Facebook    no  string
linkedin    LinkedIN    no  string
twitter     Twitter     no  string
web     Homepage    no  string
blockedCompanyIds   Blocks candidate from companies, by ID  no   string
children    Adds children by adding the year they were bort (1998, 2001, ect)   no  int (array)
nationality     Nationality     no  string
internal*/

$data = array("key" => "170802052520k704a4ea1b924837dc639307650e27e34354317558",
              "scope" => "candidate",
              "operation" => "select",
              "data" => array("page" => 1, "fields" => ["corporationId","firstName","lastName","title","email","password","languageId","statusId","mobilePhone","homePhone","officePhone","workEmail","gender","dob","departmentId","description","notes","connectDepartment","connectUser","connectCompany","connectCompanyContact","rating","facebook","linkedin","twitter","web","blockedCompanyIds","children","nationality"]));
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
 
  
}
?>