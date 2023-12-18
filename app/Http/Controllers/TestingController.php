<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Barryvdh\DomPDF\Facade\Pdf;
use PDF;

class TestingController extends Controller
{
    public function index()
    {
        $pdf = Pdf::loadView('backend.testing');
        return $pdf->stream();
        // return view('backend.testing');
    }

    public function testingku()
    {
        // $files = 'newteach.pbworks.com%2Ff%2Fele%2Bnewsletter.docx';
        // $files = 'Testingku.docx';
        $files = asset('Testingku.docx');
        $url_encode = rawurlencode($files);
        // dd($files);
        // dd($url_encode);

        // persiapkan curl

        $ch = curl_init(); 
        // curl_setopt($ch, CURLOPT_URL, "https://view.officeapps.live.com/op/view.aspx?src=".$url_encode);
        curl_setopt($ch, CURLOPT_URL, "https://docs.google.com/gview?url=".$url_encode."&embedded=true");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
        $output = curl_exec($ch); 
        curl_close($ch);      

        echo $output;

        // $data['files'] = asset('Testingku.docx');
        // $data['files'] = urlencode(asset('Testingku.docx'));
        // dd($data);
        // $data['viewer'] = "<iframe src='https://view.officeapps.live.com/op/embed.aspx?src=$files' width='1366px' height='623px' frameborder='0'>";
        // return view('backend.testing',$data);
    }

    public function convertWordToPDF()
    {
        $domPdfPath = base_path('vendor/dompdf/dompdf');
        \PhpOffice\PhpWord\Settings::setPdfRendererPath($domPdfPath);
        \PhpOffice\PhpWord\Settings::setPdfRendererName('DomPDF');

        //Load word file
        $files = asset('Testingku.docx');
        $filess = asset('result3.pdf');
        $Content = \PhpOffice\PhpWord\IOFactory::load(public_path('Testingku.docx')); 

        //Save it into PDF
        $PDFWriter = \PhpOffice\PhpWord\IOFactory::createWriter($Content,'PDF');
        // $PDFWriter->save(public_path('result3.pdf'));
        // return $PDFWriter;
        // $pdf = new PDF();
        // $pdf->output($filess);
        return $PDFWriter;
        // echo 'File has been successfully converted';
    }

    public function convertWordToPDF2()
    {
            /* Set the PDF Engine Renderer Path */
        $domPdfPath = base_path('vendor/dompdf/dompdf');
        \PhpOffice\PhpWord\Settings::setPdfRendererPath($domPdfPath);
        \PhpOffice\PhpWord\Settings::setPdfRendererName('DomPDF');
         
        //Load word file
        $Content = \PhpOffice\PhpWord\IOFactory::load(public_path('Testingku.docx')); 

        //Save it into PDF
        $PDFWriter = \PhpOffice\PhpWord\IOFactory::createWriter($Content,'PDF');
        $PDFWriter->save(public_path('Testingku.pdf')); 
        // $PDFWriter->load(public_path('Testingku.pdf')); 

        // $link = asset('Testingku.pdf');

        // $link = $PDFWriter;

        // return view('backend.testing',compact('link'));

        echo 'File has been successfully converted';
    }
}
