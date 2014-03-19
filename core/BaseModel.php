<?php

/**
 * BaseModel is required to be extented in all the models in the applicaltion.
 * It will instatiate and connet to database and provide the handler to query in the database.
 * 
 * @author Vijay
 */
abstract class BaseModel {
    
    /**
     * Database Handler
     * @var object
     */
    protected $db;
    
    
    function __construct() {
        /* Contructor Called */
        
        /* Call database connect method. */
        $this->connect();
    }
    
    /**
     * Close db connection when object is destroyed
     */
    public function __destruct() {
        
        if(!$this->db->connect_errno) {
            $this->db->close();
        }
        
    }
    
    /**
     * connect to database
     */
    protected function connect() {
       try {
           $this->db = new mysqli(Database::$SERVER, Database::$USERNAME, Database::$PASSWORD, Database::$DATABASE_SCHEMA);
           
           if ($this->db->connect_errno) {
                throw new Exception('Could not connect to mysql: ' . $this->db->connect_error);
            }
       } catch (Exception $ex) {
           /* @TODO with proper wrapper meathod. */
           echo $ex->getMessage();
           exit;
       }
        
    }
    
    
}
