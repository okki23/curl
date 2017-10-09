<!DOCTYPE html>
<html>
<head>
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

  <title>API COMPANY</title>
</head>
<body>

<?php

if(!isset($_GET['page'])){
  $page = 1;
}else{
  $page = $_GET['page'];
}

$data = array("key" => "170802052520k704a4ea1b924837dc639307650e27e34354317558",
              "scope" => "company",
              "operation" => "select",
              "data" => array("page" => $page, "fields" => ["companyId","name","countryRegNumber","companyNumber","web","phone","email","newsletter","linkedin","facebook","twitter","skype","employeeCount","countryId","branchCategoryId","notes","creditTime","connectDepartment","connectUser","directions","invoiceAddress","department_id"]),
              );
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

//echo "<pre>$result</pre>";
print_r(json_decode($result, true));
$companylist = json_decode($result, true);
//print_r($companylist['data']);

$page == 1 ? $active1 = 'active' : $active1 = '';
$page == 2 ? $active2 = 'active' : $active2 = '';
$page == 3 ? $active3 = 'active' : $active3 = '';
$page == 4 ? $active4 = 'active' : $active4 = '';
$page == 5 ? $active5 = 'active' : $active5 = '';

$page == 1 ? $i = 1 : '';/*
$page == 3 ? $i = 201 : $active3 = '';
$page == 4 ? $i = 301 : $active4 = '';
$page == 5 ? $i = 401 : $active5 = '';*/
if($page == 1){
  $i = 1;
}elseif($page == 2){
  $i = 101;
}elseif ($page == 3) {
  $i = 201;
}elseif ($page == 3) {
  $i = 301;
}elseif ($page == 4) {
  $i = 401;
}
?>
<div class="container">
<h1>Company List</h1>
<div class="table-responsive">
<ul class="pagination">
  <li class="<?php echo $active1;?>"><a href="/curl/lat3.php?page=1">1</a></li>
  <li class="<?php echo $active2;?>"><a href="/curl/lat3.php?page=2">2</a></li>
  <li class="<?php echo $active3;?>"><a href="/curl/lat3.php?page=3">3</a></li>
  <li class="<?php echo $active4;?>"><a href="/curl/lat3.php?page=4">4</a></li>
  <li class="<?php echo $active5;?>"><a href="/curl/lat3.php?page=5">5</a></li>
</ul>
<table class="table table-striped">
  <tr>
    <th>No.</th>
    <th>Company ID</th>
    <th>Company Name</th>
    <th>Country Reg Number</th>
    <th>Email</th>
    <th>Company NUmber</th>
    <th>Web</th>
    <th>Phone</th>

    <th>Newsletter</th>
    <th>Linkedin</th>
    <th>Facebook</th>
    <th>Skype</th>
    <th>EmployeeCount</th>
    <th>CountryId</th>
    <th>BranchCategoryId</th>
    <th>Notes</th>
  </tr>
  <?php
  //$i = 1;
  foreach ($companylist['data'] as $key => $value) {?>
    <tr>
      <td><?php echo $i;?></td>
      <td><?php echo $value['companyId'];?></td>
      <td><?php echo $value['name'];?></td>
      <td><?php echo $value['countryRegNumber'];?></td>
      <td><?php echo $value['email'];?></td>
      <td><?php echo $value['companyNumber'];?></td>
      <td><?php echo $value['web'];?></td>
      <td><?php echo $value['phone'];?></td>
      <th><?php echo $value['newsletter'];?></th>
      <th><?php echo $value['linkedin'];?></th>
      <th><?php echo $value['facebook'];?></th>
      <th><?php echo $value['skype'];?></th>
      <th><?php echo $value['employeeCount'];?></th>
      <th><?php echo $value['countryId'];?></th>
      <th><?php echo $value['branchCategoryId'];?></th>
      <th><?php echo substr($value['notes'], 0,100);?></th>
    </tr>
  <?php $i++; } ?>
</table>
</div>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</body>
</html>