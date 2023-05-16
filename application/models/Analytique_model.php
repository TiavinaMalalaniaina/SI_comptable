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
        $query = $this->db->query("SELECT centre.id,centre.nom,centre.dat,type_centre.id as id_type_centre,type_centre.nom as nom_type_centre FROM centre join type_centre on centre.id_type_centre = type_centre.id where dat <= '".$dat."'");
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

    public function affect_struct_to_operationnal($centres){
        $centrestruct = [];
        $centresop = [];
        for ($i=0; $i < count($centres); $i++) {
            $centres[$i]['total'] = $centres[$i]['fixe'] + $centres[$i]['variable'];  
            if($centres[$i]['nom_type_centre']=='de structures'){
                array_push($centrestruct,$centres[$i]);
            }
            else if($centres[$i]['nom_type_centre']=='operationnel'){
                array_push($centresop,$centres[$i]);
            }
        }
        $total_op = 0;
        for ($i=0; $i < count($centresop); $i++) { 
            $total_op += $centresop[$i]['total'];
        }
        for ($i=0; $i < count($centresop); $i++) { 
            $centresop[$i]['cles'] = $centres[$i]['total']/$total_op;
        }
        for ($i=0; $i < count($centresop); $i++) { 
            $centresop[$i]['cout_total'] = $centresop[$i]['total'];
            for ($j=0; $j < count($centrestruct); $j++) { 
                $centrestruct[$j]['affectation'][$i] = $centresop[$i]['cles']*$centrestruct[$j]['total'];
                $centresop[$i]['cout_total'] += $centrestruct[$j]['affectation'][$i];
            }
        }
        for ($i=0; $i < count($centrestruct); $i++) { 
            $centrestruct[$i]['rep_total'] = 0;
            for ($j=0; $j < count($centresop); $j++) { 
                $centrestruct[$i]['rep_total'] += $centrestruct[$i]['affectation'][$j];
            }
        }
        $centresop_ct = 0;
        for ($i=0; $i < count($centresop); $i++) { 
            $centresop_ct += $centresop[$i]['cout_total'];
        }
        return [$centresop,$centrestruct,$centresop_ct];
    }

    public function prix($centresop_ct,$produit,$daty){
        $query = "select sum(quantite),prix from production where dat='".$daty."' and idproduit=".$produit['id']."";
        $query = $this->db->query($query);
        $rs =  $query->row_array();
        $rs['pv'] = $centresop_ct/$rs['sum'];
        return $rs;
    }

    public function seuil($prix,$total,$qtt){
        $supp = $total['variable']/$qtt;
        $seuil = $total['fixe']/($prix-$supp);
        return $seuil;
    }

    public function charges_produits($charges,$produits,$dat){
        for ($i=0; $i < count($charges) ; $i++) { 
            for ($j=0; $j < count($produits); $j++) { 
                $query = $this->db->query("select * from charge_produit where idcharge='".$charges[$i]['id']."' and idproduit='".$produits[$j]['id']."' and dat<='".$dat."' order by dat desc limit 1");
                $rs = $query->row_array();
                $charges[$i]['somme_p'][$j] = ($charges[$i]['somme'] * $rs['pourcentage'])/100;
            }
        }
        return $charges;
    } 

    public function pourcentage_centre($charges,$centre,$dat){
        for ($i=0; $i < count($charges); $i++) { 
            $query = $this->db->query("select * from charge_centre where idcharge='".$charges[$i]['id']."' and idcentre='".$centre['id']."' and dat<='".$dat."' order by dat desc limit 1");
            $rs = $query->row_array();
            $charges[$i]['pour_p'] = $rs['pourcentage'];  
        }
    }

    public function product_part($charges,$produits){
        for ($i=0; $i < count($charges) ; $i++) { 
            for ($j=0; $j < count($produits); $j++) { 
                $charges[$i]['part_p'][$j] = ($charges[$i]['somme_p'][$j]*$charges[$i]['pour_p'] )/100;
            }
        }
        return $charges;
    }
    
}
?>