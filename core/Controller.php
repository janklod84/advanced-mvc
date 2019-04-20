<?php 


class Controller extends Application
{

        /**
         * @var string
        */
        protected $controller;


        /**
         * @var string
        */
        protected $action;


        /**
         * @var string
        */
        public $view; // do may protected
 
        
        /**
          * @var object
        */       
        public $request;



        /**
         * Constructor
         * @param string $controller 
         * @param string $action 
         * @return void
        */
        public function __construct($controller, $action)
        {
              parent::__construct(); // Application constructor
              $this->controller = $controller;
              $this->action  = $action;
              $this->request = new Input();
              $this->view = new View();
        }

        
        /**
         * Load model
         * @param string $model 
         * @return void
         */
        protected function loadModel($model)
        {
             if(class_exists($model))
             {
                  $this->{$model.'Model'} = new $model(strtolower($model));
             }
        }
}