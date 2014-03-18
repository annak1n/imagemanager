<?php

/**
 * User controller that handles user actions like login, logout, register, manage etc. 
 *
 * @author Vijay Singh <vjpaleo@gmail.com>
 */
class UserController extends BaseController {
    
    public function __construct() {
        parent::__construct();
        
        /* Initilize user model */
    }
    
    public function login() {
        /* check user session exists , if yes then refirect user to dashboard */
        
        /**
         * User login form submitted.
         */
        if(isset($this->reqPost['signin'])) {
            /* register user */
            
            exit();
        }
        
        /* Create user session */
        
        /* redirect user to dashboard */
            
    }
    
    public function register() {
        /* check user session exists , if yes then refirect user to dashboard */
        
        $formFields = array('username', 'pass', 'confirmPass', 'email');
        $this->viewData = array_merge($this->viewData, array_fill_keys($formFields, ''));
        
        /**
         * User Registration form submitted.
         */
        if(isset($this->reqPost['signup'])) {
            
            /* Check required fields for user registration. */
            if($this->reqPost['username'] == '' || $this->reqPost['pass'] == '' || 
                    $this->reqPost['confirmPass'] == ''  || $this->reqPost['email'] == '') {
                $this->viewData['error'] = "All fields are mendetory!";
                
            } elseif($this->reqPost['pass'] !== $this->reqPost['confirmPass']) {
                
                /* password and confirm password doesn't match. */
                $this->viewData['error'] = "Password and Confirm Password fields should match.";
                
                $this->viewData = array_merge($this->viewData, $this->reqPost);
                
            } else {
                /* register user */
                $inData['u_username'] = $this->reqPost['username'];
                $inData['u_password'] = $this->reqPost['pass'];
                $inData['u_raw_pass'] = $this->reqPost['confirmPass'];
                $inData['u_username'] = $this->reqPost['email'];
                
                /*if registration success then sign in the user. */
                $_POST['signin'] = 'Sign In';
                $this->login();
                exit();
            }
            
            
        }
        
        /* load register form view. */
        
    }
    
    public function manage() {
        
    }
    
    public function logout() {
        
    }
    
    public function disable() {
        
    }
    
}