<?php 

/**
   * Find First item
   * @return mixed
*/
$db = DB::getInstance();
$contacts = $db->findFirst('contacts', [
	'conditions' => ['lname = ?'], 
	'bind' => ['Yao']
]);

debug($contacts);
