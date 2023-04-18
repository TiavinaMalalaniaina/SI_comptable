<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Etat_financier extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('balance_model');
        $this->load->model('code_journaux_model');
        $this->load->model('Company_model', 'company');
        $this->load->model('Detail_company_model', 'detail_company');
		$this->load->model('code_journaux_model');
        $this->load->model('document_model');
        $this->load->model('Etat_financier_model');
    }


    public function index() {

        $head['company'] = $this->company_model->select();
		$this->load->view('templates/header', $head);
		$piwi = [];
		$piwi['lst'] = $this->code_journaux_model->selectAll();
		$this->load->view('templates/sidebar.php',$piwi);
        // 
        $company = $this->company->select();
        $detail_company = $this->detail_company->select();
        $docs = $this->document_model->selectAll();
        $datacompany = array(
            'company' => $company,
            'detail' => $detail_company,
            'docs' => $docs
        );
        $exo = $this->Etat_financier_model->current_exercice();

        $test = $this->Etat_financier_model->get_it([1,2,3,4,5,6],[[],[],[],[],[],[]]);
        $test2 = $this->Etat_financier_model->get_it([7,8,12],[[],[9,10,11],[]]);
        
        $data = array(
            'con' => $datacompany,
            'exo' => $exo,
            'anc' => $test,
            'ac' => $test2
        );


        $this->load->view('bilan_actif.php',$data);
        // 
		$this->load->view('templates/footer.php');
    }

    public function passif() {

        $head['company'] = $this->company_model->select();
		$this->load->view('templates/header', $head);
		$piwi = [];
		$piwi['lst'] = $this->code_journaux_model->selectAll();
		$this->load->view('templates/sidebar.php',$piwi);
        // 
        $company = $this->company->select();
        $detail_company = $this->detail_company->select();
        $docs = $this->document_model->selectAll();
        $datacompany = array(
            'company' => $company,
            'detail' => $detail_company,
            'docs' => $docs
        );
        $exo = $this->Etat_financier_model->current_exercice();
        $test = $this->Etat_financier_model->get_it([13,14,15,16,17],[[],[],[],[],[]]);
        $test2 = $this->Etat_financier_model->get_it([18,19],[[],[]]);
        $test3 = $this->Etat_financier_model->get_it([20,21,22,23,24,25],[[],[],[],[],[],[]]);
        
        $data = array(
            'con' => $datacompany,
            'exo' => $exo,
            'cp' => $test,
            'pnc' => $test2,
            'pc' => $test3
        );
        $this->load->view('bilan_passif.php',$data);
        // 
		$this->load->view('templates/footer.php');
    }

    public function resultat() {

        $head['company'] = $this->company_model->select();
		$this->load->view('templates/header', $head);
		$piwi = [];
		$piwi['lst'] = $this->code_journaux_model->selectAll();
		$this->load->view('templates/sidebar.php',$piwi);
        // 
        $company = $this->company->select();
        $detail_company = $this->detail_company->select();
        $docs = $this->document_model->selectAll();
        $datacompany = array(
            'company' => $company,
            'detail' => $detail_company,
            'docs' => $docs
        );
        $exo = $this->Etat_financier_model->current_exercice();

        
        $lst = [];
        $lst[0] = $this->Etat_financier_model->do_do(['70','71']);
        $lst[1] = $this->Etat_financier_model->do_do(['60','61/62']);
        $lst[2] = $this->Etat_financier_model->do_do(['64','63']);
        $lst[3] = $this->Etat_financier_model->do_do(['75','65','68','78']);
        $lst[4] = $this->Etat_financier_model->do_do(['76','66']);
        $lst[5] = $this->Etat_financier_model->do_do(['695','692']);
        $lst[6] = $this->Etat_financier_model->do_do(['77','67']);

        $totco = 0;
        $totpo = 0;
        for ($i=0; $i < count($lst)-1; $i++) { 
            for ($j=0; $j < count($lst[$i][0]); $j++) { 
                if(str_starts_with($lst[$i][0][$j]['con'],'6')){
                    $totco += $lst[$i][0][$j]['somme'];
                }
                else {
                    $totpo += $lst[$i][0][$j]['somme'];
                }
            }
        }


        $data = array(
            'con' => $datacompany,
            'exo' => $exo,
            'lst' => $lst,
            'totco' => $totco,
            'totpo' => $totpo
        );
        $this->load->view('resultat.php',$data);
        //  
		$this->load->view('templates/footer.php');
    }

}