@extends('adminlte::page')

@section('title', $title)

@section('content_header')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fas fa-home"></i></a></li>
        <li class="breadcrumb-item active" aria-current="page">Empresa</li>
    </ol>
</nav>

<h1>{{ $title }} <a href="{{ route('tenants.create') }}" class="btn btn-dark">Add</a></h1>

@stop

@section('content')
<div class="card">
    <div class="card-body">
        @include('admin.includes.alerts')

        <table class="table table-condensed">
            <thead>
                <tr>
                    <th width="100">Imagem</th>
                    <th>Nome</th>
                    <th width="150">Ações</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <img src="{{ url("storage/{$tenant->logo}") }}" alt="{{ $tenant->title }}"
                            style="max-width: 90px;">
                    </td>
                    <td>{{ $tenant->name }}</td>
                    <td style="width=10px;">
                        <a href="{{ route('tenants.edit', $tenant->id) }}" class="btn btn-info">Edit</a>
                        <a href="{{ route('tenants.show', $tenant->id) }}" class="btn btn-warning">VER</a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@stop