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

$field = array("city");
$imp = implode(",",$field);
$curl = curl_download('api.recman.no/v1.php?type=json&scope=branch_category_list&key=170802052520k704a4ea1b924837dc639307650e27e34354317558');
//$curl = curl_download('https://api.recman.no/v1.php?scope=location&key=170802052520k704a4ea1b924837dc639307650e27e34354317558&fields=city&type=json');


//echo "<pre>$curl</pre>";
$data = json_decode($curl, true);
// var_dump($data);

foreach ($data as $key => $value) {
    

    echo "insert into temp_branch_category_list (branch_category_id,name) values ('".$value['branch_category_id']."','".$value['name']."');";
    
}
?>
