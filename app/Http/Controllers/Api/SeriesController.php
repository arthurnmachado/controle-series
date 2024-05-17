<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SeriesFormRequest;
use App\Models\Series;
use App\Repositories\SeriesRepository;
use Illuminate\Http\Request;

class SeriesController extends Controller
{
    public function __construct(private SeriesRepository $seriesRepository) 
    {
    }

    public function index(){
        return Series::all();
    }

    public function store(SeriesFormRequest $request){
        if(!$request->seasonsQty || !$request->episodesPerSeason){
            $data = [
                "message" => "Os campos seasonsQty e episodesPerSeason precisam ser enviados."
            ];

            return response()->json($data, 422);
        }

        return response()
            ->json($this->seriesRepository->add($request), 201);
    }

    public function show(int $series){
        $seriesModel = Series::whereId($series)->with("seasons.episodes")->first();

        if($seriesModel === null){
            return response()->json(["message"=> "Series not found"],404);
        }

        return $seriesModel;
    }

    public function update(SeriesFormRequest $request, int $series){
        Series::where('id', $series)->update($request->all());
        return response()->noContent(200);
    }

    public function destroy(int $series){
        Series::destroy($series);
        return response()->noContent();
    }
}
