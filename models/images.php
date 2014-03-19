<?php

/**
 * User model handles all the database interaction required for user management.
 *
 * @author vsingh
 */
class Images extends BaseModel {

    private $table = 'im_images';
    private $fields = array('i_id', 'i_title', 'i_name', 'i_u_id', 'i_datetime');

    public function __construct() {
        parent::__construct();
    }

    /**
     * Update image details in the images table.
     * @param array $inData
     * @return type
     */
    public function updateImage(Array $inData) {

        $sql = " UPDATE " . $this->table . " SET ";

        $updateFields = array();

        foreach ($inData['fields'] as $key => $value) {
            $updateFields[] = $key . " = ' " . $value . "' ";
        }

        $sql .= implode(", ", $updateFields);

        if (isset($inData['where']) && !empty($inData['where'])) {
            $sql .=' WHERE 1 ';

            if (isset($inData['where']['i_id'])) {
                $sql .=' AND i_id = \'' . $inData['where']['u_email']."' ";
            }

            if (isset($inData['where']['i_title'])) {
                $sql .=' AND i_title = \'' . $inData['where']['i_title']."' ";
            }

            if (isset($inData['where']['i_u_id'])) {
                $sql .=' AND i_u_id = \'' . $inData['where']['i_u_id']."' ";
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
     * Insert Image details in the image table.
     * @param array $inData
     * @return type
     */
    public function insertImage(Array $inData) {

        $validFields = array_intersect_key($inData, array_fill_keys($this->fields, ""));
        
        $sql = "INSERT INTO " . $this->table . " ( " . implode(',', array_keys($validFields)) . " ) VALUES ";

        $sql .= '( \'' . implode('\', \'', $validFields) . '\')';

        $res = $this->db->query($sql);
        
        $response = array();
        $response['status'] =  ($res) ? TRUE : FALSE;
        $response['i_id'] = $this->db->insert_id;
        
        return $response;
    }

    /**
     * Fetch the image details from the database images table.
     * $inData['where'] - Associative array of where clause.
     * $inData['limit'] - Number of records to be fetched.
     * 
     * @param array $inData
     * @return mixed data / boolean false
     */
    public function getImages(Array $inData) {

        $sql = 'SELECT * FROM ' . $this->table;

        if (isset($inData['where']) && !empty($inData['where'])) {
            $sql .=' WHERE 1 ';

            if (isset($inData['where']['i_id'])) {
                $sql .=' AND i_id = \'' . $inData['where']['i_id']."' ";
            }

            if (isset($inData['where']['i_u_id'])) {
                $sql .=' AND i_u_id = \'' . $inData['where']['i_u_id']."' ";
            }

        }
        if (isset($inData['orderby'])) {
            $sql .= ' Order by ' . $inData['orderby'];
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
    
    /**
     * Delete the images from the datadase table.
     * @param array $inData
     * @return boolean
     */
    public function deleteImages(Array $inData) {

        if (isset($inData['where']) && !empty($inData['where'])) {
            $sql = 'DELETE FROM ' . $this->table;
            
            $sql .=' WHERE 1 ';

            if (isset($inData['where']['i_id'])) {
                $sql .=' AND i_id = \'' . $inData['where']['i_id']."' ";
            }

            if (isset($inData['where']['i_u_id'])) {
                $sql .=' AND i_u_id = \'' . $inData['where']['i_u_id']."' ";
            }
            
            if (isset($inData['limit'])) {
                $sql .= ' LIMIT ' . $inData['limit'];
            }
        } else {
            /* Where clause should be there to delete images. */
        }
        

        $outData = array();
        
        CommonUtils::debug($sql);
        if($sql) {
            
            if($res = $this->db->query($sql)) {
                return true;
            }
        }
        
        
        return false;
    }

}

?>
