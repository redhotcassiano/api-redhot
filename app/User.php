<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'type_acl'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function consultorios()
    {
        return $this->hasMany('App\Models\Consultorios');
    }

    public function profile()
    {
        return $this->belongsTo('App\Models\Profiles', 'profiles_id');
    }

    public function consultas()
    {
        return $this->hasMany('App\Models\Consultas');
    }

}
