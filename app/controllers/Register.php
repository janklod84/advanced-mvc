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
       * Login action
       * @return void
      */
  	  public function loginAction()
  	  {
           debug(Cookie::all(), true);
           $validation = new Validate();
           
           if($_POST)
           {
                // form validation
                $validation->check($_POST, [
                    'username' => [
                        'display'  => "Username",  
                        'required' => true,   
                    ], 
                    'password' => [
                         'display' => 'Password',
                         'required' => true,
                         'min' => 6
                    ]
                ]);


                if($validation->passed())
                {
                     $user = $this->UsersModel->findByUsername($_POST['username']);
                     
                     if($user && password_verify(Input::get('password'), $user->password))
                     {
                          $remember = (isset($_POST['remember_me']) && Input::get('remember_me')) ? true : false;

                          $user->login($remember);
                          Router::redirect(''); // redirect to home page '/'

                     }else{

                         $validation->addError("There is an error with your username or password.");
                     }
                }
           }

           $this->view->displayErrors = $validation->displayErrors();
           $this->view->render('register/login');
  	  }


      /**
       * Logout action
       * @return void
      */
      public function logoutAction()
      {
         if(currentUser())
         {
              currentUser()->logout();
         }

         Router::redirect('register/login');
      }
}