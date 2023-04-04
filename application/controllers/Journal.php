<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Journal extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
		$this->load->model('journal_model');
		$this->load->model('code_journaux_model');
		$this->load->model('devise_model');
		$this->load->model('compte_tiers_model');
		$this->load->model('compte_general_model');
    }

	public function index()
	{
		$data = [];
		$data['months'] = $this->journal_model->get_months();
		$month = date('m');
		if($this->input->get('month')!==null){
			$month = $this->input->get('month');
		}
		$code = 'AC';
		if($this->input->get('cj')!==null){
			$code = $this->input->get('cj');
		}
		$data['refs'] = $this->journal_model->get_references();
		$data['month'] = $month;
		$data['compte_tiers'] = $this->compte_tiers_model->selectAll();
		$data['compte_gen'] = $this->compte_general_model->selectAll();
		$data['devise'] = $this->devise_model->selectAll();
		$data['journal'] = $this->journal_model->get_journal($code);
		$data['liste'] = $this->journal_model->get_journal_detail($this->journal_model->current_exercice(),$code,$month);
		$this->load->view('templates/header');
		$piwi = [];
		$piwi['lst'] = $this->code_journaux_model->selectAll();
		$this->load->view('templates/sidebar',$piwi);
		$this->load->view('journal',$data);
		$this->load->view('templates/footer');
	}



	public function insertor(){

		$code_journal = $this->input->get('cj');
		$debit = $this->input->get('debit');
		$credit = $this->input->get('credit');
		$quantite = $this->input->get('quantite');
		$montant = $this->input->get('montant');
		$libelle = $this->input->get('libelle');
		$compteg = $this->input->get('compteg');
		$comptet = $this->input->get('comptet');
		$devise = $this->input->get('devise');
		$jour = $this->input->get('jour');
		$npiece = $this->input->get('npiece');
		$refpiece = $this->input->get('rpiecetype').$this->input->get('rpiece');
		$exo = $this->journal_model->current_exercice();
		// $this->db->trans_begin();
		// $sumdebit = 0;
		// $sumcredit = 0;
		for ($i=0; $i < count($debit); $i++) { 
			$data = array(
				'compte' => $compteg[$i],
				'debit' => $debit[$i],
				'credit' => $credit[$i],
				'date_journal' => $jour,
				'numero_piece' => $npiece,
				'reference_piece' => $refpiece,
				'libelle' => $libelle,
				'devise' => $devise,
				'idexercice' => $exo,
				'code_journal' => $code_journal,
				'compte_tierce' => $comptet[$i],
				'quantite' => $quantite[$i]
			);
			// echo json_encode($data);
			$this->db->insert('journal',$data);
			// $sumdebit += intval($this->input->post('debit'.$i));
			// $sumcredit += intval($this->input->post('credit'.$i));
			// $i++;
		}
		redirect('Journal/index?cj='.$code_journal.'&month='.$this->input->get('month'));
		// if($sumcredit!=$sumdebit){
		// 	$this->db->trans_rollback();
		// 	redirect('Journal/index?code='.$code_journal."&error");
		// }
		// else {
		// 	$this->db->trans_commit();
		// }
	}
	public function modifior(){
		$exo = $this->journal_model->current_exercice();
		$data = [];
		$data['data'] = $this->journal_model->load_to_modify($this->input->get('cj'),$exo,$this->input->get('npiece'));
		$this->load->view('templates/header');
		$piwi = [];
		$piwi['lst'] = $this->code_journaux_model->selectAll();
		$data['compte_tiers'] = $this->compte_tiers_model->selectAll();
		$data['compte_gen'] = $this->compte_general_model->selectAll();
		$data['devise'] = $this->devise_model->selectAll();
		$data['month'] = $this->input->get('month');
		$this->load->view('templates/sidebar',$piwi);
		$this->load->view('update_journal',$data);
		$this->load->view('templates/footer');
	}
	public function update_modified(){
		$code_journal = $this->input->get('cj');
		$ids = $this->input->get('id');
		$debit = $this->input->get('debit');
		$credit = $this->input->get('credit');
		$quantite = $this->input->get('quantite');
		$devise = $this->input->get('devise');
		for ($i=0; $i <  count($ids); $i++) { 
			$data = array(
				'debit' => $debit[$i],
				'credit' => $credit[$i],
				'quantite' => $quantite[$i],
				'devise' => $devise
            );
            $this->db->where('id',$ids[$i]);
            $this->db->update('journal',$data);
		}
		redirect('Journal/index?cj='.$code_journal.'&month='.$this->input->get('month'));
	}	
}