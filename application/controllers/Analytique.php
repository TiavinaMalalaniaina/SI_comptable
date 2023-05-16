<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Analytique extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('balance_model');
        $this->load->model('analytique_model');
    }

    public function index() {
        $date = date('Y-m-d');
        if($this->input->get('date')!==null){
            $date = $this->input->get('date');
        }
        $idproduit = 1;
        if($this->input->get('produit')!==null){
            $idproduit = $this->input->get('produit');
        }
        $products = $this->analytique_model->products($date);
        $charges = $this->analytique_model->charges($date);
        $charges = $this->analytique_model->somme_charges($charges,$date);
        $charges = $this->analytique_model->charges_produit($charges,$products[$idproduit-1],$date);
        $centres = $this->analytique_model->centres($date);
        $centres = $this->analytique_model->charges_centres($charges,$centres,$date);
        $total = $this->analytique_model->total($charges,$centres);
        $affectation = $this->analytique_model->affect_struct_to_operationnal($centres);
        $centres = $affectation[4];
        $prix = $this->analytique_model->prix($affectation[2],$products[$idproduit-1],$date);
        $p = $prix['prix'];
        if($this->input->get('prix')!==null){
            $p = $this->input->get('prix');
        }
        $seuil = $this->analytique_model->seuil($p,$total,$prix['sum']);
        $data = array(
            'daty'=>$date,
            'prod'=>$products[$idproduit-1],
            'produits'=>$products,
            'charges'=>$charges,
            'centres'=>$centres,
            'total'=>$total,
            'affectation'=>$affectation,
            'prix'=>$prix,
            'seuil'=>$seuil,
            'perc'=>$this->analytique_model->perc($centres),
            'data'=>[$date,$idproduit]
        );
        
        $head['company'] = $this->company_model->select();
		$this->load->view('templates/header', $head);
		$piwi = [];
		$piwi['lst'] = $this->code_journaux_model->selectAll();
		$this->load->view('templates/sidebar.php',$piwi);
		$this->load->view('analytique.php', $data);
		$this->load->view('templates/footer.php');
    }

    public function index2(){
        $date = date('Y-m-d');
        if($this->input->get('date')!==null){
            $date = $this->input->get('date');
        }
        $idcentre = 1;
        if($this->input->get('centre')!==null){
            $idcentre = $this->input->get('centre');
        }
        $products = $this->analytique_model->products($date);
        $charges = $this->analytique_model->charges($date);
        $charges = $this->analytique_model->somme_charges($charges,$date);
        $charges = $this->analytique_model->charges_produits($charges,$products,$date);
        $centres = $this->analytique_model->centres($date);
        $centre = $centres[$idcentre-1];
        $charges = $this->analytique_model->pourcentage_centre($charges,$centre,$date);
        $charges = $this->analytique_model->product_part($charges,$products);
        $data = array(
            'daty'=>$date,
            'produits'=>$products,
            'charges'=>$charges,
            'centres'=>$centres,
            'centre'=>$centre,
        );        
        $head['company'] = $this->company_model->select();
		$this->load->view('templates/header', $head);
		$piwi = [];
		$piwi['lst'] = $this->code_journaux_model->selectAll();
		$this->load->view('templates/sidebar.php',$piwi);
		$this->load->view('analytique_centre.php', $data);
		$this->load->view('templates/footer.php');
    }

}