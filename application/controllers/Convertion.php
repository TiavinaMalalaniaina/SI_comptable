<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Convertion extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('devise_model');
        $this->load->model('devise_equivalence_model');
        $this->load->model('detail_company_model');
    }

    public function index(){
        $devise = $this->devise_model->selectAll();
        $data = array(
            'devise' => $devise
        );
        $this->load->view('templates/header.php');
		$piwi = [];
		$piwi['lst'] = $this->code_journaux_model->selectAll();
		$this->load->view('templates/sidebar.php',$piwi);
        $this->load->view('templates/sidebar');
        $this->load->view('convertion', $data);
        $this->load->view('templates/footer');
    }

    public function add() {
        $taux = $this->input->post('taux');
        $code = $this->input->post('code');
        $nom = $this->input->post('nom');
        $company = $this->detail_company_model->select();

        $this->devise_model->save($code, $nom);
        $this->devise_equivalence_model->insert($company['devise'], $code, $taux, null);

        redirect('/convertion');
    }

    public function convertion_compte_devise() {
        $argent = $this->input->post('argent');
        $code = $this->input->post('devise');
        $devise = $this->devise_model->selectAll();
        $convert = $this->devise_equivalence_model->convertion_compte_devise($argent, $code);
        $data = array(
            'devise' => $devise,
            'convert' => $convert
        );
        $this->load->view('templates/header.php');
		$piwi = [];
		$piwi['lst'] = $this->code_journaux_model->selectAll();
		$this->load->view('templates/sidebar.php',$piwi);;
        $this->load->view('convertion', $data);
        $this->load->view('templates/footer');
    }

    public function convertion_devise_compte() {
        $argent = $this->input->post('argent');
        $code = $this->input->post('devise');
        $devise = $this->devise_model->selectAll();
        $convert = $this->devise_equivalence_model->convertion_devise_compte($argent, $code);
        $data = array(
            'devise' => $devise,
            'convert' => $convert
        );
        $this->load->view('templates/header.php');
		$piwi = [];
		$piwi['lst'] = $this->code_journaux_model->selectAll();
		$this->load->view('templates/sidebar.php',$piwi);
        $this->load->view('convertion', $data);
        $this->load->view('templates/footer');
    }

}
?>