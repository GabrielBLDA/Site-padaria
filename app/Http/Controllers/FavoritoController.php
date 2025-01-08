<?php

namespace App\Http\Controllers;

use App\Models\Favorito;
use App\Http\Requests\StoreFavoritoRequest;
use App\Http\Requests\UpdateFavoritoRequest;
use Illuminate\Support\Facades\Auth;

class FavoritoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreFavoritoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store($boloId)
    {
    $bolo = \App\Models\Bolo::findOrFail($boloId);

    $favoritoExistente = Favorito::where('user_id', Auth::id())->where('bolo_id', $boloId)->exists();  

    if ($favoritoExistente) {
        Favorito::where('user_id', Auth::id())->where('bolo_id', $boloId)->delete();  
        
        $message = "Bolo de {$bolo->nome} Removido da lista de Interesses!";
        $removido = true;
    } else {
        Favorito::create([
            'user_id' => Auth::id(),
            'bolo_id' => $boloId,
        ]);
        $message = "Bolo de {$bolo->nome} Adicionado à lista de interesses!";
        $removido = false;
    }

    return redirect()->back()->with('message', $message)->with('removido', $removido);
    }
}
