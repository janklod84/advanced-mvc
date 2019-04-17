<?php 


class Home extends Controller 
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
      }


      /**
       * Render view index
       * @return mixed
      */
	  public function indexAction($name)
	  {
	  	  echo $name;
          $this->view->render('home/index');
	  }
}