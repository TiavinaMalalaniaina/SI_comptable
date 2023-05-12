<?php
    defined('BASEPATH') OR exit('No direct script access allowed'); 

    class Seuil_model extends CI_Model{

        public function all($debut,$fin,$charges){
            $ca = 0;
            $cv = 0;
            $cf = 0;
            $query = $this->db->query("select coalesce(sum(credit),0) as s from journal where date_journal<='".$debut."' and date_journal>='".$fin."' and compte like '70%'");
            $rs = $query->row_array();
            $ca = $rs['s'];
            for ($i=0; $i < count($charges) ; $i++) { 
                if($charges[$i]['nature']=='fixe'){
                    $cf += $charges[$i]['somme'];
                }
                else if($charges[$i]['nature']=='variable'){
                    $cv += $charges[$i]['somme'];
                }
            }
            if($ca == 0){
                $ca = 1;
            }
            $mg = $ca - ($cv+$cf);
            $mcv = $ca - $cv;
            $mcf = $ca - $cf;
            $tmcv = $mcv/$ca;
            $seuil = $ca/$tmcv;
            return array(
                'ca'=>$ca,
                'cv'=>$cv,
                'cf'=>$cf,
                'mg'=>$mg,
                'mcv'=>$mcv,
                'mcf'=>$mcf,
                'seuil'=>$seuil
            );
        }
        public function charges(){
            $result = array();
            $query = $this->db->query("select charge.id,charge.code,charge.nom,nature.nom as nature,unite_oeuvre.nom as unite_oeuvre from charge join nature join unite_oeuvre on charge.idnature=nature.id and charge.idunite_oeuvre=unite_oeuvre.id order by charge.id");
            foreach($query->result_array() as $row){
                $result[] = $row;
            }
            return $result;
        }
        public function somme_charges($charges,$debut,$fin){
            for ($i=0; $i < count($charges); $i++) { 
                $query = "select coalesce(sum(debit),0) as s from journal where compte='".$charges[$i]['code']."' and date_journal<='".$debut."' and date_journal>='".$fin."' ";
                if (strlen($charges[$i]['code'])<5) {
                    $query = "select coalesce(sum(debit),0) as s  from journal where compte like '".$charges[$i]['code']."%' and date_journal<='".$debut."' and date_journal>='".$fin."' ";
                }
                else if (strlen($charges[$i]['code'])>5) {
                    $sp = explode('-',$charges[$i]['code']);
                    $a = "(";
                    for ($j=0; $j < count($sp)-1; $j++) { 
                        $a .= "'".$sp[$j]."',";
                    }
                    $a .= "'".$sp[count($sp)-1]."')";
                    $query = "select coalesce(sum(debit),0) as s from journal where compte in ".$a." and date_journal<='".$debut."' and date_journal>='".$fin."' ";
                }
                // echo $query;
                $query = $this->db->query($query);
                $rs =  $query->row_array();
                $charges[$i]['somme'] = $rs['s'];
            }
            return $charges;
        }
        
    }
?>