@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1 class="text-center">Formulário de Bebida</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        @if (isset($bebidas))
            {!! Form::model($bebidas, ['route' => ['bebida.update', $bebidas->id], 'method' => 'PUT', 'files' => true]) !!}
        @else
            {!! Form::open(['url' => route('bebida.store'), 'files' => true]) !!}
        @endif
            <div class="form-group">
                {!! Form::label('nome', 'Nome') !!}
                {!! Form::text('nome', null, ['class' => 'form-control ']) !!}
                @error('nome') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                {!! Form::label('foto', 'Imagem') !!}
                {!! Form::file('foto_atemp', null, ['class' => 'form-control-file']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('preco', 'Preço') !!}
                {!! Form::number('preco', null, ['class' => 'form-control', 'step' => 0.010 ,'placeholder' => 'R$ 00,00']) !!}
                @error('preco') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                {!! Form::label('categoria', 'Categoria') !!}
                {!! Form::select('categoria', $categoria, null, ['class' => 'form-control ']) !!}
                @error('categoria') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            {!! Form::submit('Salvar', ['class' => 'btn btn-primary']) !!}
        {!! Form::close() !!}
    </div>
</div>
@stop

@section('css')

@stop

@section('js')
    <script>
        document.getElementById("preco").addEventListener("change", function() {
            this.value = parseFloat(this.value).toFixed(2);
        })
    </script>
@stop  