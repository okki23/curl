<?php
// buat nama file unique untuk di download
 // $filename = 'export-co-worker'.date('YmdHis');
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
 
$field = array("first_name","last_name","title","mobile_phone","office_phone","email","image","facebook","linkedin","twitter","corporation_id","department_id");
$imp = implode(",",$field);
$curl = curl_download('https://api.recman.no/v1.php?key=170802052520k704a4ea1b924837dc639307650e27e34354317558&scope=user&type=json&fields='.$imp);
 
//echo "<pre>$curl</pre>";
$data = json_decode($curl, true);
// var_dump($data);
// exit(); 

foreach($data as $key=>$value){
    //var_dump($value);
    echo "insert into temp_co_worker (user_id,first_name,last_name,title,mobile_phone,office_phone,email,image,facebook,linkedin,twitter,corporation_id,department_id) values ('".$value['user_id']."','".$value['first_name']."','".$value['last_name']."','".$value['title']."','".$value['mobile_phone']."','".$value['office_phone']."','".$value['email']."','".$value['image']."','".$value['facebook']."','".$value['linkedin']."','".$value['twitter']."','".$value['corporation_id']."','".$value['department_id']."');";
}
?>