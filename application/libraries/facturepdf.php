<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once APPPATH . 'third_party\fpdf185\fpdf.php';

class Facturepdf extends FPDF
{
    public function __construct()
    {
        parent::__construct();
    }    

    function Heade($date,$numero) {
        $this->Image(base_url("assets/img/481903.png"), 10, 10, 30); 
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(0, 10, 'Date: '.$date, 0, 0, 'R');
        $this->Ln(10); 
        $this->Cell(0, 10, 'Facture '.$numero, 0, 0, 'R'); 
        $this->Ln(20); 
    }

    function ClientInfo($client) {
        $this->SetFont('Arial', '', 12);
        $this->Cell(0, 10, 'Client:', 0, 1); 
        $this->Cell(0, 10, 'Nom : ' . $client['nom'], 0, 1);
        $this->Cell(0, 10, 'Adresse : ' . $client['adresse'], 0, 1);
        $this->Cell(0, 10, 'Email : ' . $client['email'], 0, 1);
        $this->Cell(0, 10, 'Telephone : ' . $client['telephone'], 0, 1);
        $this->Cell(0, 10, 'Responsable : ' . $client['nom_responsable'], 0, 1);
        $this->Ln(10); 
    }

    function InformationsFacture($objet, $reference) {
        $this->SetFont('Arial', '', 12);
        $this->Cell(0, 10, 'Objet : ' . $objet, 0, 1);
        $this->Cell(0, 10, 'Reference : ' . $reference, 0, 1);
        $this->Ln(10); 
    }

    function TableauProduits($header, $produits) {
        $this->SetFont('Arial', 'B', 12);
        foreach ($header as $colonne) {
            $this->Cell(37.5, 10, $colonne, 1, 0, 'C');
        }
        $this->Ln();

        $this->SetFont('Arial', '', 12);
        for ($i=0; $i < count($produits); $i++) { 
            $this->Cell(37.5, 10, $produits[$i]['designation'], 1, 0, 'C');
            $this->Cell(37.5, 10, $produits[$i]['nom'], 1, 0, 'C');
            $this->Cell(37.5, 10, $produits[$i]['prix_unitaire'], 1, 0, 'C');
            $this->Cell(37.5, 10, $produits[$i]['nombre'], 1, 0, 'C');
            $this->Cell(37.5, 10, $produits[$i]['montant'], 1, 0, 'C');
            $this->Ln();   
        }
    }

    function TableauTotaux($totaux) {
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(37.5*3, 10, '', 0, 0); 
        $this->Cell(37.5, 10, 'Montant HT', 1, 0, 'C');
        $this->SetFont('Arial', '', 12);
        $this->Cell(37.5, 10, $totaux['montant_ht'], 1, 0, 'C');
        $this->Ln();
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(37.5*3, 10, '', 0, 0); 
        $this->Cell(37.5, 10, 'TVA', 1, 0, 'C');
        $this->SetFont('Arial', '', 12);
        $this->Cell(37.5, 10, $totaux['montant_tva'], 1, 0, 'C');
        $this->Ln();
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(37.5*3, 10, '', 0, 0); 
        $this->Cell(37.5, 10, 'Montant TTC', 1, 0, 'C');
        $this->SetFont('Arial', '', 12);
        $this->Cell(37.5, 10, $totaux['monntant_ttc'], 1, 0, 'C');
        $this->Ln();
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(37.5*3, 10, '', 0, 0); 
        $this->Cell(37.5, 10, 'Avance', 1, 0, 'C');
        $this->SetFont('Arial', '', 12);
        $this->Cell(37.5, 10, $totaux['montant_avance'], 1, 0, 'C');
        $this->Ln();
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(37.5*3, 10, '', 0, 0); 
        $this->Cell(37.5, 10, 'Net a payer', 1, 0, 'C');
        $this->SetFont('Arial', '', 12);
        $this->Cell(37.5, 10, $totaux['net_payer'], 1, 0, 'C');
        $this->Ln();
        $this->Ln(10); 
    }

    function SommeEnLettre($montant) {
        $this->SetFont('Arial', '', 12);
        $this->Cell(0, 10, 'Facture arrete a la somme de : ' . $montant.' Ariary', 0, 1);
        $this->Ln(10);
    }

    function Footer() {
        $this->SetFont('Arial', 'I', 10);
        $this->Cell(30, 10, '', 0, 0, 'L');
        $this->Cell(20, 10, 'DIMPLEX', 0, 0, 'L'); 
        $this->Cell(90, 10, '', 0, 0, 'L');
        $this->Cell(0, 10, 'Le client', 0, 0, 'L');
    }
}
?>
