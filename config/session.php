<?php

/**
 * Main session class to handle php session and user data in session.
 *
 * @author Vijay Singh <vjpaleo@gmail.com>
 */
class Session {
    
    public static $sessionId;
    public static $userData;
    
    /**
     * Initialize session
     */
    public static function init() {
        self::startSession();
    }
    
    /**
     * Start php session
     */
    public static function startSession() {
        session_start();
    }
    
    /**
     * Get session id of current session.
     * @return type
     */
    public static function getSessionId() {
        return self::$sessionId = session_id();
    }
    
    /**
     * Set data in key / value pair in session
     * @param string $key
     * @param string $data
     */
    public static function setData($key, $data) {
        
        $_SESSION[$key] = $data;
        
    }
    
    /**
     * Get data from session.
     * @param string $key
     * @return mixed session data or boolean false
     */
    public static function getData($key) {
        
        return isset($_SESSION[$key])? $_SESSION[$key] : false;
        
    }
    
    /**
     * 
     * @param string $key
     */
    public static function unsetData($key = '') {
        
        if(isset($_SESSION[$key])) {
            unset($_SESSION[$key]);
        }
        
    }
    /**
     * Set user data to session.
     * @param array $userData
     */
    public static function setUserData(Array $userData) {
        self::$userData = $userData;
        self::setData('UsrSess', json_encode($userData));
    }
    
    /**
     * Get user data from session.
     */
    public static function getUserData() {
        if(is_array(self::$userData) && !empty(self::$userData)) {
            return self::$userData;
        }
        
        $jsnUserData = self::getData('UsrSess');
        $userData = json_decode($jsnUserData);
        
        return self::$userData = $userData;
        
    }
    
    /**
     * Destroy user session data.
     * @param array $userData
     */
    public static function destroyUserSession(Array $userData) {
        self::$userData = NULL;
        self::unsetData('UsrSess');
    }
    
    /**
     * Update user data in session.
     * @param type $key
     * @param type $value
     */
    public static function updateUserSession($key, $value) {
        if($key != '') {
            $userSession = self::getUserData();
            $userSession[$key] = $value;
            self::setUserData($userSession);
        }
    }
    
}

/**
 * Initialize session for the application.
 * @todo: Can be moved to bootstrap later. 
 */
Session::init();
