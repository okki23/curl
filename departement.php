<?php
// buat nama file unique untuk di download
 // $filename = 'export-department'.date('YmdHis');
 // // dengan perintah di bawah ini akan memunculkan dialog download di browser anda
 // header("Content-type: application/x-msdownload");
 // // perintah di bawah untuk menentukan nama file yang akan di download
 // header("Content-Disposition: attachment; filename=".$filename.".xls");
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

$field = array("name","address1","address2","postal_code","city","country","phone","email","fax","logo","number","corporation_id","c_exclude_department_id","c_corporation_id");
$imp = implode(",",$field);
$curl = curl_download('https://api.recman.no/v1.php?key=170802052520k704a4ea1b924837dc639307650e27e34354317558&scope=department&type=json&fields='.$imp.'&order_by=name');


//echo "<pre>$curl</pre>";
$data = json_decode($curl, true);
echo "<table border='1' cellpadding ='3' cellspacing='0'>
        <tr style='text-align:center; font-weight:bold;'>
        <td> No </td>
        <td> Department ID </td>
        <td> Name </td>
        <td> Address 1 </td>
        <td> Address 2 </td>
        <td> Postal Code </td>
        <td> City </td>
        <td> Code </td>
        <td> Country </td>
        <td> Phone </td>
        <td> Email </td>
        <td> Fax </td>
        <td> Logo </td>
        <td> Number </td>
        <td> Corporation ID </td>
        </tr>";
// var_dump($data);
$no = 1;
foreach ($data as $key => $value) {
  echo "<tr>";
  echo "<td>".$no."</td>";
  echo "<td>".$value['department_id']."</td>";
  echo "<td>".$value['name']."</td>";
  echo "<td>".$value['address1']."</td>";
  echo "<td>".$value['address2']."</td>";
  echo "<td>".$value['postal_code']."</td>";
  echo "<td>".$value['city']."</td>";
  echo "<td>".$value['country']."</td>";
  echo "<td>".$value['phone']."</td>";
  echo "<td>".$value['email']."</td>";
  echo "<td>".$value['fax']."</td>";
  echo "<td>".$value['logo']."</td>";
  echo "<td>".$value['number']."</td>";
  echo "<td>".$value['corporation_id']."</td>";
  echo "</tr>";
  $no++;
}

echo "</table>";

/*CompanyDepartmentID
DepartmentName
TS
Active
ValidFrom
ValidTo
EnableZeroYearEnd
Address
Zipcode
Description
km0101
km3112
City
*/
?>
