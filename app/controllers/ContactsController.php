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

      
      /**
       * add action
       * @return mixed
      */
  	  public function addAction()
  	  {
  	  	   $contact = new Contacts();
           $validation = new Validate();
  	  	   if($_POST)
  	  	   {
               $contact->assign($_POST);
               $validation->check($_POST, Contacts::$addValidation);

               if($validation->passed())
               {
               	   $contact->user_id = currentUser()->id;
               	   $contact->deleted = 0;
                   $contact->save();
                   Router::redirect('contacts');
               }
  	  	   }

  	  	   $this->view->contact = $contact;
  	  	   $this->view->displayErrors = $validation->displayErrors();
  	  	   $this->view->postAction = PROOT . 'contacts/add';
           $this->view->render('contacts/add');
  	  }
}