<?php
//last 5 '222248'

include "konek.php";
$data = array("key" => "170802052520k704a4ea1b924837dc639307650e27e34354317558",
              "scope" => "candidate",
              "operation" => "select",
              "data" => array("page" => 122, "fields" => ["corporationId","firstName","lastName","title","email","password","languageId","statusId","mobilePhone","homePhone","officePhone","workEmail","gender","dob","departmentId","description","notes","connectDepartment","connectUser","connectCompany","connectCompanyContact","rating","facebook","linkedin","twitter","web","blockedCompanyIds","children","nationality","internal","education","experience","certifications","address","skills","languages","employee","dependents","jobApplication","profilePicture","candidateId","file","candidateAttributes","tags"]));
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
 var_dump($companylist);
 exit();

foreach ($companylist['data'] as $key => $value) {
	// echo "insert into temp_person (PersonID,FirstName,LastName,Title,Email,MobilePhoneNumber,HomePhone,Gender,BirthDate,Notes,LanguageID,Active,Defaultinterface,DefaultModule,DefaultTemplate,Classification) values ('".$value['candidateId']."','".$value['firstName']."','".$value['lastName']."','".$value['title']."','".$value['email']."','".$value['mobilePhone']."','".$value['homePhone']."','".$value['gender']."','".$value['dob']."','".str_replace("'","",$value['description'])."','".$value['languageId']."','1','internett1','publish','profil','A'); "; 
	// // exit();

  $sql = mysqli_query($connect,"insert into temp_person(PersonID,FirstName,LastName,Title,Email,MobilePhoneNumber,HomePhone,Gender,BirthDate,Notes,LanguageID,Active,Defaultinterface,DefaultModule,DefaultTemplate,Classification) values ('".$value['candidateId']."','".$value['firstName']."','".$value['lastName']."','".$value['title']."','".$value['email']."','".$value['mobilePhone']."','".$value['homePhone']."','".$value['gender']."','".$value['dob']."','".str_replace("'","",$value['description'])."','".$value['languageId']."','1','internett1','publish','profil','A') ");


}


if($sql){
	echo "inserted!";
}else{
	echo mysqli_error($connect);
}
 
 
?>