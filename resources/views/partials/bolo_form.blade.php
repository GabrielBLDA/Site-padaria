<form method="POST" action="{{ $action }}" enctype="multipart/form-data">
    @csrf
    @isset($method)
        @method($method)
    @endisset
    
    @if(isset($method) && $method !== 'GET')
        <div class="text-center mb-4">
            <img class="bolo-imagem-preview" src="{{ isset($bolo) && $bolo->imagem ? asset('storage/' . $bolo->imagem) : asset('img/bolo_generico.png') }}" alt="{{ isset($bolo) ? $bolo->nome : 'Novo Bolo' }}">
        </div>
    @endif

    <div class="form-group mb-3">
        <label for="descricaoBoloInput" class="form-label">Descrição:</label>
        <input 
            type="text" 
            class="form-control @error('nome') is-invalid @enderror" 
            id="descricaoBoloInput" 
            name="nome" 
            value="{{ old('nome', isset($bolo) ? $bolo->nome : '') }}" 
            placeholder="Descrição do bolo">
        @error('nome')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group mb-3">
        <label for="pesoInput" class="form-label">Peso:</label>
        <input 
            type="number" 
            id="pesoInput" 
            name="peso" 
            step="0.01" 
            min="0" 
            class="form-control @error('peso') is-invalid @enderror" 
            value="{{ old('peso', isset($bolo) ? $bolo->peso : '') }}" 
            placeholder="Ex.: 1.5">
        @error('peso')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group mb-3">
        <label for="valorInput" class="form-label">Valor:</label>
        <div class="input-group">
            <span class="input-group-text">$</span>
            <input 
                type="number" 
                id="valorInput" 
                name="valor" 
                step="0.01" 
                min="0" 
                class="form-control @error('valor') is-invalid @enderror" 
                value="{{ old('valor', isset($bolo) ? $bolo->valor : '') }}" 
                placeholder="Ex.: 10.5">
        </div>
        @error('valor')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group mb-3">
        <label for="quantidadeInput" class="form-label">Quantidade:</label>
        <input 
            type="number" 
            id="quantidadeInput" 
            name="qtd_disponivel" 
            step="1" 
            min="0" 
            class="form-control @error('qtd_disponivel') is-invalid @enderror" 
            value="{{ old('qtd_disponivel', isset($bolo) ? $bolo->qtd_disponivel : '') }}" 
            placeholder="Ex.: 10">
        @error('qtd_disponivel')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group mb-3">
        <label for="inputFotoBolo" class="form-label">Imagem:</label>
        <div class="custom-file">
            <input 
                type="file" 
                class="custom-file-input @error('imagem') is-invalid @enderror" 
                id="inputFotoBolo" 
                name="imagem"
                onchange="updateFileName(this)">
            <label class="custom-file-label" for="inputFotoBolo">Selecione uma imagem</label>
            @if(isset($bolo) && $bolo->imagem)
                <small class="form-text text-muted">Arquivo atual: {{ $bolo->imagem }}</small>
            @endif
        </div>
        <small id="fileNameDisplay" class="form-text text-muted"></small>
        @error('imagem')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <button type="submit" class="btn btn-outline-info w-100">{{ $buttonText }}</button>
</form>

<script>
function updateFileName(input) {
    let fileName = input.files[0].name;
    document.getElementById('fileNameDisplay').textContent = 'Arquivo selecionado: ' + fileName;
}
</script>