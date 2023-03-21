<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Grand_livre extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('grand_livre_model');
    }


    public function index() {

        $balance = $this->grand_livre_model->selectAll();

        $data = array(
           'title' => "Balance",
           'balance' => $balance,
        );

        $this->load->view('templates/header.php');
		$this->load->view('templates/sidebar.php');
		$this->load->view('Grand_livre.php', $data);
		$this->load->view('templates/footer.php');
    }

}