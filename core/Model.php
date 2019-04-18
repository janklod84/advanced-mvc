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
		    protected $solftDelete = false;

	        
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
             * Find item with parses params
             * Extrating params
             * 
             * @param array $params 
             * @return array
            */
		    public function find($params = [])
		    {
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
		    	 $resultsQuery = $this->db->findFirst($this->table, $params);
		    	 $result = new $this->modelName($this->table);
                 $result->populateObjData($resultsQuery);
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
             * Populate object data
             * @param object $obj 
             * @return void
            */
		    protected function populateObjData($result)
		    {
                 foreach($result as $key => $value)
                 {
                 	   $this->{$key} = $val;
                 }
		    }
}