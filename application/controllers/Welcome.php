<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function index()
	{
		$this->load->view('templates/header.php');
		$this->load->view('templates/sidebar.php');
		// $this->load->view('form_company.php');
		$this->load->view('templates/footer.php');
	}

	public function display() {
		$company_name = $this->input->post('company_name');
		$leader_name = $this->input->post('leader_name');
		$date_creation = $this->input->post('date_creation');
		$siege_sociale = $this->input->post('siege_sociale');
		$siege_exploit = $this->input->post('siege_exploit');
		$object = $this->input->post('object');
		$nif = $this->input->post('nif');
		$ns = $this->input->post('ns');
		$nrc = $this->input->post('nrc');
	
		
		$data = array(
			'company_name' => $company_name,
			'leader_name' => $leader_name,
			'date_creation' => $date_creation,
			'siege_sociale' => $siege_sociale,
			'siege_exploit' => $siege_exploit,
			'object' => $object,
			'nif' => $nif,
			'ns' => $ns,
			'nrc' => $nrc
		);
		// echo var_dump($data);
		$this->load->view('display_data', $data);
	}

	public function show_information() {
		// Vérifie si le formulaire a été soumis
		if($this->input->post()) {
			// Récupération des informations du formulaire
			$company_name = $this->input->post('company_name');
			$leader_name = 	$this->input->post('leader_name');
			$date_creation = $this->input->post('date_creation');
			$siege_sociale = $this->input->post('siege_sociale');
			$siege_exploit = $this->input->post('siege_exploit');
			$object = 		$this->input->post('object');
			$nif = 			$this->input->post('nif');
			$ns = $this->input->post('ns');
			$nrc = $this->input->post('nrc');
	
			// Configuration de l'upload de fichier
			$config['upload_path'] = './assets/img/';
			$config['allowed_types'] = 'gif|jpg|png';
			$config['max_size'] = '100000000';
	
			$this->load->library('upload', $config);
	
			// Vérifie si le fichier a bien été uploadé
			if($this->upload->do_upload('logo')) {
				// Récupération des informations sur le fichier uploadé
				$upload_data = $this->upload->data();
	
				$data = array(
					'company_name' => $company_name,
					'leader_name' => $leader_name,
					'date_creation' => $date_creation,
					'siege_sociale' => $siege_sociale,
					'siege_exploit' => $siege_exploit,
					'object' => $object,
					'nif' => $nif,
					'ns' => $ns,
					'nrc' => $nrc,
					'logo' => $upload_data['file_name']
				);
				echo var_dump($data);
				// Redirection vers une autre page après traitement
				$this->load->view('display_data', $data);
			} else {
				$error = array('error' => $this->upload->display_errors());
				$this->load->view('data_form', $error);
			}
			

		} else {
			$this->load->view('data_form');
		}
	}
	


}