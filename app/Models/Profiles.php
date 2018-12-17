<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profiles extends Model
{
    protected $fillable = [
        'name', 'type', 'active'
    ];

    public function users()
    {
        return $this->hasMany('App\User');
    }
}
