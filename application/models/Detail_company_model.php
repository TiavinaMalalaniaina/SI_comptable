<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Detail_company_model extends CI_Model{
        public function insert($idcompany, $nif, $num_statistique, $rcs, $devise, $debut_exercise){
            $sql = sprintf("INSERT INTO detail_company values('%s', '%s', '%s', '%s', '%s', '%s')", $idcompany, $nif, $num_statistique, $rcs, $devise, $debut_exercise);
            $query = $this->db->query($sql);
        }

        
        public function select(){
            $result = array();
            $query = $this->db->query('SELECT * FROM detail_company LIMIT 1');
            return $query->row_array();
        }
    }
?>