<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Interacao extends Model
{
    protected $table = 'interacao';
    protected $primaryKey = 'id_interacao';
    
    public $timestamps = false;

    protected $fillable = [
        'id_cliente', 'id_candidato', 'tipo'
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'id_cliente');
    }

    public function candidato()
    {
        return $this->belongsTo(Candidato::class, 'id_candidato');
    }
}
