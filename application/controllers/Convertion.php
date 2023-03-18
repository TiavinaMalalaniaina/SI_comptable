<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Convertion extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('devise_model');
        $this->load->model('devise_equivalence_model');
    }

    public function index(){
        $devise = $this->devise_model->selectAll();
        $data = array(
            'devise' => $devise
        );
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('convertion', $data);
        $this->load->view('templates/footer');
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
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
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
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('convertion', $data);
        $this->load->view('templates/footer');
    }

}
?>