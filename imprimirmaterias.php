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
    $this->Cell(65);
    // Título
    $this->Cell(30,10,'Materias para este grupo','C');
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
require('conexion.php');
if (isset($_GET["materias"])) {
    
    # code...
    $datosm=$_GET['materias'];
    $csmaterias="SELECT * FROM MateriasGrupo WHERE IdGrupo='$datosm'";
    $conexM=$conn->query($csmaterias);
    if ($conexM->num_rows > 0) {
        # code...
        $pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','',9);
$pdf->SetFillColor(2,157,116);//Fondo verde de celda
$pdf->SetTextColor(240, 255, 240); //Letra color blanco
$pdf->Cell(7);
$pdf->Cell(40,10,'Materia',1,0,'C',true);
$pdf->Cell(60,10,'nombre del Docente',1,0,'C',true);
$pdf->Cell(40,10,'Grupo',1,0,'C',true);
$pdf->Cell(40,10,'Periodo',1,1,'C',true);
$pdf->SetFillColor(229, 229, 229); //Gris tenue de cada fila
    $pdf->SetTextColor(3, 3, 3); //Color del texto: Negro
    $bandera = false; //Para alternar el relleno
    
while ($filap=$conexM->fetch_array()) {
    # code...
    $csgrupo="SELECT * FROM Grupos WHERE IdGrupos=".$filap['IdGrupo'];
    $nmt="SELECT * FROM Materias WHERE IdMateria=".$filap['IdMaterias'];
    $ndt="SELECT * FROM Profesor WHERE IdProfe=".$filap['IdProfe'];
    $connG=$conn->query($csgrupo);
    $conmt=$conn->query($nmt);
    $condt=$conn->query($ndt);
   
    
    while (($filamat=$conmt->fetch_array())&&($filadocen=$condt->fetch_array())&&($filag1=$connG->fetch_array())) {
        # code...
        $pdf->Cell(7);
        $pdf->Cell(50,10,utf8_decode($filamat['Nombre']),1,0,'C',$bandera);
        $pdf->Cell(50,10,utf8_decode($filadocen['NombreP']),1,0,'C',$bandera);
        $pdf->Cell(40,10,utf8_decode($filag1['NombreGru']),1,0,'C',$bandera);
       $pdf->Cell(40,10,utf8_decode($filag1['PeriodoGrup']),1,1,'C',$bandera);
    //}
    
    $bandera = !$bandera;//Alterna el valor de la bandera
    }
    
    //while () {
    //$pdf->Cell(80,10,utf8_decode($fila1['PeriodoGrup']),1,1,'C',$bandera);
    //
        # code...
       
}
    }else{
        $pdf = new PDF();
        $pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','',9);
$pdf->SetFillColor(248,28,28);//Fondo verde de celda
$pdf->SetTextColor(0,0,0); //Letra color blanco
$pdf->Cell(40);
$pdf->Cell(100,10,'No se encontro ninguna materia para este grupo',1,0,'C',true);

$pdf->Output(); 
    }

// Creación del objeto de la clase heredada

}

$pdf->Output();
?>