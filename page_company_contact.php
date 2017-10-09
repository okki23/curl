<!DOCTYPE html>
<html>
<head>
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

  <title>API COMPANY CONTACT
  </title>
</head>
<body>

<?php
include "konek.php";
if(!isset($_GET['page'])){
  $page = 20;
}else{
  $page = $_GET['page'];
}

$data = array("key" => "220802052520k704a4ea1b924837dc639307650e27e34354322558",
              "scope" => "companyContact",
              "operation" => "select",
              "data" => array("page" => $page, "fields" => ["companyId","companyContactId","name","title","email","mobilePhone","officePhone","homePhone","notes","newsletter","active","twitter","linkedin","facebook","skype"]));
$data_string = json_encode($data);
//echo $data_string;

/*$ch = curl_init('https://api.recman.no/post/');
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json',
    'Content-Length: ' . strlen($data_string))
);*/

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

// var_dump($companylist['data']);
// exit();


$page == 20 ? $active1 = 'active' : $active1 = '';
$page == 21 ? $active2 = 'active' : $active2 = '';
$page == 22 ? $active3 = 'active' : $active3 = '';
$page == 23 ? $active4 = 'active' : $active4 = '';
$page == 24 ? $active5 = 'active' : $active5 = '';

$page == 20 ? $i = 20 : '';/*
$page == 3 ? $i = 201 : $active3 = '';
$page == 4 ? $i = 301 : $active4 = '';
$page == 5 ? $i = 401 : $active5 = '';*/
if($page == 20){
  $i = 2000;
}elseif($page == 21){
  $i = 2101;
}elseif ($page == 22) {
  $i = 2201;
}elseif ($page == 23) {
  $i = 2301;
}elseif ($page == 24) {
  $i = 2401;
} 
?>
<div class="container">
<h1>Company Contact List</h1>
<div class="table-responsive">
<ul class="pagination">
  <li class="<?php echo $active1;?>"><a href="/curl/page_company_contact.php?page=20">20</a></li>
  <li class="<?php echo $active2;?>"><a href="/curl/page_company_contact.php?page=21">21</a></li>
  <li class="<?php echo $active3;?>"><a href="/curl/page_company_contact.php?page=22">22</a></li>
  <li class="<?php echo $active4;?>"><a href="/curl/page_company_contact.php?page=23">23</a></li>
  <li class="<?php echo $active5;?>"><a href="/curl/page_company_contact.php?page=24">24</a></li>
</ul>
<table class="table table-striped">
  <tr>
    
    <th>No.</th>
    <th>companyContactId</th>
    <th>companyId</th>
    <th>name</th>
    <th>title</th>
    <th>email</th>
    <th>mobilePhone</th>
    <th>officePhone</th>
    <th>homePhone</th>
    <th>notes</th>
    <th>newsletter</th>
    <th>active</th>
    <th>twitter</th>
    <th>linkedin</th>
    <th>facebook</th>
    <th>skype</th>
  </tr>
  <?php
  //$i = 1;
  foreach ($companylist['data'] as $key => $value) {
    var_dump($value);
    ?>
    <tr>
      <td><?php echo $i;?></td>
      <td><?php echo $value['companyContactId'];?></td>
      <td><?php echo $value['companyId'];?></td>
      <td><?php echo $value['name'];?></td>
      <td><?php echo $value['title'];?></td>
      <td><?php echo $value['email'];?></td>
      <td><?php echo $value['mobilePhone'];?></td>
      <td><?php echo $value['officePhone'];?></td>
      <th><?php echo $value['homePhone'];?></th>
      <th><?php echo $value['notes'];?></th>
      <th><?php echo $value['newsletter'];?></th>
      <th><?php echo $value['active'];?></th>
      <th><?php echo $value['twitter'];?></th>
      <th><?php echo $value['linkedin'];?></th>
      <th><?php echo $value['facebook'];?></th>
      <th><?php echo $value['skype'];?></th>
    </tr>
  <?php $i++; }

    // $data = mysqli_query($connect,"insert into temp_company_contact (companyId,companyContactId,name,title,email,mobilePhone,officePhone,homePhone,notes,newsletter,active,twitter,linkedin,facebook,skype) values ('".$value['companyId']."','".$value['companyContactId']."','".$value['name']."','".$value['title']."','".$value['email']."','".$value['mobilePhone']."','".$value['officePhone']."','".$value['homePhone']."','".$value['notes']."','".$value['newsletter']."','".$value['active']."','".$value['twitter']."','".$value['linkedin']."','".$value['facebook']."','".$value['skype']."') ");
 

 ?>
</table>
</div>
</div>

<?php

// if($data){
//   echo "inserted!";
// }else{
//   echo mysqli_error($connect);
// }
 
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</body>
</html>