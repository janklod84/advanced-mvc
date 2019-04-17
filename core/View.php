<?php 


class View 
{
     
	     /**
	      * @var string
	     */
		 protected $head;

		 /**
		  * @var string
		 */
		 protected $body;

		 /**
		  * @var string
		 */
		 protected $siteTitle;

	     
	     /**
	      * @var string
	     */
		 protected $outputBuffer;


		 /**
		  * @var string
		 */
		 protected $layout = DEFAULT_LAYOUT;

         
         /**
          * Constructor
          * @return void
         */
		 public function __construct()
		 {

		 }

         
         /**
          * View render
          * @param string $viewName 
          * @return mixed
         */
		 public function render($viewName)
		 {
		 	 $viewArray = explode('/', $viewName);
             $viewString = implode(DS, $viewArray);

             $viewPath = ROOT . DS . 'app' . DS . 'views' . DS . $viewString . '.php';
             if(file_exists($viewPath))
             {
             	include($viewPath);
             	include(ROOT . DS . 'app' . DS . 'views' . DS . 'layouts' . DS . $this->layout . '.php');

             }else{

             	 die('The view \"' . $viewName . '" does not exist.');
             }
		 }

         
         /**
          * Create content
          * @param string $type 
          * @return 
         */
		 public function content($type)
		 {
             if($type == 'head')
             {
             	 return $this->head;

             }elseif($type == 'body'){

             	 return $this->body;
             }

             return false;
		 }
}