<?php 


class DB 
{
       

       const DSN_FORMAT = 'mysql:host=%s;dbname=%s;charset=utf8';


       /**
        * @var self
       */
	   private static $instance = null;

       
       /**
        * @var \PDO
       */
	   private $pdo;


	   /**
        * @var string
       */
	   private $query;


	   /**
        * @var bool
       */
	   private $error;


	   /**
        * @var mixed
       */
	   private $result;


	   /**
        * @var int
       */
	   private $count = 0;


	   /**
        * @var int 
       */
	   private $lastInsertID = null;

       
       /**
        * Constructor
        * @return void
       */
	   private function __construct()
	   {
            try 
            {

                 $this->pdo = new PDO($this->dsn(), DB_USER, DB_PASSWORD);

            }catch(PDOException $e) {
                
                 die($e->getMessage());
            }
	   }

       
       /**
        * return dsn
        * @return string
       */
	   private function dsn()
	   {
           return sprintf(self::DSN_FORMAT, DB_HOST, DB_NAME);
	   }

       
       /**
        * Return instance of database
        * Used pattern singleton
        * @return self
       */
	   public static function getInstance()
	   {
            if(!isset(self::$instance))
            {
            	self::$instance = new DB();
            }

            return self::$instance;
	   }


       
       /**
        * Excecution query
        * [$this->query return \PDOStatement]
        * 
        * @param string $sql 
        * @param array $params 
        * @return 
        */
	   public function query($sql, $params = [])
	   {
             $this->error = false;
             
             // if query executed successfully
             if($this->query = $this->pdo->prepare($sql))
             {
             	  $x = 1;

             	  // if have params
             	  if(count($params))
             	  {
             	  	  foreach($params as $param)
             	  	  {   
             	  	  	   // bindValue(1, 'param 1'); bindValue(2, 'param 2')
             	  	  	   $this->query->bindValue($x, $param);
             	  	  	   $x++;
             	  	  }
             	  }

                  // if executed successfully
             	  if($this->query->execute())
             	  {
             	  	   $this->result  = $this->query->fetchAll(PDO::FETCH_OBJ);
             	  	   $this->count   = $this->query->rowCount();
             	  	   $this->lastInsertID = $this->pdo->lastInsertId();

             	  }else{

             	  	  $this->error = true;
             	  }
             }

             return $this;

	   }// end query method






}// end class DB