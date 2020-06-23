@extends('adminlte::page')

@section('title', $title)

@section('content_header')
<h1>{{ $title }}</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        @include('admin.includes.alerts')
        
        <form action="{{ route('plans.store') }}" class="form" method="post">
            @include('admin.pages.plans._partials.form')
        </form>
    </div>
</div>
@stop