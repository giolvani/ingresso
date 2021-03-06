@extends('layouts.admin')

@section('content')
    <div class="page-header clearfix">
        <h2 class="pull-left">Evento <small>editar registro</small></h2>
        <div class="pull-right header-buttons">
            <a href="{{ route('admin.evento.index') }}" class="btn btn-default"><span class="glyphicon glyphicon-arrow-left"></span> Voltar</a>
        </div>
    </div>

    @include('partials.alerts')

    <form action="{{ route('admin.evento.update', $entry->id) }}" method="POST" data-toggle="validator" role="form" id="checkin-form">
        {{ method_field('PUT') }}
        {{ csrf_field() }}

        @include('admin.evento.form', ['entry' => $entry])
    </form>
@stop