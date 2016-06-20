<?php

Route::get('/', 'HomeController@listarEventos');

Route::get('/evento/{id}', ['uses' => 'HomeController@verEvento', 'as' => 'ver_evento']);

Route::post('/evento/{id}/inscrever', ['uses' => 'HomeController@inscreverNoEvento', 'as' => 'inscricao']);


Route::group(['prefix' => 'admin'], function()
{
    //Route::get('booking/resend/{id}', ['as' => 'booking.resend-request', 'uses' => 'BookingController@resendRequest']);

    //Route::put('booking/confirm/{id}', ['as' => 'booking.confirm', 'uses' => 'BookingController@confirm']);

    Route::get('/', function(){
        return view('admin.home');
    });

    Route::resource('organizador', 'OrganizadorController');

    Route::get('evento/{id}/publish', ['as' => 'admin.evento.publish', 'uses' => 'EventoController@publish']);
    Route::get('evento/{id}/unpublish', ['as' => 'admin.evento.unpublish', 'uses' => 'EventoController@unpublish']);
    Route::resource('evento', 'EventoController');
});
