<?php

/**
 * Configuration file
 * 
 * @package Image Manager
 * @author Vijay Singh <vjpaleo@gmail.com>
 */

/**
 * Application Constants
 */
define('DOCUMENT_ROOT' , $_SERVER['DOCUMENT_ROOT']);
define('DEFAULT_CONTROLLER' , "home");
define('DEFAULT_METHOD' , "index");


class Config {
    public static $ENABLED_LAYOUTS =  array('main', 'ajax');
    public static $MAIN_LAYOUT = 'main';
    
    public static $DEBUG_MODE = true;
    public static $ACTIVATION_REQUIRED = false;
    public static $ADMIN_CODE = 4507;
    
    
}