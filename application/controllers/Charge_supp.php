<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Charge_supp extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('charge_supp_model');
        $this->load->model('code_journaux_model');
    }


    public function index() {
        // 
        if($this->input->get('date')!==null){
            $date = $this->input->get('date');
            $valeur = $this->input->get('valeur');
            $nom = $this->input->get('nom');
            $this->db->query("insert into charges_suppletives(nom,valeur,dat) values('".$nom."',".$valeur.",'".$date."')");
            redirect("Charge_supp/index");
        }
        //
        $date = date('Y-m-d');
        if($this->input->get('daty')!==null){
            $date = $this->input->get('daty');
        }
        $reo  = $this->charge_supp_model->supp_at($date); 
        $data = array(
            'liste'=>$this->charge_supp_model->liste(),
            'reo'=>$reo
        );
        $head['company'] = $this->company_model->select();
		$this->load->view('templates/header', $head);
		$piwi = [];
		$piwi['lst'] = $this->code_journaux_model->selectAll();
		$this->load->view('templates/sidebar.php',$piwi);
		$this->load->view('charges_supp.php', $data);
		$this->load->view('templates/footer.php');
    }

}