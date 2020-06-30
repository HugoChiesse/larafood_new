@extends('adminlte::page')

@section('title', "{$title}: {$role->name}")

@section('content_header')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fas fa-home"></i></a></li>
        <li class="breadcrumb-item"><a href="{{ route('roles.index') }}">Cargos</a></li>
        <li class="breadcrumb-item active" aria-current="page">Visualizar</li>
    </ol>
</nav>

<h1>{{ $title }}: <strong>{{ $role->name }}</strong></h1>

@stop

@section('content')
<div class="card">
    <div class="card-body">
        <ul>
            <li>Nome: {{ $role->name }}</li>
            <li>Descrição: {{ $role->description }}</li>
        </ul>

    </div>
    <div class="card-footer">
        <form action="{{ route('roles.destroy', $role->id) }}" method="post">
            @csrf
            @method('delete')
            <button type="submit" class="btn btn-danger">Deletar o cargo |{{$role->name}}|</button>
        </form>
    </div>
</div>
@stop