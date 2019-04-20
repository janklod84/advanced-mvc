<?php 
namespace Core\Validators;

use Core\Validators\CustomValidator;



/**
 * @package Core\Validators\MatchesValidator
*/
class MatchesValidator  extends CustomValidator
{
       
       /**
        * Run Validation
        * @return bool
       */
       public function runValidation()
       {
           $value = $this->model->{$this->field};
           return $value == $this->rule;
       }
}