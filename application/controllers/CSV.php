<?php
defined('BASEPATH') or exit('No direct script access allowed');

class CSV extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("csv_model");
    }

    public function import(){
        $table = $this->input->post('table');
        $file = fopen($_FILES['csv']['tmp_name'],"r");
        $head = null;
        $cols = "";
        $datatypes = null;
        $headto = "";
        $separator = $this->input->post('separator');
        $this->db->trans_begin();
        while(($field = fgetcsv($file,null,$separator))!==false){
            if($head==null){
                $head = $field;
                for ($i=0; $i < count($head)-1; $i++) { 
                    $head[$i] = trim($head[$i]);
                    $headto .= $head[$i].',';
                }
                $headto .= $head[count($head)-1];
                try {
                    $datatypes = $this->csv_model->datatyper($table,$head);
                } catch (Exception $e) {
                    redirect('CSV/index?error=1');
                    return;
                }
                
                for ($i=0; $i < count($head)-1; $i++) { 
                    $cols .= $head[$i].",";
                }
                $cols .= $head[count($head)-1];
            }
            else {
                if(count($field)!=count($head)){
                    $this->db->trans_rollback();
                    redirect('CSV/index?error=2');
                    return;
                }
                $q = "insert into ".$table."(".$headto.") values(";
                for ($i=0; $i < count($field)-1; $i++) { 
                    $q .= $datatypes[$i].$this->csv_model->formatter($field[$i]).$datatypes[$i].",";
                }
                $q .= $datatypes[$i].$this->csv_model->formatter($field[count($field)-1]).$datatypes[$i].")";
                // echo $q.';<br>';
                $this->db->query($q);
            }
        }
        $this->db->trans_commit();
        redirect('CSV/index?error=0');
    }

    public function export(){
        $this->csv_model->export($this->input->post('table'),$this->input->post('separator'));
        exit;
        redirect('CSV/');
    }

    public function index(){
        $data = [];
        $data['tables'] = $this->csv_model->tables();
        $data['error'] = '';
        if($this->input->get("error")!==null){
            if($this->input->get("error")=='1'){
                $data['error'] = "You have an error in your csv file";
            }
            else {
                $data['error'] = "Importation success";
            }
        }
        $head['company'] = $this->company_model->select();
		$this->load->view('templates/header', $head);
		$piwi = [];
		$piwi['lst'] = $this->code_journaux_model->selectAll();
		$this->load->view('templates/sidebar.php',$piwi);
        $this->load->view("import_export",$data);
        // $this->load->view("csv",$data);
        $this->load->view("/templates/footer");
    }
}
