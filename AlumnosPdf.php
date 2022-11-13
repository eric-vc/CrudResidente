<?php

    require ('fpdf/fpdf.php');
    class PDF extends FPDF
{
// Cabecera de página
function Header()
{
    // Logo
    $this->Image('istzlogo.png',10,8,33);
    // Arial bold 15
    $this->SetFont('Arial','B',15);
    // Movernos a la derecha
    $this->Cell(70);
    // Título
    $this->Cell(30,10,'Alumnos Registrados','C');
    // Salto de línea
    $this->Ln(20);
}

// Pie de página
function Footer()
{
    // Posición: a 1,5 cm del final
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Número de página
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}
}
$pdf = new PDF();
require('conexion.php');
$grupo1="SELECT * FROM Grupos";
$congru=$conn->query($grupo1);
while ($filagru=$congru->fetch_array()) {


$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','',9);
$pdf->SetFillColor(2,157,116);//Fondo verde de celda
$pdf->SetTextColor(240, 255, 240); //Letra color blanco

$pdf->Cell(10);
    $pdf->Cell(155,10,'Grupo: '.$filagru['NombreGru'],1,1,'C',true);

$pdf->Cell(10);
$pdf->Cell(15,10,'Matricula',1,0,'C',true);
$pdf->Cell(60,10,'nombre de Alumnos',1,0,'C',true);
$pdf->Cell(40,10,'Grupo',1,0,'C',true);
$pdf->Cell(40,10,'Periodo',1,1,'C',true);

    # code..
    
    $csAlumnos="SELECT * FROM Alumnos WHERE IdGrupo='".$filagru['IdGrupos']."' ORDER BY NombreAl";
$conexA=$conn->query($csAlumnos);
// Creación del objeto de la clase heredada

$pdf->SetFillColor(229, 229, 229); //Gris tenue de cada fila
    $pdf->SetTextColor(3, 3, 3); //Color del texto: Negro
    $bandera = false; //Para alternar el relleno
while ($filap=$conexA->fetch_array()) {
    # code...
    $csgrupo="SELECT * FROM Grupos WHERE IdGrupos=".$filap['IdGrupo'];
    $connG=$conn->query($csgrupo);
    $pdf->Cell(10);
    $pdf->Cell(15,10,utf8_decode($filap['Matricula']),1,0,'C',$bandera);
    $pdf->Cell(60,10,utf8_decode($filap['NombreAl']),1,0,'C',$bandera);
    $filag1=$connG->fetch_array();
    //while () {
    //$pdf->Cell(80,10,utf8_decode($fila1['PeriodoGrup']),1,1,'C',$bandera);
    //
        # code...
       $pdf->Cell(40,10,utf8_decode($filag1['NombreGru']),1,0,'C',$bandera);
       $pdf->Cell(40,10,utf8_decode($filag1['PeriodoGrup']),1,1,'C',$bandera);
    //}
    
    $bandera = !$bandera;//Alterna el valor de la bandera
    
}

}
$pdf->Output();

?>