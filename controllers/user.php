<?php

/**
 * User controller that handles user actions like login, logout, register, manage etc. 
 *
 * @author Vijay Singh <vjpaleo@gmail.com>
 */
/* Inclue user model. */
include_once PathVars::$MODELS . '/user.php';

class UserController extends BaseController {

    private $objUserModel;

    public function __construct() {
        parent::__construct();

        /* Initilize user model */
        $this->objUserModel = new User();
    }

    public function login() {
        /* check user session exists , if yes then refirect user to dashboard */
        $this->isLoggedIn();

        $formFields = array('email', 'pass');
        $this->viewData = array_merge($this->viewData, array_fill_keys($formFields, ''));

        /**
         * User login form submitted.
         */
        if (isset($this->reqPost['signin'])) {
            
            /* Check required fields for user login. */
            if ($this->reqPost['pass'] == '' || $this->reqPost['email'] == '') {
                $this->viewData['form_error'] = "All fields are mendetory!";
            } else {
                /* login user */
                $inData = array();
                $inData['u_email'] = $this->reqPost['email'];
                $inData['u_password'] = md5($this->reqPost['pass']);
                
                $returnData = $this->objUserModel->login($inData);
                echo $returnData['response_code'];
                if ($returnData['response_code']) {
                    /* Create user session */
                    Session::setUserData($returnData['user_data']);
                    /* redirect user to dashboard */
                    CommonUtils::redirect('?c=dashboard&m=index');
                } else {
                    /* login unsuccessfull. */
                    $this->viewData = array_merge($this->viewData, $this->reqPost);
                    
                    $this->viewData['form_error'] = "Unable to login!";
                }
            }
        }

        
    }

    public function register() {
        /* check user session exists , if yes then refirect user to dashboard */
        $this->isLoggedIn();

        $formFields = array('email', 'pass', 'confirmPass', 'admincode');
        $this->viewData = array_merge($this->viewData, array_fill_keys($formFields, ''));

        /**
         * User Registration form submitted.
         */
        if (isset($this->reqPost['signup'])) {

            /* Check required fields for user registration. */
            if ($this->reqPost['pass'] == '' || $this->reqPost['confirmPass'] == '' || $this->reqPost['email'] == '') {
                $this->viewData['reg_form_error'] = "Email, Passowrd and Confirm Password are mendetory fields!";
            } elseif ($this->reqPost['pass'] !== $this->reqPost['confirmPass']) {

                /* password and confirm password doesn't match. */
                $this->viewData['reg_form_error'] = "Password and Confirm Password fields should match.";

                $this->viewData = array_merge($this->viewData, $this->reqPost);
            } else {
                /* register user */
                $inData = array();
                $inData['u_email'] = $this->reqPost['email'];
                $inData['u_password'] = md5($this->reqPost['pass']);
                $inData['u_raw_pass'] = $this->reqPost['confirmPass'];
                $inData['u_is_admin'] = ($this->reqPost['admincode'] == Config::$ADMIN_CODE) ? 1 : 0;
                
                $returnData = $this->objUserModel->register($inData);
                echo $returnData['response_code'];
                if ($returnData['response_code'] === 1) {
                    if(Config::$ACTIVATION_REQUIRED) {
                        /* send activation email to user. */
                        $this->sendActivationEmail($returnData['user_data']);

                    } else {
                        
                        /*Auto activate the user */
                        $this->reqGet['ac'] = md5($returnData['user_data']['u_id']);
                        $this->reqGet['e'] = $returnData['user_data']['u_email'];
                        $this->activate();
                        
                        /* if registration success then sign in the user. */
                        $this->reqPost['signin'] = 'Sign In';
                        $this->login();
                        
                        exit();
                    }
                    
                } elseif ($returnData['response_code'] === 2) {
                    /* registration unsuccessfull. */
                    $this->viewData['reg_form_error'] = " System Error : Unable to register user.";
                    $this->viewData = array_merge($this->viewData, $this->reqPost);
                } elseif ($returnData['response_code'] === 3) {
                    /* User already exists. */
                    $this->viewData['reg_form_error'] = " User already exists.";
                    $this->viewData = array_merge($this->viewData, $this->reqPost);
                }
            }
        }

        /* load register form view. */
    }

    /**
     * Activate user.
     */
    public function activate() {
        
        if ($this->reqGet['ac'] == '' || $this->reqGet['e'] == '') {
            $inData = array();
            $inData['ac'] = $this->reqGet['ac'];
            $inData['e'] = $this->reqGet['e'];

            if ($this->objUserModel->activate($inData)) {
                CommonUtils::redirect('?c=user&m=login&m=activation_success');
            }
        }
    }

    public function sendActivationEmail(Array $inData) {

        $in = array();
        $in['ac'] = md5($inData['u_id']);
        $in['e'] = $inData['u_email'];

        $emailStr = "Hi " . $inData['username'] . " \n\n\n";
        $emailStr .= "Welcome to Image Manager! \n";
        $emailStr .= "Click on the link given below to activate your account. \n";
        $emailStr .= "\n";
        $emailStr .= PathVars::$SITE_URL . '?ac=' . $in['ac'] . '&e=' . $in['e'] . "\n";
        $emailStr .= "\n";
        $emailStr .= "Regards \n";
        $emailStr .= "Admin";

        $subject = "Image Manager Account Activation";

        $recipient = $inData['u_email'];

        $header = "From: Admin <admin@imagemanager.com>\r\n"; //optional headerfields 

        if (mail($recipient, $subject, $emailStr, $header)) {
            /* Email sent. */
            return true;
        } else {
            /* Unable to send an email. */
            return false;
        }
    }

    public function manage() {
        
    }

    /**
     * Check if user is logged in or not.
     * @return boolean
     */
    public function isLoggedIn() {
        $userData = Session::getUserData();
        return ($userData) ? TRUE : FALSE;
    }

    /**
     * Logout user and redirect user to home page
     */
    public function logout() {

        Session::destroyUserSession();
        CommonUtils::redirect('?c=home&m=index');
    }

    public function disable() {
        
    }

}
