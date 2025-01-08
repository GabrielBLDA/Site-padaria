@component('mail::message')
# O Bolo está Disponível!

Olá! O bolo **{{ $bolo->nome }}** está disponível novamente em nosso estoque.

Aproveite enquanto ele ainda está disponível!

@component('mail::button', ['url' => env('APP_URL') . ':8000/bolo'])
Retornar ao estoque
@endcomponent

Obrigado,<br>
{{ config('app.name') }}
@endcomponent