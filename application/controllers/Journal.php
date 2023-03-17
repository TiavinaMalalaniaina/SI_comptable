<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Journal extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
		$this->load->model('journal_model');
    }

	public function index()
	{
		$data = [];
		$data['journal'] = $this->journal_model->get_journal($this->input->get('code'));
		$month = 03;
		if($this->input->get('month')!==null){
			$month = $this->input->get('month');
		}
		$data['liste'] = $this->journal_model->get_journal_detail($this->journal_model->current_exercice(),$this->input->get('code'),$month);
		$this->load->view('templates/header.php');
		$this->load->view('templates/sidebar.php');
		// $this->load->view('consultation.php',$data);
		$this->load->view('templates/footer.php');
	}

	public function insertor(){
		$code_journal = $this->input->post('code_journal');
		$i = 0;
		$exo = $this->journal_model->current_exercice();
		while($this->input->post('compte'.$i)!==null){
			$data = array(
				'compte' => $this->input->post('compte'.$i),
				'debit' => $this->input->post('debit'.$i),
				'credit' => $this->input->post('credit'.$i),
				'date' => $this->input->post('date'.$i),
				'numero_piece' => $this->input->post('num_piece'.$i),
				'reference_piece' => $this->input->post('ref_piece'.$i),
				'libelle' => $this->input->post('libelle'.$i),
				'devise' => $this->input->post('devise'.$i),
				'idexercice' => $exo,
				'code_journal' => $code_journal
			);
			$this->db->insert('journal',$data);
			$i++;
		}
		redirect('Journal/index?code='.$code_journal);
	}
	public function modifior(){
		$data = [];
		$data['data'] = $this->journal_model->load_to_modify($this->input->get('code_journal'),$this->input->get('exo'),$this->input->get('num_piece'));
		// $this->load->view('',$data);
	}
	public function update_modified(){
		$i = 0;
		while($this->input->post('id'.$i)!==null){
			$data = array(
                'compte' => $this->input->post('compte'.$i),
				'debit' => $this->input->post('debit'.$i),
				'credit' => $this->input->post('credit'.$i),
				'date' => $this->input->post('date'.$i),
				'numero_piece' => $this->input->post('num_piece'.$i),
				'reference_piece' => $this->input->post('ref_piece'.$i),
				'libelle' => $this->input->post('libelle'.$i),
				'devise' => $this->input->post('devise'.$i)
            );
            $this->db->where('id',intval($this->input->post('id'.$i)));
            $this->db->update('journal',$data);
			$i++;
		}
	}	
}