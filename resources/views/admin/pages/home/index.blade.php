@extends('adminlte::page')

@section('title', $title)

@section('content_header')
<h1>{{ $title }}</h1>
@stop

@section('content')
<div class="card">
    <div class="card-header">
        #Dashboard
    </div>
    <div class="card-body">
        @include('admin.includes.alerts')

    </div>
    <div class="card-footer">
    </div>
</div>
@stop