<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateDetailRequest;
use App\Http\Requests\UpdateDetailRequest;
use App\Models\Detail;
use App\Models\Sale;
use App\Repositories\DetailRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class DetailController extends AppBaseController
{
    /** @var  DetailRepository */
    private $detailRepository;

    public function __construct(DetailRepository $detailRepo)
    {
        $this->detailRepository = $detailRepo;
    }

    /**
     * Store a newly created Detail in storage.
     *
     * @param CreateDetailRequest $request
     *
     * @return Response
     */
    public function store(CreateDetailRequest $request)
    {
        $input = $request->all();

        try
        {
            foreach ($input['carrito'] as $key => $row) {
                $detalle = new Detail();
                $detalle->precio = $row['precio'];
                $detalle->cantidad = $row['cantidad'];
                $detalle->products_id = $row['id'];
                $detalle->sales_id= $input['sale_id'];
                $detalle->save();
            }
            return "Ok";
        }
        catch(\Exception $e)
        {
            $this->eliminar_venta($input['sale_id']);

            return response()->json(["error" => "Ha ocurrido un error!, revise que las cantidades no revasen el stock permitido",
                'e' => $e->getMessage()]);
        }
        catch(\FatalThrowableError $e)
        {
            $this->eliminar_venta($input['sale_id']);

            return response()->json(["error" => "Ha ocurrido un error!, intentelo de nuevo mas adelante",
                'e' => $e->getMessage()]);
        }
    }

    public function eliminar_venta($id)
    {
        $sale = Sale::find($id);
        if(isset($sale))
            $sale->delete();
    }
}
