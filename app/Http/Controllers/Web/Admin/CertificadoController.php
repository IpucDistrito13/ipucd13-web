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
        $nombre = $request->nombre;
        setlocale(LC_TIME, 'es_ES.UTF-8', 'es_ES', 'es');
    
        $municipio = $request->municipio;
        $fecha  = date($request->start);
    
        $dateTime = new DateTime($fecha);
        $formattedDate = strftime('el %d %B del %Y', $dateTime->getTimestamp());
    
        $formattedDate = strtolower($formattedDate);
        $formattedDate = preg_replace_callback('/(\w+)( del)/', function ($matches) {
            return ucfirst($matches[1]) . $matches[2];
        }, $formattedDate);
    
        $pdf = new FPDF('L', 'mm', 'Letter');
        $pdf->AddPage();
        $pdf->SetTitle("Certificado de bautismo");
    
        $pdf->SetFont('Arial', 'B', 20);
    
        $this->showImagenPDF(3, 3, 273, 210, $pdf, 'https://ipucd13.nyc3.cdn.digitaloceanspaces.com/certificados/bautismo/certificado-bautismo.jpg');
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

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
