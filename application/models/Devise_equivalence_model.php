<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Devise_equivalence_model extends CI_Model{
        public function insert($devise1, $devise2, $parite, $date_parite){
            $sql = sprintf("INSERT INTO devise_equivalence values(null, '%s', '%s', '%s', '%s')", $devise1, $devise2, $parite, $date_parite);
            $query = $this->db->query($sql);
        }

        
        public function selectByCode($code){
            $sql = sprintf("SELECT * FROM devise_equivalence where devise2 = '%s'", $code);
            $query = $this->db->query($sql);
            $result = $query->row_array();
            return $result;
        }

        public function selectAll(){
            $result = array();
            $query = $this->db->query('SELECT * FROM devise_equivalence');
            foreach($query->result_array() as $row){
                $result[] = $row;
            }
            return $result;
        }

        public function convertion_compte_devise($argent, $code) {
            $devise = $this->selectByCode($code);
            $devise1 = $devise['devise1'];
            $devise2 = $devise['devise2'];
            $argent1 = $argent;
            $argent2 = $argent / $devise['parite'];
            $result = array(
                'devise1' => $devise1,
                'devise2' => $devise2,
                'argent1' => $argent1,
                'argent2' => $argent2,
            );
            return $result;
        }

        public function convertion_devise_compte($argent, $code) {
            $devise = $this->selectByCode($code);
            $devise1 = $devise['devise2'];
            $devise2 = $devise['devise1'];
            $argent1 = $argent;
            $argent2 = $argent * $devise['parite'];
            $result = array(
                'devise1' => $devise1,
                'devise2' => $devise2,
                'argent1' => $argent1,
                'argent2' => $argent2,
            );
            return $result;
        }
    }
?>