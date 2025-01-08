@extends('layouts.app')

@section('content')
    @include('partials.alerts')
    
    <div class="container">
       
        <div class="row justify-content-center">
            @if($lista_bolos->isEmpty())
                <div class="col-md-6 text-center">
                    <img src="{{ asset('img/personagem_lista_limpa.png') }}" alt="Lista_Limpa" class="img-fluid" style="max-height: 220px; object-fit: contain;">
                    <p class="mt-3">Oppss! Parece que não há bolos no estoque...</p>
                    <p class="mt-3">Tente novamente mais tarde</p>
                </div>
            @else
                @foreach ($lista_bolos as $bolo)
                    <div class="col-md-4 mb-4">
                        @include('partials.bolo_card', ['bolo' => $bolo])
                    </div>
                @endforeach
            @endif
        </div>

        @auth
            @if (auth()->user()->isAdmin())
                <div class="row">
                    <div class="col-md-12 d-flex justify-content-center">
                        <form method="get" action="{{ route('bolo.create') }}">
                            <button type="submit" class="btn btn-outline-primary">Adicionar novo Bolo (+)</button>
                        </form>
                    </div>
                </div>
            @endif
        @endauth
    </div>
@endsection