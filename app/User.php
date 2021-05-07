<?php

namespace App;

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
        'dni','first_name','second_name','first_last_name','second_last_name', 'password',
    ];

    protected $dates = ['deleted_at'];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function setPasswordAttribute($valor){
        if( ! empty($valor)){
            $this->attributes['password'] = bcrypt($valor);
        }
    }
}
