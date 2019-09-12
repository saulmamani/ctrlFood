<?php

namespace App\Http\Controllers;

use App\Models\Detail;
use App\Models\Sale;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;

class ReporteController extends Controller
{
    public function print_recibo($id)
    {
        $sale = Sale::findOrFail($id);
        $details = Detail::where('sales_id', $id)->get();
        return view('reports.recibo')->with(['sale'=>$sale, 'details'=>$details]);
//        $pdf = \PDF::loadView('reports.recibo', ['sale' => $sale, 'details' => $details])
//            ->setPaper(array(100,100,0,0))->setWarnings(false)->save('recibo.pdf');
//        return $pdf->stream();
    }
}
