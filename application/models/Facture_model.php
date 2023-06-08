<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Devise_equivalence_model extends CI_Model{

    public function current_date(){
        return date('Y-m-d');
    }

    public function next_numero(){
        $y = date('Y');
        $m = date('m');
        $result = $this->db->query("select coalesce(id,1) from facture order by id desc limit 1");
        $result = $result->row_array();
        $result = $result[0];
        $num = "";
        if ($result<10) {
            $num = "00".$result;
        }
        else if ($result>=10 and $result<100) {
            $num = "0".$result;
        }
        else {
            $num = "".$result;
        }
        return "DPX/".$m."/".$y."/".$num;
    }        

    public function calculate($avance,$tva,$nombre,$pu){
        $montant = [];
        $ht = 0;
        for ($i=0; $i < count($nombre); $i++) { 
            $montant[$i] = $nombre[$i]*$pu[$i];
            $ht += $montant[$i];
        }
        $ttc = $ht+($ht*$tva/100);
        $net = $ttc-$avance;
        return array(
            'ht'=>$ht,
            'montant'=>$montant,
            'ttc'=>$ttc,
            'net'=>$net
        );
    }

    public function insert_facture($data){
        $query = "INSERT INTO facture( numero, date_facture, objet, reference, montant_ht, montant_tva, monntant_ttc, montant_avance, net_payer ) VALUES ( '".$data['numero']."', '".$data['date']."', '".$data['obj']."', '".$data['ref']."', ".$data['ht'].", ".$data['tva'].", ".$data['ttc'].", ".$data['avance'].", ".$data['net'].")";
        $this->db->query($query);
        $result = $this->db->query("select coalesce(id,1) from facture order by id desc limit 1");
        $result = $result->row_array();
        $result = $result[0];
        $query = "INSERT INTO client_facture( nom, adresse, telephone, email, nom_responsable, id_facture ) VALUES ( '".$data['nom']."', '".$data['adresse']."', '".$data['tel']."', '".$data['mail']."', '".$data['nomresp']."', ".$result.")";
        $this->db->query($query);
        for ($i=0; $i < count($data['designation']); $i++) { 
            $query = "INSERT INTO liste_facture( designation, unite, nombre, prix_unitaire, montant, id_facture ) VALUES ( '".$data['designation'][$i]."', ".$data['unite'][$i].", ".$data['nombre'][$i].", ".$data['pu'][$i].", ".$data['montant'][$i].", ".$result.")";
            $po = array(
				'compte' => '70110',
				'debit' => 0,
				'credit' => $data['montant'][$i],
				'date_journal' => $data['date'],
				'reference_piece' => $data['numero'],
				'libelle' => $data['designation'][$i],
				'devise' => 1,
				'idexercice' => 1,
				'code_journal' => 4,
				'quantite' => $data['nombre'][$i],
				'idunite_oeuvre' => $data['unite'][$i],
				'prix_unite_oeuvre' => $data['pu'][$i]
			);
            $this->db->insert('journal',$po);
        }
    }

    public function list_facture(){
        $query = "select id,numero from facture";
        $result = $this->db->query($query);
        $result = $result->result_array();
        return $result;   
    }

    public function see_facture($id){
        $query = "select * from facture where id=".$id;
        $result = $this->db->query($query);
        $fac = $result->row_array();
        $query = "select * from client_facture where id_facture=".$id;
        $result = $this->db->query($query);
        $client = $result->row_array();
        $query = "select * from liste_facture where id=".$id;
        $result = $this->db->query($query);
        $liste = $result->result_array();
        return array(
            'facture'=>$fac,
            'client'=>$client,
            'liste'=>$liste
        );
    }

    public function uo_map($unite,$uo){
        $rs = array();
        for ($i=0; $i < count($unite); $i++) { 
            for ($j=0; $j < count($uo); $j++) { 
                if($uo[$j]['id']==$unite[$i]){
                    array_push($rs,$uo[$j]['nom']);
                }
            }
        }
        return $rs;
    }
}
?>