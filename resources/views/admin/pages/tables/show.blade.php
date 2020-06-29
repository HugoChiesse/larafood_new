@extends('adminlte::page')

@section('title', "{$title}: {$table->name}")

@section('content_header')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fas fa-home"></i></a></li>
        <li class="breadcrumb-item"><a href="{{ route('tables.index') }}">Mesas</a></li>
        <li class="breadcrumb-item active" aria-current="page">Visualizar</li>
    </ol>
</nav>

<h1>{{ $title }}: <strong>{{ $table->name }}</strong></h1>

@stop

@section('content')
<div class="card">
    <div class="card-body">
        <ul>
            <li>Identificação: {{ $table->identify }}</li>
            <li>Empresa: {{ $table->description }}</li>
        </ul>

    </div>
    <div class="card-footer">
        <form action="{{ route('tables.destroy', $table->id) }}" method="post">
            @csrf
            @method('delete')
            <button type="submit" class="btn btn-danger">Deletar a mesa: |{{$table->identify}}|</button>
        </form>
    </div>
</div>
@stop