<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Charge_produit_model extends CI_Model{
        

        public function selectAll(){
            $result = array();
            $query = $this->db->query('SELECT * FROM charge_produit');
            foreach($query->result_array() as $row){
                $result[] = $row;
            }
            return $result;
        }

        public function selectById($id){
            $sql = sprintf('SELECT * FROM charge_produit WHERE id=%s', $this->db->escape($id));
            $query = $this->db->query($sql);
            return $query->row_array();
        }

        public function valide($id, $idCharge, $idProduit, $pourcentage, $date) {
            $sql_sum = sprintf("SELECT SUM(pourcentage) AS total FROM charge_produit WHERE id = %s", $id);
            $result = $this->db->query($sql_sum);
            $row = $result->fetch_assoc();
            $total = $row['total'];
            if ($total > 100) {
                throw new Exception("La somme des pourcentages pour cette charge ne peut pas dépasser 100%.");
            }

            $sql_insert = sprintf("INSERT INTO charge_produit VALUES (null, %s, %s, COALESCE(%s, 0), '%s')", $idCharge, $idProduit, $pourcentage, $date);
            $this->db->query($sql_insert);
        }

        public function insert($idCharge, $idProduit, $date){
            $sql = sprintf("INSERT INTO charge_produit values(null, %d, %d, 0, '%s')", $idCharge, $idProduit, $date);
            $this->db->query($sql);
        }
        public function getP(){
            
        }
    }
?>