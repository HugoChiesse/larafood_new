@extends('adminlte::page')

@section('title', "{$title}: {$product->name}")

@section('content_header')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fas fa-home"></i></a></li>
        <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Produtos</a></li>
        <li class="breadcrumb-item active" aria-current="page">Visualizar</li>
    </ol>
</nav>

<h1>{{ $title }}: <strong>{{ $product->name }}</strong></h1>

@stop

@section('content')
<div class="card">
    <div class="card-body">
        <ul>
            <li>
                <img src="{{ url("storage/{$product->image}") }}" alt="{{ $product->title }}" style="max-width:90px;">
            </li>
            <li>Título: {{ $product->title }}</li>
            <li>URL: {{ $product->flag }}</li>
            <li>Descrição: {{ $product->description }}</li>
        </ul>

    </div>
    <div class="card-footer">
        <form action="{{ route('products.destroy', $product->id) }}" method="post">
            @csrf
            @method('delete')
            <button type="submit" class="btn btn-danger">Deletar o produto: |{{$product->title}}|</button>
        </form>
    </div>
</div>
@stop