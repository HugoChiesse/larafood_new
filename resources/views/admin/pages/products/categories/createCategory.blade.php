@extends('adminlte::page')

@section('title', $title)

@section('content_header')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fas fa-home"></i></a></li>
        <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Produto</a></li>
        <li class="breadcrumb-item"><a href="{{ route('products.categories', $product->id) }}">Categoria do Producto</a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">Associar Categoria ao Produto</li>
    </ol>
</nav>

<h1>{{ $title }}</h1>
@stop

@section('content')
<div class="card">
    <div class="card-header">
        <form action="{{ route('products.createCategory', $product->id) }}" method="post" class="form form-inline">
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
                    <th width="40px">#</th>
                    <th>Nome</th>
                </tr>
            </thead>
            <tbody>
                <form action="{{ route('products.storeCategory', $product->id) }}" method="post">
                    @csrf
                    @foreach ($categories as $category)
                    <tr>
                        <td>
                            <input type="checkbox" name="categories[]" value="{{ $category->id }}" id="categories"
                                class="form-control">
                        </td>
                        <td>{{ $category->name }}</td>
                    </tr>
                    @endforeach
                    <tr>
                        <td colspan="500">
                            <button type="submit" class="btn btn-success">Vincular</button>
                        </td>
                    </tr>
                </form>
            </tbody>
        </table>
    </div>
    <div class="card-footer">
        @if (isset($filters))
        {!! $categories->appends($filters)->links() !!}
        @else
        {!! $categories->links() !!}
        @endif
    </div>
</div>
@stop