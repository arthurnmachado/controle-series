<?php

namespace App\Http\Controllers;

use App\Models\Serie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SeriesController extends Controller
{
    public function index(Request $request)
    {
        $series = Serie::query()->orderBy('nome')->get();
        $mensagemSucesso = $request->session()->get('mensagem.sucesso');

        return view('series.index')
            ->with('series', $series)
            ->with('mensagemSucesso', $mensagemSucesso);
    }

    public function create()
    {
        return view('series.create');
    }

    public function store(Request $request)
    {
        $series = Serie::create($request->all());

        return to_route('series.index')
            ->with('mensagem.sucesso',"Série '$series->nome' adicionada com sucesso!");
    }

    public function destroy(Serie $series, Request $request) {
        $series->delete();

        return to_route('series.index')
            ->with('mensagem.sucesso', "Série '$series->nome' removida com sucesso!");
    }

    public function edit(Serie $series) {
        return view("series.edit")
            ->with("serie", $series);
    }

    public function update(Serie $series, Request $request) {
        $series->update($request->all());

        return to_route("series.index")
            ->with("mensagem.sucesso", "Série '$series->nome' editada com sucesso!");
    }
}
