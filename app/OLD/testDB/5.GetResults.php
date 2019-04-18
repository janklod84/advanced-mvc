<?php 


/**
* Get Results
* @return mixed
*/

$db = DB::getInstance();
$contacts = $db->query("SELECT * FROM contacts ORDER BY lname, fname")
               ->results();
pre($contacts);
