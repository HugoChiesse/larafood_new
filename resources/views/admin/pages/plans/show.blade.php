@extends('adminlte::page')

@section('title', "{$title}: {$plan->name}")

@section('content_header')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fas fa-home"></i></a></li>
        <li class="breadcrumb-item"><a href="{{ route('plans.index') }}">Planos</a></li>
        <li class="breadcrumb-item active" aria-current="page">Visualizar</li>
    </ol>
</nav>

<h1>{{ $title }}: <strong>{{ $plan->name }}</strong></h1>

@stop

@section('content')
<div class="card">
    <div class="card-body">
        <ul>
            <li>Nome: {{ $plan->name }}</li>
            <li>URL: {{ $plan->url }}</li>
            <li>Preço: {{ number_format($plan->price, 2, ',', '.') }}</li>
            <li>Descrição: {{ $plan->description }}</li>
        </ul>

    </div>
    <div class="card-footer">
        <form action="{{ route('plans.destroy', $plan->id) }}" method="post">
            @csrf
            @method('delete')
            <button type="submit" class="btn btn-danger">Deletar o plano {{$plan->name}}</button>
        </form>
    </div>
</div>
@stop