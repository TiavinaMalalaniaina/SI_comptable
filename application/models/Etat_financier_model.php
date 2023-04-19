<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Etat_financier_model extends CI_Model
{
    public function current_exercice(){
        $req = $this->db->query('select * from exercice where year(debut)=year(curdate())');
        $rs = $req->row_array();
        return $rs;
    }

    public function one($num,$dt){
        $req = $this->db->query("select * from compte_amort where id=".$num."");
        $con = $req->row_array();
        // echo "select coalesce(sum(debit)-sum(credit),0) as c from journal where code_journal in (".$con['cp'].")";
        $req = $this->db->query("select coalesce(sum(debit),0)-coalesce(sum(credit),0) as c from journal where compte in (".$con['cp'].") and date_journal<='".$dt."'");
        $val1 = $req->row_array();
        $req = $this->db->query("select coalesce(sum(debit),0)-coalesce(sum(credit),0) as c from journal where compte in (".$con['ca'].") and date_journal<='".$dt."'");
        $val2 = $req->row_array();
        $con['brut'] = $val1['c'];
        $con['ap'] = $val2['c'];
        $con['net'] = $con['brut'] - $con['ap'];
        return $con;
    }

    public function get_it($ids,$subids,$dt){
        $sum = [0,0,0];
        $rs = [];
        for ($i=0; $i < count($ids); $i++) { 
            $t1 = $this->one($ids[$i],$dt);
            $subs = [];
            for ($j=0; $j < count($subids[$i]); $j++) { 
                array_push($subs,$this->one($subids[$i][$j],$dt));
            }
            $t1['subs'] = $subs;
            $sum[0] += $t1['brut'];
            $sum[1] += $t1['ap']; 
            $sum[2] += $t1['net']; 
            array_push($rs,$t1);
        }
        return [$rs,$sum];
    }



// 
public function one2($num,$dt){
    $req = $this->db->query("select * from compte_amort where id=".$num."");
    $con = $req->row_array();
    // echo "select coalesce(sum(debit)-sum(credit),0) as c from journal where code_journal in (".$con['cp'].")";
    $req = $this->db->query("select coalesce(sum(credit),0)-coalesce(sum(debit),0) as c from journal where compte in (".$con['cp'].") and date_journal<='".$dt."'");
    $val1 = $req->row_array();
    $req = $this->db->query("select coalesce(sum(credit),0)-coalesce(sum(debit),0) as c from journal where compte in (".$con['ca'].") and date_journal<='".$dt."'");
    $val2 = $req->row_array();
    $con['brut'] = $val1['c'];
    $con['ap'] = $val2['c'];
    $con['net'] = $con['brut'] - $con['ap'];
    return $con;
}

public function get_it2($ids,$subids,$dt){
    $sum = [0,0,0];
    $rs = [];
    for ($i=0; $i < count($ids); $i++) { 
        $t1 = $this->one2($ids[$i],$dt);
        $subs = [];
        for ($j=0; $j < count($subids[$i]); $j++) { 
            array_push($subs,$this->one2($subids[$i][$j],$dt));
        }
        $t1['subs'] = $subs;
        $sum[0] += $t1['brut'];
        $sum[1] += $t1['ap']; 
        $sum[2] += $t1['net']; 
        array_push($rs,$t1);
    }
    return [$rs,$sum];
}
// 


    public function getSumByCodeCredit($code){
        $query = $this->db->query("select coalesce(sum(credit),0) somme from  journal  where compte like '$code%' ");
        $result = $query->row_array();
        return $result['somme'];
    }

    public function getSumByCodeDebit($code){
        $query = $this->db->query("select coalesce(sum(debit),0) somme from  journal  where compte like '$code%' ");
        $result = $query->row_array();
        return $result['somme'];
    }

    public function getSumByCode6162(){
        $query = $this->db->query("SELECT coalesce(sum(debit),0) AS somme FROM  journal  WHERE compte LIKE '61%' OR compte LIKE '62%' ");
        $result = $query->row_array();
        return $result['somme'];
    }

    public function do_do($table){
        $diff = 0;
        $rs = [];
        for ($i=0; $i < count($table); $i++) { 
            $req = $this->db->query("select * from compte_amort where con='".$table[$i]."'");
            // echo "select * from compte_amort where con='".$table[$i]."'";
            $con = $req->row_array();
            if ($table[$i] == '61/62') {
                $con['somme'] = $this->getSumByCode6162();
                $diff -= $con['somme'];
            }
            else if (str_starts_with($table[$i],'6')) {
                $con['somme'] = $this->getSumByCodeDebit($table[$i]);
                $diff -= $con['somme'];
            }
            else if (str_starts_with($table[$i],'7')) {
                $con['somme'] = $this->getSumByCodeCredit($table[$i]);
                $diff += $con['somme'];
            }
            array_push($rs,$con);
        }
        return [$rs,$diff];
    }
}
?>