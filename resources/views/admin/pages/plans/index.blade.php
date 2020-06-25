@extends('adminlte::page')

@section('title', $title)

@section('content_header')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fas fa-home"></i></a></li>
        <li class="breadcrumb-item active" aria-current="page">Planos</li>
    </ol>
</nav>

<h1>{{ $title }} <a href="{{ route('plans.create') }}" class="btn btn-dark">Add</a></h1>

@stop

@section('content')
<div class="card">
    <div class="card-header">
        <form action="{{ route('plans.search') }}" method="post" class="form form-inline">
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
                    <th>Nome</th>
                    <th>Preço</th>
                    <th width="350px">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($plans as $plan)
                <tr>
                    <td>{{ $plan->name }}</td>
                    <td>{{ number_format($plan->price, 2, ',', '.') }}</td>
                    <td>
                        <a href="{{ route('details.index', $plan->id) }}" class="btn btn-secondary">Detalhes</a>
                        <a href="{{ route('plans.show', $plan->id) }}" class="btn btn-warning">Ver</a>
                        <a href="{{ route('plans.edit', $plan->id) }}" class="btn btn-primary">Editar</a>
                        <a href="{{ route('plans.profiles', $plan->id) }}" class="btn btn-dark">Perfis</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="card-footer">
        @if (isset($filters))
        {!! $plans->appends($filters)->links() !!}
        @else
        {!! $plans->links() !!}
        @endif
    </div>
</div>
@stop