<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSaleRequest;
use App\Http\Requests\UpdateSaleRequest;
use App\Models\Sale;
use App\Patrones\Fachada;
use App\Repositories\SaleRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class SaleController extends AppBaseController
{
    /** @var  SaleRepository */
    private $saleRepository;

    public function __construct(SaleRepository $saleRepo)
    {
        $this->saleRepository = $saleRepo;
    }

    /**
     * Display a listing of the Sale.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $input = $request->all();

        //formateando fechas
        $dtpInicio = \DateTime::createFromFormat('Y-m-d H:i:s', date('Y-m-d').' 00:00:00');
        $dtpFinal = \DateTime::createFromFormat('Y-m-d H:i:s',  date('Y-m-d').' 23:59:59');
        if(!empty($request->txtDesde) && !empty($request->txtHasta))
        {
            $dtpInicio = \DateTime::createFromFormat('d/m/Y H:i:s',date($request->txtDesde).' 00:00:00');
            $dtpFinal  = \DateTime::createFromFormat('d/m/Y H:i:s',date($request->txtHasta).' 23:59:59');
        }


        if(count($input) > 0 && !is_null($request->txtEstado))
        {
            $txtBuscar = $request->txtBuscar;
            if(is_null($txtBuscar))
                $txtBuscar= '';

            $sales = Sale::where('estado', $request->txtEstado)
                ->whereBetween('fecha', [$dtpInicio, $dtpFinal])
                ->where(function($q) use ($txtBuscar){
                    $q->where('razon_social', 'like', '%'.$txtBuscar.'%')
                        ->orwhere('numero_ticket', 'like', '%'.$txtBuscar.'%')
                        ->orWhere('nit', 'like', '%'.$txtBuscar.'%');
                })
                ->orderBy('id', 'desc')->get();
        }
        else
        {
            $sales = Sale::where('estado', 1)->whereBetween('fecha', [$dtpInicio, $dtpFinal])->orderBy('id', 'desc')->get();
        }

        return view('sales.index')
            ->with('sales', $sales);
    }

    private function ultimo_numero()
    {
        $numero = Sale::all()->max('numero');
        if(\is_null($numero))
            return 0;
        else
            return $numero;
    }

    private function ultimo_ticket()
    {
        $dtpInicio = \DateTime::createFromFormat('Y-m-d H:i:s', date('Y-m-d').' 00:00:00');
        $dtpFinal = \DateTime::createFromFormat('Y-m-d H:i:s',  date('Y-m-d').' 23:59:59');

        $numero = Sale::all()->whereBetween('fecha', [$dtpInicio, $dtpFinal])->max('numero_ticket');
        if(\is_null($numero))
            return 0;
        else
            return $numero;
    }

    /**
     * Show the form for creating a new Sale.
     *
     * @return Response
     */
    public function create()
    {
        return view('sales.create');
    }

    /**
     * Store a newly created Sale in storage.
     *
     * @param CreateSaleRequest $request
     *
     * @return Response
     */
    public function store(CreateSaleRequest $request)
    {
        $input = $request->all();

        $sale = $this->saleRepository->create($input);

        Flash::success('Sale saved successfully.');

        return redirect(route('sales.index'));
    }

    /**
     * Display the specified Sale.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $sale = $this->saleRepository->find($id);

        if (empty($sale)) {
            Flash::error('Sale not found');

            return redirect(route('sales.index'));
        }

        return view('sales.show')->with('sale', $sale);
    }

    /**
     * Show the form for editing the specified Sale.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $sale = $this->saleRepository->find($id);

        if (empty($sale)) {
            Flash::error('Sale not found');

            return redirect(route('sales.index'));
        }

        return view('sales.edit')->with('sale', $sale);
    }

    /**
     * Update the specified Sale in storage.
     *
     * @param int $id
     * @param UpdateSaleRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSaleRequest $request)
    {
        $sale = $this->saleRepository->find($id);

        if (empty($sale)) {
            Flash::error('Sale not found');

            return redirect(route('sales.index'));
        }

        $sale = $this->saleRepository->update($request->all(), $id);

        Flash::success('Sale updated successfully.');

        return redirect(route('sales.index'));
    }

    /**
     * Remove the specified Sale from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $sale = $this->saleRepository->find($id);

        if (empty($sale)) {
            Flash::error('Sale not found');

            return redirect(route('sales.index'));
        }

        $this->saleRepository->delete($id);

        Flash::success('Sale deleted successfully.');

        return redirect(route('sales.index'));
    }
}
