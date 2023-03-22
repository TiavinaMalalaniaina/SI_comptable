<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Journal_model extends CI_Model
{
    public function current_exercice(){
        $req = $this->db->query('select id from exercice where year(debut)=year(curdate())');
        $rs = $req->row_array();
        return $rs['id'];
    }
    public function get_journal($code){
        $req = $this->db->query("select * from code_journaux where code='".$code."'");
        $rs = $req->row_array();
        return $rs;
    }
    public function get_journal_detail($exo,$code,$month){
        $req = "select * from journal j join devise_equivalence d on j.devise=d.devise2  where j.idexercice=".$exo." and j.code_journal='".$code."' and month(j.date_journal)=".$month." order by j.date_journal,j.id asc";
        // echo $req;
		$rs = $this->db->query($req);
        $data = [];
		$i=0;
		foreach ($rs->result_array() as $row) {
			$data[$i] = $row;
			$i++;
		}
		return $data;
    }
	public function get_references(){
        $req = "select * from reference_piece";
        $rs = $this->db->query($req);
        $data = [];
		$i=0;
		foreach ($rs->result_array() as $row) {
			$data[$i] = $row;
			$i++;
		}
		return $data;
    }

    public function load_to_modify($code_journal,$exo,$num_piece){
		$req = "select * from journal where idexercice=".$exo." and numero_piece='".$num_piece."' and code_journal='".$code_journal."'";
		// echo $req;
		$rs = $this->db->query($req);
		$data = [];
		$i=0;
		foreach ($rs->result_array() as $row) {
			$data[$i] = $row;
			$i++;
		}
		return $data;
	}
	public function get_months(){
		return ['Janvier','Fevrier','Mars','Avril','Mai','Juin','Juillet','Aout','Septembre','Octobre','Novembre','Decembre'];
	}
	 
}
?>