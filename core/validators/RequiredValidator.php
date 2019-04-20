<?php 
namespace Core\Validators;


use Core\Validators\CustomValidator;



/**
 * @package Core\Validators\RequiredValidator
*/
class RequiredValidator  extends CustomValidator
{
       
       /**
        * Run Validation
        * @return bool
       */
       public function runValidation()
       {
           $value = $this->model->{$this->field};
           $passes  = (!empty($value));
           return $passes;
       }
}