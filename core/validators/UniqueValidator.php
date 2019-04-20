<?php 


class UniqueValidator  extends CustomValidator
{
       
       /**
        * Run Validation
        * @return bool
       */
       public function runValidation()
       {
            $field = (is_array($this->field)) ? $this->field[0] : $this->field;
            $value = $this->model->{$field};

            $conditions = ["{$field} = ?"];
            $bind = [$value];

            // check updating record
            if(!empty($this->model->id))
            {
                 $conditions[] = "id = ?";
                 $bind[] = $this->model->id;
            }

            // this allow you to check multiple fields for unique
            if(is_array($this->field))
            {
                 array_unshift($this->field);

                 foreach($this->field as $adds)
                 {
                     $conditions[] = "{$adds} = ?";
                     $bind[] = $this->model->{$adds};
                 }
            }

            $queryParams = ['conditions' => $conditions, 'bind' => $bind];
            $other = $this->model->findFirst($queryParams);
            return(!$other);
       }



}