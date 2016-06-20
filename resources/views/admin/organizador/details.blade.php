@extends('layouts.admin')

@section('content')
    <div class="page-header clearfix">
        <h2 class="pull-left">Organizador <small>detalhes do registro</small></h2>
        <div class="pull-right header-buttons">
            <a href="{{ route('admin.organizador.index') }}" class="btn btn-default"><span class="glyphicon glyphicon-arrow-left"></span> Voltar</a>
        </div>
    </div>

    @include('partials.alerts')

    @if ($delete_view)
        <form action="{{ route('admin.organizador.destroy', [$entry->id]) }}" method="POST" role="form">
            {{ method_field('DELETE') }}
            {{ csrf_field() }}
            <div class="alert alert-danger" role="alert">
                <h4>Confirmação!</h4>
                <p>Tem certeza que deseja <strong>EXCLUIR</strong> este registro?</p>
                <p>
                    <button type="submit" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Sim, eu quero!</button>
                    <a href="{{ route('admin.organizador.index') }}" class="btn btn-default">Não</a>
                </p>
            </div>
        </form>
    @endif


    <dl class="dl-horizontal">
        <dt>Nome</dt>
        <dd>{{ $entry->nome }}</dd>
    </dl>
@stop