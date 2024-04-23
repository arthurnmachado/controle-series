<?php

namespace App\Repositories;
use App\Http\Requests\SeriesFormRequest;
use Illuminate\Support\Facades\DB;
use App\Models\Series;
use App\Models\Season;
use App\Models\Episode;


class EloquentSeriesRepository implements SeriesRepository
{
    public function add(SeriesFormRequest $request): Series{
        return DB::transaction(function () use ($request) {
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
    
            return $series;
        });
    }
}