<?php

namespace App\Http\Controllers;

use App\Models\Detail;
use App\Models\Sale;
use App\Patrones\Permiso;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReporteController extends Controller
{

    /**
     * ReporteController constructor.
     */
    public function __construct()
    {
        $this->middleware('administrador')->only(['reporte_estadistico']);
    }

    public function print_recibo($id)
    {
        $sale = Sale::findOrFail($id);
        $details = Detail::where('sales_id', $id)->get();
        return view('reports.recibo')->with(['sale' => $sale, 'details' => $details]);
    }

    public function reporte_economico(Request $request)
    {
        try {
            $input = $request->all();
            $sales = $this->search_form($request, $input);

            $pdf = \PDF::loadView('reports.economico', ['sales' => $sales])
                ->setPaper("letter", "portrait")->setWarnings(false);
            return $pdf->stream();
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function reporte_estadistico(Request $request)
    {
        $anio = date("Y");
        if ($request->txtAnio)
            $anio = $request->txtAnio;

        $totales = DB::select("select to_char(s.fecha, 'TMMonth') as mes, sum(d.precio * d.cantidad) as total
                                    from sales s
                                             inner join details d on s.id = d.sales_id
                                    where extract(year  from s.fecha) = ?
                                    group by to_char(s.fecha, 'TMMonth'), extract(month from s.fecha)", [$anio]);

        $clientes = DB::select("select s.razon_social, sum(d.precio * d.cantidad) as total
                                    from sales s inner join details d on s.id = d.sales_id
                                    group by s.razon_social
                                    order by total desc");

        $ymax = 0;
        foreach ($totales as $row)
            if ($row->total > $ymax)
                $ymax = $row->total;

        return view('reports.estadistico')
            ->with(['totales' => $totales, 'ymax' => $ymax, 'clientes' => $clientes]);
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


        $txtBuscar = $request->txtBuscar;
        if (is_null($txtBuscar))
            $txtBuscar = '';

        $sales = Sale::whereEstado($request->txtEstado)
            ->whereBetween('fecha', [$dtpInicio, $dtpFinal])
            ->where(function ($q) use ($txtBuscar) {
                $q->where('razon_social', 'like', '%' . $txtBuscar . '%')
                    ->orwhere('numero_ticket', 'like', '%' . $txtBuscar . '%')
                    ->orWhere('nit', 'like', '%' . $txtBuscar . '%');
            })
            ->orderBy('id', 'desc')->get();

        return $sales;
    }
}
