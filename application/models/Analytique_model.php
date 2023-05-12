<?php
defined('BASEPATH') OR exit('No direct script access allowed'); 
class Analytique_model extends CI_Model{
    public function products($date){
        $result = array();
        $query = $this->db->query("SELECT * FROM produit where dat<='".$date."' order by id");
        foreach($query->result_array() as $row){
            $result[] = $row;
        }
        return $result;
    }
    public function charges(){
        $result = array();
        $query = $this->db->query("select charge.id,charge.code,charge.nom,nature.nom as nature,unite_oeuvre.nom as unite_oeuvre from charge join nature join unite_oeuvre on charge.idnature=nature.id and charge.idunite_oeuvre=unite_oeuvre.id order by charge.id");
        foreach($query->result_array() as $row){
            $result[] = $row;
        }
        return $result;
    }
    public function somme_charges($charges,$date){
        for ($i=0; $i < count($charges); $i++) { 
            $query = "select coalesce(sum(debit),0) as s from journal where compte='".$charges[$i]['code']."' and date_journal='".$date."'";
            if (strlen($charges[$i]['code'])<5) {
                $query = "select coalesce(sum(debit),0) as s  from journal where compte like '".$charges[$i]['code']."%' and date_journal='".$date."'";
            }
            else if (strlen($charges[$i]['code'])>5) {
                $sp = explode('-',$charges[$i]['code']);
                $a = "(";
                for ($j=0; $j < count($sp)-1; $j++) { 
                    $a .= "'".$sp[$j]."',";
                }
                $a .= "'".$sp[count($sp)-1]."')";
                $query = "select coalesce(sum(debit),0) as s from journal where compte in ".$a." and date_journal='".$date."'";
            }
            // echo $query;
            $query = $this->db->query($query);
            $rs =  $query->row_array();
            $charges[$i]['somme'] = $rs['s'];
        }
        return $charges;
    }
    public function charges_produit($charges,$produit,$dat){
        for ($i=0; $i < count($charges) ; $i++) { 
            $query = $this->db->query("select * from charge_produit where idcharge='".$charges[$i]['id']."' and idproduit='".$produit['id']."' and dat<='".$dat."' order by dat desc limit 1");
            $rs = $query->row_array();
            $charges[$i]['somme'] = ($charges[$i]['somme'] * $rs['pourcentage'])/100;
        }
        return $charges;
    } 
    public function centres($dat){
        $result = array();
        $query = $this->db->query("SELECT * FROM centre where dat <= '".$dat."'");
        foreach($query->result_array() as $row){
            $result[] = $row;
        }
        return $result;      
    } 
    public function charges_centres($charges,$centres,$dat){
        for ($i=0; $i < count($charges); $i++) { 
            for ($j=0; $j < count($centres); $j++) {
                if(!isset($centres[$j]['fixe'])){
                    $centres[$j]['fixe'] = 0;
                    $centres[$j]['variable'] = 0;
                }
                $query = $this->db->query("select * from charge_centre where idcharge='".$charges[$i]['id']."' and idcentre='".$centres[$j]['id']."' and dat<='".$dat."' order by dat desc limit 1");
                $rs = $query->row_array();
                $fv = array(
                    'p'=>$rs['pourcentage'],
                    'fixe'=>0,
                    'variable'=>0
                );
                if($charges[$i]['nature']=='fixe'){
                    $fv['fixe'] = ($charges[$i]['somme'] * $rs['pourcentage'])/100;
                }
                else if($charges[$i]['nature']=='variable'){
                    $fv['variable'] = ($charges[$i]['somme'] * $rs['pourcentage'])/100;
                }
                $centres[$j]['charges'][$i] = $fv;
                $centres[$j]['fixe'] += $fv['fixe'];
                $centres[$j]['variable'] += $fv['variable'];
            }
        }
        return $centres;
    }
    public function total($charges,$centres){
        $total['charges'] = array();
        $total['fixe'] = 0;
        $total['variable'] = 0;
        $total['somme'] = 0;
        for ($i=0; $i < count($charges); $i++) { 
            $fv = array(
                'fixe'=>0,
                'variable'=>0
            ); 
            for ($j=0; $j < count($centres); $j++) { 
                $fv['fixe'] += $centres[$j]['charges'][$i]['fixe']; 
                $fv['variable'] += $centres[$j]['charges'][$i]['variable']; 
            }
            array_push($total['charges'],$fv);
            $total['fixe'] += $fv['fixe'];
            $total['variable'] += $fv['variable'];
            $total['somme'] += $charges[$i]['somme'];
        }
        return $total;
    }
}
?>