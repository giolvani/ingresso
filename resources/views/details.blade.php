@extends('layouts.master')

@section('content')
    @include('partials.alerts')

    @if (session('ingresso'))
        <div class="alert alert-warning">
            <strong>{{ session('ingresso')->nome }}</strong>, anote seu código para acesso ao evento: {{ session('ingresso')->codigo }}
        </div>
    @endif

    <div class="row">
        <div class="col-sm-4">
            <img class="img-responsive" src="http://placehold.it/350x250" alt="imagem">
        </div>
        <div class="col-sm-8">
            <h2 class="media-heading">{{ $evento->nome }}</h2>
            <p>{{ $evento->descricao }}</p>
            <dl>
                <dt>Data</dt>
                <dd>{{ $evento->data_inicial->format('d/m/Y') }}</dd>
                <dt>Capacidade</dt>
                <dd>{{ $evento->lotacao_maxima }} pessoas</dd>
                <dt>Tipo</dt>
                <dd>{{ $evento->tipo }}</dd>
                <dt>Organização</dt>
                <dd>{{ $evento->organizador->nome }}</dd>
            </dl>
        </div>
    </div>

    <hr>

    <h3>Ingresso <small>preencha o formulário para participar</small></h3>

    @if (count($evento->ingressos) < $evento->lotacao_maxima)
        <?php /*$messages = $validator->errors();*/ ?>
        <form class="form-inline well" action="{{ route('inscricao', ['id' => $evento->id]) }}" method="post">
            {{ csrf_field() }}
            <div class="form-group {{ $errors->has('nome') ? 'has-error' : '' }}">
                <label for="nome">Nome</label>
                <input type="text" class="form-control" id="nome" name="nome" value="{{ old('nome') }}" placeholder="Digite seu nome" maxlength="80">
            </div>
            <div class="form-group {{ $errors->has('cpf') ? 'has-error' : '' }}">
                <label for="cpf">CPF</label>
                <input type="text" class="form-control" id="cpf" name="cpf" value="{{ old('cpf') }}" placeholder="Digite seu CPF" maxlength="11">
            </div>
            <button type="submit" class="btn btn-primary">Participar</button>
        </form>
    @else
        <div class="alert alert-info">Inscrições esgotadas!</div>
    @endif
@stop