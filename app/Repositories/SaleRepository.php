<?php

namespace App\Repositories;

use App\Models\Sale;
use App\Repositories\BaseRepository;

/**
 * Class SaleRepository
 * @package App\Repositories
 * @version September 5, 2019, 5:35 pm -04
*/

class SaleRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'numero',
        'numero_ticket',
        'fecha',
        'concepto',
        'nit',
        'razon_social',
        'estado',
        'users_id',
        'clients_id'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Sale::class;
    }
}
