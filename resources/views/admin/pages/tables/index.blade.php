@extends('adminlte::page')

@section('title', $title)

@section('content_header')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fas fa-home"></i></a></li>
        <li class="breadcrumb-item active" aria-current="page">Mesas</li>
    </ol>
</nav>

<h1>{{ $title }} <a href="{{ route('tables.create') }}" class="btn btn-dark">Add</a></h1>

@stop

@section('content')
<div class="card">
    <div class="card-header">
        <form action="{{ route('tables.search') }}" method="post" class="form form-inline">
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
                    <th>Identificação</th>
                    <th>Descrição</th>
                    <th width="150px">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tables as $table)
                <tr>
                    <td>{{ $table->identify }}</td>
                    <td>{{ $table->description }}</td>
                    <td>
                        <a href="{{ route('tables.show', $table->id) }}" class="btn btn-warning">Ver</a>
                        <a href="{{ route('tables.edit', $table->id) }}" class="btn btn-primary">Editar</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="card-footer">
        @if (isset($filters))
        {!! $tables->appends($filters)->links() !!}
        @else
        {!! $tables->links() !!}
        @endif
    </div>
</div>
@stop