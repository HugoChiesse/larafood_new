@extends('adminlte::page')

@section('title', "{$title}: {$plan->name}")

@section('content_header')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fas fa-home"></i></a></li>
        <li class="breadcrumb-item"><a href="{{ route('plans.index') }}">Planos</a></li>
        <li class="breadcrumb-item"><a href="{{ route('details.index', $plan->id) }}">Detalhes do Plano</a></li>
        <li class="breadcrumb-item active" aria-current="page">Visualizar Detalhe</li>
    </ol>
</nav>

<h1>{{ $title }}</h1>

@stop

@section('content')
<div class="card">
    <div class="card-body">
        <ul>
            <li>Nome: {{ $detail->name }}</li>
        </ul>

    </div>
    <div class="card-footer">
        <form action="{{ route('details.destroy', [$plan->id, $detail->id]) }}" method="post">
            @csrf
            @method('delete')
            <button type="submit" class="btn btn-danger">Deletar o detalhe do plano |{{$plan->name}}|</button>
        </form>
    </div>
</div>
@stop