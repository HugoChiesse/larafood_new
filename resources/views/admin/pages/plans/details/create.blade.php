@extends('adminlte::page')

@section('title', $title)

@section('content_header')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fas fa-home"></i></a></li>
        <li class="breadcrumb-item"><a href="{{ route('plans.index') }}">Planos</a></li>
        <li class="breadcrumb-item"><a href="{{ route('details.index', $plan->id) }}">Detalhes do Plano</a></li>
        <li class="breadcrumb-item active" aria-current="page">Novo Detalhe</li>
    </ol>
</nav>

<h1>{{ $title }}</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        @include('admin.includes.alerts')
        
        <form action="{{ route('details.store', $plan->id) }}" class="form" method="post">
            @include('admin.pages.plans.details._partials.form')
        </form>
    </div>
</div>
@stop