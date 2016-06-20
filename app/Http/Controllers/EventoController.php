<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use App\Models\Organizador;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;

class EventoController extends Controller
{
    public function index()
    {
        $entries = Evento::query()
            ->orderBy('data_inicial', 'desc')
            ->orderBy('nome', 'asc')
            ->get();
        return view('admin.evento.index', ['entries' => $entries]);
    }

    public function create()
    {
        $organizadores = Organizador::all(['id', 'nome']);

        return view('admin.evento.create', [
            'organizadores' => $organizadores
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'organizador_id' => 'required',
            'nome' => 'required|max:150',
            'data_inicial' => 'required|date|after:today',
            'data_final' => 'required|date|after:today',
            'descricao' => 'required|max:500',
            'lotacao_maxima' => 'required|integer',
            'tipo' => 'required|in:show,balada,teatro,esporte',
        ]);

        try
        {
            dd($request->all());

            Evento::create([
                'organizador_id' => $request->get('organizador_id'),
                'nome' => $request->get('nome'),
                'data_inicial' => Carbon::createFromFormat('d/m/Y', $request->get('data_inicial')),
                'data_final' => Carbon::createFromFormat('d/m/Y', $request->get('data_final')),
                'descricao' => $request->get('descricao'),
                'lotacao_maxima' => $request->get('lotacao_maxima'),
                'tipo' => $request->get('tipo'),
                'publicado' => $request->get('publicado'),
            ]);
            return redirect()->route('admin.evento.create')->with('success', 'Registro inserido com sucesso.');
        }
        catch (\Exception $e)
        {
            return redirect()->route('admin.evento.create')->with('error', $e->getMessage());
        }
    }

    public function show(Request $request, $id)
    {
        $entry = Evento::find($id);
        if (!$entry)
        {
            abort(404, 'Registro não encontrado.');
        }

        return view('admin.evento.details', ['entry' => $entry, 'delete_view' => $request->input('delete') == 1,]);
    }

    public function edit($id)
    {
        $entry = Evento::find($id);
        $organizadores = Organizador::all(['id', 'nome']);

        if (!$entry)
        {
            abort(404, 'Registro não encontrado.');
        }

        return view('admin.evento.edit', ['entry' => $entry, 'organizadores' => $organizadores]);
    }

    public function update(Request $request, $id)
    {
        /*$this->validate($request, [
            'nome' => 'required|max:80'
        ]);

        $entry = Evento::find($id);
        if (!$entry)
        {
            abort(404, 'Registro não encontrado.');
        }

        try
        {
            $entry->update(['nome' => $request->get('nome')]);
            return redirect()->route('admin.evento.edit', [$id])->with('success', 'Registro alterado com sucesso.');
        }
        catch (\Exception $e)
        {
            return redirect()->route('admin.evento.edit', [$id])->with('error', $e->getMessage());
        }*/
    }

    public function destroy($id)
    {
        $entry = Evento::find($id);
        if (!$entry)
        {
            abort(404, 'Registro não encontrado.');
        }

        try
        {
            $entry->ingressos->delete();
            $entry->delete();
            return redirect()->route('admin.evento.index')->with('success', 'Registro excluído com sucesso.');
        }
        catch (\Exception $e)
        {
            return redirect()->route('admin.evento.show', [$id, 'delete' => 1])->with('error', $e->getMessage());
        }
    }

    public function publish($id)
    {

    }

    public function unpublish($id)
    {

    }
}
