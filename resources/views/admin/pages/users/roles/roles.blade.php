@extends('adminlte::page')

@section('title', $title)

@section('content_header')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fas fa-home"></i></a></li>
        <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Usuários</a></li>
        <li class="breadcrumb-item active" aria-current="page">Cargos do Usuário</li>
    </ol>
</nav>

<h1>{{ $title }} <a href="{{ route('users.roles.available', $user->id) }}" class="btn btn-dark">Add Novo Cargo</a>
</h1>

@stop

@section('content')
<div class="card">
    <div class="card-body">
        <table class="table table-condensed">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th width="50">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($roles as $role)
                <tr>
                    <td>
                        {{ $role->name }}
                    </td>
                    <td style="width=10px;">
                        <a href="{{ route('users.role.detach', [$user->id, $role->id]) }}"
                            class="btn btn-danger">DESVINCULAR</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="card-footer">
        @if (isset($filters))
        {!! $roles->appends($filters)->links() !!}
        @else
        {!! $roles->links() !!}
        @endif
    </div>
</div>
@stop