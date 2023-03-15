<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Company extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Company_model', 'company');
        $this->load->model('Detail_company_model', 'detail_company');
        $this->load->model('document_model');
    }


    public function index() {

        $company = $this->company->select();
        $detail_company = $this->detail_company->select();
        $docs = $this->document_model->selectAll();
        $data = array(
            'company' => $company,
            'detail' => $detail_company,
            'docs' => $docs
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
        $this->load->model('devise_model');
        $devise = $this->devise_model->selectAll();
        $data = array(
            'devise' => $devise
        );
        $this->load->view('register_detail_company', $data);
    }

    public function insert() {
        // Vérifie si le formulaire a été soumis
        if($this->input->post()) {
            // Récupération des informations du formulairz
            $name = $this->input->post('name');
            $leader = 	$this->input->post('leader');
            $social = $this->input->post('social');
            $exploit = $this->input->post('exploit');
            $contact = $this->input->post('contact');
            $telecopie = $this->input->post('tele$telecopie');
            $objet = $this->input->post('objet');
    
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

    public function save_detail() {
        $nif = $this->input->post('nif');
        $ns = $this->input->post('ns');
        $rcs = $this->input->post('rcs');
        $devise = $this->input->post('devise');
        $debut = $this->input->post('debut');
        $fin = $this->input->post('fin');

        $this->detail_company->insert($nif, $ns, $rcs, $devise, $debut, $fin);
        
        redirect(site_url('Company/'));
    }

    public function saveDocs() {
        $this->load->model('document_model');
         if($this->input->post()) {
            $intitule = 	$this->input->post('intitule');
    
            // Configuration de l'upload de fichier
            $config['upload_path'] = './assets/docs';
            $config['allowed_types'] = 'gif|jpg|png|pdf|docx|xlsx';
            $config['max_size'] = '100000000';
    
            $this->load->library('upload', $config);
    
            // Vérifie si le fichier a bien été uploadé
            if($this->upload->do_upload('file')) {
                // Récupération des informations sur le fichier uploadé
                $upload_data = $this->upload->data();
                $this->document_model->insert($upload_data['file_name'], $intitule);
                redirect(site_url('Company/'));
            } else {
                $error = array('error' => $this->upload->display_errors());
                var_dump($error);
                // redirect(site_url('Company/'));
            }
        } else {
            // redirect(site_url('Company/'));
        }
    }

    public function download() {
        $this->load->model('document_model');
        $id = $this->input->get('id');
        $docs = $this->document_model->selectById($id);
        $this->document_model->download($docs['name']);
    }
}