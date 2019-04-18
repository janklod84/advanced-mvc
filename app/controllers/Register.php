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
                         'required' => true
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
                     }
                }
           }
           $this->view->render('register/login');
  	  }
}