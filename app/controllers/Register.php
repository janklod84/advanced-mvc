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