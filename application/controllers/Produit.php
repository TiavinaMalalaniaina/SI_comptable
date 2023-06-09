<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produit extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('balance_model');
        $this->load->model('code_journaux_model');
        $this->load->model('analytique_model');
        $this->load->model('produit_model');
        $this->load->model('charge_produit_model');
    }


    public function index() {
        $head['company'] = $this->company_model->select();
		$this->load->view('templates/header', $head);
		$piwi = [];
		$piwi['lst'] = $this->code_journaux_model->selectAll();
		$this->load->view('templates/sidebar.php',$piwi);
		$this->load->view('ajout-produit.php', $data);
		$this->load->view('templates/footer.php');
    }
    public function insertion(){
        $nom = $this->input->get('nom');
        $date = $this->input->get('date');
        $this->db->query("insert into produit(nom,dat) values('".$nom."','".$date."')");
        $charges = $this->analytique_model->charges();
        $pd = $this->produit_model->getLast();
        for ($i=0; $i < count($charges); $i++) { 
            $this->charge_produit_model->insert($charges[$i]['id'],$pd['id'],$date);
        }
        redirect(site_url('Produit'));
    }

    public function equilibre() {
        $produits = $this->produit_model->getList();
        $charges = $this->analytique_model->charges();
        for ($i=0; $i < count($charges); $i++) { 
            for ($j=0; $j < count($produits) ; $j++) {
                $produits[$j]['charges'][$i] = $this->produit_model->setup($charges[$i],$produits[$j]);
            }
        }
        $data = array(
            'charges'=>$charges,
            'produits'=>$produits
        );
        $head['company'] = $this->company_model->select();
		$this->load->view('templates/header', $head);
		$piwi = [];
		$piwi['lst'] = $this->code_journaux_model->selectAll();
		$this->load->view('templates/sidebar.php',$piwi);
		$this->load->view('insertion-charges.php', $data);
		$this->load->view('templates/footer.php');
    }

    public function insertion_eq(){
        $dat  = $this->input->get('date');
        $produits = $this->produit_model->getList();
        $charges = $this->analytique_model->charges();
        for ($i=0; $i < count($charges); $i++) { 
            for ($j=0; $j < count($produits) ; $j++) {
                $p = $this->input->get($charges[$i]['id']."-".$produits[$j]['id']);
                $this->db->query("insert into charge_produit(idcharge,idproduit,pourcentage,dat) values(".$charges[$i]['id'].",".$produits[$j]['id'].",".$p.",'".$dat."')");
            }
        }
        redirect(site_url('Produit/equilibre'));
    }

    public function production(){
        $data = array(
            'list'=>$this->produit_model->getList(),
        );
        $head['company'] = $this->company_model->select();
		$this->load->view('templates/header', $head);
		$piwi = [];
		$piwi['lst'] = $this->code_journaux_model->selectAll();
		$this->load->view('templates/sidebar.php',$piwi);
		$this->load->view('ajout-production.php', $data);
		$this->load->view('templates/footer.php');       
    }   

    public function insertion_production(){
        $idproduit = $this->input->get('idproduit');
        $qtt = $this->input->get('qtt');
        $pu = $this->input->get('pu');
        $dat = $this->input->get('dat');
        $this->db->query("insert into production(idproduit,quantite,pu,dat) values(".$idproduit.",".$qtt.",".$pu.",'".$dat."')");
        redirect(site_url('Produit/production'));   
    }
    
}