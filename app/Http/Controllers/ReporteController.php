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
        return view('reports.recibo')->with(['sale' => $sale, 'details' => $details]);
//        $pdf = \PDF::loadView('reports.recibo', ['sale' => $sale, 'details' => $details])
//            ->setPaper(array(100,100,0,0))->setWarnings(false)->save('recibo.pdf');
//        return $pdf->stream();
    }

    public function reporte_economico(Request $request)
    {
        $input = $request->all();
        $sales = $this->search_form($request, $input);

//        return view("reports.economico")->with('sales', $sales);
        $pdf = \PDF::loadView('reports.economico', ['sales' => $sales])
                        ->setPaper("letter", "portrait")->setWarnings(false)->save('report.pdf');
        return $pdf->stream();
    }

    /**
     * @param Request $request
     * @param array $input
     * @return mixed
     */
    public function search_form(Request $request, array $input)
    {
        //formateando fechas
        $dtpInicio = \DateTime::createFromFormat('Y-m-d H:i:s', date('Y-m-d') . ' 00:00:00');
        $dtpFinal = \DateTime::createFromFormat('Y-m-d H:i:s', date('Y-m-d') . ' 23:59:59');
        if (!empty($request->txtDesde) && !empty($request->txtHasta)) {
            $dtpInicio = \DateTime::createFromFormat('d/m/Y H:i:s', date($request->txtDesde) . ' 00:00:00');
            $dtpFinal = \DateTime::createFromFormat('d/m/Y H:i:s', date($request->txtHasta) . ' 23:59:59');
        }


        if (count($input) > 0 && !is_null($request->txtEstado)) {
            $txtBuscar = $request->txtBuscar;
            if (is_null($txtBuscar))
                $txtBuscar = '';

            $sales = Sale::where('estado', $request->txtEstado)
                ->whereBetween('fecha', [$dtpInicio, $dtpFinal])
                ->where(function ($q) use ($txtBuscar) {
                    $q->where('razon_social', 'like', '%' . $txtBuscar . '%')
                        ->orwhere('numero_ticket', 'like', '%' . $txtBuscar . '%')
                        ->orWhere('nit', 'like', '%' . $txtBuscar . '%');
                })
                ->orderBy('id', 'desc')->get();
        } else {
            $sales = Sale::where('estado', 1)->whereBetween('fecha', [$dtpInicio, $dtpFinal])->orderBy('id', 'desc')->get();
        }
        return $sales;
    }
}
