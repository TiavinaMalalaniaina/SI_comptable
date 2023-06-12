<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Facture extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('facture_model');
        $this->load->model('code_journaux_model');
        $this->load->model('journal_model');
        $this->load->library('facturepdf');
    }

    public function input_facture() {
        $this->session->unset_userdata('data');
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
		$this->load->view('facture-form.php', $data);
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
        $this->session->set_userdata('data',$data);
        $head['company'] = $this->company_model->select();
		$this->load->view('templates/header', $head);
		$piwi = [];
		$piwi['lst'] = $this->code_journaux_model->selectAll();
		$this->load->view('templates/sidebar.php',$piwi);
		$this->load->view('facture.php', $data);
		$this->load->view('templates/footer.php');
    }

    public function see_facture(){
        $id = $this->input->get('id');
        $fac = $this->facture_model->see_facture($id);
        $head['company'] = $this->company_model->select();
		$this->load->view('templates/header', $head);
		$piwi = [];
		$piwi['lst'] = $this->code_journaux_model->selectAll();
		$this->load->view('templates/sidebar.php',$piwi);
		$this->load->view('facture-export.php', $fac);
		$this->load->view('templates/footer.php');
    }

    public function search_facture(){
        $list = $this->facture_model->list_facture();
        $data = array(
            'list'=>$list,
        );
        $head['company'] = $this->company_model->select();
		$this->load->view('templates/header', $head);
		$piwi = [];
		$piwi['lst'] = $this->code_journaux_model->selectAll();
		$this->load->view('templates/sidebar.php',$piwi);
		$this->load->view('search_facture.php', $data);
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
        $datas = $this->session->userdata('data');
        $data = array(
            'date'=>$this->facture_model->current_date(),
            'numero'=>$this->facture_model->next_numero(),
            'uo'=>$this->journal_model->uo(),
            'data'=>$datas
        );
        $head['company'] = $this->company_model->select();
		$this->load->view('templates/header', $head);
		$piwi = [];
		$piwi['lst'] = $this->code_journaux_model->selectAll();
		$this->load->view('templates/sidebar.php',$piwi);
		$this->load->view('facture-modifier.php', $data);
		$this->load->view('templates/footer.php');
    }

    public function export_facture(){
        $id = $this->input->get('id');
        $pdf = new Facturepdf();
        // echo $pdf;
        $this->facture_model->export_facture($pdf,$this->facture_model->see_facture($id));
        $pdf->Output();
    }

}