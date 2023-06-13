<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Facture_model extends CI_Model{

    public function current_date(){
        return date('Y-m-d');
    }

    public function next_numero(){
        $y = date('Y');
        $m = date('m');
        $result = $this->db->query("select count(id_facture) as p from facture where month(date_facture)=".$m." and year(date_facture)=".$m);
        $result = $result->row_array();
        $result = $result['p']+1;
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
        // echo $query;
        $this->db->query($query);
        $result = $this->db->query("select id_facture as p  from facture order by id_facture desc limit 1");
        $result = $result->row_array();
        $result = $result['p'];
        $query = "INSERT INTO client_facture( nom, adresse, telephone, email, nom_responsable, id_facture ) VALUES ( '".$data['nom']."', '".$data['adresse']."', '".$data['tel']."', '".$data['mail']."', '".$data['nomresp']."', ".$result.")";
        $this->db->query($query);
        for ($i=0; $i < count($data['designation']); $i++) { 
            $query = "INSERT INTO liste_facture( designation, idunite, nombre, prix_unitaire, montant, id_facture ) VALUES ( '".$data['designation'][$i]."', ".$data['unite'][$i].", ".$data['nombre'][$i].", ".$data['pu'][$i].", ".$data['montant'][$i].", ".$result.")";
            // echo $query;
            $this->db->query($query);
            $po = array(
				'compte' => '70110',
				'debit' => 0,
				'credit' => $data['montant'][$i],
				'date_journal' => $data['date'],
				'reference_piece' => $data['numero'],
				'libelle' => $data['designation'][$i],
				'devise' => 'AR',
				'idexercice' => 1,
				'code_journal' => 'VE',
				'quantite' => $data['nombre'][$i],
				'idunite_oeuvre' => $data['unite'][$i],
				'prix_unite_oeuvre' => $data['pu'][$i]
			);
            $this->db->insert('journal',$po);
            $po = array(
				'compte' => '44570',
				'debit' => 0,
				'credit' => $data['montant'][$i]*$data['tva']/100,
				'date_journal' => $data['date'],
				'reference_piece' => $data['numero'],
				'libelle' => $data['designation'][$i],
				'devise' => 'AR',
				'idexercice' => 1,
				'code_journal' => 'VE',
				'quantite' => $data['nombre'][$i],
				'idunite_oeuvre' => $data['unite'][$i],
				'prix_unite_oeuvre' => $data['pu'][$i]
			);
            $this->db->insert('journal',$po);
            $po = array(
				'compte' => '41110',
				'credit' => 0,
				'debit' => ($data['montant'][$i]*$data['tva']/100)+$data['montant'][$i],
				'date_journal' => $data['date'],
				'reference_piece' => $data['numero'],
				'libelle' => $data['designation'][$i],
				'devise' => 'AR',
				'idexercice' => 1,
				'code_journal' => 'VE',
				'quantite' => $data['nombre'][$i],
				'idunite_oeuvre' => $data['unite'][$i],
				'prix_unite_oeuvre' => $data['pu'][$i]
			);
            $this->db->insert('journal',$po);
        }
    }

    public function list_facture(){
        $query = "select id_facture,numero from facture";
        $result = $this->db->query($query);
        $result = $result->result_array();
        return $result;   
    }

    public function see_facture($id){
        $query = "select * from facture where id_facture=".$id;
        $result = $this->db->query($query);
        $fac = $result->row_array();
        $query = "select * from client_facture where id_facture=".$id;
        $result = $this->db->query($query);
        $client = $result->row_array();
        $query = "select * from liste_facture join unite_oeuvre on liste_facture.idunite=unite_oeuvre.id where liste_facture.id_facture=".$id;
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

    public function export_facture($pdf,$facture){
        $pdf->AddPage();

        $pdf->Heade($facture['facture']['date_facture'],$facture['facture']['numero']);

        $pdf->ClientInfo($facture['client']);

        
        $pdf->InformationsFacture($facture['facture']['objet'], $facture['facture']['reference']);

        $header = array('Designation', 'Unite', 'Prix unitaire','Nombre', 'Montant');

        $pdf->TableauProduits($header, $facture['liste']);

        $pdf->TableauTotaux($facture['facture']);
 
        $montantEnLettre = (new NumberFormatter("fr",NumberFormatter::SPELLOUT))->format($facture['facture']['monntant_ttc']);
        $pdf->SommeEnLettre($montantEnLettre);

    }
}
?>