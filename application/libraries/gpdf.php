<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once APPPATH . 'third_party\fpdf185\fpdf.php';

class GPDF extends FPDF
{
    public function __construct()
    {
        parent::__construct();
    }
    
    function analyse($header, $data) {
        // Largeurs des colonnes
        $w = array(45, 30);
        // En-tête
        $this->SetFont('Arial', 'B', 0);
        for($i=0;$i<count($header);$i++)
            $this->Cell($w[$i],10,$header[$i],1,0,'C');
        $this->Cell(70, 5, 'MONTANT',1,1,'C');
        $this->Cell($this->sum($w), 5, '',0,0,'');
        $this->Cell(10, 5, 'Brute', 1, 0, 'C');
        $this->Cell(30, 5, 'Ammortissement', 1, 0, 'C');
        $this->Cell(30, 5, 'Net', 1, 0, 'C');
        $this->Ln();
        // Données
        $this->SetFont('Arial', '', 0);
        $this->content($data['anc'], 'ACTIF NON COURANT', $w);
        $this->content($data['ac'], 'ACTIF COURANT', $w);

        $tot = $data['anc'][1][2]+$data['ac'][1][2];
        
        // Trait de terminaison
        $this->SetFont('Arial', 'B', 0);
        // $this->Cell($this->sum($w)+10, 7, 'TOTAL', 1, 0, 'L');
        // $this->Cell(30, 7, number_format(2500000, 2, '.', ' '), 1, 0, 'R');
        // $this->Cell(30, 7, number_format(2500000, 2, '.', ' '), 1, 0, 'R');
        // $this->Ln();
        $this->Cell($this->sum($w)+10, 7, 'TOTAL', 1, 0, 'L');
        $this->Cell(60, 7, number_format($tot, 2, '.', ' '), 1, 0, 'R');

        $this->Ln();
        
    }

    function sum($tab) {
        $s = 0;
        foreach ($tab as $t) {
            $s += $t;
        }
        return $s;
    }

    function content($data, $name, $w) {
        $this->SetFont('Arial', 'B', 0);
        $this->Cell($w[0] + $w[1] + 70  , 7, $name, 1, 0, 'L');
        $this->SetFont('Arial', '', 0);
        $this->Ln();
        $i = 0;
        foreach($data[0] as $row)
        {
            $this->Cell($w[0],7,$row['nom'],1, 0, 'L');
            $this->Cell($w[1],7,$row['con'],1, 0, 'R');
            $this->Cell(10, 7, number_format($row['brut'], 2, '.', ' '), 1, 0, 'R');
            $this->Cell(30, 7, number_format($row['ap'], 2, '.', ' '), 1, 0, 'R');
            $this->Cell(30, 7, number_format($row['net'], 2, '.', ' '), 1, 0, 'R');
            $this->Ln();
            $i++;
        }
    }
}

?>
