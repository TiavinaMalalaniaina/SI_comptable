<?php
    defined('BASEPATH') OR exit('No direct script access allowed'); 

    class Grand_livre_model extends CI_Model{
        public function selectByCompte($compte){
            $result = array();
            $sql = sprintf("SELECT * FROM grand_livre where compte = '%s'",$compte);
            $query = $this->db->query($sql);
            foreach($query->result_array() as $row){
                $result[] = $row;
            }
            return $result;
        }

        public function selectAll(){
            $result = array();
            $query = $this->db->query('SELECT * FROM grand_livre');
            foreach($query->result_array() as $row){
                $result[] = $row;
            }
            return $result;
        }
    }
?>