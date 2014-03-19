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
     * Site URL
     * @var string  
     */
    public static $SITE_URL;
    
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
    
    /**
     * Css directory url
     * @var string 
     */
    public static $CSS;
    
    /**
     * Js directory url.
     * @var string 
     */
    public static $JS;
    
    
    public static $IMAGE_UPLOAD;
    
    public static $IMAGE_UPLOAD_URL;
    
    
    
    static function init() {
        
        self::$ROOT_DIR = DOCUMENT_ROOT;
        
        self::$SITE_URL = 'http://'.$_SERVER['SERVER_NAME'];
        
        self::$CORE = self::$ROOT_DIR.'/core';
        
        self::$CONTROLLER = self::$ROOT_DIR.'/controllers';
        
        self::$MODELS = self::$ROOT_DIR.'/models';
        
        self::$VIEWS = self::$ROOT_DIR.'/views';
        
        self::$UTILS = self::$ROOT_DIR.'/utils';
        
        self::$CSS = self::$SITE_URL.'/assets/css';
        
        self::$JS = self::$SITE_URL.'/assets/js';
        
        self::$IMAGE_UPLOAD = self::$ROOT_DIR.'/assets/upload';
        
        self::$IMAGE_UPLOAD_URL = self::$SITE_URL.'/assets/upload';
        
        
    }
    
}
/**
 * Initialize path vars class.
 */
PathVars::init();