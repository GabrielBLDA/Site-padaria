<?php
namespace App\Services;

use App\Models\Bolo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class BoloService
{
    public function getBolosList()
    {
        $user = Auth::user();    
        $favoritos = $user ? $user->favoritos()->pluck('bolo_id')->toArray() : [];

        if(Cache::has('estoque_bolos')){
            $lista_bolos = Cache::get('estoque_bolos');
        }else{
            $lista_bolos = \App\Models\Bolo::all();
            Cache::put('estoque_bolos', $lista_bolos, 5);
        }  

        if ($user) {
            $lista_bolos = $lista_bolos->sortByDesc(function ($bolo) use ($favoritos) {
                return in_array($bolo->id, $favoritos) ? 1 : 0;
            });
        }

        return ['lista_bolos' => $lista_bolos, 'favoritos' => $favoritos];
    }

    public function updateBoloControleEmailsEstoque(Bolo $bolo, array $data)
    {
        $estoqueAnterior = $bolo->qtd_disponivel;
        
        if ($estoqueAnterior <= 0 && isset($data['qtd_disponivel']) && $data['qtd_disponivel'] > 0) {
            $favoritos = $bolo->favoritos()->where('email_enviado', false)->get();
            
            $favoritos->each(function($favorito) use ($bolo) {
                dispatch(new \App\Jobs\EnviarAlertaEstoqueJob($favorito->user->email, $bolo));
            });

            $bolo->favoritos()->where('email_enviado', false)->update(['email_enviado' => true]);
        }

        $bolo->update($data);
        return $bolo;
    }
    }