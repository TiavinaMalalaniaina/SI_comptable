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
        $this->db->trans_begin();
        while(($field = fgetcsv($file,null,","))!==false){
            if($head==null){
                $head = $field;
                $datatypes = $this->csv_model->datatyper($table,$head);
                for ($i=0; $i < count($head)-1; $i++) { 
                    $cols .= $head[$i].",";
                }
                $cols .= $head[count($head)-1];
            }
            else {
                if(count($field)!=count($head)){
                    $this->db->trans_rollback();
                    redirect('CSV/index?error=1');
                    return;
                }
                $q = "insert into ".$table."(".$cols.") values(";
                for ($i=0; $i < count($field)-1; $i++) { 
                    $q .= $datatypes[$i].$field[$i].$datatypes[$i].",";
                }
                $q .= $datatypes[$i].$field[count($field)-1].$datatypes[$i].")";
                $this->db->query($q);
            }
        }
        $this->db->trans_commit();
        redirect('CSV/error=0');
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
        $this->load->view("/templates/header");
        $this->load->view("/templates/sidebar");
        $this->load->view("import_export",$data);
        // $this->load->view("csv",$data);
        $this->load->view("/templates/footer");
    }
}
