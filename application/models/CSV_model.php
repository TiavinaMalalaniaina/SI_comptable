<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class CSV_model extends CI_Model
{
    public function import(){

    }
    public function export($table,$separator){
        $date = date('Y-m-d');
        $filename = $table."_".$date.".csv";
        header("Content-Description: File Transfer");
        header("Content-Disposition: attachment;filename=$filename");
        header("Content_Type: application/csv");
        $cols = $this->columns($table);
        $file = fopen('php://output','w');
        $data = $this->data($table,$cols);
        fputcsv($file,$cols,$separator);
        foreach($data->result_array() as $key => $value){
            fputcsv($file,$value,$separator,'\\');
        }
        fclose($file);
    }
    public function tables(){
        $rs = $this->db->query("show tables");
        $result = [];
        $i = 0;
        foreach($rs->result_array() as $row){
            $result[$i] = $row['Tables_in_si_comptable'];
            $i++;   
        }
        return $result;
    }
    public function columns($table){
        $req = $this->db->query("select column_name from information_schema.columns where table_schema='si_comptable' and table_name='".$table."'");
        $result = [];
        $i=0;
        foreach($req->result_array() as $row){
            $result[$i] = $row['column_name'];
            $i++;
        }
        return $result;
    }
    public function data($table,$cols){
        $datatype = $this->datatyper($table,$cols);
        $q = "select ";
        for ($i=0; $i < count($cols)-1; $i++) { 
            if($datatype[$i]=="'"){
                $q .= "concat('\"',".$cols[$i].",'\"'),";
            }
            else {
                $q .= $cols[$i].",";
            }
        }
        if($datatype[count($cols)-1]=="'"){
            $q .= "concat('\"',".$cols[count($cols)-1].",'\"')";
        }
        else {
            $q .= $cols[count($cols)-1];
        }
        $q .= " from ".$table;
        $req = $this->db->query($q);
        return $req;
    }
    public function datatyper($table,$cols){
        $result = [];
        for ($i=0; $i < count($cols); $i++) { 
            $req = $this->db->query("select data_type from information_schema.columns where table_schema='si_comptable' and table_name='".$table."' and  column_name='".$cols[$i]."'");
            $rs = $req->row_array();
            $rs = $rs['data_type'];
            if($rs!='int' && $rs!='double'){
                $result[$i] = "'";
            }
            else {
                $result[$i] = "";
            }
        }
        return $result;
    }
}
?>