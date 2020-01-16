<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Client
 * @package App\Models
 * @version September 3, 2019, 2:20 am -04
 *
 * @property \Illuminate\Database\Eloquent\Collection clients
 * @property \Illuminate\Database\Eloquent\Collection 
 * @property string nit
 * @property string razon_social
 */
class Client extends Model
{
    public $table = 'clients';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'nit',
        'razon_social'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'nit' => 'string',
        'razon_social' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'nit' => 'required|min:7|max:15|alpha_num',
        'razon_social' => 'required|min:3|max:50|alpha_spaces',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function clients()
    {
        return $this->hasMany(\App\Models\Sale::class, 'clients_id');
    }
}
