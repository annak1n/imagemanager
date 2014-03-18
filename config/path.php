<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class PathVars {
    
    /**
     * Base directory path
     * @var string 
     */
    public static $ROOT_DIR;
    
    /**
     * Controller directory path 
     * @var string 
     */
    public static $CONTROLLER;
    
    /**
     * Models directory path
     * @var string 
     */
    public static $MODELS;
    
    /**
     * Views directory path
     * @var string 
     */
    public static $VIEWS;
    
    /**
     * Core Directory path;
     * @var core 
     */
    public static $CORE;
    
    /**
     * Utility Directory Path 
     * @var string 
     */
    public static $UTILS;
    
    static function init() {
        
        self::$ROOT_DIR = DOCUMENT_ROOT;
        
        self::$CORE = self::$ROOT_DIR.'/core';
        
        self::$CONTROLLER = self::$ROOT_DIR.'/contollers';
        
        self::$MODELS = self::$ROOT_DIR.'/models';
        
        self::$VIEWS = self::$ROOT_DIR.'/views';
        
        self::$UTILS = self::$ROOT_DIR.'/utils';
        
    }
    
}
/**
 * Initialize path vars class.
 */
PathVars::init();