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
        * If softDelete = true , row will not deleted in the table
        * it will setted deleted = 1
        * set solfDelete = false and 'll see behaviors 
        * see item in database, and listing contacts
        * 
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

       
       /**
        * Find By Id and User Id
        * @param int $contact_id 
        * @param int $user_id 
        * @return mixed
        */
       public function findByIdAndUserId($contact_id, $user_id, $params = [])
       {
            $conditions = [
                'conditions' => 'id = ? AND user_id = ?',
                'bind' => [$contact_id, $user_id]
            ];

            $conditions = array_merge($conditions, $params);
            return $this->findFirst($conditions);
       }

       
       /**
        * Display address
        * @return string
       */
       public function displayAddress()
       {
           $address = '';

           if(!empty($this->address))
           {
               $address .= $this->address . '<br>';
           }
           
           if(!empty($this->address2))
           {
               $address .= $this->address2 . '<br>';
           }

           if(!empty($this->city))
           {
               $address .= $this->city . ', ';
           }

           $address .= $this->state . ' '. $this->zip . '<br>';
           return $address;
       }

       
       /**
        * Display Address Label
        * @return string
        */
       public function displayAddressLabel()
       {
            $html = $this->displayName() . '<br />';
            $html .= $this->displayAddress();
            return $html;
       }
}