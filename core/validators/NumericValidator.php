<?php 
namespace Core\Validators;

use Core\Validators\CustomValidator;


/**
 * @package Core\Validators\NumericValidator
*/

class NumericValidator  extends CustomValidator
{
       
       /**
        * Run Validation
        * @return bool
       */
       public function runValidation()
       {
           $value = $this->model->{$this->field};
           $pass = true;
           if(!empty($value))
           {
              $pass = is_numeric($value);
           }
           return $pass;
       }
}