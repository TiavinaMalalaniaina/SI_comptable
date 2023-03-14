<?php
    defined('BASEPATH') OR exit('No direct script access allowed'); 

    class Type_tiers_model extends CI_Model{

        public function selectAll(){
            $result = array();
            $query = $this->db->query('SELECT * FROM type_tiers');
            foreach($query->result_array() as $row){
                $result[] = $row;
            }
            return $result;
        }
        
    }
?>