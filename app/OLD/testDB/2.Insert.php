<?php 


/**
   * Insert data
   * index action
   * @return mixed
*/

$db = DB::getInstance();
$fields = [
	'fname' => 'Brown',
	'lname' => 'Yao',
	'email' => 'test@blog.com'
];

$db->insert('contacts', $fields);
