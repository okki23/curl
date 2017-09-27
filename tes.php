<?php
$json = <<<END_OF_JSON
{
   "destination_addresses" : [ "New Town, Uckfield, East Sussex TN22 5DJ, UK" ],
   "origin_addresses" : [ "Maresfield, East Sussex TN22 2AF, UK" ],
   "rows" : [
      {
         "elements" : [
            {
               "distance" : {
                  "text" : "3.0 mi",
                  "value" : 4855
               },
               "duration" : {
                  "text" : "22 mins",
                  "value" : 1311
               },
               "status" : "OK"
            }
         ]
      }
   ],
   "status" : "OK"
}
END_OF_JSON;

$arr = (json_decode($json, true));
echo $arr["rows"][0]["elements"][0]["distance"]["text"];
