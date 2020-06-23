@extends('adminlte::page')

@section('title', "{$title}: {$profile->name}")

@section('content_header')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fas fa-home"></i></a></li>
        <li class="breadcrumb-item"><a href="{{ route('profiles.index') }}">Perfis</a></li>
        <li class="breadcrumb-item active" aria-current="page">Visualizar</li>
    </ol>
</nav>

<h1>{{ $title }}: <strong>{{ $profile->name }}</strong></h1>

@stop

@section('content')
<div class="card">
    <div class="card-body">
        <ul>
            <li>Nome: {{ $profile->name }}</li>
            <li>Descrição: {{ $profile->description }}</li>
        </ul>

    </div>
    <div class="card-footer">
        <form action="{{ route('profiles.destroy', $profile->id) }}" method="post">
            @csrf
            @method('delete')
            <button type="submit" class="btn btn-danger">Deletar o plano {{$profile->name}}</button>
        </form>
    </div>
</div>
@stop