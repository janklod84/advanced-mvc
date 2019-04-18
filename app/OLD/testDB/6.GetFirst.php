<?php 


/**
* Get first
* @return mixed
*/

$db = DB::getInstance();
$contacts = $db->query("SELECT * FROM contacts ORDER BY lname, fname")
               ->first();
pre($contacts);
         