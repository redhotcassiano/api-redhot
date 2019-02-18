<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Consultorios extends Model
{
    protected $fillable = [
        'razao_social', 'name', 'active'
    ];

    public function consultas()
    {
        return $this->hasMany('App\Models\Consultas');
    }

    public function info()
    {
        return $this->belongsTo('App\Models\InfoConsultorios', 'consultorios_id');
    }

}
