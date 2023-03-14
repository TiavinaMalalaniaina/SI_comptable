<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
 
    class Compte_general_model extends CI_Model{
        public function selectByNumero($code){
            $sql = sprintf("SELECT * FROM plan_comptable where code = %s",$code);
            $query = $this->db->query($sql);
            $result = $query->row_array();
            return $result;
        }

        public function selectAll(){
            $result = array();
            $query = $this->db->query('SELECT * FROM plan_comptable ORDER BY code');
            foreach($query->result_array() as $row){
                $result[] = $row;
            }
            return $result;
        }

        public function insert($code, $intitule){
            $sql = sprintf("INSERT INTO plan_comptable values('%s', '%s')", $code, $intitule);
            $query = $this->db->query($sql);
        }

        public function update($code, $intitule, $id)
        {
            $sql = sprintf("UPDATE plan_comptable SET code='%s', intitule='%s' WHERE code='%s'", $code, $intitule, $id);
            $query = $this->db->query($sql);
        }

        public function delete($code)
        {
            $sql = sprintf("DELETE from plan_comptable where code='%s'", $code);
            $query = $this->db->query($sql);
        }
    }
?>