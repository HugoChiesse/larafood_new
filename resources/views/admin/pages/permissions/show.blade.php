@extends('adminlte::page')

@section('title', "{$title}: {$permission->name}")

@section('content_header')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fas fa-home"></i></a></li>
        <li class="breadcrumb-item"><a href="{{ route('permissions.index') }}">Permissões</a></li>
        <li class="breadcrumb-item active" aria-current="page">Visualizar</li>
    </ol>
</nav>

<h1>{{ $title }}: <strong>{{ $permission->name }}</strong></h1>

@stop

@section('content')
<div class="card">
    <div class="card-body">
        <ul>
            <li>Nome: {{ $permission->name }}</li>
            <li>Descrição: {{ $permission->description }}</li>
        </ul>

    </div>
    <div class="card-footer">
        <form action="{{ route('permissions.destroy', $permission->id) }}" method="post">
            @csrf
            @method('delete')
            <button type="submit" class="btn btn-danger">Deletar o plano {{$permission->name}}</button>
        </form>
    </div>
</div>
@stop