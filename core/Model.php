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
	         * @var array
	        */
		    protected $columnNames = [];


	        /**
	         * @var int
	        */
		    protected $id;


	        
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
                   $this->setTableColumns();
                   $this->modelName = str_replace(' ', '', ucwords(str_replace('_', ' ', $this->table)));
		    }

            
            /**
             * set table columns
             * $column have property Field, Key [ all properties written with uppercase]
             * var_dump($column) for see more ...
             * 
             * @return void
            */
		    protected function setTableColumns()
		    {
                $columns = $this->get_columns();
                foreach($columns as $column)
                {
                     $columnName = $column->Field;
                	 $this->columnNames[] = $column->Field;
                	 $this->{$columnName} = null;
                }
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
                 $results = [];
                 $resultsQuery = $this->db->find($this->table, $params);

                 foreach($resultsQuery as $result)
                 {
                 	   $obj = new $this->modelName($this->table);
                 	   $obj->populateObjData($result);
                 	   $results[] = $obj;
                 }

                 return $results;
		    }


            
            /**
             * Find first record
             * @param array $params 
             * @return array
            */
		    public function findFirst($params = [])
		    {
                 $params = $this->softDeleteParams($params);
		    	 $resultQuery = $this->db->findFirst($this->table, $params);
		    	 $result = new $this->modelName($this->table);
                 if($resultQuery)
                 {
                    $result->populateObjData($resultQuery);
                 }
                 return $result;
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
                $fields = [];

                foreach($this->columnNames as $column)
                {
                	$fields[$column] = $this->{$column};
                }

                // determine whether to update or insert 
                if(property_exists($this, 'id') && $this->id != '')
                {
                	 return $this->update($this->id, $fields);

                }else{

                	return $this->insert($fields);
                }
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

                  if($this->solftDelete)
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

		    	 foreach($this->columnNames as $column)
		    	 {
		    	 	   $data->column = $this->column;
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
		    	 	 	 if(in_array($key, $this->columnNames))
		    	 	 	 {
		    	 	 	 	  $this->{$key} = sanitize($val);
		    	 	 	 }
		    	 	 }

		    	 	 return true;
		    	 }

		    	 false;
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
}