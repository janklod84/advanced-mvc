<?php 



/**
* Delete
* @return mixed
*/

$db = DB::getInstance();
$db->delete('contacts', 3);
