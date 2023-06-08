<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Facture extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('facture_model');
        $this->load->model('code_journaux_model');
        $this->load->model('journal_model');
    }

    public function input_facture() {
        $data = array(
            'date'=>$this->facture_model->current_date(),
            'numero'=>$this->facture_model->next_numero(),
            'uo'=>$this->journal_model->uo()
        );
        $head['company'] = $this->company_model->select();
		$this->load->view('templates/header', $head);
		$piwi = [];
		$piwi['lst'] = $this->code_journaux_model->selectAll();
		$this->load->view('templates/sidebar.php',$piwi);
		$this->load->view('input_facture.php', $data);
		$this->load->view('templates/footer.php');
    }

    public function confirm_facture(){
        $uo = $this->journal_model->uo();
        $nom = $this->input->get('nom');
        $adresse = $this->input->get('adresse');
        $tel = $this->input->get('tel');
        $mail = $this->input->get('mail');
        $nomresp = $this->input->get('nomresp');
        $obj = $this->input->get('obj');
        $ref = $this->input->get('ref');
        $tva = $this->input->get('tva'); 
        $avance = $this->input->get('avance');
        $designation = $this->input->get('designation');
        $unite = $this->input->get('unite');
        $nombre = $this->input->get('nombre');
        $pu = $this->input->get('pu');
        $calc = $this->facture_model->calculate($avance,$tva,$nombre,$pu);
        $data = array(
            'date'=>$this->facture_model->current_date(),
            'numero'=>$this->facture_model->next_numero(),
            'nom'=>$nom,
            'adresse'=>$adresse,
            'tel'=>$tel,
            'mail'=>$mail,
            'nomresp'=>$nomresp,
            'obj'=>$obj,
            'ref'=>$ref,
            'designation'=>$designation,
            'unite'=>$unite,
            'nombre'=>$nombre,
            'pu'=>$pu,
            'montant'=>$calc['montant'],
            'ht'=>$calc['ht'],
            'tva'=>$tva,
            'ttc'=>$calc['ttc'],
            'avance'=>$avance,
            'net'=>$calc['net'],
            'unite_map'=>$this->facture_model->uo_map($unite,$uo)
        );
        $this->session->set_userdata(array(
            'data'=>$data
        ));
        $head['company'] = $this->company_model->select();
		$this->load->view('templates/header', $head);
		$piwi = [];
		$piwi['lst'] = $this->code_journaux_model->selectAll();
		$this->load->view('templates/sidebar.php',$piwi);
		$this->load->view('confirm_facture.php', $data);
		$this->load->view('templates/footer.php');
    }

    public function see_facture(){
        $id = 1;
        if($this->input->get('id')!==null){
            $id = $this->input->get('id');
        }
        $list = $this->facture_model->list_facture();
        $fac = $this->facture_model->see_facture($id);
        $data = array(
            'list'=>$list,
            'facture'=>$fac
        );
        $head['company'] = $this->company_model->select();
		$this->load->view('templates/header', $head);
		$piwi = [];
		$piwi['lst'] = $this->code_journaux_model->selectAll();
		$this->load->view('templates/sidebar.php',$piwi);
		$this->load->view('see_facture.php', $data);
		$this->load->view('templates/footer.php');
    }

    public function insert_facture(){
        $data = $this->session->userdata('data');
        $this->facture_model->insert_facture($data);
        redirect("Facture/input_facture");
    }

    public function annuler_facture(){
        redirect("Facture/input_facture");
    }

    public function modifier_facture(){
        $data = $this->session->userdata('data');
        $head['company'] = $this->company_model->select();
		$this->load->view('templates/header', $head);
		$piwi = [];
		$piwi['lst'] = $this->code_journaux_model->selectAll();
		$this->load->view('templates/sidebar.php',$piwi);
		$this->load->view('modify_facture.php', $data);
		$this->load->view('templates/footer.php');
    }

    public function export_facture(){
        $id = $this->input->get('id');
        redirect("Facture/see_facture?id=".$id);
    }

}