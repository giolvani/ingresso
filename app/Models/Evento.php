<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    protected $table = 'eventos';

    protected $fillable = [
        'organizador_id', 'nome', 'data_inicial', 'data_final', 'descricao', 'lotacao_maxima', 'tipo', 'publicado'
    ];

    protected $hidden = [
        'organizador_id'
    ];

    protected $dates = [
        'data_inicial', 'data_final'
    ];

    public function ingressos()
    {
        return $this->hasMany(\App\Models\Ingresso::class);
    }

    public function organizador()
    {
        return $this->hasOne(\App\Models\Organizador::class, 'id', 'organizador_id');
    }
}
