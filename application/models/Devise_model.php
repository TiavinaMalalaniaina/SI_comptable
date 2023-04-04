<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Devise_model extends CI_Model{

        public function selectAll(){
            $result = array();
            $query = $this->db->query('SELECT * FROM devise');
            foreach($query->result_array() as $row){
                $result[] = $row;
            }
            return $result;
        }

        public function save($code, $name) {
            $sql = "INSERT INTO devise (code, name) VALUES (%s, %s)";
            $sql = sprintf($sql, $this->db->escape($code), $this->db->escape($name));
            $this->db->query($sql);
        } 

    }
?>