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
           $this->load_model('Users'); // load_model() dynamically generate from Controller 
           $this->view->setLayout('default');
      }


      /**
       * login action
       * @return mixed
      */
  	  public function loginAction()
  	  {
           $this->view->render('register/login');
  	  }
}