<!DOCTYPE html>
<html>
<head>
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

  <title>API COMPANY</title>
</head>
<body>

<?php
include "konek.php";
if(!isset($_GET['page'])){
  $page = 1;
}else{
  $page = $_GET['page'];
}

$data = array("key" => "170802052520k704a4ea1b924837dc639307650e27e34354317558",
              "scope" => "company",
              "operation" => "select",
              "data" => array("page" => $page,"fields" => 
        ["name","countryRegNumber","companyNumber","email",
        "web","phone","invoiceEmail","newsletter","linkedin",
        "facebook","skype","countryId","branchCategoryId","note",
        "creditTime","connectDepartment","connectUser","directions",
        "visitAddress","postAddress","deliveryAddress","invoiceAddress"
        ,"file","attribute","parentCompanyId","type"]));
$data_string = json_encode($data);
//echo $data_string;
 

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

$page == 1 ? $active1 = 'active' : $active1 = '';
$page == 2 ? $active2 = 'active' : $active2 = '';
$page == 3 ? $active3 = 'active' : $active3 = '';
$page == 4 ? $active4 = 'active' : $active4 = '';
$page == 5 ? $active5 = 'active' : $active5 = '';
$page == 6 ? $active6 = 'active' : $active6 = '';
$page == 7 ? $active7 = 'active' : $active7 = '';
$page == 8 ? $active8 = 'active' : $active8 = '';
$page == 9 ? $active9 = 'active' : $active9 = '';
$page == 10 ? $active10 = 'active' : $active10 = '';

$page == 1 ? $i = 1 : '';/*
$page == 3 ? $i = 201 : $active3 = '';
$page == 4 ? $i = 301 : $active4 = '';
$page == 5 ? $i = 401 : $active5 = '';*/
if($page == 1){
  $i = 1;
}elseif($page == 2){
  $i = 201;
}elseif ($page == 3) {
  $i = 301;
}elseif ($page == 4) {
  $i = 401;
}elseif ($page == 5) {
  $i = 501;
}elseif ($page == 6) {
  $i = 601;
}elseif ($page == 7) {
  $i = 701;
}elseif ($page == 8) {
  $i = 801;
}elseif ($page == 9) {
  $i = 901;
}elseif ($page == 10) {
  $i = 1001;
}


?>
<div class="container">
<h1>Company List (Customer Type)</h1>
<div class="table-responsive">
<ul class="pagination">
  <li class="<?php echo $active1;?>"><a href="/curl/page_company.php?page=1">1</a></li>
  <li class="<?php echo $active2;?>"><a href="/curl/page_company.php?page=2">2</a></li>
  <li class="<?php echo $active3;?>"><a href="/curl/page_company.php?page=3">3</a></li>
  <li class="<?php echo $active4;?>"><a href="/curl/page_company.php?page=4">4</a></li>
  <li class="<?php echo $active5;?>"><a href="/curl/page_company.php?page=5">5</a></li>
  <li class="<?php echo $active6;?>"><a href="/curl/page_company.php?page=6">6</a></li>
  <li class="<?php echo $active7;?>"><a href="/curl/page_company.php?page=7">7</a></li>
  <li class="<?php echo $active8;?>"><a href="/curl/page_company.php?page=8">8</a></li>
  <li class="<?php echo $active9;?>"><a href="/curl/page_company.php?page=9">9</a></li>
  <li class="<?php echo $active10;?>"><a href="/curl/page_company.php?page=10">10</a></li>
</ul>

<table class="table table-striped">
  <tr>
    

    <th>No.</th>
    <th>companyId</th>
    <th>name</th>
    <th>companyNumber</th>
    <th>countryRegNumber</th>
    <th>email</th>
    <th>web</th>
    <th>branchCategoryId</th>
    <th>phone</th>
    <th>linkedin</th>
    <th>facebook</th>
    <th>type</th>
  </tr>

  <?php
  //$i = 1;
  foreach ($companylist['data'] as $key => $value) { 
  
  if($value['type'] == 'customer'){
   $sql = mysqli_query($connect,"insert into temp_company (CompanyID,CompanyName,CompanyNumber,OrgNumber,Email,WWW,ClassificationID,Phone,LinkedIn,Facebook,Type)
     values
      ('".$value['companyId']."','".$value['name']."','".$value['companyNumber']."','".$value['countryRegNumber']."','".$value['email']."','".$value['web']."','".$value['branchCategoryId']."','".$value['phone']."','".$value['linkedin']."','".$value['facebook']."','1') ");
 
  ?>
     <tr>
      <td><?php echo $i;?></td>
      <td><?php echo $value['companyId'];?></td>
      <td><?php echo $value['name'];?></td>
      <td><?php echo $value['companyNumber'];?></td>
      <td><?php echo $value['countryRegNumber'];?></td>
      <td><?php echo $value['email'];?></td>
      <td><?php echo $value['web'];?></td>
      <td><?php echo $value['branchCategoryId'];?></td>
      <td><?php echo $value['phone'];?></td>
      <td><?php echo $value['linkedin'];?></td>
      <td><?php echo $value['facebook'];?></td>
      <td><?php echo '1';?></td>
 
      
    </tr>
    <?php
  }
    ?>
    <?php
      $i++; } 

    if($sql){
  echo "inserted!";
}else{
  echo mysqli_error($connect);
}
  
  
?>
 
</div>
</div>
 

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</body>
</html>