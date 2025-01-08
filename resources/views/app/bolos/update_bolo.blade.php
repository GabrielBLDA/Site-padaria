@extends('layouts.app')

@section('content')
    @include('partials.alerts')
    
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-info text-white text-center">
                        <h4>Editar Bolo {{ $bolo->nome }}</h4>
                    </div>
                    <div class="card-body">
                        @include('partials.bolo_form', [
                            'action' => route('bolo.update', $bolo->id),
                            'method' => 'PUT',
                            'buttonText' => 'Gravar Alterações'
                        ])
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection