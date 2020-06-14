@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1 class="text-center">Formulário de Lanches</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
            {!! Form::open(['url' => route('lanche.store'), 'files' => true]) !!}
            <div class="form-group">
                {!! Form::label('nome', 'Nome') !!}
                {!! Form::text('nome', null, ['class' => 'form-control ']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('descricao', 'Descriçao') !!}
                {!! Form::textArea('descricao', null, ['class' => 'form-control ', 'rows' => 2, 'cols' => 2]) !!}
            </div>

            <div class="form-group">
                {!! Form::label('foto_atemp', 'Imagem') !!}
                {!! Form::file('foto_atemp', null, ['class' => 'form-control ']) !!}
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    {!! Form::label('categoria', 'Categoria') !!}
                    {!! Form::select('categoria', $categoria , null, ['class' => 'form-control ']) !!}
                </div>

                <div class="form-group col-md-6">
                    {!! Form::label('preco', 'Preço') !!}
                    {!! Form::number('preco', null, ['class' => 'form-control ', 'step' => 0.010]) !!}
                </div>
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
      document.getElementById('preco').addEventListener("change", function() {
          this.value = parseFloat(this.value).toFixed(2);
      });
  </script>
@stop  