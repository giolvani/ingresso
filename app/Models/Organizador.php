<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Organizador extends Model
{
    protected $table = 'organizadores';

    protected $fillable = [
        'nome'
    ];

    public function eventos()
    {
        return $this->hasMany(\App\Models\Evento::class);
    }
}
