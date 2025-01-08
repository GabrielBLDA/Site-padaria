<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<img src="https://i.postimg.cc/ncMFCBQb/personagem-novo-bolo-email.png" class="logo" alt="Logo Novo Bolo">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
