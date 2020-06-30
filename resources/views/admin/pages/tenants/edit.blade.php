@extends('adminlte::page')

@section('title', $title)

@section('content_header')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fas fa-home"></i></a></li>
        <li class="breadcrumb-item"><a href="{{ route('tenants.index') }}">Empresa</a></li>
        <li class="breadcrumb-item active" aria-current="page">Editar</li>
    </ol>
</nav>
<h1>{{ $title }}</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        @include('admin.includes.alerts')
        
        <form action="{{ route('tenants.update', $tenant->id) }}" class="form" method="post" enctype="multipart/form-data">
            @method('put')
            @include('admin.pages.tenants._partials.form')
        </form>
    </div>
</div>
@stop