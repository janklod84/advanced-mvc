<?php 


class ContactsController extends Controller
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
           $this->loadModel('Contacts');
      }


      /**
       * index action
       * @return mixed
      */
  	  public function indexAction()
  	  {
  	  	   $contacts = $this->ContactsModel->findAllByUserId(currentUser()->id, [
               'order' => 'lname, fname'
  	  	   ]);

  	  	   $this->view->contacts = $contacts;
           $this->view->render('contacts/index');
  	  }
}