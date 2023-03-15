<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Document_model extends CI_Model{
        public function insert($filename, $intitule){
            $sql = sprintf("INSERT INTO document values(null, '%s', '%s')", $filename, $intitule);
            $this->db->query($sql);
        }

        
        public function selectAll(){
            $result = array();
            $query = $this->db->query('SELECT * FROM document');
            foreach($query->result_array() as $row){
                $result[] = $row;
            }
            return $result;
        }

        public function selectById($id){
            $result = array();
            $sql = sprintf('SELECT * FROM document WHERE id=%s', $this->db->escape($id));
            $query = $this->db->query($sql);
            return $query->row_array();
        }

        public function download($filename) {
            $file = './assets/docs/'.$filename; // Chemin absolu ou relatif vers le fichier à télécharger

            // En-têtes HTTP pour indiquer que le fichier est un téléchargement
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="' . $filename . '"');

            readfile($file);

        }
    }
?>