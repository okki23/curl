<?php
//header('Content-Type: application/json');
include "konek.php";
   
$data = array("key" => "170802052520k704a4ea1b924837dc639307650e27e34354317558",
              "scope" => "companyContact",
              "operation" => "select",
              "data" => array("page" => 14, "fields" => ["companyId","companyContactId","name","title","email","mobilePhone","officePhone","homePhone","notes","newsletter","active","twitter","linkedin","facebook","skype"]));
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

// var_dump($companylist['data']);
// exit();


foreach ($companylist['data'] as $key => $value) {
     $data = mysqli_query($connect,"insert into temp_company_contact (companyId,companyContactId,name,title,email,mobilePhone,officePhone,homePhone,notes,newsletter,active,twitter,linkedin,facebook,skype) values ('".$value['companyId']."','".$value['companyContactId']."','".$value['name']."','".$value['title']."','".$value['email']."','".$value['mobilePhone']."','".$value['officePhone']."','".$value['homePhone']."','".$value['notes']."','".$value['newsletter']."','".$value['active']."','".$value['twitter']."','".$value['linkedin']."','".$value['facebook']."','".$value['skype']."') ");

   }
    

if($data){
  echo "inserted!";
}else{
  echo mysqli_error($connect);
}
 

?>
