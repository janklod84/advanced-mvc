<?php 


/**
   * Find item
   * @return mixed
*/
$db = DB::getInstance();
$contacts = $db->find('contacts', [
   // 'conditions' => ['lname' => '?', 'fname' => 'Brown'], 
   // 'conditions' => 'lname = ?', 'bind' => ['Yao']
   // 'conditions' => 'fname = ?', 
   // 'conditions' => ['fname = ?'], 'bind' => ['Brown']
   // 'conditions' => ['fname = ?', 'lname = ?'], 'bind' => ['Brown', 'Yao'],
   'conditions' => ['lname = ?'], 
   'bind' => ['Yao'],
   'order' => "lname, fname",   
   'limit' => 1 , // 2 ..
]);

debug($contacts);