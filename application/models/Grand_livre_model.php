<?php
    defined('BASEPATH') OR exit('No direct script access allowed'); 

    class Grand_livre_model extends CI_Model{
        public function selectByCompte($compte){
            $d = 0;
            $c = 0;
            $result = array();
            $sql = sprintf("SELECT * FROM grand_livre where compte = '%s'",$compte);
            $query = $this->db->query($sql);
            $i = 0;
            $result = [];
            foreach($query->result_array() as $row){
                $result[$i] = $row;
                $d += $result[$i]['debit'];
                $c += $result[$i]['credit'];
                $i++;
            }
            $rs = $d - $c;
            $solde = '';
            if($rs>0){
                $solde = 'debiteur';
            }
            else if($rs < 0){
                $solde  = 'crediteur';
                $rs = $rs*-1;
            }
            $f = [$rs,$solde,$result];
            return $f;
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