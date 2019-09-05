<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Detail
 * @package App\Models
 * @version September 5, 2019, 5:35 pm -04
 *
 * @property \App\Models\Sale sales
 * @property \App\Models\Product products
 * @property \Illuminate\Database\Eloquent\Collection 
 * @property float precio
 * @property integer cantidad
 * @property integer sales_id
 * @property integer products_id
 */
class Detail extends Model
{
    use SoftDeletes;

    public $table = 'details';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'precio',
        'cantidad',
        'sales_id',
        'products_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'precio' => 'float',
        'cantidad' => 'integer',
        'sales_id' => 'integer',
        'products_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'precio' => 'required',
        'cantidad' => 'required',
        'sales_id' => 'required',
        'products_id' => 'required'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function sales()
    {
        return $this->belongsTo(\App\Models\Sale::class, 'sales_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function products()
    {
        return $this->belongsTo(\App\Models\Product::class, 'products_id');
    }
}
