<?php 


class Contacts  extends Model
{
       

       /**
        * For column 'deleted'
        * @var int
       */
       public $deleted = 0;


       /**
        * Constructor
        * @return void
       */
       public function __construct()
       {
       	     $table = 'contacts';
       	     parent::__construct($table);
       	     $this->softDelete = true;
       }


       public static $addValidation = [
             'fname' => [
                'display'  => 'First Name',
                'required' => true,
                'max' => 155
             ],
             'lname' => [
                'display'  => 'Last Name',
                'required' => true,
                'max' => 155
             ]
       ];


       
       /**
        * Find contacts by user id
        * @param int $user_id 
        * @param array $params 
        * @return 
        */
       public function findAllByUserId($user_id, $params = [])
       {
             $conditions = [
                 'conditions' => 'user_id = ?',
                 'bind' => [$user_id]
             ];

             $conditions = array_merge($conditions, $params);
             return $this->find($conditions);
       }

       
       /**
        * Display Full name
        * @return string
       */
       public function displayName()
       {
           return $this->fname . ' ' . $this->lname;
       }
}