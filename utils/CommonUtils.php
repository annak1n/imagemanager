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
        if ($_SERVER['REQUEST_URI'] == '/') {
            
            /**
             * Default controller.
             */
            $controller = DEFAULT_CONTROLLER; // config.php
        }
        /**
         * Controller name as a parameter in the url.
         */
        if(isset($_GET['c'])) {
            $controller = $_GET['c'];
        }
        
        return $controller;
    }

    /**
     * Get the method name from the url passed as a parameter.
     * @param string $url
     * @return string - Name of the method
     */
    public static function findMethod($url) {
        $method = '';
        if ($_SERVER['REQUEST_URI'] == '/') {

            /**
             * Default method.
             */
            $method = DEFAULT_METHOD; // config.php
        }
        
        /**
         * Method name as a parameter in the url.
         */
        if(isset($_GET['m'])) {
            $method = $_GET['m'];
        }
        return $method;
    }

    /**
     * Get the path of the controller file.
     * @param string $controller
     * @return string - Path of the controller file. 
     */
    public static function getControllerFile($controller = '') {

        if ($controller) {
            return PathVars::$CONTROLLER . '/' . $controller . '.php';
        }
    }

}
