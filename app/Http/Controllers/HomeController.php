<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use App\Models\Ingresso;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;

class HomeController extends Controller
{
    public function listarEventos()
    {
        $eventos = Evento::where('publicado', true)
            ->where('data_inicial', '>=', Carbon::now())
            ->orderBy('data', 'asc')
            ->get();

        return view('home', [
            'eventos' => $eventos
        ]);
    }

    public function verEvento($id)
    {
        $evento = Evento::where('publicado', true)->find($id);

        return view('details', [
            'evento' => $evento
        ]);
    }

    public function inscreverNoEvento($id, Request $request)
    {
        // validacao
        $this->validate($request, [
            'nome' => 'required|max:80',
            'cpf' => 'required|max:11',
        ]);

        // consulta evento
        $evento = Evento::find($id);

        if (!$evento)
        {
            abort(404, 'Evento não encontrado.');
        }

        // consulta o ingresso pelo cpf
        $ingresso = $evento->ingressos()->where('cpf', $request->get('cpf'))->first();

        //se o cpf ainda nao tiver cadastro para o evento
        if(!$ingresso)
        {
            $ingresso = $evento->ingressos()->save(new Ingresso([
                'codigo' => random_int(10000000, 99999999),
                'nome' => $request->get('nome'),
                'cpf' => $request->get('cpf')
            ]));
        }

        return redirect()->route('ver_evento', [$id])
            ->with('success', 'Inscrição efetuada com sucesso')
            ->with('ingresso', $ingresso);
    }
}
