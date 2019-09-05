<?php

namespace App\Repositories;

use App\Models\Detail;
use App\Repositories\BaseRepository;

/**
 * Class DetailRepository
 * @package App\Repositories
 * @version September 5, 2019, 5:35 pm -04
*/

class DetailRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'precio',
        'cantidad',
        'sales_id',
        'products_id'
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
        return Detail::class;
    }
}
