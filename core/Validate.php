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


                                case 'matches':
	                                if($value != $source[$rule_value])
	                                {
	                                	 $matchDisplay = $items[$rule_value]['display'];
	                                    $this->addError(["{$matchDisplay} and {$display} must much.", $item]);
	                                }
                                break;

                                case 'unique':
                                 $check = $this->db->query("SELECT {$item} FROM {$rule_value} WHERE {$item} = ?", [$value]);

	                                 if($check->count())
	                                 {
	                                 	 $this->addError(["{$display} already exists. Please choose another {$display}", $item]);
	                                 }
                                 break;


                                 case 'unique_update':
                                   $t = explode(',', $rule_value);
                                   $table = $t[0];
                                   $id = $t[1];
                                   $query = $this->db->query("SELECT * FROM {$table} WHERE id != ? AND {$item} = ?", [$id, $value]);

                                   if($query->count())
                                   {
                                   	   $this->addError(["{$display} already exists. Please choose another {$display}.", $item]);
                                   }
                                 break;


                                 case 'is_numeric':
                                   if(!is_numeric($value))
                                   {
                                   	   $this->addError(["{$display} has to be a number. Please use a numeric value.", $item]);
                                   }
                                 break;

                                 case 'valid_email':
                                    if(!filter_var($value, FILTER_VALIDATE_EMAIL))
                                    {
                                    	  $this->addError(["{$display} must be a valid email address.", $item]);
                                    }
                                 break;
              	   	   	   }
              	   	   }
              	   }
              }

              if(empty($this->errors))
              {
              	  $this->passed = true;
              }

              return $this;
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


       
       /**
        * Get errors
        * @return array
       */
       public function errors()
       {
       	   return $this->errors;
       }

       
       /**
        * Determine if validation passed
        * @return bool
       */
       public function passed()
       {
            return $this->passed;
       }

       
       /**
        * Display errors
        * @return string
       */
       public function displayErrors()
       {
       	   $html = '<ul class="bg-danger">';
       	   foreach ($this->errors as $error) {

       	   	  if(is_array($error))
       	   	  {
                $html .= '<li class="text-danger">'. $error[0] .'</li>';
                $html .= '<script>jQuery("document").ready(function(){jQuery("#'. $error[1] .'").parent().closest("div").addClass("has-error");});</script>';

              }else{

              	  $html .= '<li class="text-danger">'. $error . '</li>';
              }
       	   }

       	   $html .= '</ul>';
       	   return $html;
       }
}