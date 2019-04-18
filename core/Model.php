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
}