<div class="card" style="width: 100%; position: relative;">
    @php
        $style_sem_estoque = $bolo->qtd_disponivel <= 0 ? 'filter: grayscale(100%);' : '';
    @endphp

    <div class="card-image" style="position: relative;">
        <img class="card-img-top" src="{{ $bolo->imagem ? asset('storage/' . $bolo->imagem) : asset('img/bolo_generico.png') }}" alt="{{ $bolo->nome }}" style="max-height: 255px; width: 100%; height: 100%; object-fit: cover; {{ $style_sem_estoque }}">

        @if ($bolo->qtd_disponivel <= 0)
            <img class="img-sem-estoque" src="{{ asset('img/personagem_sem_estoque.png') }}" alt="Card image cap">
            <p class="legenda-sem-estoque">Opss.. Sem estoque</p>
        @elseif (now()->diffInDays($bolo->created_at) <= 7)
            <div class="novidade-container">
                <img class="img-novidade" src="{{ asset('img/personagem_novidade.png') }}" alt="Card image cap">
                <span class="badge badge-primary badge-novidade">Novidade!</span>
            </div>
        @endif
    </div>

    @auth
        <form method="POST" action="{{ route('favoritar', $bolo->id) }}" style="position: absolute; top: 10px; right: 10px;">
            @csrf
            <button class="favoritar-btn" title="Favoritar">
                <img src="{{ in_array($bolo->id, $favoritos) ? asset('img/fav_full.png') : asset('img/fav_empty.png') }}" alt="Favoritar" style="width: 24px; height: 24px;">
            </button>
        </form>
    @endauth

    <div class="card-body">
        <h5 class="card-title" style="font-size: 1.5rem;">{{ $bolo->nome }}</h5>
        <p class="card-text">Peso: {{ $bolo->peso }} g</p>
        <p class="card-text">Quantidade Disponível: {{ $bolo->qtd_disponivel }}</p>
        <p class="card-text">Valor: R$ {{ $bolo->valor }}</p>
        
        @auth
            <div class="d-flex justify-content-around mt-2">
                <a href="#" class="btn btn-outline-primary">Comprar</a>
                @if (auth()->user()->isAdmin())
                    <form method="get" action="{{ route('bolo.edit', ['bolo' => $bolo->id]) }}">
                        <button type="submit" class="btn btn-outline-info">Editar</button>
                    </form>

                    <form method="POST" action="{{ route('bolo.destroy', $bolo) }}" onsubmit="return confirm('Tem certeza que deseja excluir este bolo?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger">Excluir</button>
                    </form>
                @endif 
            </div>                   
        @endauth
        
    </div>
</div>