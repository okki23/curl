<?php
/*
ProjectID
Heading
Type
CommentCustomer
ValidFrom
ValidTo
Status
Priority
CompanyID
Active
ResponsiblePersonID
FinishedDate
RegisteredByPersonID
SalePersonID
Address
Zipcode
EnableZeroYearEnd
RequestID
City
CommentInternal
CreatedByPersonID
UpdatedByPersonID
CreatedDateTime
TS
ContactPersonID
PersonID
EnableHourListOnExtranet
RetailCompanyID
RetailKickbackPercent
isSupport
*/

/*
 ["projectId"]=>
    string(5) "33238"
    ["customerId"]=>
    string(6) "173830"
    ["departmentId"]=>
    string(3) "517"
    ["responsibleUserId"]=>
    string(4) "1769"
    ["name"]=>
    string(14) "Bygg og anlegg"
    ["description"]=>
    string(18) "Snorri - Uke 40-41"
    ["categoryId"]=>
    string(1) "1"
    ["statusId"]=>
    string(1) "4"
    ["percentCompleted"]=>
    string(1) "0"
    ["invoiceNotes"]=>
    NULL
    ["startDate"]=>
    NULL
    ["endDate"]=>
    NULL
    ["created"]=>
    string(19) "18.10.2005 19:50:40"
    ["updated"]=>
    string(19) "20.10.2005 13:29:26"
	*/

$data = array("key" => "170802052520k704a4ea1b924837dc639307650e27e34354317558",
              "scope" => "project",
              "operation" => "select",
              "data" => array("page" => 1, "fields" => ["companyId","projectId","departmentId","responsibleUserId","name","description","categoryId","statusId","percentCompleted","invoiceNotes","startDate","endDate","created","updated"]));
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

var_dump($companylist['data']);
exit();
foreach ($companylist['data'] as $key => $value) {
 
  
}
/*function curl_download($Url){
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
 
$field = array("companyId","projectId","departmentId","responsibleUserId","name","description","categoryId","statusId","percentCompleted","invoiceNotes","startDate","endDate","created","updated");
$imp = implode(",",$field);
$curl = curl_download('https://api.recman.no/v1.php?key=170802052520k704a4ea1b924837dc639307650e27e34354317558&scope=project&type=json&fields='.$imp.'&order_by=name');
 

//echo "<pre>$curl</pre>";
print_r(json_decode($curl, true));*/
?>