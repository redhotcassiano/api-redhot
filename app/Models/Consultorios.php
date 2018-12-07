<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Consultorios extends Model
{
    protected $fillable = [
        'razao_social', 'name', 'active'
    ];
}
