<?php
    defined('BASEPATH') OR exit('No direct script access allowed'); 

    class Balance_model extends CI_Model{
        public function selectAll(){
            $result = array();
            $query = $this->db->query('SELECT * FROM balance');
            foreach($query->result_array() as $row){
                $result[] = $row;
            }
            return $result;
        }
    }
?>