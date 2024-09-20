<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CertificadoBautismoRequest;
use Illuminate\Http\Request;
use Codedge\Fpdf\Fpdf\Fpdf;
use DateTime;

class CertificadoController extends Controller
{
    protected $fpdf;

    public function __construct()
    {
        $this->fpdf = new Fpdf;
        $this->middleware('can:admin.certificado.bautismo.certificadoBautismo')->only('certificadoBautismo');

    }

    public function certificadoBautismo()
    {
        return view('admin.certificados.bautismos.index');
    }

    public function diplomaBautismo()
    {
        return view('admin.certificados.diploma-bautismo.index');
    }

    public function downloadCertificadoBautismo(CertificadoBautismoRequest $request)
    {
        // Convertir el nombre a title case (primera letra de cada palabra en mayúscula)
        $nombre = mb_convert_case($request->nombre, MB_CASE_TITLE, "UTF-8");
        
        $municipio = $request->municipio;
        $fecha = date($request->start);
    
        $dateTime = new DateTime($fecha);
        
        // Array con los nombres de los meses en español
        $meses = array("enero", "febrero", "marzo", "abril", "mayo", "junio", "julio", "agosto", "septiembre", "octubre", "noviembre", "diciembre");
        
        // Formatear la fecha manualmente
        $dia = $dateTime->format('d');
        $mes = ucfirst($meses[$dateTime->format('n') - 1]);  // Primera letra del mes en mayúscula
        $anio = $dateTime->format('Y');
        $formattedDate = "El $dia de $mes del $anio";
    
        $pdf = new FPDF('L', 'mm', 'Letter');
        $pdf->AddPage();
        $pdf->SetTitle("Certificado de bautismo");
    
        $pdf->SetFont('Arial', 'B', 20);
    
        $this->showImagenPDF(3, 3, 273, 210, $pdf, 'https://ipucd13.nyc3.cdn.digitaloceanspaces.com/certificados/bautismo/Certificado-bautismo.png');
        $pdf->Ln(80);
    
        $pdf->SetTextColor(0, 51, 141);
        $pdf->SetX(20);
    
        $pdf->Cell(150, 10, mb_convert_encoding($nombre, 'ISO-8859-1'), 0, 0, 'C');
    
        $pdf->Ln(41);
    
        $pdf->SetTextColor(0, 0, 0);
    
        $pdf->SetFont('Arial', '', 11);
        $pdf->Ln(0);
    
        $pdf->SetX(65);
        $pdf->Cell(115, 11, mb_convert_encoding($municipio . ', ' . $formattedDate, 'ISO-8859-1'), 0, 0, 'L');
    
        header('Content-Type: application/pdf');
        header('Content-Disposition: inline; filename="certificado-bautismo.pdf"');
    
        $pdf->Output('I');
        exit;
    }
    
    public function downloadDiplomaBautismo()
    {
        return 'Se requiere la imagen';
    }



    public function showImagenPDF($x, $y, $width, $height, $pdf, $urlImagen)
    {
        // Establecer la posición y tamaño del código de barras en la página
        /*
        $x = 10;
        $y = 30;
        $width = 0;
        $height = 10;
        */
        $pdf->Image($urlImagen, $x, $y, $width, $height);
    }


}
