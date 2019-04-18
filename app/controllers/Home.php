<?php 


// http://mvc.loc/home/[index, first, second, third]
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
       * index action
       * @return mixed
      */
  	  public function indexAction()
  	  {
            $db = DB::getInstance();
            $contacts = $db->findFirst('contacts', [
               'conditions' => "id = ?", 
               'bind' => [1]
            ]);

            debug($contacts);
            $this->view->render('home/index');
  	  }
}