<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Localizacao extends Model
{
    protected $table = 'localizacao';
    protected $primaryKey = 'id_localizacao';
    
    public $timestamps = false;

    protected $fillable = [
        'id_cliente', 'cidade', 'estado', 'cep'
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'id_cliente');
    }
}
