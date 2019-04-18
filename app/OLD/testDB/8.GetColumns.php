<?php 


/**
 * Get Columns
 * @return mixed
*/

$db = DB::getInstance();
$columns = $db->get_columns('contacts');

debug($columns);