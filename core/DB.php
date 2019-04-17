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
        * @var array
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
}