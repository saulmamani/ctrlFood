<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Sale
 * @package App\Models
 * @version September 5, 2019, 5:35 pm -04
 *
 * @property \App\Models\User users
 * @property \App\Models\Client clients
 * @property \Illuminate\Database\Eloquent\Collection sales
 * @property string|\Carbon\Carbon fecha
 * @property string concepto
 * @property string nit
 * @property string razon_social
 * @property boolean estado
 * @property integer users_id
 * @property integer clients_id
 */
class Sale extends Model
{
    public $table = 'sales';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
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
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'fecha' => 'datetime',
        'concepto' => 'string',
        'nit' => 'string',
        'razon_social' => 'string',
        'estado' => 'boolean',
        'users_id' => 'integer',
        'clients_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'nit' => 'required|min:7|max:15|alpha_num',
        'razon_social' => 'required|min:3|max:50|alpha_spaces',
        'concepto' => 'required|min:5|max:100|alpha_num_spaces',
    ];

    //datos calculados
    public $appends = ['total'];
    public function getTotalAttribute()
    {
        $total = \DB::select('select sum(precio * cantidad) as total from details where sales_id = ? group by sales_id', [$this->id]);
        if(count($total))
            return $total[0]->total;
        else
            return 0;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function users()
    {
        return $this->belongsTo(\App\User::class, 'users_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function clients()
    {
        return $this->belongsTo(\App\Models\Client::class, 'clients_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function details()
    {
        return $this->hasMany(\App\Models\Detail::class, 'sales_id');
    }
}
