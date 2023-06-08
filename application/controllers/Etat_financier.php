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
        $this->load->library('gpdf');
        $this->load->model('Etat_financier_model');
    }


    public function index() {

        $dt = date('Y-m-d');
        if($this->input->get('date')!==null){
            $dt = $this->input->get('date');
        }

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

        $test = $this->Etat_financier_model->get_it([1,2,3,4,5,6],[[],[],[],[],[],[]],$dt);
        $test2 = $this->Etat_financier_model->get_it([7,8,12],[[],[9,10,11],[]],$dt);
        
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

    public function actif_pdf() {
        $dt = date('Y-m-d');
        if($this->input->get('date')!==null){
            $dt = $this->input->get('date');
        }

        $head['company'] = $this->company_model->select();
		// $this->load->view('templates/header', $head);
		$piwi = [];
		$piwi['lst'] = $this->code_journaux_model->selectAll();
		// $this->load->view('templates/sidebar.php',$piwi);
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

        $test = $this->Etat_financier_model->get_it([1,2,3,4,5,6],[[],[],[],[],[],[]],$dt);
        $test2 = $this->Etat_financier_model->get_it([7,8,12],[[],[9,10,11],[]],$dt);
        
        $data = array(
            'con' => $datacompany,
            'exo' => $exo,
            'anc' => $test,
            'ac' => $test2
        );    

           
        $title = array(
            'ACTIF', 'COMPTE'
        );

        $pdf = new GPDF();
        $pdf->AddPage();
        $pdf->SetFont('Arial','B',22);
        $pdf->Cell(200, 10, 'Bilan');
        $pdf->Ln();
        $pdf->SetFont('Arial','B',20);
        $pdf->Cell(200, 20, 'Jeudi le 09 avril 2023', 0, 1);
        $pdf->SetFont('Times','B',7);
        $pdf->analyse($title, $data);
        $pdf->Ln();
        $pdf->Ln();
        $pdf->Ln();
    
        $pdf->Output();
    }

    public function passif() {

        $dt = date('Y-m-d');
        if($this->input->get('date')!==null){
            $dt = $this->input->get('date');
        }

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
        $test = $this->Etat_financier_model->get_it2([13,14,15,16,17],[[],[],[],[],[]],$dt);
        $test2 = $this->Etat_financier_model->get_it2([18,19],[[],[]],$dt);
        $test3 = $this->Etat_financier_model->get_it2([20,21,22,23,24,25],[[],[],[],[],[],[]],$dt);
        
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

        $dt = date('Y-m-d');
        if($this->input->get('date')!==null){
            $dt = $this->input->get('date');
        }

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
        $lst[0] = $this->Etat_financier_model->do_do(['70','71'],$dt);
        $lst[1] = $this->Etat_financier_model->do_do(['60','61/62'],$dt);
        $lst[2] = $this->Etat_financier_model->do_do(['64','63'],$dt);
        $lst[3] = $this->Etat_financier_model->do_do(['75','65','68','78'],$dt);
        $lst[4] = $this->Etat_financier_model->do_do(['76','66'],$dt);
        $lst[5] = $this->Etat_financier_model->do_do(['695','692'],$dt);
        $lst[6] = $this->Etat_financier_model->do_do(['77','67'],$dt);


        $rsam = 0;
        $sd = -1;

        $totco = 0;
        $totpo = 0;
        for ($i=0; $i < count($lst)-1; $i++) { 
            for ($j=0; $j < count($lst[$i][0]); $j++) { 
                if(str_starts_with($lst[$i][0][$j]['con'],'6')){
                    $totco += $lst[$i][0][$j]['somme'];
                }
                else {
                    $totpo += $lst[$i][0][$j]['somme'];
                    if($sd==-1){
                        $sd = $lst[$i][0][$j]['somme'];
                    }
                }
            }
            if($i==4){
                $rsam = $totpo - $totco;
                $rsam = (20*$rsam)/100;
        $sd = (5*$sd)/1000 + 320000;

        $max = $rsam;
        if($max<$sd){
            $max = $sd;
        }

        $lst[5][0][1]['somme'] = $max;
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