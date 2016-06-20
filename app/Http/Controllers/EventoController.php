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
            'data_inicial' => 'required|date_format:"d/m/Y"|after:today',
            'data_final' => 'required|date_format:"d/m/Y"|after_equal_format:data_inicial,format:d/m/Y',
            'descricao' => 'required|max:500',
            'lotacao_maxima' => 'required|integer',
            'tipo' => 'required|in:show,balada,teatro,esporte',
        ]);

        try
        {
            Evento::create([
                'organizador_id' => $request->get('organizador_id'),
                'nome' => $request->get('nome'),
                'data_inicial' => Carbon::createFromFormat('d/m/Y', $request->get('data_inicial')),
                'data_final' => Carbon::createFromFormat('d/m/Y', $request->get('data_final')),
                'descricao' => $request->get('descricao'),
                'lotacao_maxima' => $request->get('lotacao_maxima'),
                'tipo' => $request->get('tipo'),
                'publicado' => false
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
        $this->validate($request, [
            'organizador_id' => 'required',
            'nome' => 'required|max:150',
            'data_inicial' => 'required|date_format:"d/m/Y"|after:today',
            'data_final' => 'required|date_format:"d/m/Y"|after_equal_format:data_inicial,format:d/m/Y',
            'descricao' => 'required|max:500',
            'lotacao_maxima' => 'required|integer',
            'tipo' => 'required|in:show,balada,teatro,esporte',
        ]);

        $entry = Evento::find($id);
        if (!$entry)
        {
            abort(404, 'Registro não encontrado.');
        }

        try
        {
            $entry->update([
                'organizador_id' => $request->get('organizador_id'),
                'nome' => $request->get('nome'),
                'data_inicial' => Carbon::createFromFormat('d/m/Y', $request->get('data_inicial')),
                'data_final' => Carbon::createFromFormat('d/m/Y', $request->get('data_final')),
                'descricao' => $request->get('descricao'),
                'lotacao_maxima' => $request->get('lotacao_maxima'),
                'tipo' => $request->get('tipo')
            ]);

            return redirect()->route('admin.evento.edit', [$id])->with('success', 'Registro alterado com sucesso.');
        }
        catch (\Exception $e)
        {
            return redirect()->route('admin.evento.edit', [$id])->with('error', $e->getMessage());
        }
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
            $entry->ingressos()->delete();
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
        $entry = Evento::find($id);

        if (!$entry)
        {
            abort(404, 'Registro não encontrado.');
        }

        try
        {
            if (Carbon::now()->setTime(0,0,0)->timestamp > $entry->data_inicial->setTime(0,0,0)->timestamp)
            {
                throw new \Exception('O evento não pode ser publicado após a data de realização');
            }

            $entry->publicado = true;
            $entry->save();

            return redirect()->route('admin.evento.index')->with('success', 'O evento foi publicado.');
        }
        catch (\Exception $e)
        {
            return redirect()->route('admin.evento.index')->with('error', $e->getMessage());
        }
    }

    public function unpublish($id)
    {
        $entry = Evento::find($id);

        if (!$entry)
        {
            abort(404, 'Registro não encontrado.');
        }

        $entry->publicado = false;
        $entry->save();

        return redirect()->route('admin.evento.index')->with('success', 'O evento foi despublicado.');
    }
}
