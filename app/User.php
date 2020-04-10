<?php

namespace App;

use http\Env\Request;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'rol', 'fotografia'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public static function rules($isEdit = false, \Illuminate\Http\Request $request = null)
    {
        $email = $isEdit ? 'required|min:5|max:50|unique:users,email,' . $request->route('user') : 'required|min:5|max:50|unique:users,email';
        return $rules = [
            'email' => $email,
            'name' => 'required|min:3|max:50|alpha_spaces',
            'rol' => 'required',
        ];
    }


    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
