<?php 
$start_date = new DateTime("2015-02-03");
$now = date("Y-m-d");
$end_date = new DateTime($now);
$interval = $start_date->diff($end_date);
echo "$interval->days hari "; 

if($interval->days > 720){
	echo "Sudah Expire";
}else{
	echo "Belum Expire";
}
// hasil : 217 hari
?>