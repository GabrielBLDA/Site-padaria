@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

@if(session('deleted'))
    <div class="alert alert-danger">{{ session('deleted') }}</div>
@endif

@if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif

@php
    $alertType = (session('removido') || session('deleted')) ? 'alert-warning' : 'alert-info';
    $message = session('message');
@endphp

@if ($message)
    <div class="alert {{ $alertType }}">{{ $message }}</div>
@endif