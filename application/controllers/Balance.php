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

        for ($i=0; $i < count($balance); $i++) { 
            $solde = $balance[$i]['debit']-$balance[$i]['credit'];
            if ($solde > 0) {
                $balance[$i]['soldedebit'] = $solde;
                $balance[$i]['soldecredit'] = "";
                $total['debit'] = 
            } else {
                $balance[$i]['soldedebit'] = "";
                $balance[$i]['soldecredit'] = -$solde;
            }

            if ($balance[$i]['debit'] == 0) $balance[$i]['debit']=""; 
            if ($balance[$i]['credit'] == 0) $balance[$i]['credit']=""; 
        }

        $data = array(
           'title' => "Balance",
           'balance' => $balance,
           'total' => $total,
        );
        $this->load->view('templates/header.php');
		$piwi = [];
		$piwi['lst'] = $this->code_journaux_model->selectAll();
		$this->load->view('templates/sidebar.php',$piwi);
		$this->load->view('balance.php', $data);
		$this->load->view('templates/footer.php');
    }

}