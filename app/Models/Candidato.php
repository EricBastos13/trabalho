<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Candidato extends Model
{
    protected $table = 'candidato';
    protected $primaryKey = 'id_candidato';
    
    public $timestamps = false;

    protected $fillable = ['id_candidato'];
    public function interacoes()
    {
        return $this->hasMany(Interacao::class, 'id_candidato');
    }

    
}
