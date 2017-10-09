<!DOCTYPE html>
<html>
<head>
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

  <title>API PROJECT</title>
</head>
<body>

<?php
include "konek.php";
if(!isset($_GET['page'])){
  $page = 160;
}else{
  $page = $_GET['page'];
}

$data = array("key" => "170802052520k704a4ea1b924837dc639307650e27e34354317558",
              "scope" => "project",
              "operation" => "select",
              "data" => array("page" => $page, "fields" => ["companyId","projectId","departmentId","responsibleUserId","name","description","categoryId","statusId","percentCompleted","invoiceNotes","startDate","endDate","created","updated"]));
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
//print_r(json_decode($result, true));
$companylist = json_decode($result, true);
// var_dump($companylist['data']);
// exit(); 

$page == 160 ? $active1 = 'active' : $active1 = '';
$page == 161 ? $active2 = 'active' : $active2 = '';
$page == 162 ? $active3 = 'active' : $active3 = '';
$page == 163 ? $active4 = 'active' : $active4 = '';
$page == 164 ? $active5 = 'active' : $active5 = '';

$page == 160 ? $i = 160 : '';/*
$page == 3 ? $i = 201 : $active3 = '';
$page == 4 ? $i = 301 : $active4 = '';
$page == 5 ? $i = 401 : $active5 = '';*/
if($page == 160){
  $i = 16000;
}elseif($page == 161){
  $i = 16101;
}elseif ($page == 162) {
  $i = 16201;
}elseif ($page == 163) {
  $i = 16301;
}elseif ($page == 164) {
  $i = 16401;
} 
?>
<div class="container">
<h1>Project List</h1>
<div class="table-responsive">
<ul class="pagination">
  <li class="<?php echo $active1;?>"><a href="/curl/page_project.php?page=160">160</a></li>
  <li class="<?php echo $active2;?>"><a href="/curl/page_project.php?page=161">161</a></li>
  <li class="<?php echo $active3;?>"><a href="/curl/page_project.php?page=162">162</a></li>
  <li class="<?php echo $active4;?>"><a href="/curl/page_project.php?page=163">163</a></li>
  <li class="<?php echo $active5;?>"><a href="/curl/page_project.php?page=164">164</a></li>
</ul>

<table class="table table-striped">
  <tr>
    <th>No.</th>
    <th>projectId</th>
    <th>customerId</th>
    <th>departmentId</th>
    <th>responsibleUserId</th>
    <th>name</th>
    <th>description</th>
    <th>categoryId</th>
    <th>statusId</th>
    <th>percentCompleted</th>
    <th>invoiceNotes</th>
    <th>startDate</th>
    <th>endDate</th>
    <th>created</th>
    <th>updated</th>
  </tr>
  <?php
  //$i = 1;
 

  foreach ($companylist['data'] as $key => $value) {?>
    <tr>
      <td><?php echo $i;?></td>
      <td><?php echo $value['projectId'];?></td>
      <td><?php echo $value['customerId'];?></td>
      <td><?php echo $value['departmentId'];?></td>
      <td><?php echo $value['responsibleUserId'];?></td>
      <td><?php echo $value['name'];?></td>
      <td><?php echo $value['description'];?></td>
      <td><?php echo $value['categoryId'];?></td>
      <td><?php echo $value['statusId'];?></td>
      <td><?php echo $value['percentCompleted'];?></td>
      <td><?php echo $value['invoiceNotes'];?></td>
      <td><?php echo $value['startDate'];?></td>
      <td><?php echo $value['endDate'];?></td>
      <td><?php echo $value['created'];?></td>
      <td><?php echo $value['updated'];?></td>
      
    </tr>
  <?php $i++; } 

    $sql = mysqli_query($connect,"insert into temp_project (ProjectID,Heading,Status,ValidFrom,ValidTo,CompanyID,Active,ResponsiblePersonID,RetailCompanyID) values 
('".$value['projectId']."','".$value['name']."','registered','2017-08-30 00:00:00','9999-12-31 00:00:00','".$value['customerId']."','1','".$value['responsibleUserId']."','".$value['departmentId']."') ");

?>
</table>
</div>
</div>
<?php
if($sql){
  echo "inserted!";
}else{
  echo mysqli_error($connect);
}
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</body>
</html>