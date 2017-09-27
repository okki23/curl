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

$field = array("name","address1","address2","postal_code","city","country","phone","email","fax","logo","number","corporation_id","c_exclude_department_id","c_corporation_id");
$imp = implode(",",$field);

$curl = curl_download('https://api.recman.no/v1.php?key=170802052520k704a4ea1b924837dc639307650e27e34354317558&scope=department&type=json&fields='.$imp.'&order_by=name');


//echo "<pre>$curl</pre>";
$data = json_decode($curl, true);
 

$awal = date("Y-m-d H:i:s");
$akhir = "9999-99-99 00:00:00";
foreach ($data as $key => $value) {
 var_dump($value);
 exit();

 echo "insert into companydepartment (CompanyDepartmentID,DepartmentName,TS,Active,ValidFrom,ValidTo,EnableZeroYearEnd,Address,Zipcode,Description,km0101,km3112,City) values ('".$value['department_id']."','".$value['name']."','','1','".$awal."','".$akhir."','','".$value['address1']."','".$value['postal_code']."','','','','".$value['city']."');";
}
/*

  ["department_id"]=>
    string(3) "516"
    ["name"]=>
    string(17) "Bemanningsgruppen"
    ["address1"]=>
    string(18) "Karenslyst allé 2"
    ["address2"]=>
    string(0) ""
    ["postal_code"]=>
    string(4) "0278"
    ["city"]=>
    string(4) "Oslo"
    ["country"]=>
    string(5) "Norge"
    ["phone"]=>
    string(11) "22 91 99 00"
    ["email"]=>
    string(25) "post@bemanningsgruppen.no"
    ["fax"]=>
    string(11) "22 91 99 01"
    ["logo"]=>
    string(76) "http://www.recman.no/user/img/logos/20140907211927d15396d1fe5f6c24d80050.jpg"
    ["number"]=>
    NULL
    ["corporation_id"]=>
    string(3) "153"

    CompanyDepartmentID
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
