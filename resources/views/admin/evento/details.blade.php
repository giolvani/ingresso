@extends('layouts.admin')

@section('content')
    <div class="page-header clearfix">
        <h2 class="pull-left">Organizador <small>detalhes do registro</small></h2>
        <div class="pull-right header-buttons">
            <a href="{{ route('admin.evento.index') }}" class="btn btn-default"><span class="glyphicon glyphicon-arrow-left"></span> Voltar</a>
        </div>
    </div>

    @include('partials.alerts')

    @if ($delete_view)
        <form action="{{ route('admin.evento.destroy', [$entry->id]) }}" method="POST" role="form">
            {{ method_field('DELETE') }}
            {{ csrf_field() }}
            <div class="alert alert-danger" role="alert">
                <h4>Confirmação!</h4>
                <p>Tem certeza que deseja <strong>EXCLUIR</strong> este evento e todas suas inscrições?</p>
                <p>
                    <button type="submit" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Sim, eu quero!</button>
                    <a href="{{ route('admin.evento.index') }}" class="btn btn-default">Não</a>
                </p>
            </div>
        </form>
    @endif


    <dl class="dl-horizontal">
        <dt>Nome</dt>
        <dd>{{ $entry->nome }}</dd>

        <dt>Descrição</dt>
        <dd>{!! nl2br($entry->descricao) !!}</dd>

        <dt>Data Inicial</dt>
        <dd>{{ $entry->data_inicial->format('d/m/Y') }}</dd>

        <dt>Data Final</dt>
        <dd>{{ $entry->data_final->format('d/m/Y') }}</dd>

        <dt>Lotação</dt>
        <dd><strong>{{ $entry->ingressos->count() }}/{{ $entry->lotacao_maxima }}</strong></dd>

        <dt>Tipo</dt>
        <dd>{{ $entry->tipo }}</dd>

        <dt>Publicado</dt>
        <dd>{{ $entry->publicado ? 'Sim' : 'Não' }}</dd>
    </dl>

    @if (!$delete_view)
        <hr>
        <h3>Ingressos adquiridos</h3>

        <table class="table">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Documento</th>
                </tr>
            </thead>
            @foreach($entry->ingressos as $item)
                <tr>
                    <td>{{ $item->nome }}</td>
                    <td>{{ $item->cpf }}</td>
                </tr>
            @endforeach
        </table>
    @endif
@stop