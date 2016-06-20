@extends('layouts.admin')

@section('content')
    <div class="page-header clearfix">
        <h2 class="pull-left">Evento <small>lista</small></h2>
        <div class="pull-right header-buttons">
            <a href="{{ route('admin.evento.create') }}" class="btn btn-primary"><span class="glyphicon glyphicon-plus-sign"></span> Adicionar</a>
        </div>
    </div>

    @include('partials.alerts')

    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Data</th>
                <th>Lotação</th>
                <th>Tipo</th>
                <th>Publicado</th>
                <th>Organizador</th>
                <th></th>
            </tr>
        </thead>
        @foreach($entries as $entry)
            <tr>
                <td><a href="{{ route('admin.evento.show', [$entry->id]) }}">{{ $entry->nome }}</a></td>
                <td>{{ $entry->data_inicial->format('d/m/Y') }}</td>
                <td>{{ $entry->ingressos->count() }}/{{ $entry->lotacao_maxima }}</td>
                <td>{{ $entry->tipo }}</td>
                <td>{{ $entry->publicado ? 'Sim' : 'Não' }}</td>
                <td>{{ $entry->organizador->nome }}</td>
                <td width="1%" nowrap>
                    @if (!$entry->publicado)
                    <a href="{{ route('admin.evento.publish', [$entry->id]) }}" class="btn btn-success btn-sm" title="Publicar">
                        <span class="glyphicon glyphicon-unchecked"></span>
                    </a>
                    @else
                    <a href="{{ route('admin.evento.unpublish', [$entry->id]) }}" class="btn btn-success btn-sm" title="Despublicar">
                        <span class="glyphicon glyphicon-check"></span>
                    </a>
                    @endif
                    <a href="{{ route('admin.evento.edit', [$entry->id]) }}" class="btn btn-info btn-sm" title="Show details">
                        <span class="glyphicon glyphicon-pencil"></span>
                    </a>
                    <a href="{{ route('admin.evento.show', [$entry->id, 'delete' => 1]) }}" class="btn btn-danger btn-sm" title="Show details">
                        <span class="glyphicon glyphicon-trash"></span>
                    </a>
                </td>
            </tr>
        @endforeach
    </table>
@stop

