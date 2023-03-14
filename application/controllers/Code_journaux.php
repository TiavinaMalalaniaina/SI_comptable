<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Code_journaux extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('code_journaux_model', 'code_journaux');
    }


    public function index() {

        $compte = $this->code_journaux->selectAll();

        $data = array(
           'title' => "Code journaux",
           'insert' => "code_journaux/insert",
           'update' => "code_journaux/update",
           'delete' => "code_journaux/delete",
           'compte' => $compte
        );

        $this->load->view('templates/header.php');
		$this->load->view('templates/sidebar.php');
		$this->load->view('consultation.php', $data);
		$this->load->view('templates/footer.php');
    }

    public function insert() {
        $code = $this->input->post('code');
        $intitule = $this->input->post('intitule');
        $this->code_journaux->insert($code, $intitule);
        redirect(site_url('code_journaux'));
    }

    public function update() {
        $id = $this->input->post('id');
        $code = $this->input->post('code');
        $intitule = $this->input->post('intitule');
        $this->code_journaux->update($code, $intitule, $id);
        redirect(site_url('code_journaux'));
    }

    public function delete() {
        $code = $this->input->get('code');
        $this->code_journaux->delete($code);
        redirect(site_url('code_journaux'));
    }

}