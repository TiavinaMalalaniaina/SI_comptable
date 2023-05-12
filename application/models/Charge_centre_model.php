<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Charge_centre_model extends CI_Model{
        public function insert($idCharge, $idCentre, $date){
            $sql = sprintf("INSERT INTO charge_centre values(null, %d, %d, 0, '%s')", $idCharge, $idCentre, $date);
            $this->db->query($sql);
        }

        public function selectAll(){
            $result = array();
            $query = $this->db->query('SELECT * FROM charge_centre');
            foreach($query->result_array() as $row){
                $result[] = $row;
            }
            return $result;
        }

        public function selectById($id){
            $sql = sprintf('SELECT * FROM charge_centre WHERE id=%s', $this->db->escape($id));
            $query = $this->db->query($sql);
            return $query->row_array();
        }

        public function valide($id, $idCharge, $idCentre, $pourcentage, $date) {
            $sql_sum = sprintf("SELECT SUM(pourcentage) AS total FROM charge_centre WHERE id = %s", $id);
            $result = $this->db->query($sql_sum);
            $row = $result->fetch_assoc();
            $total = $row['total'];
            if ($total > 100) {
                throw new Exception("La somme des pourcentages pour cette charge ne peut pas dépasser 100%.");
            }

            $sql_insert = sprintf("INSERT INTO charge_centre VALUES (null, %s, %s, COALESCE(%s, 0), '%s')", $idCharge, $idCentre, $pourcentage, $date);
            $this->db->query($sql_insert);
        }
    }
?>