<?php
namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BoloResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'nome' => $this->nome,
            'qtd_disponivel' => $this->qtd_disponivel,
            'valor' => $this->valor,
            'imagem' => $this->imagem,
        ];
    }
}