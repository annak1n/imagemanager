<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include_once 'config/include.php';

try {

    /**
     * Read the URL and decide the controller and method being to be called.
     * Use reflection class to instatiate the contoller.
     */
    /**
     * Complete request URL
     */
    $url = 'http://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
    
    /**
     * Read controller from url.
     */
    $controller = CommonUtils::findController($url);

    /**
     * Read method/ action from url
     */
    $method = CommonUtils::findMethod($url);

    /**
     * Create of path to controller file.
     */
    $controllerFile = CommonUtils::getControllerFile($controller);

    /* Check if controller requested in the url exists. */
    if (!is_file($controllerFile)) {

        /* Controller file doesn't exists. */
        throw new Exception("Invalid Controller - Controller file not found.", 404);
    }

    include_once $controllerFile;
    
    /**
     * Create controller class name.
     */
    $controllerClass = ucfirst($controller).'Controller';
    
    /**
     * check controller class exists
     */
    if (!class_exists($controllerClass)) {

        /* controller class doesn't exist */
        throw new Exception("Invalid Controller", 404);
    }
    
    /**
     * Intantiate the controller.
     * @TODO: Use reflection class.
     */
    $objContClass = new $controllerClass;
    /**
     * Initilize the controller process.
     */
    $objContClass->init($controller, $method);
    
    
    if (method_exists($objContClass, $method)) {
        $objContClass->$method();
    } else {
        throw new Exception("Invalid Method", "404");
    }
    /**
     * Render the output.
     */
    $objContClass->render();
    
    /**
     * Packup the controller.
     */
    $objContClass->packup();
    
    
} catch (Exception $ex) {
    /*@TODO log this and show 404 error page instead. */
    echo '<br/>Exception: ' . $ex->getCode() . ' - ' . $ex->getMessage() . ' at line ' . $ex->getLine() . ' in file ' . $ex->getFile();
}
exit();
