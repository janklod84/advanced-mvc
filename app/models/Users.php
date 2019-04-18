<?php 


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
      * @var 
     */
     public static $currentLoggedInUser = null;

     
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
          $this->solftDelete = true;

          if($user != '')
          {
          	   if(is_int($user))
          	   {
          	   	   $u = $this->db->findFirst('users', [
                        'conditions' => 'id = ?', 
                        'bind' => [$user]
          	   	   ]);

          	   }else{

          	   	   $u = $this->db->findFirst('users', [
                        'conditions' => 'username = ?',
                        'bind' => [$user]
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
          	  Cookie::set($this->cookieName, $hash, REMEMBER_COOKIE_EXPIRY);
          	  $fields = ['session' => $hash, 'user_agent' => $user_agent, 'user_id' => $this->id];

          	  $this->db->query("DELETE FROM user_sessions WHERE user_id = ? AND user_agent = ?", [$this->id, $user_agent]);

          	  $this->db->insert('user_sessions', $fields);
          }
     }


}