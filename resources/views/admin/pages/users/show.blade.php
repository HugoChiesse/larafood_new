@extends('adminlte::page')

@section('title', "{$title}: {$user->name}")

@section('content_header')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fas fa-home"></i></a></li>
        <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Usuários</a></li>
        <li class="breadcrumb-item active" aria-current="page">Visualizar</li>
    </ol>
</nav>

<h1>{{ $title }}: <strong>{{ $user->name }}</strong></h1>

@stop

@section('content')
<div class="card">
    <div class="card-body">
        <ul>
            <li>Nome: {{ $user->name }}</li>
            <li>E-mail: {{ $user->email }}</li>
            <li>Empresa: {{ $user->tenant->name }}</li>
        </ul>

    </div>
    <div class="card-footer">
        <form action="{{ route('users.destroy', $user->id) }}" method="post">
            @csrf
            @method('delete')
            <button type="submit" class="btn btn-danger">Deletar o usuário: |{{$user->name}}|</button>
        </form>
    </div>
</div>
@stop