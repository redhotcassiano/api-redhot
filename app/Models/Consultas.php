<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Consultas extends Model
{
    protected $fillable = [
        'description', 'data_consulta', 'hora_consulta', 'active'
    ];

    public function client()
    {
        return $this->belongsTo('App\User', 'client_id');
    }

    public function doctor()
    {
        return $this->belongsTo('App\User', 'doctor_id');
    }

    public function consultorio()
    {
        return $this->belongsTo('App\Models\Consultorios', 'consultorios_id');
    }

}
