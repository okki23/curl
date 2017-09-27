<?php
  
function curl_download($Url){
     // is cURL installed yet?
    if (!function_exists('curl_init')){
        die('Sorry cURL is not installed!');
    }
 
    // OK cool - then let's create a new cURL resource handle
    $ch = curl_init();
 
    // Now set some options (most are optional)
 
    // Set URL to download
    curl_setopt($ch, CURLOPT_URL, $Url);
 
    // Set a referer
    //curl_setopt($ch, CURLOPT_REFERER, "http://www.example.org/yay.htm");
 
    // User agent
    //curl_setopt($ch, CURLOPT_USERAGENT, "MozillaXYZ/1.0");
 
    // Include header in result? (0 = yes, 1 = no)
    curl_setopt($ch, CURLOPT_HEADER, 0);
 
    // Should cURL return or print out the data? (true = return, false = print)
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
 
    // Timeout in seconds
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
 
    // Download the given URL, and return output
    $output = curl_exec($ch);
 
    // Close the cURL resource, and free system resources
    curl_close($ch);
 
    return $output;
}
 
$field = array("companyId","companyContactId","name","title","email","mobilePhone","officePhone","homePhone","notes","newsletter","active","twitter","linkedin","facebook","skype");
$imp = implode(",",$field);
$curl = curl_download('https://api.recman.no/v1.php?key=170802052520k704a4ea1b924837dc639307650e27e34354317558&scope=companyContact&type=json&fields='.$imp);
 
//echo "<pre>$curl</pre>";
$data = json_decode($curl, true);
var_dump($data);
exit();
echo "<table border='1' cellpadding ='3' cellspacing='0'>
        <tr style='text-align:center; font-weight:bold;'>
        <td> No </td>
        <td> User ID </td>
        <td> First Name </td>
        <td> Last Name </td>
        <td> Title </td>
        <td> Mobile Phone </td>
        <td> Office Phone </td>
        <td> Email </td>
        <td> Image </td>
        <td> Facebook </td>
        <td> Linkedin </td>
        <td> Twitter </td>
        <td> Corporation ID </td>
        <td> Department ID </td>
        </tr>";
// var_dump($data);
$no = 1;
foreach ($data as $key => $value) {
  echo "<tr>";
  echo "<td>".$no."</td>";
  echo "<td>".$value['user_id']."</td>";
  echo "<td>".$value['first_name']."</td>";
  echo "<td>".$value['last_name']."</td>";
  echo "<td>".$value['title']."</td>";
  echo "<td>".$value['mobile_phone']."</td>";
  echo "<td>".$value['office_phone']."</td>";
  echo "<td>".$value['email']."</td>";
  echo "<td>".$value['image']."</td>";
  echo "<td>".$value['facebook']."</td>";
  echo "<td>".$value['linkedin']."</td>";
  echo "<td>".$value['twitter']."</td>";
  echo "<td>".$value['corporation_id']."</td>";
  echo "<td>".$value['department_id']."</td>";
  echo "</tr>";
  $no++;
}

echo "</table>";
?>