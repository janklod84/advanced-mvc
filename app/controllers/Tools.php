<?php 


// http://mvc.loc/tools/[index, first, second, third]
class Tools extends Controller 
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
       * index action
       * @return mixed
      */
  	  public function indexAction()
  	  {
            $this->view->render('tools/index');
  	  }


      /**
       * first action
       * @return mixed
      */
      public function firstAction()
      {
            $this->view->render('tools/first');
      }


      /**
       * second action
       * @return mixed
      */
      public function secondAction()
      {
            $this->view->render('tools/second');
      }


      /**
       * third action
       * @return mixed
      */
      public function thirdAction()
      {
            $this->view->render('tools/third');
      }
}