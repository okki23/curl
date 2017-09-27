<?php
 
 
$nameArray = array(
  'BobRay' => 'bobray@somewhere.com',
  'JohnDoe' => 'johndoe@gmail.com',
  'JaneRoe' => 'janeroe@aol.com',
);
 
 

function string_from_array_assoc($nameArray){
$users = Array();
$output = '';
 
/* Add each user to the new array */
foreach ($nameArray as $key => $value) {
  $users[] = $key  . ' (' . $value . ')';
}
$output =  'The values are: '. implode(', ',$users);
return $output;
}

echo string_from_array_assoc($nameArray);
?>