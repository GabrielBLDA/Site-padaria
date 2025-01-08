<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorito extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'bolo_id',
        'email_enviado',
        'data_favorito',
    ];

    public $timestamps = true;

     /**
     * Relacionamento com o usuário.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relacionamento com o bolo.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function bolo()
    {
        return $this->belongsTo(Bolo::class);
    }
}
