<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ingresso extends Model
{
    protected $table = 'ingressos';

    protected $fillable = [
        'evento_id', 'codigo', 'nome', 'cpf'
    ];

    protected $hidden = [
        'evento_id'
    ];

    public function evento()
    {
        return $this->hasOne(\App\Models\Evento::class, 'id', 'evento_id');
    }
}
