<?php

namespace App\Repositories;

use App\Models\Client;
use App\Repositories\BaseRepository;

/**
 * Class ClientRepository
 * @package App\Repositories
 * @version September 3, 2019, 2:20 am -04
*/

class ClientRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nit',
        'razon_social'
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
        return Client::class;
    }
}
