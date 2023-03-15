<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Company_model extends CI_Model{
        public function insert($name, $leader, $address_social, $address_exploitation, $tel, $telecopie, $objet, $logo){
            $sql = sprintf("INSERT INTO company(id, name, leader, address_social, address_exploitation, tel, telecopie, objet, logo) values(null,%s, %s, %s, %s, %s, %s, %s, %s)", $this->db->escape($name), $this->db->escape($leader), $this->db->escape($address_social), $this->db->escape($address_exploitation), $this->db->escape($tel), $this->db->escape($telecopie), $this->db->escape($objet), $this->db->escape($logo));
            $query = $this->db->query($sql);
        }

        public function selectAll(){
            $result = array();
            $query = $this->db->query('SELECT * FROM company');
            foreach($query->result_array() as $row){
                $result[] = $row;
            }
            return $result;
        }

        public function select(){
            $result = array();
            $query = $this->db->query('SELECT * FROM company LIMIT 1');
            return $query->row_array();
        }
    }
?>