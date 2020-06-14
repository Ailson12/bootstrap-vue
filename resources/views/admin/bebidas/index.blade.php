@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')

@stop

@section('content')
  <div class="card">
    <div class="card-body">
      {!! $dataTable->table() !!}
    </div>
  </div>
@stop

@section('css')
  
@stop

@section('js')
 {!! $dataTable->scripts() !!}
@stop  