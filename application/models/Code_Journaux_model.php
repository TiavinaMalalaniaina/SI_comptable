<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
 
    class Code_Journaux_model extends CI_Model{
        public function insert($code, $intitule){
            $sql = sprintf("INSERT INTO code_journaux values('%s', '%s')", $code, $intitule);
            $query = $this->db->query($sql);
        }

        public function selectByCode($code){
            $sql = sprintf("SELECT * FROM code_journaux where code = %s",$code);
            $query = $this->db->query($sql);
            $result = $query->row_array();
            return $result;
        }

        public function selectAll(){
            $result = array();
            $query = $this->db->query('SELECT * FROM code_journaux');
            foreach($query->result_array() as $row){
                $result[] = $row;
            }
            return $result;
        }

        public function update($code, $intitule, $id)
        {
            $sql = sprintf("UPDATE code_journaux SET code='%s', intitule='%s' where code='%s'", $code, $intitule, $id);
            $query = $this->db->query($sql);
        }

        public function delete($code)
        {
            $sql = sprintf("DELETE from code_journaux where code='%s'", $code);
            $query = $this->db->query($sql);
        }
    }
?>