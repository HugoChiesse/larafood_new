@extends('adminlte::page')

@section('title', $title)

@section('content_header')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fas fa-home"></i></a></li>
        <li class="breadcrumb-item"><a href="{{ route('plans.index') }}">Planos</a></li>
        <li class="breadcrumb-item active" aria-current="page">Detalhes do Plano</li>
    </ol>
</nav>

<h1>{{ $title }} <a href="{{ route('details.create', $plan->id) }}" class="btn btn-dark">Add</a></h1>

@stop

@section('content')
<div class="card">
    <div class="card-body">
        @include('admin.includes.alerts')

        <table class="table table-condensed">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th width="250px">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($details as $detail)
                <tr>
                    <td>{{ $detail->name }}</td>
                    <td>
                        <a href="{{ route('details.show', [$plan->id, $detail->id]) }}" class="btn btn-warning">Ver</a>
                        <a href="{{ route('details.edit', [$plan->id, $detail->id]) }}" class="btn btn-primary">Editar</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="card-footer">
        @if (isset($filters))
        {!! $details->appends($filters)->links() !!}
        @else
        {!! $details->links() !!}
        @endif
    </div>
</div>
@stop