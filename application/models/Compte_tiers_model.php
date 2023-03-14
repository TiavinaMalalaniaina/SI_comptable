<?php
    defined('BASEPATH') OR exit('No direct script access allowed'); 

    class Compte_tiers_model extends CI_Model{
        public function selectByNumero($code){
            $sql = sprintf("SELECT * FROM plan_tiers where code = %s",$code);
            $query = $this->db->query($sql);
            $result = $query->row_array();
            return $result;
        }

        public function selectAll(){
            $result = array();
            $query = $this->db->query('SELECT * FROM plan_tiers');
            foreach($query->result_array() as $row){
                $result[] = $row;
            }
            return $result;
        }

        public function insert($code, $intitule, $type){
            $sql = sprintf("INSERT INTO plan_tiers values('%s', '%s', %s)", $code, $intitule, $type);
            $query = $this->db->query($sql);
        }

        public function update($code, $intitule, $type, $id)
        {
            $sql = sprintf("UPDATE plan_tiers SET code='%s', intitule='%s', type_tiers=%s where code='%s'", $code, $intitule,$type, $id);
            $query = $this->db->query($sql);
        }

        public function delete($code)
        {
            $sql = sprintf("DELETE from plan_tiers where code='%s'", $code);
            $query = $this->db->query($sql);
        }
    }
?>