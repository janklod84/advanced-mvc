<?php 


// http://mvc.loc/register/[login]
class Register extends Controller 
{

      /**
       * Constructor
       * @param string $controller 
       * @param string $action 
       * @return void
      */
      public function __construct($controller, $action)
      {
           parent::__construct($controller, $action);
           $this->loadModel('Users'); 
           $this->view->setLayout('default');
      }


      /**
       * login action
       * @return mixed
      */
  	  public function loginAction()
  	  {
           if($_POST)
           {
                // form validation
                $validation = true;
                if($validation === true)
                {
                     $user = $this->UsersModel->findByUsername($_POST['username']);
                     
                     if($user && password_verify(Input::get('password'), $user->password))
                     {
                          $remember = (isset($_POST['remember_me']) && Input::get('remember_me')) ? true : false;

                          $user->login($remember);
                          Router::redirect('');
                     }
                }
           }
           $this->view->render('register/login');
  	  }
}