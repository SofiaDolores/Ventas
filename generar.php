<?php
date_default_timezone_set('America/Mexico_City');
$conecta = mysqli_connect('localhost', 'unidsyst_sofia', 'kookiedolores', 'unidsyst_imagosofia');

if (!$conecta) {
    die('No pudo conectarse: ' . mysqli_connect_error());
}
if (!mysqli_set_charset($conecta, 'utf8')) {
    die('Error al establecer el conjunto de caracteres: ' . mysqli_error($conecta));
}

$folio = $_GET['imprimir'];
include_once("fpdf.php");

if (isset($folio)) {
    $stmt = $conecta->prepare("SELECT * FROM cibermedio WHERE folio = ?");
    $stmt->bind_param("s", $folio);
    $stmt->execute();
    $res = $stmt->get_result();
    $exp = $res->fetch_assoc();

    $clave = $exp['folio'];
    $fecha = $exp['fecha'];
    $hora = $exp['hora'];
    $titulo = $exp['titulo'];
    $cibermedio = $exp['cibermedio'];
    $grupo = $exp['grupo'];
    $url = $exp['url'];
    $pais = $exp['pais'];
    $idioma = $exp['idioma'];
    $categorizacion = $exp['categorizacion'];
    $notas = $exp['notas'];

    $stmt->close();
    mysqli_close($conecta);
}

class PDF_MC_Table extends FPDF
{
    function Footer()
    {
        $this->SetFont('Arial', 'B', 11);
        $this->SetXY(88, 240);
        $this->Cell(40, 5, utf8_decode('A T E N T A M E N T E'), 0, 0, 'C');
        $this->SetXY(78, 258);
        $this->Cell(60, 5, utf8_decode('María Sofía Dolores Cristóbal'), 'T', 0, 'C');
        $this->SetXY(78, 262);
        $this->Cell(60, 5, utf8_decode('Cibermedios Tuxpan, Veracruz'), 0, 0, 'C');
        $this->SetXY(18, 246);
    }

    function Header()
    {
        $this->SetXY(10, 45);
        $this->SetFont('Arial', 'B', 17);
        $this->Cell(20, 15, '', 0, 0, 'C', $this->Image('logo.png', 12, 8, 24));
        $this->Cell(20, 15, '', 0, 0, 'C', $this->Image('logo.png', 160, 8, 30));

        $this->SetXY(82, 15);
        $this->Cell(40, 5, utf8_decode('Cibermedios Tuxpan, Veracruz'), 0, 0, 'C');

        $this->SetFont('Arial', 'B', 14);
        $this->SetXY(145, 37);
        $this->Cell(16, 5, 'Folio:', 0, 0, 'R');
        $this->SetXY(160, 37);
        $this->Cell(30, 5, $GLOBALS['folio'], 0, 0, 'L');

        $this->SetFont('Arial', 'B', 14);
        $this->SetXY(72, 37);
        $this->Cell(50, 5, utf8_decode('Sistema de Cibermedios Tuxpan, Ver'), 0, 0, 'C');
        $this->Ln(22);
    }
}

$pdf = new PDF_MC_Table();
$pdf->AddPage();
$pdf->AliasNbPages();
$pdf->SetFont('Arial', 'B', 12);

// De aquí en adelante se colocan distintos métodos para diseñar el formato.
$pdf->SetXY(50, 60);
$pdf->Cell(10, 5, 'Folio:', 0, 0, 'R');
$pdf->SetXY(59, 60);
$pdf->Cell(30, 5, utf8_decode($clave), 0, 0, 'L');

// Repite para el resto de los campos
// ...

$pdf->Output(); // Salida al navegador
?>