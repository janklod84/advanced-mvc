<?php 


class Model 
{
        
	        /**
	         * Connection to database
	         * @var \DB
	         */
		    protected $db;


		    /**
		     * table name
		     * @var string
		    */
		    protected $table;

	        
	        /**
	         * @var string
	        */
		    protected $modelName;

	        
	        /**
	         * @var bool
	        */
		    protected $softDelete = false;


            
            /**
             * @var bool
            */
            protected $validates = true;


            /**
             * @var array
            */
            protected $validationErrors = [];




	        /**
	         * @var int
	        */
		    public $id;


	        
	        /**
	         * Constructor
	         * Ex: if $table = 'user_sessions' => $modelName = 'UserSessions'
	         * 
	         * @param string $table
	         * @return void
	        */
		    public function __construct($table)
		    {
                   $this->db = DB::getInstance();
                   $this->table = $table;
                   $this->modelName = str_replace(' ', '', ucwords(str_replace('_', ' ', $this->table)));
		    }

        
            /**
             * Get columns
             * @return array
            */
		    public function get_columns()
		    {
		    	 return $this->db->get_columns($this->table);
		    }

            
            /**
             * Soft Delete concept
             * For deleting rows or params from database 
             * 
             * @param array $params 
             * @return bool
            */
            protected function softDeleteParams($params)
            {
                 if($this->softDelete)
                 {
                     if(array_key_exists('conditions', $params))
                     {
                            if(is_array($params['conditions']))
                            {
                                $params['conditions'][] = "deleted != 1";

                            }else{

                                $params['conditions'] .= " AND deleted != 1";
                            }

                     }else{

                         $params['conditions'] = "deleted != 1";
                     }
                 }
                 return $params;
            }

            
            /**
             * Find item with parses params
             * Extrating params
             * 
             * @param array $params 
             * @return array
            */
		    public function find($params = [])
		    {
                 $params = $this->softDeleteParams($params);
                 $resultsQuery = $this->db->find($this->table, $params, get_class($this));
                 if(!$resultsQuery) { return []; }
                 return $resultsQuery;
		    }


            
            /**
             * Find first record
             * @param array $params 
             * @return array
            */
		    public function findFirst($params = [])
		    {
                 $params = $this->softDeleteParams($params);
		    	 $resultQuery = $this->db->findFirst($this->table, $params, get_class($this));
                 return $resultQuery;
		    }

            
            /**
             * Find item by id
             * @param int $id 
             * @return mixed
            */
		    public function findById($id)
		    {
                 return $this->findFirst([
                     'conditions' => "id = ?",
                     'bind' => [$id]
                 ]);
		    }

            
            /**
             * Return insert or update record
             * @return bool
            */
            public function save()
            {
                // Run validator before saving
                $this->validator();
                
                // if validation passed, we will run next scripts
                if($this->validates)
                {
                    // Get fields current Model
                    $fields = H::getObjectProperties($this);

                    // determine whether to update or insert 
                    if(property_exists($this, 'id') && $this->id != '')
                    {
                         return $this->update($this->id, $fields);

                    }else{

                        return $this->insert($fields);
                    }
                }
                
                return false;
            }



            /**
             * Insert data into table
             * @param array $fields 
             * @return bool
            */
		    public function insert($fields)
		    {
                 if(empty($fields))
                 {
                 	return false;
                 }

                 return $this->db->insert($this->table, $fields);
		    }


            /**
             * Update data [ record ]
             * @param int $id 
             * @param array $fields 
             * @return bool
            */
		    public function update($id, $fields)
		    {
                if(empty($fields) || $id == '')
                {
                	 return false;
                }

                return $this->db->update($this->table, $id, $fields);
		    }

            
            /**
             * Delete record 
             * @param int $id 
             * @return bool
            */
		    public function delete($id = '')
		    {
                  if($id == '' && $this->id == '')
                  {
                  	   return false;
                  }

                  $id = ($id == '') ? $this->id : $id;

                  if($this->softDelete)
                  {
                  	   return $this->update($id, ['deleted' => 1]);
                  }

                  return $this->db->delete($this->table, $id);
		    }

            
            /**
             * Execute Query
             * @param string $sql 
             * @param array $bind 
             * @return bool
             */
		    public function query($sql, $bind = [])
		    {
		    	 return $this->db->query($sql, $bind);
		    }


            
            /**
             * Return data
             * @return array
            */
		    public function data()
		    {
		    	 $data = new stdClass();

		    	 foreach(H::getObjectProperties($this) as $column => $value)
		    	 {
		    	 	   $data->column = $value;
		    	 }

		    	 return $data;
		    }

            
            /**
             * Assignement for exemple data from request $_POST
             * 
             * @param array $params 
             * @return void
            */
		    public function assign($params)
		    {
		    	 if(!empty($params))
		    	 {
		    	 	 foreach($params as $key => $val)
		    	 	 {
		    	 	 	 if(property_exists($this, $key))
		    	 	 	 {
		    	 	 	 	  $this->{$key} = FH::sanitize($val);
		    	 	 	 }
		    	 	 }

		    	 	 return true;
		    	 }

		    	 return false;
		    }

            
            /**
             * Populate object data
             * @param object $obj 
             * @return void
            */
		    protected function populateObjData($result)
		    {
                 foreach($result as $key => $val)
                 {
                 	   $this->{$key} = $val;
                 }
		    }

            
            /**
             * Validator
             * @return 
            */
            public function validator(){}
            

            
            /**
             * Run validator
             * @param Validator $validator 
             * @return void
            */
            public function runValidation($validator)
            {
                 $key = $validator->field;

                 if(!$validator->success)
                 {
                     $this->validates = false;
                     $this->validationErrors[$key] = $validator->msg;
                 }
            }

            
            /**
             * Get Error messages
             * @return array
            */
            public function getErrorMessages()
            {
                return $this->validationErrors;
            }

            
            /**
             * Get all passed validation
             * @return bool
            */
            public function validationPasses()
            {
                return $this->validates;
            }

            
            /**
             * Add Error Message
             * @param string $field
             * @param string $msg
             * @return void
            */
            public function addErrorMessage($field, $msg)
            {
                  $this->validates = false;
                  $this->validationErrors[$field] = $msg;
            }
}