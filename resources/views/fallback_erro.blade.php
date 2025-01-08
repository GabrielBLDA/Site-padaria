@extends('../layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center align-items-center" style="height: 50vh;">
        <div class="col-md-6 text-center">
            <img src="{{ asset('img/personagem_fallback.png') }}" 
                 alt="Fallback" 
                 class="img-fluid" 
                 style="max-height: 220px; object-fit: contain;">
            <p class="mt-3">Oppss! Algo deu errado...</p>

            <form method="get" action="{{ route('home') }}">
                <button class="btn btn-warning" title="Retornar">
                    Retornar
                </button>
            </form>
        </div>
    </div>
</div>

@endsection
