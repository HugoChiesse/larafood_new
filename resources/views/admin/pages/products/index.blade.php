@extends('adminlte::page')

@section('title', $title)

@section('content_header')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fas fa-home"></i></a></li>
        <li class="breadcrumb-item active" aria-current="page">Produtos</li>
    </ol>
</nav>

<h1>{{ $title }} <a href="{{ route('products.create') }}" class="btn btn-dark">Add</a></h1>

@stop

@section('content')
<div class="card">
    <div class="card-header">
        <form action="{{ route('products.search') }}" method="post" class="form form-inline">
            @csrf
            <input type="text" name="filter" placeholder="Nome:" class="form-control"> &nbsp;
            <button type="submit" class="btn btn-dark">Filtar</button>
        </form>
    </div>
    <div class="card-body">
        @include('admin.includes.alerts')

        <table class="table table-condensed">
            <thead>
                <tr>
                    <th>Imagem</th>
                    <th>Título</th>
                    <th>Descrição</th>
                    <th width="250px">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                <tr>
                    <td>
                        <img src="{{ url("storage/{$product->image}") }}" alt="{{ $product->title }}"
                            style="max-width:90px;">
                    </td>
                    <td>{{ $product->title }}</td>
                    <td>{{ $product->description }}</td>
                    <td>
                        <a href="{{ route('products.show', $product->id) }}" class="btn btn-warning">Ver</a>
                        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-primary">Editar</a>
                        <a href="{{ route('products.categories', $product->id) }}" class="btn btn-dark">Categorias</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="card-footer">
        @if (isset($filters))
        {!! $products->appends($filters)->links() !!}
        @else
        {!! $products->links() !!}
        @endif
    </div>
</div>
@stop