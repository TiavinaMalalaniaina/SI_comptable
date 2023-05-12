<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Seuil extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('balance_model');
        $this->load->model('seuil_model');
        $this->load->model('analytique_model');
    }

    public function index() {
        $debut = $this->input->get('debut');
        $fin = $this->input->get('fin');
        $charges = $this->seuil_model->charges();
        $charges = $this->seuil_model->somme_charges($charges,$debut,$fin);
        $all = $this->seuil_model->all($debut,$fin,$charges);
        $head['company'] = $this->company_model->select();
		$this->load->view('templates/header', $head);
		$piwi = [];
		$piwi['lst'] = $this->code_journaux_model->selectAll();
		$this->load->view('templates/sidebar.php',$piwi);
		$this->load->view('seuil.php', $all);
		$this->load->view('templates/footer.php');
    }
}