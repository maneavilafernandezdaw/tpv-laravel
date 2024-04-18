<?php

namespace App\Http\Controllers;

use App\Mail\ReportMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class ReportController extends Controller
{
   public function report(): View
   {
    return view('report.index');
   }
   public function sendReport(Request $request)
   {
     
      $data = [
         'subject' => "Factura Minibar",
         'content' => "Descarga el archivo.",
       
     ];


     Mail::to('maneavila78@gmail.com')->send(new ReportMail($data));
   }
}
