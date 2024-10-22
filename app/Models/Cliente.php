<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Authenticatable 
{
    use Notifiable;

    protected $table = 'cliente';
    protected $primaryKey = 'id_cliente';
    
    public $timestamps = false;

    protected $fillable = [
        'CPF', 'idade', 'nomesobrenome', 'apelido', 'email', 'senha','foto'
    ];

    // Campos a serem ocultados
    protected $hidden = [
        'senha', // Oculte a senha
        'remember_token', // Token de sessão, se estiver usando
    ];

    // Relacionamentos
    public function localizacoes()
    {
        return $this->hasMany(Localizacao::class, 'id_cliente');
    }

    public function interacoes()
    {
        return $this->hasMany(Interacao::class, 'id_cliente');
    }

    public function getAuthPassword()
    {
        return $this->senha; 
    }
    public function setSenhaAttribute($value)
    {
        $this->attributes['senha'] = bcrypt($value);
    }
    
}
