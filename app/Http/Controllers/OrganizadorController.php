<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use App\Models\Organizador;
use Illuminate\Http\Request;

use App\Http\Requests;

class OrganizadorController extends Controller
{
    public function index()
    {
        $entries = Organizador::all();
        return view('admin.organizador.index', ['entries' => $entries]);
    }

    public function create()
    {
        return view('admin.organizador.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nome' => 'required|max:80'
        ]);

        try
        {
            Organizador::create(['nome' => $request->get('nome')]);
            return redirect()->route('admin.organizador.create')->with('success', 'Registro inserido com sucesso.');
        }
        catch (\Exception $e)
        {
            return redirect()->route('admin.organizador.create')->with('error', $e->getMessage());
        }
    }

    public function show(Request $request, $id)
    {
        $entry = Organizador::find($id);
        if (!$entry)
        {
            abort(404, 'Registro não encontrado.');
        }

        return view('admin.organizador.details', ['entry' => $entry, 'delete_view' => $request->input('delete') == 1,]);
    }

    public function edit($id)
    {
        $entry = Organizador::find($id);
        if (!$entry)
        {
            abort(404, 'Registro não encontrado.');
        }

        return view('admin.organizador.edit', ['entry' => $entry]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nome' => 'required|max:80'
        ]);

        $entry = Organizador::find($id);
        if (!$entry)
        {
            abort(404, 'Registro não encontrado.');
        }

        try
        {
            $entry->update(['nome' => $request->get('nome')]);
            return redirect()->route('admin.organizador.edit', [$id])->with('success', 'Registro alterado com sucesso.');
        }
        catch (\Exception $e)
        {
            return redirect()->route('admin.organizador.edit', [$id])->with('error', $e->getMessage());
        }
    }

    public function destroy($id)
    {
        $entry = Organizador::find($id);
        if (!$entry)
        {
            abort(404, 'Registro não encontrado.');
        }

        try
        {
            if ($entry->eventos->count() > 0)
            {
                throw new \Exception('Existem eventos ligados a este Organizador.');
            }

            $entry->delete();
            return redirect()->route('admin.organizador.index')->with('success', 'Registro excluído com sucesso.');
        }
        catch (\Exception $e)
        {
            return redirect()->route('admin.organizador.show', [$id, 'delete' => 1])->with('error', $e->getMessage());
        }
    }
}
