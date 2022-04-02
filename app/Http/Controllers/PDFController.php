<?php

namespace App\Http\Controllers;

use App\Models\pdf as ModelsPdf;
use Barryvdh\DomPDF\Facade as PDF;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PDFController extends Controller
{
    public function generatePDF()
    {
        $data = [
            'title' => 'Welcome to NRB BD Solution',
            'date' => date('m/d/Y')
        ];

        $pdf = PDF::loadView('myPDF', $data);

        return $pdf->stream('document.pdf');
    }

    public function submit(Request $request){

        $pdfsubmit= new ModelsPdf();
        $pdfsubmit->text_1= $request->text_1;
        $pdfsubmit->text_2= $request->text_2;

        $pdfsubmit->save();

        $dataa= ModelsPdf::where('id',$pdfsubmit->id)->first();
        $data = [
            'text' => $dataa->text_1,
            'title' => $dataa->text_2,
        ];

        $pdf = PDF::loadView('myPDF', $data)->setOptions(['defaultFont' => 'sans-serif']);
        $namePdf=uniqid();
       $pdfsubmit->file= $namePdf.'test.pdf';

        $pdfsubmit->save();
        Storage::put('public/'.$namePdf.'test.pdf', $pdf->output());

        return $pdf->stream('document.pdf');

    }
}
