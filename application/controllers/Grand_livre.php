<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Grand_livre extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('grand_livre_model');
        $this->load->model('compte_general_model');
    }


    public function index() {

        $balance = $this->grand_livre_model->selectAll();

        $data = array(
           'title' => "Balance",
           'livre' => array(),
           'compte' => $this->compte_general_model->selectAll() 
        );
        $this->load->view('templates/header');
		$piwi = [];
		$piwi['lst'] = $this->code_journaux_model->selectAll();
		$this->load->view('templates/sidebar',$piwi);
		$this->load->view('Grand_livre', $data);
		$this->load->view('templates/footer');
    }

    public function compte() {

        $compte = $this->input->post('compte');
        $grand_livre = $this->grand_livre_model->selectByCompte($compte);

        $data = array(
           'title' => "Grand livre",
           'livre' => $grand_livre,
           'compte' => $this->compte_general_model->selectAll() 
        );
        $this->load->view('templates/header');
		$piwi = [];
		$piwi['lst'] = $this->code_journaux_model->selectAll();
		$this->load->view('templates/sidebar',$piwi);
		$this->load->view('Grand_livre', $data);
		$this->load->view('templates/footer');
    }

}