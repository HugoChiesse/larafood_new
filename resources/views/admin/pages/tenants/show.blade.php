@extends('adminlte::page')

@section('title', $title)

@section('content_header')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fas fa-home"></i></a></li>
        <li class="breadcrumb-item"><a href="{{ route('tenants.index') }}">Empresa</a></li>
        <li class="breadcrumb-item active" aria-current="page">Visualizar</li>
    </ol>
</nav>

<h1>{{ $title }}: <strong>{{ $tenant->name }}</strong></h1>

@stop

@section('content')
<div class="card">
    <div class="card-body">
        <img src="{{ url("storage/{$tenant->logo}") }}" alt="{{ $tenant->title }}" style="max-width: 90px;">
        <ul>
            <li>
                <strong>Plano: </strong> {{ $tenant->plan->name }}
            </li>
            <li>
                <strong>Nome: </strong> {{ $tenant->name }}
            </li>
            <li>
                <strong>URL: </strong> {{ $tenant->url }}
            </li>
            <li>
                <strong>E-mail: </strong> {{ $tenant->email }}
            </li>
            <li>
                <strong>CNPJ: </strong> {{ $tenant->cnpj }}
            </li>
            <li>
                <strong>Ativo: </strong> {{ $tenant->active == 'Y' ? 'SIM' : 'NÃO' }}
            </li>
        </ul>

        <hr>
        <h3>Assinatura</h3>
        <ul>
            <li>
                <strong>Data Assinatura: </strong> {{ $tenant->subscription }}
            </li>
            <li>
                <strong>Data Expira: </strong> {{ $tenant->expires_at }}
            </li>
            <li>
                <strong>Identificador: </strong> {{ $tenant->subscription_id }}
            </li>
            <li>
                <strong>Ativo? </strong> {{ $tenant->subscription_active ? 'SIM' : 'NÃO' }}
            </li>
            <li>
                <strong>Cancelou? </strong> {{ $tenant->subscription_suspended ? 'SIM' : 'NÃO' }}
            </li>
        </ul>

    </div>
</div>
@stop