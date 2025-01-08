@extends('../layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-info text-white text-center">
                    <h4>Cadastrar Novo Bolo</h4>
                </div>
                <div class="card-body">
                    @include('partials.bolo_form', [
                        'action' => route('bolo.store'),
                        'buttonText' => 'Cadastrar novo Bolo'
                    ])
                </div>
            </div>
        </div>
    </div>
</div>
@endsection