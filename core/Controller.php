<?php 


class Controller extends Application
{

        /**
         * @var string
        */
        protected $_controller;


        /**
         * @var string
        */
        protected $_action;


        /**
         * @var string
        */
        public $_view;

        
        /**
         * Constructor
         * @param string $controller 
         * @param string $action 
         * @return void
        */
        public function __construct($controller, $action)
        {
              parent::__construct(); // Application constructor
              $this->_controller = $controller;
              $this->_action = $action;
              $this->view = new View();
        }
}