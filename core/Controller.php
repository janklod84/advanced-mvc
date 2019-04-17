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
        public $view;

        
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
              $this->action = $action;
              $this->view = new View();
        }
}