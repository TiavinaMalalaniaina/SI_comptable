<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Centre extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('balance_model');
        $this->load->model('code_journaux_model');
        $this->load->model('analytique_model');
        $this->load->model('centre_model');
        $this->load->model('charge_centre_model');
    }


    public function index() {
        $head['company'] = $this->company_model->select();
		$this->load->view('templates/header', $head);
		$piwi = [];
		$piwi['lst'] = $this->code_journaux_model->selectAll();
		$this->load->view('templates/sidebar.php',$piwi);
		$this->load->view('ajout-centre.php', $data);
		$this->load->view('templates/footer.php');
    }
    public function insertion(){
        $nom = $this->input->get('nom');
        $date = $this->input->get('date');
        $this->db->query("insert into centre(nom,dat) values('".$nom."','".$date."')");
        $charges = $this->analytique_model->charges();
        $pd = $this->centre_model->getLast();
        for ($i=0; $i < count($charges); $i++) { 
            $this->charge_centre_model->insert($charges[$i]['id'],$pd['id'],$date);
        }
        redirect(site_url('Centre'));
    }

    public function equilibre() {
        $centres = $this->centre_model->getList();
        $charges = $this->analytique_model->charges();
        for ($i=0; $i < count($charges); $i++) { 
            for ($j=0; $j < count($centres) ; $j++) {
                $centres[$j]['charges'][$i] = $this->centre_model->setup($charges[$i],$centres[$j]);
            }
        }
        $data = array(
            'charges'=>$charges,
            'centres'=>$centres
        );
        $head['company'] = $this->company_model->select();
		$this->load->view('templates/header', $head);
		$piwi = [];
		$piwi['lst'] = $this->code_journaux_model->selectAll();
		$this->load->view('templates/sidebar.php',$piwi);
		$this->load->view('insertion-charges2.php', $data);
		$this->load->view('templates/footer.php');
    }

    public function insertion_eq(){
        $dat  = $this->input->get('date');
        $centres = $this->centre_model->getList();
        $charges = $this->analytique_model->charges();
        for ($i=0; $i < count($charges); $i++) { 
            for ($j=0; $j < count($centres) ; $j++) {
                $p = $this->input->get($charges[$i]['id']."-".$centres[$j]['id']);
                $this->db->query("insert into charge_centre(idcharge,idcentre,pourcentage,dat) values(".$charges[$i]['id'].",".$centres[$j]['id'].",".$p.",'".$dat."')");
            }
        }
        redirect(site_url('Centre/equilibre'));
    }


}