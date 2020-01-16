<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Product
 * @package App\Models
 * @version September 3, 2019, 2:20 am -04
 *
 * @property \Illuminate\Database\Eloquent\Collection 
 * @property \Illuminate\Database\Eloquent\Collection products
 * @property string categoria
 * @property string nombre
 * @property float precio
 * @property string fotografia
 */
class Product extends Model
{
    public $table = 'products';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'categoria',
        'nombre',
        'precio',
        'fotografia'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'categoria' => 'string',
        'nombre' => 'string',
        'precio' => 'float',
        'fotografia' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'categoria' => 'required|min:3|max:50',
        'nombre' => 'required|min:5|max:50|alpha_num_spaces',
        'precio' => 'required|numeric|min:0.2|max:5000'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function products()
    {
        return $this->hasMany(\App\Models\Detail::class, 'products_id');
    }
}
