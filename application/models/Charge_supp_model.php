<?php
    defined('BASEPATH') OR exit('No direct script access allowed'); 

class Charge_supp_model extends CI_Model{
    public function liste(){
        $liste = ['remuneration des capitaux propres','remuneration du travail de l exploitant'];
        return $liste;
    }    
    public function supp_at($date){
        $result = array();
        $query = $this->db->query("select nom,coalesce(sum(valeur),0) as s from charges_suppletives where dat='".$date."' group by nom");
        foreach($query->result_array() as $row){
            $result[] = $row;
        }
        return $result;
    }
}
?>