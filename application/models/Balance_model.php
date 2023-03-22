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

        public function getTotal($balance) {
            $total = array(
                'debit' => 0,
                'credit' => 0,
                'soldedebit' => 0,
                'soldecredit' => 0 
            );

            foreach ($balance as $b) {
                $total['debit'] += $b['debit'];
                $total['credit'] += $b['credit'];
            }
            $solde = $total['debit'] - $total['credit'];
            if ($solde > 0) {
                $total['soldedebit'] = $solde;
                $total['soldecredit'] = 0;
            } else {
                $total['soldedebit'] = 0;
                $total['soldecredit'] = -$solde;
            }
            return $total;
        }
    }
?>