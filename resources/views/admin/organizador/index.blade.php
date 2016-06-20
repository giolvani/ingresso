@extends('layouts.admin')

@section('content')
    <div class="page-header clearfix">
        <h2 class="pull-left">Organizador <small>lista</small></h2>
        <div class="pull-right header-buttons">
            <a href="{{ route('admin.organizador.create') }}" class="btn btn-primary"><span class="glyphicon glyphicon-plus-sign"></span> Adicionar</a>
        </div>
    </div>

    @include('partials.alerts')

    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>Nome</th>
                <th></th>
            </tr>
        </thead>
        @foreach($entries as $entry)
            <tr>
                <td>{{ $entry->nome }}</td>
                <td width="1%" nowrap>
                    <a href="{{ route('admin.organizador.edit', [$entry->id]) }}" class="btn btn-info btn-sm" title="Show details">
                        <span class="glyphicon glyphicon-pencil"></span>
                    </a>
                    <a href="{{ route('admin.organizador.show', [$entry->id, 'delete' => 1]) }}" class="btn btn-danger btn-sm" title="Show details">
                        <span class="glyphicon glyphicon-trash"></span>
                    </a>
                </td>
            </tr>
        @endforeach
    </table>
@stop

