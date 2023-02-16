<?php
require('../../../fpdf/fpdf.php');

class PDFF extends FPDF
{
// Cabecera de página
function Header()
{
    // Logo
    $this->Image('../../images/logo2.png',15,1,40);
    // Arial bold 15
    $this->SetFont('Arial','B',15);
    // Movernos a la derecha
    $this->Cell(80);
    // Título
    
    $this->Cell(30,5,'LICORERIA',0,0,'C');
    $this->Ln(5);
    $this->SetFont('Arial','',12);
    $this->Cell(200,5,'Atahualpa y Teodoro Gomez',0,0,'C');
    $this->Cell(30);
    $this->Cell(30,5,'Factura',1,2,'C');
    //Fecha
    $this->SetFont('Arial','',10);
   
    
   
    $this->SetY(1);
    $this->SetX(-35);
     $this->Cell(30,20,'Fecha:'.date("d/m/y"),0,0,'C');
   
     //Cliente
     $this->Ln(10);

    // Salto de línea
    $this->Ln(30);
    $this->Ln(10);
 

   
 
}

// Pie de página
function Footer()
{
    // Posición: a 1,5 cm del final
    $this->SetY(-35);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    //Imagen
    $this->Image('../../images/logo.png',50,240,75);
    // Número de página
    $this->Cell(0,45,'Pagina '.$this->PageNo().'/{nb}',0,0,'C');
}
}
?>