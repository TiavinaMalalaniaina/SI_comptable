<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Detail_company_model extends CI_Model{
        public function insert($nif, $num_statistique, $rcs, $devise, $debut_exercice, $fin_exercice){
            $sql = sprintf("INSERT INTO detail_company values( '%s', '%s', '%s', '%s', '%s', '%s')", $nif, $num_statistique, $rcs, $devise, $debut_exercice, $fin_exercice);
            $query = $this->db->query($sql);
        }

        
        public function select(){
            $result = array();
            $query = $this->db->query('SELECT * FROM detail_company LIMIT 1');
            return $query->row_array();
        }
    }
?>