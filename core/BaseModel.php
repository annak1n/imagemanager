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
        mysql_close($this->db);
    }
    
    /**
     * connect to database
     */
    protected function connect() {
       try {
           $this->db = mysqli_connect(Database::$SERVER, Database::$USERNAME, Database::$PASSWORD, Database::$DATABASE_SCHEMA);
            if (!$this->db) {
                throw new Exception('Could not connect: ' . mysql_error());
            }
       } catch (Exception $ex) {
           /* @TODO with proper wrapper meathod. */
       }
        
    }
    
    /**
     * Initialize the controller class, get request params, decide method default view
     * and decide default controller. 
     * @param string $controller
     * @param string $method
     */
    function init($controller, $method) {
        
        $this->reqParam = array_merge($_GET, $_POST);
        $this->decideView($controller, $method);
        $this->decideLayout();
    }
    
    /**
     * Decide the view file according to the controller and method called.
     * @param String $controller
     * @param String $method
     */
    protected function decideView($controller, $method) {
        $this->view = VIEWS_PATH.'/'.$controller.'/'.$method.'.php';
    }
    
    /**
     * Decide the layout to be rendered. Custom layout can be called.
     * @param String $custom_layout
     * @return boolean
     */
    protected function decideLayout($custom_layout = "") {
        
        if($custom_layout != "" && in_array($custom_layout, Config::$ENABLED_LAYOUTS)) {
            $this->layout = VIEWS_PATH.'/'.$custom_layout.'.php';
            return true;
        }
        $this->layout = VIEWS_PATH.'/'.MAIN_LAYOUT.'.php';
            
        return true;
    }

    /**
     * Render the view for a request.
     * @param string $content
     */
    public function render($content = '') {
        $content = $content;
        include_once $this->layout;
    }
    
    /**
     * Shut down every thing after the calls is complete.
     */
    public function packup() {
        /* Release memory */
    }
}
