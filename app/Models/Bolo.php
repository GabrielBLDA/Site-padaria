<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bolo extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'peso',
        'qtd_disponivel',
        'valor',
        'imagem',
    ];

    public function favoritos()
    {
        return $this->hasMany(Favorito::class);
    }
}
