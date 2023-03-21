<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Balance extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('balance_model');
    }


    public function index() {

        $balance = $this->balance_model->selectAll();

        $data = array(
           'title' => "Balance",
           'balance' => $balance,
        );

        $this->load->view('templates/header.php');
		$this->load->view('templates/sidebar.php');
		$this->load->view('balance.php', $data);
		$this->load->view('templates/footer.php');
    }

}