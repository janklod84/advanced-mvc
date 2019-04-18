<?php 

$db = DB::getInstance();
$contacts = $db->findFirst('contacts', [
   'conditions' => "id = ?", 
   'bind' => [1]
]);

debug($contacts);