<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

define('DOCUMENT_ROOT' , $_SERVER['DOCUMENT_ROOT']);
define('DEFAULT_CONTROLLER' , "home");
define('DEFAULT_METHOD' , "index");

class Config {
    public static $ENABLED_LAYOUTS =  array('main', 'ajax');
    public static $MAIN_LAYOUT = 'main';
    
}