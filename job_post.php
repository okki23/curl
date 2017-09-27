<?php
 
function resourceWeb($url){
     $data = curl_init();
  curl_setopt($data, CURLOPT_URL, $url);
  curl_setopt($data, CURLOPT_RETURNTRANSFER, 1);
     $hasil = curl_exec($data);
     curl_close($data);
     return $hasil;
}
 
$field = array("name","ingress","body","logo","from_date","to_date","title","place","deadline","facebook","twitter","webpage","num_positions","video","external_ats","created","updated","position_start","salary","company_name","address1","address2","city","postal_code","country","keywords","contact_persons","country_id","region_id","city_id","first_branch","first_branch_category_id","first_branch_id","second_branch_category_id","second_branch_id","sector_id","extent_id");
$imp = implode(",",$field);
$session = resourceWeb('api.recman.no/v1.php?type=json&key=170802052520k704a4ea1b924837dc639307650e27e34354317558&scope=job_post&fields='.$imp.' '); 
 
$data = json_decode($session);
 
foreach ($data as $key => $value) {
    

  
   echo "insert into temp_job_post (job_post_id,name,ingress,body,logo,from_date,to_date,title,place,deadline,facebook,twitter,webpage,num_positions,video,external_ats,created,updated,position_start,salary,company_name,address1,address2,city,postal_code,country,country_id,region_id,city_id,first_branch_category_id,first_branch_id,second_branch_category_id,second_branch_id,sector_id,extent_id,apply_link) values ('".$value->job_post_id."','".$value->name."','".$value->ingress."','".$value->body."','".$value->logo."','".$value->from_date."','".$value->to_date."','".$value->title."','".$value->place."','".$value->deadline."','".$value->facebook."','".$value->twitter."','".$value->webpage."','".$value->num_positions."','".$value->video."','".$value->external_ats."','".$value->created."','".$value->updated."','".$value->position_start."','".$value->salary."','".$value->company_name."','".$value->address1."','".$value->address2."','".$value->city."','".$value->postal_code."','".$value->country."','".$value->country_id."','".$value->region_id."','".$value->city_id."','".$value->first_branch_category_id."','".$value->first_branch_id."','".$value->second_branch_category_id."','".$value->second_branch_id."','".$value->sector_id."','".$value->extent_id."','".$value->apply_link."');";
 
} 
  
?>