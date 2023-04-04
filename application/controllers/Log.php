<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Log extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('utilisateur_model');
    }


    public function index() {

        $this->load->view('login');

    }

    public function login() {
        $name = $this->input->post('username');
        $mdp = $this->input->post('password');
        try {
            $this->utilisateur_model->login($name, $mdp);
            redirect('/Company');
        } catch (\Throwable $th) {
            redirect('Log');
        }
    }

    public function logout() {
        redirect('/log');
    }

}