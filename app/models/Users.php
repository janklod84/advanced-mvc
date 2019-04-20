<?php 
namespace App\Models;

use Core\Model;
use App\Models\Users;
use App\Models\UserSession;
use Core\Cookie;
use Core\Session;
use Core\Validators\MinValidator;
use Core\Validators\MaxValidator;
use Core\Validators\RequiredValidator;
use Core\Validators\EmailValidator;
use Core\Validators\MatchesValidator;
use Core\Validators\UniqueValidator;



class Users  extends Model
{

       
      /**
        * @var 
       */
       private $isLoggedIn;

       /**
        * @var string
       */
       private $sessionName;
       
       
       /**
        * @var string
       */
       private $cookieName;


       /**
        * @var string
       */
       private $_confirm; 

       
       /**
        * @var 
       */
       public static $currentLoggedInUser = null;



       /**
        * Table properties
        * 
        * @var int $id
        * @var string $username
        * @var string $email
        * @var string $password
        * @var string $fname
        * @var string $lname
        * @var string $acl
        * @var int $deleted
       */
       public $id;
       public $username;
       public $email;
       public $password;
       public $fname;
       public $lname;
       public $acl;
       public $deleted = 0;
     
     


     /**
      * Constructor
      * @param string $user 
      * @return void
     */
     public function __construct($user = '')
     {
          $table = 'users';
          parent::__construct($table);
          $this->sessionName = CURRENT_USER_SESSION_NAME;
          $this->cookieName  = REMEMBER_ME_COOKIE_NAME;
          $this->softDelete = true;

          if($user != '')
          {
          	   if(is_int($user))
          	   {
          	   	   $u = $this->db->findFirst('users', [
                        'conditions' => 'id = ?', 
                        'bind' => [$user],   
                        'App\\Models\\Users'
          	   	   ]);

          	   }else{

          	   	   $u = $this->db->findFirst('users', [
                        'conditions' => 'username = ?',
                        'bind' => [$user],  
                        'App\\Models\\Users'
          	   	   ]);
          	   }

          	   if($u)
          	   {
          	   	   foreach($u as $key => $val)
          	   	   {
          	   	   	    $this->{$key} = $val;
          	   	   }
          	   }
          }
     }// end construct

     
     /**
      * Validator fields
      * @return bool
     */
     public function validator()
     {

         # Validation Required field
         $this->runValidation(new RequiredValidator($this, [
            'field' => 'fname', 
            'msg' => 'First Name is required.'
         ]));

         $this->runValidation(new RequiredValidator($this, [
            'field' => 'lname', 
            'msg' => 'Last Name is required.'
         ]));

         $this->runValidation(new RequiredValidator($this, [
            'field' => 'email', 
            'msg' => 'Email is required.'
         ]));

         $this->runValidation(new EmailValidator($this, [
             'field' => 'email', 
             'msg' => 'Email must provide a valid email address.'
         ]));

         $this->runValidation(new MaxValidator($this, [
              'field' => 'email', 
              'rule' => 150, 
              'msg' => 'Email must be less than 150 characters.'
         ]));
         


        # Validation Min and Max
         $this->runValidation(new MinValidator($this, [
              'field' => 'username', 
              'rule' => 6, 
              'msg' => 'Username must be at least 6 characters.'
         ]));

         $this->runValidation(new MaxValidator($this, [
              'field' => 'username', 
              'rule' => 150, 
              'msg' => 'Username must be less than 150 characters.'
         ]));
         
         $this->runValidation(new UniqueValidator($this, [
              'field' => 'username',  
              'msg' => 'That username already exists. Please choose a new one.'
         ]));

         $this->runValidation(new RequiredValidator($this, [
            'field' => 'password', 
            'msg' => 'Password is required.'
         ]));

         $this->runValidation(new MinValidator($this, [
              'field' => 'password', 
              'rule' => 6, 
              'msg' => 'Password must be a minimum 6 characters.'
         ]));

         if($this->isNew())
         {
             $this->runValidation(new MatchesValidator($this, [
                  'field' => 'password', 
                  'rule' => $this->_confirm, 
                  'msg' => 'Your passwords do not match.'
            ]));
         }
     } 

     
     /**
      * Action to do before saving data
      * @return void
     */
     public function beforeSave()
     {
         if($this->isNew())
         {
             $this->password = password_hash($this->password, PASSWORD_DEFAULT);
         }
     }
     
     /**
      * Find user by username
      * @param string $username 
      * @return mixed
     */
     public function findByUsername($username)
     {
     	  return $this->findFirst([
		            'conditions' => "username = ?",
		            'bind' => [$username]
     	        ]);
     }

     

     /**
      * Return current logged User
      * @return 
     */
     public static function currentUser()
     {
           if(!isset(self::$currentLoggedInUser) && Session::exists(CURRENT_USER_SESSION_NAME))
           {
                  $u = new Users((int) Session::get(CURRENT_USER_SESSION_NAME));
                  self::$currentLoggedInUser = $u;
           }

           return self::$currentLoggedInUser;
     }


     
     /**
      * Login user
      * @param bool $rememberMe 
      * @return mixed
     */
     public function login($rememberMe = false)
     {
          Session::set($this->sessionName, $this->id);

          if($rememberMe)
          {
          	  $hash = md5(uniqid() + rand(0, 100));
          	  $user_agent = Session::uagent_no_version();
          	  Cookie::set($this->cookieName, $hash, REMEMBER_ME_COOKIE_EXPIRY);
          	  $fields = ['session' => $hash, 'user_agent' => $user_agent, 'user_id' => $this->id];

          	  $this->db->query("DELETE FROM user_sessions WHERE user_id = ? AND user_agent = ?", [$this->id, $user_agent]);

          	  $this->db->insert('user_sessions', $fields);
          }
     }

      
      /**
       * Login User From Cookie
       * @return 
      */
      public static function loginUserFromCookie()
      {
           $userSession = UserSessions::getFromCookie();

           if($userSession && $userSession->user_id != '')
           {
                 $user= new self((int) $userSession->user_id);

                 if($user)
                 {
                     $user->login();
                 }
                 return $user;
           }

           return;
      }


     /**
      * User logout
      * @return bool
     */
     public function logout()
     {
         $userSession = UserSessions::getFromCookie();
         
         if($userSession)
         {
             $userSession->delete();
         }

         Session::delete(CURRENT_USER_SESSION_NAME);

         if(Cookie::exists(REMEMBER_ME_COOKIE_NAME))
         {
             Cookie::delete(REMEMBER_ME_COOKIE_NAME);
         }

         self::$currentLoggedInUser = null;
         return true;
     }

     
    
     /**
      * Get user acl
      * @return mixed
     */
     public function acls()
     {
          if(empty($this->acl))
          {
                return [];
          }

          return json_decode($this->acl, true);
     }

     
     /**
      * Set Confirm
      * @param string $value 
      * @return void
     */
     public function setConfirm($value)
     {
          $this->_confirm = $value;
     }

     
     /**
      * Get Confirm
      * @return string
     */
     public function getConfirm()
     {
         return $this->_confirm;
     }


}