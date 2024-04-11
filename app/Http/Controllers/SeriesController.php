<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Serie;

class SeriesController extends Controller
{
    public function index() {
        $series = Serie::query()->orderby('nome')->get();

        return view('series.index')
            ->with('series', $series);
    }

    public function create() {
        return view('series.create');
    }

    public function store(Request $request) {
        $nomeSerie = $request->input('nome');
        $serie = new Serie();
        $serie->nome = $nomeSerie;
        $serie->save();

        return redirect('/series');
    }

    public function delete(Request $request) {
        $deleteId = $request->input('id');
        $serieDelete = Serie::find($deleteId);

        if($serieDelete) {
            $serieDelete->delete();
            return response()->json(['message' => 'Item deletado com sucesso']);
        }
        else
            return response()->json(['message' => 'Erro ao excluir a série'], 404);
    }
}
