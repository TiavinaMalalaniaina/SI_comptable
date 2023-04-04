<?php
    defined('BASEPATH') OR exit('No direct script access allowed'); 

    class Utilisateur_model extends CI_Model{

        public function selectAll(){
            $result = array();
            $query = $this->db->query('SELECT * FROM utilisateur');
            foreach($query->result_array() as $row){
                $result[] = $row;
            }
            return $result;
        }

        public function save($name, $mdp){
            $sql = sprintf("INSERT INTO document values(null, %s, %s)", $this->db->escape($name), $this->db->escape($mdp));
            $this->db->query($sql);
        }

        public function login($name, $mdp) {
            $sql = "SELECT * FROM utilisateur WHERE nom=%s";
            $sql = sprintf($sql, $this->db->escape($name));
            $query = $this->db->query($sql);
            if ($row = $query->row_array()) {
                if (strcmp($mdp, $row['mdp']) == 0) {
                    return $row['id'];
                }
                throw new Exception("password", 1);
            }
            throw new Exception("name", 1); 
        }
        
    }
?>