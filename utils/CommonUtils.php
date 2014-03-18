<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CommonUtils
 *
 * @author Vijay
 */
class CommonUtils {

    /**
     * Get the controller name from the url passed as parameter.
     * @param string $url
     * @return string - Name of the controller
     */
    public static function findController($url) {
        $controller = '';
        
        return $controller;
    }
    
    /**
     * Get the method name from the url passed as a parameter.
     * @param string $url
     * @return string - Name of the method
     */
    public static function findMethod($url) {
        $method = '';
        
        return $method;
    }
    
    /**
     * Get the path of the controller file.
     * @param string $controller
     * @return string - Path of the controller file. 
     */
    public static function getControllerFile($controller = '') {
        
        if($controller) {
            return PathVars::$Controller . '/' . $controller . '.php';
        }
    }

}
