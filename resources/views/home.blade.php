@extends('layouts.master')

@section('content')
    <div class="row">
        @foreach($eventos as $evento)
            <div class="col-sm-4 col-md-3">
                <div class="thumbnail">
                    <img src="http://placehold.it/250x200" alt="image">
                    <div class="caption">
                        <h3>{{ str_limit($evento->nome, 16) }}</h3>
                        <p>{{ str_limit($evento->descricao, 30) }}</p>
                        <p>
                            <a href="{{ route('ver_evento', $evento->id) }}" class="btn btn-primary" role="button">Saber mais</a>
                        </p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@stop

