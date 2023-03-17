<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class CSV_model extends CI_Model
{
    public function current_exercice(){
        $req = $this->db->query('select id from exercice where year(debut)=year(curdate())');
        $rs = $req->row_array();
        return $rs['id'];
    }
    public function get_journal($code){
        $req = $this->db->query("select * from exercice where code='".$code."'");
        $rs = $req->row_array();
        return $rs;
    }
    public function get_journal_detail($exo,$code,$month){
        $req = "select * from journal where idexercice=".$exo." and code_journal='".$code."' and month(date_journal)=".$month." order by date_journal,id asc";
        $rs = $this->db->query($req);
        $data = [];
		$i=0;
		foreach ($rs->result_array() as $row) {
			$data[$i] = array(
				'debit'=>$row['debit'],
				'credit'=>$row['credit'],
				'date_journal'=>$row['date_journal'],
				'code_journal'=>$code,
				'numero_piece'=>$row['numero_piece'],
				'compte'=>$row['compte'],
				'libelle'=>$row['libelle'],
				'reference_piece'=>$row['reference_piece'],
				'idexercice'=>$exo,
				'devise'=>$row['devise']
			);
			$i++;
		}
		return $data;
    }
    public function load_to_modify($code_journal,$exo,$num_piece){
		$req = "select * from journal where idexercice=".$exo." and numero_piece='".$num_piece."'";
		$rs = $this->db->query($req);
		$data = [];
		$i=0;
		foreach ($rs->result_array() as $row) {
			$data[$i] = array(
				'debit'=>$row['debit'],
				'credit'=>$row['credit'],
				'date_journal'=>$row['date_journal'],
				'code_journal'=>$code_journal,
				'numero_piece'=>$num_piece,
				'compte'=>$row['compte'],
				'libelle'=>$row['libelle'],
				'reference_piece'=>$row['reference_piece'],
				'idexercice'=>$exo,
				'devise'=>$row['devise']
			);
			$i++;
		}
		return $data;
	}
}
?>