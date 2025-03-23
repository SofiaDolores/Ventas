<?php
date_default_timezone_set('America/Mexico_City');
     $conecta =  mysqli_connect('localhost', 'unidsyst_sofia', 'kookiedolores', 'unidsyst_imagosofia');
   if (!mysqli_set_charset($conecta,'utf8')) {
    die('No pudo conectarse: ' . mysqli_connect_error());
    }
$GLOBALS['folio']=$_GET['imprimir'];
include_once("fpdf.php");
if(isset($GLOBALS['folio'])){
$queja = "SELECT * FROM cibermedio WHERE folio = '$GLOBALS[folio]'";
	   $res = mysqli_query($conecta,$queja);
	   while ($exp=mysqli_fetch_array($res)) {
		  $GLOBALS['clave']=$exp['folio']; 
		  $GLOBALS['telefono']=$exp['fecha'];
		  $GLOBALS['denunciante']=$exp['hora'];
		  $GLOBALS['mail']=$exp['titulo'];
		  $GLOBALS['denuncia']=$exp['cibermedio'];
		  $GLOBALS['fechor']=$exp['grupo'];
		  $GLOBALS['enlace']=$exp['url'];
		  $GLOBALS['ciudad']=$exp['pais'];
		  $GLOBALS['lengua']=$exp['idioma'];
		  $GLOBALS['cate']=$exp['categorizacion'];
		  $GLOBALS['observacion']=$exp['notas'];
	   }
	    mysqli_close($conecta);
}
class PDF_MC_Table extends FPDF
{
function Footer(){
        $this->SetFont('Arial','B',11);
		$this->SetXY(88,240);
		$this->Cell(40,5,utf8_decode('A T E N T A M E N T E'),0,0,'C');
		$this->SetXY(78,258);
		$this->Cell(60,5,utf8_decode('María Sofía Dolores Cristóbal'),'T',0,'C');
		$this->SetXY(78,262);
		$this->Cell(60,5,utf8_decode('Cibermedios Tuxpan, Veracruz'),0,0,'C');
		$this->SetXY(18,246);
	    }
 function Header(){
         
        $this->SetXY(10,45);
		$this->SetFont('Arial','B',17);
        $this->Cell(20,15,'',0,0,'C', $this->Image('logo.png',12,8,24));
        $this->Cell(20,15,'',0,0,'C',$this->Image('logo.png', 160, 8, 30));
		
		$this->SetXY(82,15);
		$this->Cell(40,5,utf8_decode('Cibermedios Tuxpan, Veracruz'),0,0,'C');
		
		$this->SetFont('Arial','B',14);
		$this->SetXY(72,37);
		$this->Cell(50,5,utf8_decode('Sistema de Cibermedios Tuxpan, Ver'),0,0,'C');
		$this->Ln(22);
	
    }	
}

$pdf = new PDF_MC_Table();
$pdf->AddPage();
$pdf->AliasNbPages();
$pdf->SetFont('Arial','B', 12);

//De aqui en adelante se colocan distintos métodos
//para diseñar el formato.
$pdf->SetFont('Arial','B', 12);
$pdf->SetXY(50,60);
$pdf->Cell(10,5,'Folio:',0,0,'R');

$pdf->SetFont('Arial','', 12);
$pdf->SetXY(59,60);
$pdf->Cell(30,5,utf8_decode($GLOBALS['clave']),0,0,'L');

$pdf->SetFont('Arial','B', 12);
$pdf->SetXY(50,67);
$pdf->Cell(10,5,utf8_decode('Fecha:'),0,0,'R');
$pdf->SetFont('Arial','', 12);
$pdf->SetXY(59,67);
$pdf->Cell(30,5,utf8_decode($GLOBALS['telefono']),0,0,'L');

$pdf->SetFont('Arial','B', 12);
$pdf->SetXY(50,74);
$pdf->Cell(10,5,'Hora:',0,0,'R');
$pdf->SetFont('Arial','', 12);
$pdf->SetXY(59,74);
$pdf->Cell(40,5,utf8_decode($GLOBALS['denunciante']),0,0,'L');

$pdf->SetFont('Arial','B', 12);
$pdf->SetXY(50,80);
$pdf->Cell(10,5,'Nombre:',0,0,'R');
$pdf->SetFont('Arial','', 12);
$pdf->SetXY(59, 80);
$pdf->Cell(135,5,utf8_decode($GLOBALS['mail']), 0, 'L');

$pdf->SetFont('Arial','B', 12);
$pdf->SetXY(50,87);
$pdf->Cell(10,5,'Cibermedio:',0,0,'R');
$pdf->SetFont('Arial','', 12);
$pdf->SetXY(59,87);
$pdf->Cell(135,5,utf8_decode($GLOBALS['denuncia']),0,0,'L');

$pdf->SetFont('Arial','B', 12);
$pdf->SetXY(50,94);
$pdf->Cell(10,5,'Grupo:',0,0,'R');
$pdf->SetFont('Arial','', 12);
$pdf->SetXY(59,94);
$pdf->Cell(135,5,utf8_decode($GLOBALS['fechor']),0,0,'L');

$pdf->SetFont('Arial','B', 12);
$pdf->SetXY(50,100);
$pdf->Cell(10,5,'URL:',0,0,'R');
$pdf->SetFont('Arial','', 12);
$pdf->SetXY(59,100);
$pdf->Cell(135,5,utf8_decode($GLOBALS['enlace']),0,0,'L');

$pdf->SetFont('Arial','B', 12);
$pdf->SetXY(50,107);
$pdf->Cell(10,5,utf8_decode('Pais:'),0,0,'R');
$pdf->SetFont('Arial','', 12);
$pdf->SetXY(59,107);
$pdf->Cell(30,5,utf8_decode($GLOBALS['ciudad']),0,0,'L');

$pdf->SetFont('Arial','B', 12);
$pdf->SetXY(50,114);
$pdf->Cell(10,5,'Idioma:',0,0,'R');
$pdf->SetFont('Arial','', 12);
$pdf->SetXY(59,114);
$pdf->Cell(40,5,utf8_decode($GLOBALS['lengua']),0,0,'L');

$pdf->SetFont('Arial','B', 12);
$pdf->SetXY(50,120);
$pdf->Cell(10,5,'Categorizacion:',0,0,'R');
$pdf->SetFont('Arial','', 12);
$pdf->SetXY(59, 120);
$pdf->Cell(135,5,utf8_decode($GLOBALS['cate']), 0, 'L');

$pdf->SetFont('Arial','B', 12);
$pdf->SetXY(50,127);
$pdf->Cell(10,5,'Notas:',0,0,'R');
$pdf->SetFont('Arial','', 12);
$pdf->SetXY(59,127);
$pdf->Cell(135,5,utf8_decode($GLOBALS['observacion']),0,0,'L');

$pdf->Output(); //Salida al navegador
 
?>