<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Compte_general extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Compte_general_model', 'compte_general');
    }


    public function index() {

        $compte = $this->compte_general->selectAll();

        $data = array(
           'title' => "Comptes général",
           'insert' => "Compte_general/insert",
           'update' => "Compte_general/update",
           'delete' => "Compte_general/delete",
           'compte' => $compte
        );
        $this->load->view('templates/header.php');
		$piwi = [];
		$piwi['lst'] = $this->code_journaux_model->selectAll();
		$this->load->view('templates/sidebar.php',$piwi);
		$this->load->view('consultation.php', $data);
		$this->load->view('templates/footer.php');
    }

    public function insert() {
        $code = $this->input->post('code');
        $code = $this->compte_general->check($code);
        $intitule = $this->input->post('intitule');
        $this->compte_general->insert($code, $intitule);
        redirect(site_url('Compte_general'));
    }

    public function update() {
        $id = $this->input->post('id');
        $code = $this->input->post('code');
        $intitule = $this->input->post('intitule');
        $this->compte_general->update($code, $intitule, $id);
        redirect(site_url('Compte_general'));
    }

    public function delete() {
        $code = $this->input->get('code');
        $this->compte_general->delete($code);
        redirect(site_url('Compte_general'));
    }

}