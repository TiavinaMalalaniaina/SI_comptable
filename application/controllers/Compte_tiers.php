<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Compte_tiers extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Compte_tiers_model', 'compte_tiers');
        $this->load->model('Type_tiers_model', 'type_tiers');
    }


    public function index() {

        $compte = $this->compte_tiers->selectAll();
        $type = $this->type_tiers->selectAll();

        $data = array(
           'title' => "Comptes tiers",
           'tiers' => $type,
           'insert' => "Compte_tiers/insert",
           'update' => "Compte_tiers/update",
           'delete' => "Compte_tiers/delete",
           'compte' => $compte
        );
        $head['company'] = $this->company_model->select();
		$this->load->view('templates/header', $head);
		$piwi = [];
		$piwi['lst'] = $this->code_journaux_model->selectAll();
		$this->load->view('templates/sidebar.php',$piwi);
		$this->load->view('consultation.php', $data);
		$this->load->view('templates/footer.php');
    }

    public function insert() {
        $type = $this->input->post('type');
        $code = $this->input->post('code');
        $intitule = $this->input->post('intitule');
        $this->compte_tiers->insert($code, $intitule, $type);
        redirect(site_url('Compte_tiers'));
    }

    public function update() {
        $type = $this->input->post('type');
        $id = $this->input->post('id');
        $code = $this->input->post('code');
        $intitule = $this->input->post('intitule');
        $this->compte_tiers->update($code, $intitule, $type, $id);
        redirect(site_url('Compte_tiers'));
    }

    public function delete() {
        $code = $this->input->get('code');
        $this->compte_tiers->delete($code);
        redirect(site_url('Compte_tiers'));
    }

}