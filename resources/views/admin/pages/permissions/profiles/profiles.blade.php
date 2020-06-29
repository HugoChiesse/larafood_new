@extends('adminlte::page')

@section('title', $title)

@section('content_header')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fas fa-home"></i></a></li>
        <li class="breadcrumb-item"><a href="{{ route('permissions.index') }}">Permissões</a></li>
        <li class="breadcrumb-item active" aria-current="page">Perfis Vinculados a Permissão</li>
    </ol>
</nav>

<h1>{{ $title }} <a href="" class="btn btn-dark">Add</a></h1>

@stop

@section('content')
<div class="card">
    <div class="card-header">
        <form action="" method="post" class="form form-inline">
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
                    <th width="150px">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($profiles as $profile)
                <tr>
                    <td>{{ $profile->name }}</td>
                    <td>
                        <a href="{{ route('profiles.permission.detach', [$profile->id, $permission->id]) }}" class="btn btn-danger">Desvincular</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="card-footer">
        @if (isset($filters))
        {!! $profiles->appends($filters)->links() !!}
        @else
        {!! $profiles->links() !!}
        @endif
    </div>
</div>
@stop