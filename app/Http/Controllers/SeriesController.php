<?php

namespace App\Http\Controllers;

use App\Http\Requests\SeriesFormRequest;
use App\Models\Series;
use App\Models\Season;
use App\Models\Episode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SeriesController extends Controller
{
    public function index(Request $request)
    {
        $series = Series::all();
        $mensagemSucesso = $request->session()->get('mensagem.sucesso');

        return view('series.index')
            ->with('series', $series)
            ->with('mensagemSucesso', $mensagemSucesso);
    }

    public function create()
    {
        return view('series.create');
    }

    public function store(SeriesFormRequest $request)
    {
        $series = Series::create($request->all());
        $seasons = [];

        for($i = 1; $i <= $request->seasonsQty; $i++){
            $seasons[] = [
                'series_id'=> $series->id,
                'number' => $i,
            ];
        }
        Season::insert($seasons);

        $episodes = [];
        foreach($series->seasons as $season){
            for($i = 1; $i <= $request->episodesPerSeason; $i++){
                $episodes[] = [
                    'season_id'=> $season->id,
                    'number' => $i,
                ];
            }
        }
        Episode::insert($episodes);

        return to_route('series.index')
            ->with('mensagem.sucesso',"Série '$series->nome' adicionada com sucesso!");
    }

    public function destroy(Series $series, Request $request) {
        $series->delete();

        return to_route('series.index')
            ->with('mensagem.sucesso', "Série '$series->nome' removida com sucesso!");
    }

    public function edit(Series $series) {
        return view("series.edit")
            ->with("serie", $series);
    }

    public function update(Series $series, SeriesFormRequest $request) {
        $series->update($request->all());

        return to_route("series.index")
            ->with("mensagem.sucesso", "Série '$series->nome' editada com sucesso!");
    }
}
