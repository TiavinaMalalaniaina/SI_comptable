<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Company extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Company_model', 'company');
        $this->load->model('Detail_company_model', 'detail_company');
    }


    public function index() {

        $company = $this->company->select();
        $detail_company = $this->detail_company->select();
        $data = array(
            'company' => $company,
            'detail' => $detail_company
        );
        $this->load->view('templates/header');
		$this->load->view('templates/sidebar');
		$this->load->view('company', $data);
		$this->load->view('templates/footer');
    }

    public function sign() {
        $this->load->view('register_company');
    }

    public function detail() {
        $this->load->view('register_detail_company');
    }

    public function insert() {
        // Vérifie si le formulaire a été soumis
        if($this->input->post()) {
            // Récupération des informations du formulairz
            $name = $this->input->post('name');
            $leader = 	$this->input->post('leader');
            $social = $this->input->post('social');
            $exploit = $this->input->post('exploit');
            $objet = 		$this->input->post('objet');
            $contact = $this->input->post('contact');
            $telecopie = $this->input->post('telecopie');
    
            // Configuration de l'upload de fichier
            $config['upload_path'] = './assets/img';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '100000000';
    
            $this->load->library('upload', $config);
    
            // Vérifie si le fichier a bien été uploadé
            if($this->upload->do_upload('logo')) {
                // Récupération des informations sur le fichier uploadé
                $upload_data = $this->upload->data();
                $this->company->insert($name, $leader, $social, $exploit, $contact, $telecopie, $objet, $upload_data['file_name']);
                redirect(site_url('Company/detail'));
            } else {
                $error = array('error' => $this->upload->display_errors());
                redirect(site_url('Company/sign'));
            }
        } else {
            redirect(site_url('Company/sign'));
        }
    }

}