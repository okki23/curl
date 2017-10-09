<!DOCTYPE html>
<html>
<head>
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

  <title>API CANDIDATE</title>
</head>
<body>

<?php
include "konek.php";
if(!isset($_GET['page'])){
  $page = 208;
}else{
  $page = $_GET['page'];
}

$data = array("key" => "170802102520k704a4ea1b924837dc639307650e27e34354317558",
              "scope" => "candidate",
              "operation" => "select",
              "data" => array("page" => 1, "fields" => ["corporationId","firstName","lastName","title","email","password","languageId","statusId","mobilePhone","homePhone","officePhone","workEmail","gender","dob","departmentId","description","notes","connectDepartment","connectUser","connectCompany","connectCompanyContact","rating","facebook","linkedin","twitter","web","blockedCompanyIds","children","nationality","internal","education","experience","certifications","address","skills","languages","employee","dependents","jobApplication","profilePicture","candidateId","file","candidateAttributes","tags"]));
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
var_dump($companylist['data']);
exit();
$page == 208 ? $active1 = 'active' : $active1 = '';
$page == 209 ? $active2 = 'active' : $active2 = '';
$page == 210 ? $active3 = 'active' : $active3 = '';
$page == 211 ? $active4 = 'active' : $active4 = '';
$page == 212 ? $active5 = 'active' : $active5 = '';

$page == 208 ? $i = 208 : '';/*
$page == 3 ? $i = 211 : $active3 = '';
$page == 4 ? $i = 301 : $active4 = '';
$page == 5 ? $i = 401 : $active5 = '';*/
if($page == 208){
  $i = 20800;
}elseif($page == 209){
  $i = 20901;
}elseif ($page == 210) {
  $i = 21001;
}elseif ($page == 211) {
  $i = 21101;
}elseif ($page == 212) {
  $i = 21201;
}
?>
<div class="container">
<h1>Candidate List</h1>
<div class="table-responsive">
<ul class="pagination">
  <li class="<?php echo $active1;?>"><a href="/curl/page_candidate.php?page=208">208</a></li>
  <li class="<?php echo $active2;?>"><a href="/curl/page_candidate.php?page=209">209</a></li>
  <li class="<?php echo $active3;?>"><a href="/curl/page_candidate.php?page=210">210</a></li>
  <li class="<?php echo $active4;?>"><a href="/curl/page_candidate.php?page=211">211</a></li>
  <li class="<?php echo $active5;?>"><a href="/curl/page_candidate.php?page=212">212</a></li>
</ul>
<table class="table table-striped">
  <tr>
    <th>No.</th>
    <th>PersonID</th>
    <th>FirstName</th>
    <th>LastName</th>
    <th>Title</th>
    <th>Email</th>
    <th>MobilePhoneNumber</th>
    <th>HomePhone</th>
    <th>Gender</th>
    <th>BirthDate</th>
    <th>Notes</th>
    <th>LanguageID</th>
    <th>Active</th>
    <th>Defaultinterface</th>
    <th>DefaultModule</th>
    <th>DefaultTemplate</th>
    <th>Classification</th>
  </tr>

  <?php
  //$i = 1;
  foreach ($companylist['data'] as $key => $value) {
    //var_dump($value);
    //str_replace("'","",$value['description'])
    ?>
    <tr>
      <td><?php echo $i;?></td> 
      <td><?php echo $value['candidateId'];?></td>
      <td><?php echo $value['firstName'];?></td>
      <td><?php echo $value['lastName'];?></td>
      <td><?php echo $value['title'];?></td>
      <td><?php echo $value['email'];?></td>
      <td><?php echo $value['mobilePhone'];?></td>
      <td><?php echo $value['homePhone'];?></td>
      <td><?php echo $value['gender'];?></td>
      <td><?php echo $value['dob'];?></td>
      <td><?php echo substr($value['description'],0,-100);?></td>
      <td><?php echo $value['languageId'];?></td>
      <td><?php echo 1;?></td>
      <td><?php echo 'internett1';?></td>
      <td><?php echo 'publish';?></td>
      <td><?php echo 'profil';?></td>
      <td><?php echo 'A';?></td>
    </tr>
 
  <?php
 
  $sql = mysqli_query($connect,"insert into temp_person(PersonID,FirstName,LastName,Title,Email,MobilePhoneNumber,HomePhone,Gender,BirthDate,Notes,LanguageID,Active,Defaultinterface,DefaultModule,DefaultTemplate,Classification) values ('".$value['candidateId']."','".$value['firstName']."','".$value['lastName']."','".$value['title']."','".$value['email']."','".$value['mobilePhone']."','".$value['homePhone']."','".$value['gender']."','".$value['dob']."','".str_replace("'","",$value['description'])."','".$value['languageId']."','1','internett1','publish','profil','A') ");


   $i++; } 



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