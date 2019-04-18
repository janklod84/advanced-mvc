<?php 


/**
* Update
* @return mixed
*/

$db = DB::getInstance();
$fields = [
   'fname' => 'Brown 2',
   'email' => 'test2@blog.com'
];

$db->update('contacts', 3, $fields);
 