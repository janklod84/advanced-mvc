<?php 


class Validate 
{
       
       /**
        * @var bool
       */
       private $passed = false;

       
       /**
        * @var array
       */
       private $errors = [];


       /**
        * @var \DB 
       */ 
       private $db = null;


       
       /**
        * Constructor
        * @return void
       */
       public function __construct()
       {
            $this->db = DB::getInstance();
       }


       
       /**
        * Check data and add errors
        * $this->check($_POST, ['username' => [], 'password' => []])
        * 
        * @param array $source Ex: $_POST
        * @param array $items  Ex: ['username', 'password']
        * @return mixed
       */
       public function check($source, $items = [])
       {
              $this->errors = [];

              foreach($items as $item => $rules)
              {
              	   $item = Input::sanitize($item);
              	   $display = $rules['display'];

              	   foreach ($rules as $rule => $rule_value)
              	   {
              	   	   $value = Input::sanitize(trim($source[$item]));

              	   	   if($rule === 'required' && empty($value))
              	   	   {
              	   	   	     $this->addError(["{$display} is required", $item]);

              	   	   }else if(!empty($value)){

              	   	   	   switch ($rule)
              	   	   	   {
              	   	   	   	    case 'min': 
              	   	   	   	    if(strlen($value) < $rule_value)
              	   	   	   	    {
              	   	   	   	    	$this->addError(["{$display} must be a minimum of {$rule_value} characters.", $item]);
              	   	   	   	    }
              	   	   	   	    break;

                                case 'max': 
              	   	   	   	    if(strlen($value) > $rule_value)
              	   	   	   	    {
              	   	   	   	    	$this->addError(["{$display} must be a maximum of {$rule_value} characters.", $item]);
              	   	   	   	    }
              	   	   	   	    break;



              	   	   	   }
              	   	   }
              	   }
              }
       }


       
       /**
        * Add Error
        * @param string $error 
        * @return void 
       */
       public function addError($error)
       {
            $this->errors[] = $error;
            if(empty($this->errors))
            {
            	 $this->passed = true;

            }else{

            	$this->passed = false;
            }
       }
}