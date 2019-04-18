<?php 

/**
 * Query
 * index action
 * @return mixed
*/
  
$db = DB::getInstance();
$sql = "SELECT * FROM contacts";
$contactsQ = $db->query($sql);
