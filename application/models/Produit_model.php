<?php
    defined('BASEPATH') OR exit('No direct script access allowed'); 

    class Produit_model extends CI_Model{
        public function getLast(){
            $query = $this->db->query("select * from produit order by id desc limit 1");
            $rs = $query->row_array();
            return $rs;
        }
        public function getList(){
            $req = "select * from produit order by id";
            $rs = $this->db->query($req);
            $data = [];
            $i=0;
            foreach ($rs->result_array() as $row) {
                $data[$i] = $row;
                $i++;
            }
            return $data;
        }
        public function setup($charges,$produits){
            $query = $this->db->query("select pourcentage from charge_produit where idcharge=".$charges['id']." and idproduit=".$produits['id']." order by dat desc limit 1");
            $rs = $query->row_array();
            return $rs['pourcentage'];
        }
    }
?>