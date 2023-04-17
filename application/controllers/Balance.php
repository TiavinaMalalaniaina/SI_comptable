<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Balance extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('balance_model');
        $this->load->model('code_journaux_model');
    }


    public function index() {

        $balance = $this->balance_model->selectAll();
        $balance = $this->balance_model->setBalance($balance);
        $total = $this->balance_model->getTotal($balance);
        $data = array(
           'title' => "Balance",
           'balance' => $balance,
           'total' => $total,
        );
        $head['company'] = $this->company_model->select();
		$this->load->view('templates/header', $head);
		$piwi = [];
		$piwi['lst'] = $this->code_journaux_model->selectAll();
		$this->load->view('templates/sidebar.php',$piwi);
		$this->load->view('balance.php', $data);
		$this->load->view('templates/footer.php');
    }

}