@extends('layouts.admin')

@section('content')
    <div class="page-header clearfix">
        <h2 class="pull-left">Evento <small>lista</small></h2>
        <div class="pull-right header-buttons">
            <a href="{{ route('admin.evento.create') }}" class="btn btn-primary"><span class="glyphicon glyphicon-plus-sign"></span> Adicionar</a>
        </div>
    </div>

    @include('partials.alerts')

    <form class="form-inline well" action="{{ route('admin.evento.index') }}">
        <p><strong>Buscar</strong></p>
        <div class="form-group">
            <label class="sr-only">Nome</label>
            <input type="text" class="form-control" name="nome" value="{{ Request::get('nome') }}" placeholder="Nome">
        </div>
        <div class="form-group">
            <label class="sr-only">Data</label>
            <input type="text" class="form-control" name="data" value="{{ Request::get('data') }}" placeholder="Data do evento">
        </div>
        <div class="form-group">
            <label class="sr-only">Organizador</label>
            <input type="text" class="form-control" name="organizador" value="{{ Request::get('organizador') }}" placeholder="Organizador">
        </div>
        <div class="checkbox">
            <select class="form-control" name="publicado">
                <optgroup label="Publicado">
                    <option value="">Todos</option>
                    <option value="s" {{ Request::get('publicado') == 's' ? 'selected="selected"' : null }}>Sim</option>
                    <option value="n" {{ Request::get('publicado') == 'n' ? 'selected="selected"' : null }}>Não</option>
                </optgroup>
            </select>
        </div>
        <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-search"></span> Buscar</button>
    </form>

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

