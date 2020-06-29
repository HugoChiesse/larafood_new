@extends('adminlte::page')

@section('title', "{$title}: {$category->name}")

@section('content_header')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fas fa-home"></i></a></li>
        <li class="breadcrumb-item"><a href="{{ route('categories.index') }}">Categorias</a></li>
        <li class="breadcrumb-item active" aria-current="page">Visualizar</li>
    </ol>
</nav>

<h1>{{ $title }}: <strong>{{ $category->name }}</strong></h1>

@stop

@section('content')
<div class="card">
    <div class="card-body">
        <ul>
            <li>Nome: {{ $category->name }}</li>
            <li>E-mail: {{ $category->url }}</li>
            <li>Empresa: {{ $category->description }}</li>
        </ul>

    </div>
    <div class="card-footer">
        <form action="{{ route('categories.destroy', $category->id) }}" method="post">
            @csrf
            @method('delete')
            <button type="submit" class="btn btn-danger">Deletar a categoria: |{{$category->name}}|</button>
        </form>
    </div>
</div>
@stop