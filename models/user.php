<?php

/**
 * User model handles all the database interaction required for user management.
 *
 * @author vsingh
 */
class User extends BaseModel {

    private $table = 'im_users';
    private $fields = array('u_id', 'u_email', 'u_password', 'u_is_admin', 'u_is_active');

    public function __construct() {
        parent::__construct();
    }

    /**
     * User Registration
     * @param array $inData
     * @return int
     */
    public function register(Array $inData) {

        $responseData = array();

        if (isset($inData['u_email'])) {
            /* Check if user already exists. */
            $chkUser = array();
            $chkUser['where']['u_email'] = $inData['u_email'];
            $chkUser['limit'] = '1';

            if ($this->getUsers($chkUser)) {
                $responseData['response_code'] = 3; // User already exists 
            } else {

                /* generate unique id for the user */
                $inData['u_id'] = $this->generateUserId();

                if ($this->insertUser($inData)) {

                    $responseData['response_code'] = 1; // Registration Successfull
                    $responseData['user_data'] = $inData;
                } else {

                    $responseData['response_code'] = 2; // Unable to insert user
                }
            }
        } else {

            $responseData['response_code'] = 4; //Invalid data passed.
        }

        return $responseData;
    }

    /**
     * User Login
     * @param array $inData
     * @return int
     */
    public function login(Array $inData) {

        $responseData = array();

        if (isset($inData['u_email']) && isset($inData['u_email'])) {

            /* Check user details for login */
            $chkUser = array();
            $chkUser['where']['u_email'] = $inData['u_email'];
            $chkUser['where']['u_password'] = $inData['u_password'];
            $chkUser['where']['u_is_active'] = 1;
            $chkUser['limit'] = '1';

            $userDetails = $this->getUsers($chkUser);
            if ($userDetails) {

                $responseData['response_code'] = 1; // User details match 
                $responseData['user_data'] = $userDetails;
            } else {
                $responseData['response_code'] = 0; // Unable to insert user
            }
        } else {

            $responseData['response_code'] = 0; //Invalid data passed.
        }

        return $responseData;
    }
    
    /**
     * Activate user
     * @param array $inData
     * @return boolean
     */
    public function activate(Array $inData) {

        $chkUser = array();
        $chkUser['where']['u_email'] = $inData['e'];
        $chkUser['where']['u_is_active'] = '0';
        $chkUser['limit'] = '1';

        $userDetails = $this->getUsers($chkUser);
        if ($userDetails) {
            if (md5($userDetails['u_id']) == $inData['ac']) {
                $upUser = array();
                $upUser['where']['u_id'] = $userDetails['u_id'];
                $upUser['fields']['u_is_active'] = '1';
                $upUser['limit'] = '1';

                if($this->updateUser($upUser)) {
                    return true; /* User activated */
                } else {
                    /* Unable to update user details. */
                }
                
            } else {
                /* Invalid activation code. */
            }
        } else {
            /* User not found. */
        }
        
        return false;
    }

    /**
     * Update user details in the users table.
     * @param array $inData
     * @return type
     */
    public function updateUser(Array $inData) {

        $sql = " UPDATE " . $this->table . " SET ";

        $updateFields = array();

        foreach ($inData['fields'] as $key => $value) {
            $updateFields[] = $key . " = '" . $value . "' ";
        }

        $sql .= implode(", ", $updateFields);

        if (isset($inData['where']) && !empty($inData['where'])) {
            $sql .=' WHERE 1 ';

            if (isset($inData['where']['u_email'])) {
                $sql .=' AND u_email = \'' . $inData['where']['u_email']."' ";
            }

            if (isset($inData['where']['u_id'])) {
                $sql .=' AND u_id = \'' . $inData['where']['u_id']."' ";
            }

            if (isset($inData['where']['u_is_admin'])) {
                $sql .=' AND u_is_admin = \'' . $inData['where']['u_is_admin']."' ";
            }
        }
        if (isset($inData['limit'])) {

            $sql .= ' LIMIT ' . $inData['limit'];
        } else {

            $sql .= " LIMIT 1 ";
        }

        $res = $this->db->query($sql);

        return ($res) ? TRUE : FALSE;
    }

    /**
     * Insert User details in the user table.
     * @param array $inData
     * @return type
     */
    public function insertUser(Array $inData) {

        $validFields = array_intersect_key($inData, array_fill_keys($this->fields, ""));
        
        $sql = "INSERT INTO " . $this->table . " ( " . implode(',', array_keys($validFields)) . " ) VALUES ";

        $sql .= '( \'' . implode('\', \'', $validFields) . '\')';

        $res = $this->db->query($sql);

        return ($res) ? TRUE : FALSE;
    }

    /**
     * Fetch the user details from the database users table.
     * $inData['where'] - Associative array of where clause.
     * $inData['limit'] - Number of records to be fetched.
     * 
     * @param array $inData
     * @return mixed data / boolean false
     */
    public function getUsers(Array $inData) {

        $sql = 'SELECT * FROM ' . $this->table;

        if (isset($inData['where']) && !empty($inData['where'])) {
            $sql .=' WHERE 1 ';

            if (isset($inData['where']['u_email'])) {
                $sql .=' AND u_email = \'' . $inData['where']['u_email']."' ";
            }

            if (isset($inData['where']['u_password'])) {
                $sql .=' AND u_password = \'' . $inData['where']['u_password']."' ";
            }

            if (isset($inData['where']['u_id'])) {
                $sql .=' AND u_id = \'' . $inData['where']['u_id']."' ";
            }

            if (isset($inData['where']['u_is_admin'])) {
                $sql .=' AND u_is_admin = \'' . $inData['where']['u_is_admin']."' ";
            }
            
            if (isset($inData['where']['u_is_active'])) {
                $sql .=' AND u_is_active = \'' . $inData['where']['u_is_active']."' ";
            }
        }
        if (isset($inData['limit'])) {
            $sql .= ' LIMIT ' . $inData['limit'];
        }

        $outData = array();
        
        CommonUtils::debug($sql);
        if($res = $this->db->query($sql)) {
            /* fetch associative array */
            while ($row = $res->fetch_assoc()) {
                $outData[] = $row;
            }
            if (!empty($outData)) {
                if (isset($inData['limit']) && $inData['limit'] == 1) {
                    return $outData[0];
                }
                return $outData;
            }
        }
        
        return false;
    }

    private function generateUserId() {
        return strtotime(date('Y-m-d h:i:s')) . str_replace(".", "", $_SERVER['REMOTE_ADDR']);
    }

}

?>
