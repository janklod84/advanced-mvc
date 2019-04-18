<?php 


/**
* Get property object $contact
* @return mixed
*/

$db = DB::getInstance();
$contact = $db->query("SELECT * FROM contacts ORDER BY lname, fname")
               ->first();
pre($contact->fname);